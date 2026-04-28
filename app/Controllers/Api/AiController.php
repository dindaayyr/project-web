<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PackageModel;
use CodeIgniter\API\ResponseTrait;

class AiController extends BaseController
{
    use ResponseTrait;

    /**
     * Menerima prompt teks dari user dan mengembalikan paket yang cocok.
     *
     * Flow:
     * 1. User input: "Umroh murah 25 juta berangkat dari Jakarta"
     * 2. Kirim prompt ke AI API → dapatkan JSON filter
     * 3. Query database berdasarkan filter
     * 4. Return hasil paket yang cocok
     */
    public function search()
    {
        $prompt = $this->request->getJSON(true)['prompt'] ?? '';

        if (empty($prompt)) {
            return $this->fail('Prompt tidak boleh kosong.', 400);
        }

        // Step 1: Parse prompt menggunakan AI API
        $filters = $this->parsePromptWithAI($prompt);

        // Step 2: Query database berdasarkan filter
        $packageModel = new PackageModel();
        $packages = $packageModel->getFiltered($filters);

        return $this->respond([
            'status'      => 'success',
            'prompt'      => $prompt,
            'filters'     => $filters,
            'total'       => count($packages),
            'packages'    => $packages,
        ]);
    }

    /**
     * Endpoint untuk menerima input teks dari AI Assistant (NLP).
     * Tujuannya agar AI bisa memfilter data berdasarkan prompt user.
     */
    public function searchNLP()
    {
        $input = $this->request->getJSON(true);
        $query = $input['query'] ?? $input['prompt'] ?? '';

        if (empty($query)) {
            return $this->fail('Query tidak boleh kosong.', 400);
        }

        $filters = $this->parsePromptWithAI($query);

        $packageModel = new PackageModel();
        $packages = $packageModel->getFiltered($filters);

        // Format response for AI consumption
        $formatted = array_map(function($pkg) {
            return [
                'id'              => $pkg['id'],
                'nama_paket'      => $pkg['nama_paket'],
                'harga'           => 'Rp ' . number_format($pkg['harga_jual'], 0, ',', '.'),
                'harga_raw'       => (float)$pkg['harga_jual'],
                'maskapai'        => $pkg['maskapai'],
                'program_hari'    => $pkg['program_hari'] . ' Hari',
                'tanggal'         => $pkg['tanggal_berangkat'],
                'hotel_madinah'   => ($pkg['hotel_madinah'] ?? '-') . ' (' . ($pkg['bintang_madinah'] ?? 3) . '★)',
                'hotel_mekkah'    => ($pkg['hotel_mekkah'] ?? '-') . ' (' . ($pkg['bintang_mekkah'] ?? 3) . '★)',
                'sisa_kuota'      => $pkg['available_seat'] . '/' . $pkg['total_seat'],
                'travel'          => $pkg['travel_name'] ?? '',
                'url'             => base_url('/katalog/detail/' . $pkg['id']),
            ];
        }, $packages);

        return $this->respond([
            'status'   => 'success',
            'query'    => $query,
            'filters'  => $filters,
            'total'    => count($formatted),
            'results'  => $formatted,
        ]);
    }

    /**
     * Parse user prompt menggunakan AI API (Gemini/OpenAI).
     * Jika API tidak tersedia, gunakan rule-based parsing sebagai fallback.
     *
     * Contoh prompt: "Umroh murah 25 juta berangkat dari Jakarta bulan Juli"
     * Expected output: ['max_price' => 25000000, 'departure_city' => 'Jakarta']
     */
    private function parsePromptWithAI(string $prompt): array
    {
        $apiKey = env('AI_API_KEY', '');

        // Jika API key tersedia, gunakan AI API
        if (!empty($apiKey)) {
            return $this->callAiApi($prompt, $apiKey);
        }

        // Fallback: rule-based parsing
        return $this->ruleBasedParsing($prompt);
    }

    /**
     * Kirim prompt ke Gemini API untuk parsing NLP
     */
    private function callAiApi(string $prompt, string $apiKey): array
    {
        $systemPrompt = "Kamu adalah asisten pencarian paket umroh. Dari prompt user, ekstrak filter pencarian dalam format JSON.
        Field yang tersedia:
        - max_price: integer (budget maksimal dalam rupiah)
        - min_price: integer (budget minimal dalam rupiah)
        - departure_city: string (kota keberangkatan)
        - hotel_star: integer (bintang hotel, 3-5)
        - duration: integer (durasi hari)
        - airline: string (nama maskapai)
        - sort_by: string (popular/cheapest/fastest)

        Contoh input: 'Umroh murah 25 juta berangkat dari Jakarta'
        Contoh output: {\"max_price\": 25000000, \"departure_city\": \"Jakarta\", \"sort_by\": \"cheapest\"}

        Input: 'Cari paket hotel bintang 5'
        Output: {\"hotel_star\": 5}

        Hanya kembalikan JSON, tanpa penjelasan tambahan.";

        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey,
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'json'    => [
                        'contents' => [
                            [
                                'parts' => [
                                    ['text' => $systemPrompt . "\n\nUser prompt: " . $prompt]
                                ]
                            ]
                        ]
                    ],
                    'timeout' => 10,
                ]
            );

            $body = json_decode($response->getBody(), true);
            $text = $body['candidates'][0]['content']['parts'][0]['text'] ?? '';

            // Extract JSON from response
            preg_match('/\{[^}]+\}/', $text, $matches);
            if (!empty($matches[0])) {
                $parsed = json_decode($matches[0], true);
                if (is_array($parsed)) {
                    return $parsed;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'AI API Error: ' . $e->getMessage());
        }

        // Fallback jika AI gagal
        return $this->ruleBasedParsing($prompt);
    }

    /**
     * Rule-based parsing sebagai fallback jika AI API tidak tersedia
     */
    private function ruleBasedParsing(string $prompt): array
    {
        $filters = [];
        $prompt = strtolower($prompt);

        // Parse harga/budget
        if (preg_match('/(\d+)\s*juta/', $prompt, $matches)) {
            $amount = (int)$matches[1] * 1000000;
            if (strpos($prompt, 'murah') !== false || strpos($prompt, 'budget') !== false || strpos($prompt, 'dibawah') !== false || strpos($prompt, 'maksimal') !== false) {
                $filters['max_price'] = $amount;
                $filters['sort_by'] = 'cheapest';
            } else {
                $filters['max_price'] = $amount;
            }
        }

        // Parse kota keberangkatan
        $cities = ['jakarta', 'surabaya', 'bandung', 'medan', 'makassar', 'semarang', 'yogyakarta'];
        foreach ($cities as $city) {
            if (strpos($prompt, $city) !== false) {
                $filters['departure_city'] = ucfirst($city);
                break;
            }
        }

        // Parse bintang hotel
        if (preg_match('/bintang\s*(\d)/', $prompt, $matches)) {
            $filters['hotel_star'] = (int)$matches[1];
        } elseif (strpos($prompt, 'premium') !== false || strpos($prompt, 'mewah') !== false || strpos($prompt, 'vip') !== false) {
            $filters['hotel_star'] = 5;
        }

        // Parse durasi
        if (preg_match('/(\d+)\s*hari/', $prompt, $matches)) {
            $filters['duration'] = (int)$matches[1];
        }

        // Parse maskapai
        $airlines = ['garuda' => 'Garuda Indonesia', 'saudi' => 'Saudi Airlines', 'emirates' => 'Emirates', 'turkish' => 'Turkish Airlines', 'lion' => 'Lion Air'];
        foreach ($airlines as $key => $value) {
            if (strpos($prompt, $key) !== false) {
                $filters['airline'] = $value;
                break;
            }
        }

        // Parse sorting preference
        if (strpos($prompt, 'murah') !== false || strpos($prompt, 'hemat') !== false) {
            $filters['sort_by'] = 'cheapest';
        } elseif (strpos($prompt, 'cepat') !== false || strpos($prompt, 'singkat') !== false || strpos($prompt, 'kilat') !== false) {
            $filters['sort_by'] = 'fastest';
        }

        return $filters;
    }
}

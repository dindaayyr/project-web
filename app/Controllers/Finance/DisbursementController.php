<?php

namespace App\Controllers\Finance;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\DisbursementModel;

class DisbursementController extends BaseController
{
    protected $bookingModel;
    protected $disbursementModel;

    private const COMMISSION_RATE = 5.00; // 5% platform commission

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->disbursementModel = new DisbursementModel();
    }

    /**
     * Show list of transactions ready for disbursement.
     * Rule: Only show bookings where departure date is within H-14 and status is success.
     */
    public function index()
    {
        $readyBookings = $this->bookingModel->getReadyForDisbursement();

        $disbursementList = [];
        foreach ($readyBookings as $booking) {
            $grossAmount      = (float)$booking['total_price'];
            $commissionAmount = round($grossAmount * (self::COMMISSION_RATE / 100), 2);
            $netAmount        = $grossAmount - $commissionAmount;

            $disbursementList[] = [
                'booking'           => $booking,
                'gross_amount'      => $grossAmount,
                'commission_rate'   => self::COMMISSION_RATE,
                'commission_amount' => $commissionAmount,
                'net_amount'        => $netAmount,
            ];
        }

        $data = [
            'disbursementList' => $disbursementList,
            'commissionRate'   => self::COMMISSION_RATE,
            'pageTitle'        => 'Pencairan Dana Agen | UmrohQueens'
        ];

        return view('finance/disbursements', $data);
    }

    /**
     * Process a disbursement for a specific booking
     */
    public function process($bookingId)
    {
        $booking = $this->bookingModel
            ->select('bookings.*, paket_umroh.travel_agent_id')
            ->join('paket_umroh', 'paket_umroh.id_paket = bookings.package_id')
            ->where('bookings.id', $bookingId)
            ->where('bookings.payment_status', 'success')
            ->where('bookings.settlement_status', 'pending')
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan atau sudah dicairkan.');
        }

        // H-14 Check
        $departureDate = $booking['tanggal_berangkat'] ?? null;
        if ($departureDate) {
            $h14Date = date('Y-m-d', strtotime('+14 days'));
            if ($departureDate > $h14Date) {
                return redirect()->back()->with('error', 'Pencairan hanya dapat dilakukan maksimal H-14 sebelum keberangkatan.');
            }
        }

        $grossAmount      = (float)$booking['total_price'];
        $commissionAmount = round($grossAmount * (self::COMMISSION_RATE / 100), 2);
        $netAmount        = $grossAmount - $commissionAmount;

        $this->disbursementModel->insert([
            'booking_id'        => $bookingId,
            'travel_agent_id'   => $booking['travel_agent_id'],
            'gross_amount'      => $grossAmount,
            'commission_rate'   => self::COMMISSION_RATE,
            'commission_amount' => $commissionAmount,
            'net_amount'        => $netAmount,
            'status'            => 'completed',
            'disbursed_at'      => date('Y-m-d H:i:s'),
            'notes'             => 'Pencairan otomatis disetujui oleh Finance pada ' . date('d/m/Y H:i'),
        ]);

        // Update booking settlement status
        $this->bookingModel->update($bookingId, ['settlement_status' => 'processed']);

        return redirect()->back()->with('success', "Pencairan Rp " . number_format($netAmount, 0, ',', '.') . " ke Agen berhasil diproses.");
    }
}

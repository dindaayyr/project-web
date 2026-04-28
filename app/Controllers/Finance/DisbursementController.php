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
     * Rule: Only show bookings where departure date is within H-14.
     */
    public function index()
    {
        $readyBookings = $this->bookingModel->getReadyForDisbursement();

        // Enrich with commission calculation
        $disbursementList = [];
        foreach ($readyBookings as $booking) {
            // Check if disbursement already exists for this booking
            $existing = $this->disbursementModel
                ->where('booking_id', $booking['id'])
                ->first();

            $grossAmount      = (float)$booking['total_price'];
            $commissionAmount = round($grossAmount * (self::COMMISSION_RATE / 100), 2);
            $netAmount        = $grossAmount - $commissionAmount;

            $disbursementList[] = [
                'booking'           => $booking,
                'gross_amount'      => $grossAmount,
                'commission_rate'   => self::COMMISSION_RATE,
                'commission_amount' => $commissionAmount,
                'net_amount'        => $netAmount,
                'disbursement'      => $existing, // null if not yet created
            ];
        }

        $data = [
            'disbursementList' => $disbursementList,
            'commissionRate'   => self::COMMISSION_RATE,
        ];

        return view('finance/disbursements', $data);
    }

    /**
     * Process a disbursement for a specific booking
     */
    public function process($bookingId)
    {
        $booking = $this->bookingModel
            ->select('bookings.*, packages.travel_agent_id, packages.harga_jual')
            ->join('packages', 'packages.id = bookings.package_id')
            ->where('bookings.id', $bookingId)
            ->where('bookings.status', 'lunas')
            ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan atau belum lunas.');
        }

        // Check if already disbursed
        $existing = $this->disbursementModel->where('booking_id', $bookingId)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Pencairan untuk booking ini sudah diproses.');
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
            'status'            => 'processing',
            'notes'             => 'Diproses oleh Admin Keuangan pada ' . date('d/m/Y H:i'),
        ]);

        return redirect()->back()->with('success', "Pencairan Rp " . number_format($netAmount, 0, ',', '.') . " berhasil diproses.");
    }
}

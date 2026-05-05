<?php

namespace App\Libraries;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransLib
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);
    }

    public function getSnapToken($params)
    {
        return Snap::getSnapToken($params);
    }

    public function getNotification()
    {
        return new Notification();
    }
}

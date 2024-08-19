<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        try {
            // Set konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = config('services.midtrans.is_sanitized');
            Config::$is3ds = config('services.midtrans.is_3ds');
    
            // Data transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $request->input('amount'),
                ],
                'customer_details' => [
                    'first_name' => $request->input('first_name'),
                    'email' => $request->input('email'),
                ],
            ];
    
            // Membuat Snap Token
            $snapToken = Snap::getSnapToken($params);
    
            Log::info('Snap Token:', ['token' => $snapToken]); 

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memproses pembayaran'], 500);
        }
    }    
}

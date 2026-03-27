<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Handle Midtrans Notification Webhook
     */
    public function notification(Request $request)
    {
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process notification'
            ], 400);
        }

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $order_id = $notification->order_id;
        $fraud = $notification->fraud_status;

        $pembayaran = Pembayaran::where('pemesananId', $order_id)->first();

        if (!$pembayaran) {
            return response()->json([
                'status' => 'error',
                'message' => 'Payment record not found'
            ], 404);
        }

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $pembayaran->status = 'challenge';
                } else {
                    $pembayaran->status = 'paid';
                }
            }
        } else if ($transaction == 'settlement') {
            $pembayaran->status = 'paid';
        } else if ($transaction == 'pending') {
            $pembayaran->status = 'pending';
        } else if ($transaction == 'deny') {
            $pembayaran->status = 'denied';
        } else if ($transaction == 'expire') {
            $pembayaran->status = 'expired';
        } else if ($transaction == 'cancel') {
            $pembayaran->status = 'cancelled';
        }

        $pembayaran->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Notification processed'
        ]);
    }

    /**
     * Verify payment status manually (used after Snap JS callback)
     */
    public function verifyStatus($orderId)
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);
            
            $pembayaran = Pembayaran::where('pemesananId', $orderId)->first();
            if (!$pembayaran) {
                return response()->json(['error' => 'Order not found'], 404);
            }

            $transaction = $status->transaction_status;
            
            if ($transaction == 'settlement' || $transaction == 'capture') {
                $pembayaran->status = 'paid';
            } else if ($transaction == 'pending') {
                $pembayaran->status = 'pending';
            } else if ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
                $pembayaran->status = 'failed';
            }

            $pembayaran->save();

            return response()->json([
                'status' => 'success',
                'pembayaran_status' => $pembayaran->status
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Optional: Create a transaction manually for testing (referenced in web.php)
     */
    public function createTransaction()
    {
         return "Midtrans controller is ready. Please use /checkout to test.";
    }
}

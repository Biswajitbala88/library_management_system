<?php

namespace App\Http\Controllers;

use Exception;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    public function handlePayment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZORPAY_API_KEY'), env('RAZORPAY_API_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture([
                    'amount' => $payment['amount']
                ]);
                // $payment = Payment::create([
                //     'r_payment_id' => $response['id'],
                //     'method' => $response['method'],
                //     'currency' => $response['currency'],
                //     'user_email' => $response['email'],
                //     'amount' => $response['amount'] / 100,
                //     'json_response' => json_encode((array)$response)
                // ]);
            } catch (Exception $e) {
                Log::info($e->getMessage());
                return back()->withError($e->getMessage());
            }
        }
        return back()->withSuccess('Payment done.');
    }
}

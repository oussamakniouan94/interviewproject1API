<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            'amount' => $request->amount,
            'currency' => 'usd',
            'source' => $request->token,
            'description' => 'Order Payment',
        ]);

        return response()->json(['status' => 'Payment Successful']);
    }
}

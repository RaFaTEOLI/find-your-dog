<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReturnHandler;

class PaymentController extends Controller
{
    use ReturnHandler;
    public function store(Request $request)
    {
        \Stripe\Stripe::setApiKey("secret_key");

        $input = $request->only(["cost", "stripeToken"]);
        $cost = $input["cost"] * 100;

        $token = $input["stripeToken"];
        \Stripe\Charge::create([
            'amount' => $cost,
            'currency' => 'brl',
            'description' => 'Charge Dog',
            'source' => $token,
        ]);

        return $this->success($request, "dogs");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Serrvice\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::get();

        return view("plan", compact("plans"));

    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Plan $plan, Request $request)
    {
    
        $intent = auth()->user()->createSetupIntent();


        return view("subscription", compact("plan", "intent"));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscription(Request $request)
    {
        $result= StripeService::Subscription($request);
        if ($result['status'] == 'success') {
            return redirect()->route('home')->with('success', $result['message']);
        } else {
            return response()->json(['error' => $result['message']], 500);
        }

    }




    public function checkout()
    {
        return view('checkout');
    }


    public function checkout_form(Request $request)
    {

        $stripeSecretKey=env('STRIPE_SECRET');


        \Stripe\Stripe::setApiKey($stripeSecretKey);
        header('Content-Type: application/json');

        $YOUR_DOMAIN='http://linedinapi.test:8081/';

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => 'price_1PbfO9JIYuloXeDYEKfeoSBI',
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        dd($checkout_session);

        // header("HTTP/1.1 303 See Other");
        // header("Location: " . $checkout_session->url);
    }
}

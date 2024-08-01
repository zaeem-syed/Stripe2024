<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Service\StripeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Serrvice\StripeService as SerrviceStripeService;

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

    public function Monthly()

    {
        $user=Auth::user();
        $active_sub = $user->subscriptions->firstWhere('stripe_status', 'active');

        $change_to=DB::table('plans')->where('stripe_price','price_1PcnoKJIYuloXeDYRzeqLuol')->first();

        // dd($change_to->id);

        $user->subscription($active_sub->type)->swap('price_1PcnoKJIYuloXeDYRzeqLuol');

        $active_sub->type=$change_to->id;
        $active_sub->save();


        return redirect()->back();
    }


    public function cancel()
    {

        $active_sub=Auth::user()->subscriptions->firstWhere('stripe_status', 'active');
        $active_sub->cancel();
        return redirect()->back();

    }


    public function trial(Plan $plan, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view("Trials", compact("plan", "intent"));
    }


    public function subscriptiontrial(Request $request)
    {
        $result= StripeService::create_trial($request);
        if ($result['status'] == 'success') {
            return redirect()->route('home')->with('success', $result['message']);
        } else {
            return response()->json(['error' => $result['message']], 500);
        }
    }

}

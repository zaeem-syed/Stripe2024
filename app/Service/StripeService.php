<?Php


namespace App\Service;

use App\Models\Plan;
use Illuminate\Http\Request;

class StripeService {

public static function Subscription(Request $request)
{

    {
        $plan = Plan::find($request->plan);

        $user = $request->user();
        $paymentMethod = $request->input('paymentMethod');

        try {
            // Ensure the user is a Stripe customer
            $user->createOrGetStripeCustomer();

            // Add the payment method to the user
            $user->updateDefaultPaymentMethod($paymentMethod);

            // Create the subscription
            $subscription = $user->newSubscription($request->plan, $plan->stripe_price)->create($paymentMethod);

            return [
                'status' => 'success',
                'message' => 'Subscription is active.'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }


}

public static function create_trial(Request $request)
{
    $plan = Plan::find($request->plan);

    if (!$plan) {
        return [
            'status' => 'error',
            'message' => 'Plan not found.'
        ];
    }

    $user = $request->user();
    $paymentMethod = $request->input('paymentMethod');

    try {
        // Ensure the user is a Stripe customer
        $user->createOrGetStripeCustomer();

        // Add the payment method to the user
        $user->updateDefaultPaymentMethod($paymentMethod);

        // Create the subscription with a trial period
        $subscription = $user->newSubscription($request->plan, $plan->stripe_price)
                             ->trialDays(14)
                             ->create($paymentMethod);

        return [
            'status' => 'success',
            'message' => 'Subscription with a trial is active.'
        ];
    } catch (\Exception $e) {
        return [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
}

}

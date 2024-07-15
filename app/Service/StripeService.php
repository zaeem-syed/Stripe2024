<?Php


namespace App\Serrvice;

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
            $subscription = $user->newSubscription($request->plan, $plan->stripe_plan)->create($paymentMethod);

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




}

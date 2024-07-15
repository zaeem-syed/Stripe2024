@extends('layouts.app')

@section('content')

<style>

/* CSS */
.button-27 {
  appearance: none;
  background-color: #000000;
  border: 2px solid #1A1A1A;
  border-radius: 15px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: Roobert,-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
  font-size: 16px;
  font-weight: 600;
  line-height: normal;
  margin: 0;
  min-height: 60px;
  min-width: 0;
  outline: none;
  padding: 16px 24px;
  text-align: center;
  text-decoration: none;
  transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 25%;
  will-change: transform;
}

.button-27:disabled {
  pointer-events: none;
}

.button-27:hover {
  box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
  transform: translateY(-2px);
}

.button-27:active {
  box-shadow: none;
  transform: translateY(0);
}
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        You will be charged ${{ number_format($plan->price, 2) }} for {{ $plan->name }} Plan
                    </div>
                    <div class="card-body">
                        <form id="payment-form" action="{{ route('subscription.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" id="plan" value="{{ $plan->id }}">
                            <input type="hidden" name="stripe_plan" id="" value="{{$plan->stripe_price}}">
                            <div id="payment-element">
                                <!--Stripe.js injects the Payment Element-->
                            </div>
                            <button id="payment-submit " style="margin-top:10px;" class="button-27">
                                <div class="spinner hidden" id="spinner"></div>
                                <span id="button-text ">Pay now </span>
                            </button>
                            <div id="payment-message" class="hidden"></div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe(
            "pk_test_51Pbf6IJIYuloXeDYP291MPYtHUa0XWnXwWtfhBFqOhq2Rf1eBk9nlR4vJhF3axKQK0g8x7ZlKjzbyagtuGRd8xaL00KHTrJpLI"
        );
        let elements;

        const appearance = {
            theme: 'night',
            labels: 'floating'
        };



        const clientSecret = '{{ $intent->client_secret }}';

        initialize();


        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        // Fetches a payment intent and captures the client secret
        function initialize() {

            elements = stripe.elements({
                clientSecret,
                appearance
            });
            const paymentElementOptions = {

                layout: {
                    type: 'accordion',
                    defaultCollapsed: false,
                    radios: true,
                    spacedAccordionItems: false
                }
            };

            const paymentElement = elements.create("payment", paymentElementOptions);
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            const {
                setupIntent,
                error
            } = await stripe.confirmSetup({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: "http://localhost:4242/checkout.html",
                },
                redirect: 'if_required'
            });



            if (error) {

                if (error.type === "card_error" || error.type === "validation_error") {
                    showMessage(error.message);
                } else {
                    showMessage("An unexpected error occurred.");
                }
            } else {

                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'paymentMethod');
                hiddenInput.setAttribute('value', setupIntent.payment_method); // Ensure setupIntent.payment_method is defined and accessible
                form.appendChild(hiddenInput);
                form.submit();

            }


        }
        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }
    </script>
@endsection

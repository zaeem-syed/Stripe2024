@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>

               @if(auth::user()->subscribed('1') )
                <button type="button" class="btn btn-primary">
                    You are subscribed to Monthly Basic <span class="badge badge-light"></span>
                    {{-- <span class="sr-only">unread messages</span> --}}
                  </button>


                @elseif(auth::user()->subscribed('2') )
                <button type="button" class="btn btn-primary">
                    You are subscribed to Monthly Unlimited <span class="badge badge-light"></span>
                    {{-- <span class="sr-only">unread messages</span> --}}
                  </button>

                @elseif(auth::user()->subscribed('4'))
                <button type="button" class="btn btn-primary">
                    You are subscribed to yearly  <span class="badge badge-light"></span>
                    {{-- <span class="sr-only">unread messages</span> --}}
                  </button>

                @endif



            </div>
        </div>

        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monthly Subscription Plan </div>
                <div class="card-body">
                    <form id="subscription-form">
                        <input type="email" id="email" required>
                        <div id="card-element"></div>
                        <button id="subscribe-button">Subscribe</button>
                    </form>

                </div>
            </div>
        </div> --}}
    </div>
</div>
{{-- <script src="https://js.stripe.com/v3/"></script> --}}

{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var stripe = Stripe('pk_test_51Pbf6IJIYuloXeDYP291MPYtHUa0XWnXwWtfhBFqOhq2Rf1eBk9nlR4vJhF3axKQK0g8x7ZlKjzbyagtuGRd8xaL00KHTrJpLI');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('subscription-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Handle error here
            } else {
                // Send the token to your server
                fetch('/create-subscription', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        email: document.getElementById('email').value,
                        stripeToken: result.token.id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                });
            }
        });
    });
}); --}}



</script>
@endsection

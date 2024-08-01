@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Select Plane:</div>

                    <div class="card-body">

                        <div class="row">


                            @foreach ($plans as $plan)
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            ${{ $plan->price }} / {{ $plan->name }}
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $plan->name }}</h5>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>

                                            @if (auth()->check())
                                                @php
                                                    $subscription = auth()
                                                        ->user()
                                                        ->subscription($plan->id);
                                                @endphp

                                                @if ($subscription)
                                                    <span class="badge badge-success">You are already subscribed to this
                                                        plan</span>
                                                    <hr>

                                                    @if ($subscription->onGracePeriod())
                                                        <div class="alert alert-danger">
                                                            <p>You are on a grace period</p>
                                                        </div>
                                                    @elseif ($subscription->onTrial())
                                                        <div class="alert alert-info">
                                                            <p>You are currently on a trial period</p>
                                                        </div>
                                                    @else
                                                        @if (auth()->user()->subscribed('4'))
                                                            <a href="{{ route('change') }}"
                                                                class="btn btn-primary pull-right">Downgrade to monthly</a>
                                                        @else
                                                            <a href="" class="btn btn-primary pull-right">Upgrade to
                                                                yearly</a>
                                                        @endif
                                                        <a href="/cancel" class="btn btn-danger pull-right">Cancel</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('plans.show', $plan->slug) }}"
                                                        class="btn btn-primary pull-right">Choose</a>
                                                    <a href="{{ route('plans.trial', $plan->slug) }}"
                                                        class="btn btn-primary pull-right">Trial</a>
                                                @endif
                                            @else
                                                <a href="{{ route('plans.show', $plan->slug) }}"
                                                    class="btn btn-primary pull-right">Choose</a>
                                                <a href="{{ route('plans.trial', $plan->slug) }}"
                                                    class="btn btn-primary pull-right">Trial</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach






                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

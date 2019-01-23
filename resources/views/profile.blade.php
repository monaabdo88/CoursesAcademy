@extends('layouts.app')

@section('header')
    <!-- Header -->
    <header class="header header-inverse" style="background-color: #9ac29d">
        <div class="container text-center">
            @if(!auth()->user()->isConfirmed())
                <div class="alert alert-warning text-center">
                    <i class="fa fa-warning"></i>
                    <strong>Please verify your email</strong>
                    <br>
                    <i class="fa fa-refresh"></i>
                    <span>Resend verification email To:</span>

                    <small>
                        <form id="reverifyEmail" action="{{ route('confirmation.resend') }}" method="post">
                            {{csrf_field()}}
                            <a href="javascript:{}" onclick="document.getElementById('reverifyEmail').submit();">
                                {{auth()->user()->email}}
                            </a>
                        </form>
                    </small>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <h1>{{ $user->username }}</h1>
                    <br>
                    <h1>{{$user->getTotalNumberOfCompletedLessons()}}</h1>
                    <p class="fs-20 opacity-70">Total Lessons Completed</p>
                </div>
            </div>
        </div>
    </header>
    <!-- END Header -->
@endsection

@section('content')
    <section class="section" id="section-vtab">
        <div class="container">
            <header class="section-header">
                <h2>Series being watched ...</h2>
                <hr>
            </header>
            <div class="row gap-5">
                @forelse($series as $s)
                    <div class="card mb-30">
                        <div class="row">
                            <div class="col-12 col-md-4 align-self-center">
                                <a href=""><img src="{{ asset($s->image_path) }}" alt="..."></a>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-block">
                                    <h4 class="card-title">{{ $s->title }}</h4>
                                    <p class="card-text">{{ $s->description }}</p>
                                    <a class="fw-600 fs-12" href="{{ route('series', $s->slug) }}">Read more <i class="fa fa-chevron-right fs-9 pl-8"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <section class="section bg-gray" id="section-vtab">
        <div class="container">
            <header class="section-header">
                <h2>Subscriptions and Plans ...</h2>
                <hr>
            </header>
            <div class="row gap-5">
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Personal details
                        </li>
                        <li class="list-group-item active">
                            Payments & Subscriptions
                        </li>
                        <li class="list-group-item">
                            Settings
                        </li>
                    </ul>
                </div>
                <div class="col-8">
                    @if(isset(auth()->user()->subscriptions->first()->name))
                        <form action="{{ route('subscriptions.change') }}" method="post">
                            {{csrf_field()}}
                            <h5 class="text-center">
                                Your current plan:
                                <span class="badge badge-success" style="text-transform: uppercase;">
                                    {{auth()->user()->subscriptions->first()->name}}
                                </span>
                            </h5>
                            <br>
                            <select name="plan" class="form-control">
                                <option value="{{$monthlyPlanId}},monthly" @if(auth()->user()->subscriptions->first()->stripe_plan === $monthlyPlanId) disabled=disabled @endif>
                                    Monthly
                                </option>
                                <option value="{{$yearlyPlanId}},yearly" @if(auth()->user()->subscriptions->first()->stripe_plan === $yearlyPlanId) disabled=disabled @endif>
                                    Yearly
                                </option>
                            </select>
                            <br>
                            <p class="text-center">
                                <button class="btn btn-primary" type="submit">Change plan</button>
                            </p>
                        </form>
                    @else
                        <p class="text-center alert alert-info">
                            <strong>No Subscriptions Found</strong>
                            <span><a href="{{ route('subscriptions.new') }}">Subscribe now....!</a></span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
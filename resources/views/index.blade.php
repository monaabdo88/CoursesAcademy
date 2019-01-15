@extends('layouts.app')
@section('header')
    <!-- Header -->
    <header class="header header-inverse h-fullscreen pb-80" data-parallax="assets/img/bg-man.jpg" data-overlay="8">
        <div class="container text-center">

            <div class="row h-full">
                <div class="col-12 col-lg-8 offset-lg-2 align-self-center">

                    <h1 class="display-4 hidden-sm-down">Create Professional Websites</h1>
                    <h1 class="hidden-md-up">Create Professional Websites</h1>
                    <br>
                    <p class="lead text-white fs-20 hidden-sm-down"><span class="fw-400">TheSaaS</span> is a responsive, professional, and multipurpose<br> SaaS template powered with <span class="mark-border">Bootstrap 4</span>.</p>

                    <br><br><br>

                    <a class="btn btn-lg btn-round w-200 btn-primary mr-16" href="#" data-scrollto="section-intro">Demos</a>
                    <a class="btn btn-lg btn-round w-200 btn-outline btn-white hidden-sm-down" href="#" data-scrollto="section-intro">Features</a>

                </div>

                <div class="col-12 align-self-end text-center">
                    <a class="scroll-down-1 scroll-down-inverse" href="#" data-scrollto="section-intro"><span></span></a>
                </div>

            </div>

        </div>
    </header>
    <!-- END Header -->


@endsection
@section('content')
    <!-- Main container -->
    <main class="main-content">
        <section class="section bg-gray">
            <div class="container">
                <header class="section-header">
                    <small>lessons</small>
                    <h2>Featured Screencasts</h2>
                    <hr>
                    <p class="lead"></p>
                </header>
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
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </section>

    </main>
    <!-- END Main container -->

@endsection


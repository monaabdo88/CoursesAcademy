@extends('layouts.app')
@section('header')
    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>{{$series->title}}</h1>
                    <p class="fs-18 opacity-70">Customize Your Series Lessons</p>

                </div>
            </div>

        </div>
    </header>
    <!-- END Header -->
@endsection
@section('content')

    <!-- Main container -->
    <main class="main-content">

        <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Contact 2
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <div class="section">
            <div class="container">

                <div class="row gap-y">
                    <div class="col-md-12">
                        <lessons-vue default_lessons="{{$series->lessons}}" series_id="{{$series->id}}"></lessons-vue>

                    </div>

                </div>


            </div>
        </div>
    </main>
    <!-- END Main container -->

@endsection
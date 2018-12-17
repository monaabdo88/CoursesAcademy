@extends('layouts.app')
@section('header')
    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(assets/img/bg-laptop.jpg)" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>Add New Series</h1>
                    <p class="fs-18 opacity-70">Add Your New series To Courses Academy</p>

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

                        <form action="{{route('series.store')}}" method="POST" enctype="multipart/form-data">
                           {{csrf_field()}}
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="text" name="title" placeholder="Your Name">
                            </div>

                            <div class="form-group">
                                <input class="form-control form-control-lg" type="file" name="image">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control form-control-lg" name="description" rows="4" placeholder="Your Message"></textarea>
                            </div>


                            <button class="btn btn-lg btn-primary btn-block" type="submit">Add New Series</button>
                        </form>

                    </div>

                </div>


            </div>
        </div>
    </main>
    <!-- END Main container -->

@endsection
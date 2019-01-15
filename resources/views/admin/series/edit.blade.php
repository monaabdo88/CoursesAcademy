@extends('layouts.app')
@section('header')
    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(assets/img/bg-laptop.jpg)" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>Edit Series {{$series->title}}</h1>
                    <p class="fs-18 opacity-70">Edit series</p>

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

                        <form action="{{route('series.update',$series->slug)}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <input class="form-control form-control-lg" type="text" name="title" value="{{$series->title}}">
                            </div>

                            <div class="form-group">
                                <input class="form-control form-control-lg" type="file" name="image">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control form-control-lg" name="description" rows="4" >{{$series->description}}</textarea>
                            </div>


                            <button class="btn btn-lg btn-primary btn-block" type="submit">Save Changes</button>
                        </form>

                    </div>

                </div>


            </div>
        </div>
    </main>
    <!-- END Main container -->

@endsection
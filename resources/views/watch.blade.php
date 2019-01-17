@extends('layouts.app')

@section('header')
    <!-- Header -->
    <header class="header header-inverse" style="background-color: #9ac29d">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <h1>{{ $lesson->title }}</h1>
                    <p class="fs-20 opacity-70">{{ $series->title }}</p>
                </div>
            </div>
        </div>
    </header>
    <!-- END Header -->
@endsection

@section('content')
    <div class="section bg-grey">
        <div class="container">
            @php
                $nextLesson = $lesson->getNextLesson();
                $prevLesson = $lesson->getPreviousLesson();
            @endphp
            <div class="row gap-y">
                <div class="col-12 text-center">
                    <vue-player default_lesson="{{ $lesson }}"
                                @if($nextLesson->id !== $lesson->id)
                                next_lesson_url="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id]) }}"
                            @endif
                    ></vue-player>

                    <a class="btn btn-primary" @if($prevLesson->id !== $lesson->id) href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $prevLesson->id]) }}"@endif data-toggle='popover' title='Previous Lesson'>
                        Previous Lesson
                    </a>
                    <a class="btn btn-primary" @if($nextLesson->id !== $lesson->id) href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $nextLesson->id]) }}" @endif data-toggle='popover' title='Next Lesson'>
                        Next Lesson
                    </a>

                </div>
                <div class="col-12">
                    <ul class="list-group">
                        @foreach($series->getOrderedLessons() as $l)
                            <li class="list-group-item @if($l->id == $lesson->id) active @endif">
                                <span class="col-11 text-left">
                                    @if(auth()->user()->hasCompleteLesson($l))
                                        <i class="fa fa-check-circle fa-lg"></i>
                                    @endif
                                    <strong>{{ $l->title  }}</strong>
                                </span>
                                <a href="{{ route('series.watch', ['series' => $series->slug, 'lesson' => $l->id]) }}" class="col-1 text-right" data-toggle="popover" title="Play Lesson">
                                    <i class="fa fa-play-circle-o fa-lg"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
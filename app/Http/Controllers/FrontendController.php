<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Series;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('index')->withSeries(Series::all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(){
        return view('calendar.index');
    }

    public function create(){
        return view('calendar.create');
    }

    public function show($calendar){
        // return view('calendar.show',['calendar' => $calendar]);
        //compact('calendar') =  ['calendar' => $calendar]

        return view('calendar.show',compact('calendar'));
    }
}

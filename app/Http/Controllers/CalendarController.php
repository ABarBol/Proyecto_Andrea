<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {

        $events = Task::get(['name as title', 'start as date', 'end', 'color as backgroundColor', 'color as borderColor']);
        return view('calendar', compact('events'));
    }
}

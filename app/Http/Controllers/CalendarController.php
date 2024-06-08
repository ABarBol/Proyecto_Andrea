<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Obtiene todos los eventos de un usuario
     */
    public function index(User $user)
    {

        $events = $user->tasks->map(function ($task) {
            return [
                'title' => $task->name,
                'date' => $task->start,
                'description' => $task->description,
                'end' => $task->end,
                'backgroundColor' => $task->color,
                'borderColor' => $task->color,
            ];
        });

        return view('calendar', compact('events'));
    }
}

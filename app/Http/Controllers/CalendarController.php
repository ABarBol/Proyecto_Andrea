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
    public function index(int $id)
    {

        $user = User::find($id);

        $events = $user->tasks->map(function ($task) {
            return [
                'title' => $task->name,
                'date' => $task->start,
                'end' => $task->end,
                'backgroundColor' => $task->color,
                'borderColor' => $task->color,
            ];
        });

        return view('calendar', compact('events'));
    }
}

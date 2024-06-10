<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * This is the user's calendar controller.
 */
class CalendarController extends Controller
{
    /**
     * Gets all events for a user
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

<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Home page controller
 */
class HomeController extends Controller
{
    /**
     * Undocumented function
     *
     * @return View
     */
    public function __invoke() : View
    {
        return view('home');   
    }
}

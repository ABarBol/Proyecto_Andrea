<?php

namespace App\Http\Controllers;


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
    public function __invoke()
    {
        return view('home');   
    }
}

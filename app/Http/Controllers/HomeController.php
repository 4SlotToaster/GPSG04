<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        $viewData = $this->loadViewData();

        return view('welcome', $viewData);
    }
}

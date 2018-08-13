<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class IndexContoller extends Controller
{
    /**
     *
     */
    public function index()
    {
        return view('layout');
    }
}

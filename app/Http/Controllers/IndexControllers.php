<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexControllers extends Controller
{
    public  function  index(){

        return view('index');

    }
}

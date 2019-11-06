<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class AdvertControllers extends Controller
{
    public function index()
    {
        return view('advert.index');
    }

    /*    public function getCatInformation(Request $request)
        {

            $id = $request->id;
            return Category::find($id);

        }*/


}

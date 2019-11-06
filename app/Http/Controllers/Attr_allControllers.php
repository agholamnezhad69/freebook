<?php

namespace App\Http\Controllers;

use App\Attr_all;
use App\Category;
use Illuminate\Http\Request;

class Attr_allControllers extends Controller
{
    public function addCatToStateAttr(Request $request)
    {

        $catSelect = $request->catSelect;
        $is_allCat = $request->is_allCat;
        $cat_ids = array();
        if ($is_allCat == true) {

            $all_cat = Category::all();
            foreach ($all_cat as $row) {

                array_push($cat_ids, $row['id']);
            }
        } else {
            foreach ($catSelect as $row) {

                array_push($cat_ids, $row['id']);
            }
        }
        $cat_ids = join('/', $cat_ids);
        Attr_all::where('title', 'state')
            ->limit(1)
            ->update(array('title' => 'state', 'cat_ids' => $cat_ids));

    }

    public function getCatToStateAttr(Request $request)
    {


        $catSelect = Attr_all::where('title', 'state')->first();


        $cat_ids = explode('/', $catSelect['cat_ids']);


        return Category::whereIn('id', $cat_ids)->get();


    }

    public function addCatToCompanyAttr(Request $request)
    {

        $catSelect = $request->catSelect;
        $is_allCat = $request->is_allCat;
        $cat_ids = array();
        if ($is_allCat == true) {

            $all_cat = Category::all();
            foreach ($all_cat as $row) {

                array_push($cat_ids, $row['id']);
            }
        } else {
            foreach ($catSelect as $row) {

                array_push($cat_ids, $row['id']);
            }
        }
        $cat_ids = join('/', $cat_ids);
        Attr_all::where('title', 'company')
            ->limit(1)
            ->update(array('title' => 'company', 'cat_ids' => $cat_ids));

    }

    public function getCatToCompanyAttr(Request $request)
    {


        $catSelect = Attr_all::where('title', 'company')->first();


        $cat_ids = explode('/', $catSelect['cat_ids']);


        return Category::whereIn('id', $cat_ids)->get();


    }


    public function getAllAttr()
    {

        $all_attr = Attr_all::all();

        return $all_attr;


    }


    public function addCatToAllAttr(Request $request)
    {
        $attr_id = $request->attr_id;
        $cat_id = $request->cat_id;

        $curren_row = Attr_all::where('id', $attr_id)->first();

        $catIds = explode('/', $curren_row['cat_ids']);

        foreach ($catIds as $key => $id) {

            if ($id == $cat_id) {

                array_pull($catIds, $key);

                $catIds = join('/', $catIds);

                Attr_all::where('id', $attr_id)
                    ->limit(1)
                    ->update(array('cat_ids' => $catIds));

                return;
            }


        }


        $curren_row['cat_ids'] = $curren_row['cat_ids'] . '/' . $cat_id;


        Attr_all::where('id', $attr_id)
            ->limit(1)
            ->update(array('cat_ids' => $curren_row['cat_ids']));


    }

    public function getCatToAllAttr(Request $request)
    {
        $cat_id = $request->cat_id;

        $all_attrs = Attr_all::all();

        $is_checked = false;

        foreach ($all_attrs as $key => $row) {

            $cat_ids = explode('/', $row['cat_ids']);

            foreach ($cat_ids as $id) {

                if ($id == $cat_id) {

                    $all_attrs[$key]['is_checked'] = true;
                    $is_checked = true;
                }
            }
            if (!$is_checked) {
                $all_attrs[$key]['is_checked'] = false;
            }
        }

        return $all_attrs;


    }


}

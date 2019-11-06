<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryControllers extends Controller
{


    public function index()
    {
        return view('admin.category.index');
    }


    public function getCategory()
    {

        return Category::orderby('id', 'asc')->where('parent_id', 0)->get();


    }


    public function getAllCategory()
    {
        return Category::all();

    }

    public function getAddCategoryPage(Request $request)
    {
        $cat_id = $request->cat_id;
        $cat_parent_id = $request->cat_parent_id;
        $is_edit = $request->is_edit;
        $cat_name = '';
        if ($is_edit == 'edit') {

            $row = Category::where('id', $cat_id)->first();
            $cat_id = $row['id'];
            $cat_name = $row['name'];
        }

        $allCategory = array();

        $allCategory = Category::all();

        return view('admin.category.addCategory',
            [
                'cat_parent_id' => $cat_parent_id,
                'cat_id' => $cat_id,
                'cat_name' => $cat_name,
                'is_edit' => $is_edit,
                'allCategory' => $allCategory
            ]);
    }

    public function addCategory(Request $request)
    {

        $is_edit = $request->is_edit;
        $cat_id = $request->cat_id;
        $catName = $request->input('nameCat');
        $cat_parent_id = $request->input('cat_parent_id');


        if ($is_edit == 'edit') {

            Category::where('id', $cat_id)
                ->limit(1)
                ->update(array('name' => $catName));

        } else {

            if ($cat_parent_id == 'idNo') {
                $newCategory = array('title' => $catName, 'parent_id' => 0);

            } else {
                $newCategory = array('title' => $catName, 'parent_id' => $cat_parent_id);
            }


            Category::create($newCategory);

        }

        return redirect('admin/category/index');

    }

    public function removeCategory(Request $request)
    {
        $ids = $request->id;
        $allChildrenIds = array();
        $allChildrenIds = array_merge($allChildrenIds, $ids);

        while (sizeof($ids) > 0) {

            $childrenIds = array();
            foreach ($ids as $id) {

                $children = Category::where('parent_id', $id)->get();
                foreach ($children as $child) {
                    array_push($childrenIds, $child['id']);
                }

            }

            $allChildrenIds = array_merge($allChildrenIds, $childrenIds);
            $ids = $childrenIds;
        }


        return Category::whereIn('id', $allChildrenIds)->delete();


    }

    public function getCatChild(Request $request)
    {
        $all = array();
        $id = $request->id;
        $parent_id = $request->parent_id;

        $CatInformation = Category::find($id);


        $all['cat_id'] = $CatInformation['id'];
        $all['catName'] = $CatInformation['title'];
        $all['catParentId'] = $CatInformation['parent_id'];

        /************************************start all parentName*/
        $all_parent_name = array();
        while ($parent_id != 0) {

            $row = Category::where('id', $parent_id)->first();
            array_push($all_parent_name, $row);
            $parent_id = $row['parent_id'];
        }

        $all_parent_name = array_reverse($all_parent_name);

        array_push($all_parent_name, $CatInformation);

        $all['allParent'] = $all_parent_name;

        /************************************end all parentName*/
        $all['catChild'] = Category::orderby('id', 'asc')->where('parent_id', $id)->get();
        if (count($all['catChild']) == 0) {
            $all['childs'] = '0';
            return $all;
        }
        return $all;
    }

    public function getCatParent(Request $request)
    {

        $parent_id = $request->parent_id;

        if ($parent_id == 0) {

            return "1";
        }

        $all = array();

        $all['catParent'] = Category::where('id', $parent_id)->first();

        $all['catParent_name'] = $all['catParent']['name'];
        $all['catParent_id'] = $all['catParent']['parent_id'];

        $id = $all['catParent']['id'];

        $all['catChild'] = Category::orderby('id', 'asc')->where('parent_id', $id)->get();


        return $all;
    }

    public function getChilds(Request $request)
    {
        $all = array();

        $id = $request->id;

        $CatInformation = Category::find($id);

        /************************************start all parentName*/
        $parent_id = $request->parent_id;

        $all_parent_name = array();
        while ($parent_id != 0) {

            $row = Category::where('id', $parent_id)->first();
            array_push($all_parent_name, $row);
            $parent_id = $row['parent_id'];
        }
        $all_parent_name = array_reverse($all_parent_name);

        array_push($all_parent_name, $CatInformation);
        $all['allParent'] = $all_parent_name;

        /************************************end all parentName*/
        /*******************************star all child************88*/
        $childs = array();
        if ($id == '') {
            $childs = Category::where('parent_id', '0')->get();
            return '1';
        }

        $childs = Category::where('parent_id', $id)->get();


        $all['child'] = $childs;
        /*******************************end all child************88*/

        return $all;
    }

    public function getSearchCat(Request $request)
    {


        $name = $request->name;

        $allCategory = $this->getAllCategory();

        $category = array();
        if ($name) {
            // $category= $all->where('name', $name);
            /*$category = col----------------+++++++++++++++++++++++++++++++++++-+++++++++++++++++++++++++++++++++++++++
            lect($all)->Where('name', 'like', '%' . $name . '%');*/
            /* $category = Category::Where('name', 'like', '%' . $name . '%')->get();*/
            /*    $category = $all->reject(function($element) use ($name) {
                    return mb_strpos($element->name, $name);
                });*/
            $category = collect($allCategory)->filter(function ($item) use ($name) {
                // replace stristr with your choice of matching function
                return stristr($item->name, $name);
            });
        }
        return $category;


    }


}

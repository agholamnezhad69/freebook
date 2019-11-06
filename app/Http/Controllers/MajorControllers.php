<?php

namespace App\Http\Controllers;

use App\Major;
use App\UniMajor;
use Illuminate\Http\Request;
use DB;

class MajorControllers extends Controller
{
    public function index()
    {
        return view('admin.major');
    }

    public function getMajor()
    {


        $all = Major::all();

        return $all;

    }


    public function addMajor(Request $request)
    {
        $is_update = $request->is_update;
        $major_id = $request->major_id;
        $majorName = $request->majorName;


        if ($is_update == 1) {


            Major::where('id', $major_id)
                ->limit(1)
                ->update(array('title' => $majorName));

        } else {


            $major = array('title' => $majorName);
            Major::create($major);
        }


    }

    public function updateMajor(Request $request)
    {


        $id = $request->id;
        $row = Major::where('id', $id)->first();

        if (is_null($row)) {

            return false;
        }

        return $row['title'];


    }

    public function removeMajor(Request $request)
    {


        $id = $request->id;
        Major::find($id)->delete();


    }


    public function getCityOfState(Request $request)
    {

        $id = $request->id;

        if ($id == 0) {
            return Major::where('parent_id', '!=', 0)->get();
        }


        return Major::where('parent_id', $id)->get();


    }

    public function addState(Request $request)
    {
        $is_update = $request->is_update;
        $name = $request->name;
        $id_state = $request->id;

        if ($is_update == 1) {


            Major::where('id', $id_state)
                ->limit(1)
                ->update(array('name' => $name));

        } else {


            $State = array('name' => $name, 'parent_id' => 0);
            Major::create($State);
        }


    }


    public function removeState(Request $request)
    {
        $id = $request->id;
        $all_id = array();
        array_push($all_id, $id);


        $children = Major::where('parent_id', $id)->get();

        foreach ($children as $row) {
            array_push($all_id, $row['id']);
        }


        return Major::whereIn('id', $all_id)->delete();

    }


    public function updateState(Request $request)
    {


        $id = $request->id;
        $row = Major::where('id', $id)->first();

        if (is_null($row)) {

            return false;
        }

        return $row['name'];


    }


    public function get_major_for_uni(Request $request)
    {

        $uni_id = $request->uni_id;

        // $all = UniMajor::where('uni_id', $uni_id)->get();

               $all = DB::table('tbl_uni_major')
                    ->join('tbl_major', 'tbl_major.id', '=', 'tbl_uni_major.major_id')
                    ->where('tbl_uni_major.uni_id', '=', $uni_id)
                    ->get();


                return $all;


    }
    public function addMajorforUni(Request $request)
    {

        $uni_id = $request->uni_id;
        $major_id = $request->major_id;

        $major = array('major_id' => $major_id,'uni_id'=>$uni_id);

        UniMajor::create($major);
    }
    public function removeMajorSelectForUni(Request $request)
    {


        $uni_id = $request->uni_id;
        $major_id = $request->major_id;



        DB::table('tbl_uni_major')->where("uni_id",  $uni_id)->where("major_id",$major_id)
        ->delete();

    //  UniMajor::where('uni_id',  $uni_id)->َwhere('major_id',$major_id)->delete();
     // UniMajor::where('major_id',  $major_id)->delete();

    }

    public function getMajor_for_uni(Request $request)
    {


        $uni_id = $request->uni_id;

        $all = DB::table('tbl_uni_major')
            ->join('tbl_major', 'tbl_major.id', '=', 'tbl_uni_major.major_id')
            ->where('tbl_uni_major.uni_id', '=', $uni_id)
            ->get();


        return $all;

    }

}

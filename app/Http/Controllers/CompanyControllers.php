<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;


class CompanyControllers extends Controller
{
    public function index()
    {
        return view('admin.company');
    }

    public function getAllCompany()
    {
        return Company::all();

    }

    public function addCompany(Request $request)
    {

        $is_update_company = $request->is_update_Company;
        $cat_id = $request->cat_id;
        $company_name = $request->name;
        $company_id=$request->company_id;

        if ($is_update_company == 1) {


            Company::where('id', $company_id)
                ->limit(1)
                ->update(array('title' => $company_name));

        } else {




            $company = array('title' => $company_name, 'cat_id' => $cat_id);
            Company::create($company);
        }








    }

    public function getCompanyOfCategory(Request $request)
    {

        $cat_id = $request->cat_id;


        return Company::where('cat_id', $cat_id)->get();


    }

    public function removeCompany(Request $request)
    {
        $id_company = $request->id_company;


        return Company::where('id', $id_company)->delete();

    }

    public function updateCompany(Request $request)
    {


        $id = $request->id;



        $row = Company::where('id', $id)->first();


        if (is_null($row)) {

            return false;
        }

        return $row['title'];


    }


}

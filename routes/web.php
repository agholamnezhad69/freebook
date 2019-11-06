<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('index', 'AdminControllers@index');

    Route::get('major', 'MajorControllers@index');

    Route::get('company', 'CompanyControllers@index');


    Route::get('getMajor', 'MajorControllers@getMajor');

    Route::post('getmajorOfState', 'MajorControllers@getmajorOfState');

    Route::post('getCompanyOfCategory', 'CompanyControllers@getCompanyOfCategory');

    Route::post('addState', 'MajorControllers@addState');

    Route::post('addCompany', 'CompanyControllers@addCompany');

    Route::post('addMajor', 'MajorControllers@addMajor');

    Route::post('removeState', 'MajorControllers@removeState');

    Route::post('removeCompany', 'CompanyControllers@removeCompany');

    Route::post('removeMajor', 'MajorControllers@removeMajor');

    Route::post('updateState', 'MajorControllers@updateState');

    Route::post('updateCompany', 'CompanyControllers@updateCompany');

    Route::post('updateMajor', 'MajorControllers@updateMajor');


    Route::get('category/index', 'CategoryControllers@index');

    Route::get('getCategory', 'CategoryControllers@getCategory');



    Route::post('addCategory/{cat_id}/{is_edit}', 'CategoryControllers@addCategory');








    Route::post('addCatToAllAttr', 'Attr_allControllers@addCatToAllAttr');

    Route::post('getCatToAllAttr', 'Attr_allControllers@getCatToAllAttr');










    Route::get('getAllCategory', 'CategoryControllers@getAllCategory');


    Route::post('removeCategory', 'CategoryControllers@removeCategory');


    Route::post('catChild', 'CategoryControllers@getCatChild');

    Route::post('getChilds', 'CategoryControllers@getChilds');


    Route::post('catParent', 'CategoryControllers@getCatParent');

    Route::post('getSearchCat', 'CategoryControllers@getSearchCat');

    Route::post('getSearchCat', 'CategoryControllers@getSearchCat');


    Route::post('addCatToStateAttr', 'Attr_allControllers@addCatToStateAttr');
    Route::post('addCatToCompanyAttr', 'Attr_allControllers@addCatToCompanyAttr');

    Route::get('getCatToStateAttr', 'Attr_allControllers@getCatToStateAttr');



    Route::get('getAllAttr', 'Attr_allControllers@getAllAttr');




    Route::get('getCatToCompanyAttr', 'Attr_allControllers@getCatToCompanyAttr');

    Route::get('getCatToCompanyAttr', 'Attr_allControllers@getCatToCompanyAttr');

    Route::post('addMajorforUni', 'MajorControllers@addMajorforUni');
    Route::post('getMajor_for_uni', 'MajorControllers@getMajor_for_uni');
    Route::post('removeMajorSelectForUni', 'MajorControllers@removeMajorSelectForUni');


    Route::get('like/{post_id}/{like_value}', ['CategoryControllers@getLikePost']);

    Route::post('get_major_for_uni','MajorControllers@get_major_for_uni');




});


Route::get('getAddCategoryPage/{cat_id}/{cat_parent_id}/{is_edit}', 'CategoryControllers@getAddCategoryPage');



Route::get('index', 'IndexControllers@index');

Route::get('advert/index', 'AdvertControllers@index');





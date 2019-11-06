<?php

use App\Lib\Helper;

?>

@extends('layout.adminLayout')

@section('content')


    <style>

        form {
            display: inline-block
        }

        .table td {
            padding: 5px;
            border: 1px solid #9e6161;
            cursor: pointer;
            color: #720f1f;

        }

        .table th {
            color: #051340;
        }

        .content .panel {
            padding: 10px;
        }

        .divChild {
            display: none;
        }

        .parent_name {
            display: inline-block;
            width: 100%;
            background-color: #ccf2d1;
            border: 2px solid #e0dddd;
            padding: 10px 4px;
            margin-top: 30px;
        }

        .parent_name h2 {
            color: #c00c1a;
            display: inline-block;
            float: right;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            font-size: 16px;
            cursor: pointer;

        }

        .parent_name span {
            float: right;
            display: inline-block;
            color: #5e5e5e;
            font-size: 16px;
            padding: 0 12px;
        }

        i.fa.fa-eye {
            color: #4bb335;
            font-size: 17px;
        }

        i.fa.fa-eyedropper {
            color: #000086;
            font-size: 17px;
        }

        i.fa.fa-edit {
            color: #b50125;
            font-size: 17px;
        }

        .attrs {
            display: none;
        }

        .main .main-row ul li {
            color: #000;
        }

        .all_attr ul li span {
            vertical-align: 3px;
            margin-right: 7px;
        }
    </style>


    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <div class="content " style="background-color: #fff;height: 700px" id="app">
            <div class="panel panel-default ">

                <div class="cats">
                    <div class="divParent">

                        <button @click="removeCategoryParent()" class="btn btn-danger">حذف دسته</button>


                        <a class="btn btn-info" :href="/getAddCategoryPage/ +'idNo'+'/'+0+'/'+'editNO'">افزودن دسته</a>
                        <h2>دسته اصلی</h2>
                        <table class="table catParent " cellspacing="0">
                            <thead>
                            <tr>
                                <th>عنوان دسته</th>
                                <th>مشاهده زیر دسته</th>
                                <th>ویرایش</th>
                                <th>انتخاب</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for=" category in categories">
                                <td>@{{ category.title }}</td>
                                <td @click="getCatChild(category.id,category.parent_id)"><i class="fa fa-eye"></i></td>
                                <td>
                                    <a :href="/getAddCategoryPage/ + category.id+'/'+category.parent_id+'/'+'edit'">
                                        <i
                                                class="fa fa-edit">

                                        </i>
                                    </a>
                                </td>

                                <td><input class="checkBox" type="checkbox" v-model="ids" :value="category.id"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="divChild">

                        <button @click="removeCategory()" class="btn btn-danger">حذف دسته</button>


                        <a class="btn btn-info" :href="/getAddCategoryPage/ +'idNo'+'/'+category_id+'/'+'add'">

                            افزودن دسته
                        </a>

                        <div class="parent_name">
                            <h2 @click="getChilds('','')"> دسته اصلی </h2>
                            <h2 v-for="row in all_parent_name" @click="getChilds(row.id,row.parent_id)"><span>-</span>
                                @{{
                                row.title}} </h2>

                        </div>

                        <table class="table catChild " cellspacing="0">
                            <thead>
                            <tr>
                                <th>عنوان دسته</th>
                                <th>مشاهده زیر دسته</th>
                                <th>ویرایش</th>
                                <th>انتخاب</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="row in catChild">
                                <td>@{{ row.title }}</td>
                                <td ><i class="fa fa-eye"></i></td>
                                <td>
                                    <a :href="/getAddCategoryPage/ + row.id+'/'+row.parent_id+'/'+'edit'">
                                        <i
                                                class="fa fa-edit">

                                        </i>
                                    </a>
                                </td>


                                {{--         <td><input class="checkBox" @click="checkbox_is_checked()" type="checkbox" name="id[]"  :value="row.id"></td>--}}
                                <td><input class="checkBox" type="checkbox" v-model="ids" :value="row.id"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

    </div>


@endsection
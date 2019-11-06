@extends('layout.adminLayout')

@section('content')

    <style>
        .content > section {
            float: right;
        }

        .form-group {
            position: relative;
        }

        .company i.input.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;

        }
        
        .company i.select.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;

        }

        h3 {
            text-align: center;
        }

        .btn_cancel_update_company {
            display: none;
        }

        .city i.input.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;

        }

        .city i.select.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;

        }


        .cat i.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;
        }




        .form-control {
            direction: rtl;
        }


        .form-group.cat-list ul {
            z-index: 999;
            border: 1px solid #eee;
            width: 100%;
            float: right;
            position: absolute;
            top: 87px;
            right: 0;
            background: #fff;
        }

        .form-group.cat-list ul li {
            color: #000;
            padding-right: 9px;
            padding-top: 9px;
        }

        .form-group.cat-list ul li:hover {
            background: #eee;
            cursor: pointer;
        }

        .cat .form-group {
            height: 22px
        }

        input.form-control {
            direction: rtl;
            text-align: right;
        }
        .cat_input {
            display: inline-block;
            width: 100%;
            float: right;
            text-align: right;
        }



        .form-group.cat-list {
            position: relative;
        }

        .form-group.cat-list ul {
            z-index: 999;
            border: 1px solid #eee;
            width: 100%;
            float: right;
            position: absolute;
            top: 87px;
            right: 0;
            background: #fff;
        }

        .form-group.cat-list ul li {
            color: #000;
            padding-right: 9px;
            padding-top: 9px;
        }

        .form-group.cat-list ul li:hover {
            background: #eee;
            cursor: pointer;
        }

        .cat .form-group {
            height: 22px
        }

        input.form-control {
            direction: rtl;
            text-align: right;
        }

        .cat span {
            margin: 12px 5px;
            position: relative;
            background: #eee;
            border: 1px solid #aaa;
            padding: 3px 17px;
            border-radius: 3px;
            float: right;
        }

        .cat span i {
            color: #df0606;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }
        .save{
            text-align: center;
            height: 118px;
            line-height: 96px;
        }
        .save button{
            width: 100%;
            height: 55px;
            font-size: 20px;
        }
        input.cat_all{
            float: right;
            margin: 19px 4px;
        }
        label {
            float: right;
            margin: 16px 14px;
        }


    </style>



    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12" xmlns:v-on="http://www.w3.org/1999/xhtml">
        <div class="content " style="background-color: #fff;height: 700px" id="app">


            <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>دسته مورد نظر را انتخاب کنید </h3></div>

                    <div class="cat panel-body">
                        <div class="form-group ">
                            <select  class="form-control select_company"  v-model="category_id"
                                     v-on:change="getCompanyOfCategory($event.target.value)">


                                <option v-for="row in allCategories" :value="row.id">@{{ row.name }}</option>

                            </select>
                            <i class="select fa fa-star"></i>

                        </div>

                    </div>
                </div>
            </section>
            <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>اضافه کردن شرکت </h3></div>

                    <div class="company panel-body">
                        <div class="form-group">
                            <input type="text" placeholder="شرکت مورد نظر را وارد کنید"
                                   class="form-control" v-model="companyName">
                            <i class="input fa fa-star"></i>
                        </div>
                        <div class="form-group ">
                            <select class="form-control select_company"  v-model="company_id" >


                                <option v-for="row in companyOfCategory" :value="row.id">@{{ row.title }}</option>

                            </select>
                            <i class="select fa fa-star"></i>

                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn_cancel_update_company"
                                    v-on:click="cancelUpdateCompany()">لغو
                            </button>
                            <button type="button" class="btn btn-info btn_add_company" v-on:click="addCompany()">ذخیره
                            </button>
                            <button type="button" class="btn btn-danger btn_remove_company" v-on:click="removeCompany()">
                                حذف
                            </button>
                            <button type="button" class="btn btn-info btn_update_company" v-on:click="updateCompany()">
                                ویرایش
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>دسته بندی</h3></div>

                    <div class="cat panel-body">

                        <input  type="checkbox"  v-model="is_check_for_all_cat"    class="cat_all"> <label>همه دسته ها</label>

                        <div class="form-group cat_selected" >

                            <input @input="getSearchCat($event)" placeholder=" دسته مورد نظر را سرچ کنید"
                                   class="form-control cat_input" v-model="cat_name">


                            <div class="form-group cat-list">
                                <ul>
                                    <li v-for="row in searchCat" v-on:click="selectCatForCompany(row)">@{{ row.name }}</li>
                                </ul>

                                <span v-for="(row, index) in catSelect_for_company">@{{ row.name }} <i @click="removeSelectForCompany(index)" class="fa fa-close"></i></span>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>ذخیره</h3></div>

                    <div class="save panel-body">

                        <button style="text-align: center" class="btn btn-info" @click="addCatToCompanyAttr()">ذخیره</button>

                    </div>
                </div>
            </section>


        </div>

    </div>


@endsection
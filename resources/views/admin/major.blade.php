@extends('layout.adminLayout')

@section('content')

    <style>
        .content > section {
            float: right;
        }

        .form-group {
            position: relative;
        }
        .state{
            position: relative;
        }
        .state ul{
            position: absolute;
            top: 4px;
            left: 0;
        }
        .state i.input.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;

        }

        .state i.select.fa-star {
            color: #f50000;
            position: absolute;
            top: 9px;
            right: -13px;
            display: none;

        }

        h3 {
            text-align: center;
        }

        .btn_cancel_update_state {
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


        .btn_cancel_update_city {
            display: none;
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
            top: -15px;
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

        .cat-list span {
            margin: 12px 5px;
            position: relative;
            background: #eee;
            border: 1px solid #aaa;
            padding: 3px 17px;
            border-radius: 3px;
            float: right;
        }

        .cat-list span i {
            color: #df0606;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }

        .save {
            text-align: center;
            height: 118px;
            line-height: 96px;
        }

        .save button {
            width: 100%;
            height: 55px;
            font-size: 20px;
        }

        input.cat_all {
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
                    <div class="panel-heading"><h3>اضافه کردن رشته </h3></div>

                    <div class=" city panel-body">
                        <div class="form-group">
                            <input type="text" placeholder=" محله مورد نظر را وارد کنید"
                                   class="form-control" v-model="majorName">
                            <i class="input fa fa-star"></i>
                        </div>
                        <div class="form-group">
                            <select class="form-control select_city" v-model="major_id">


                                <option v-for="row in major" :value="row.id">@{{ row.title }}</option>

                            </select>
                            <i class="select fa fa-star"></i>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn_cancel_update_city"
                                    v-on:click="cancelUpdateCity()">لغو
                            </button>
                            <button type="button" class="btn btn-info btn_add_city" v-on:click="addMajor()">ذخیره
                            </button>
                            <button type="button" class="btn btn-danger btn_remove_city" v-on:click="removeMajor()">
                                حذف
                            </button>
                            <button type="button" class="btn btn-info btn_update_city" v-on:click="updateMajor()">
                                ویرایش
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>دانشگاه خود را انتخاب کنید </h3></div>

                    <div class="state  panel-body">
                        <div class="form-group">
                            <input type="text" placeholder=" دانشگاه مورد نظر را سرچ کنید"
                                   class="form-control" v-model="uniName">
                            <i class="input fa fa-star"></i>
                        </div>
                        <div class="form-group cat-list">
                            <ul>
                                <li v-for="row in allUni " v-if="row.parent_id != 0" v-on:click="selectCatForCompany(row)">@{{ row.title }}</li>
                            </ul>

                            <span v-for="(row, index) in majorSelect_for_uni">@{{ row.title }} <i @click="removeMajorSelectForUni(row.id)" class="fa fa-close"></i></span>

                            <button class="btn btn-success" @click="addMajorforUni()">ثبت رشته برای  @{{ uniName }} </button>
                        </div>

                    </div>
                </div>
            </section>

        </div>

    </div>


@endsection

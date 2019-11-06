<style>
    body {
        background: #eee !important;
    }

    .register_advert {
        display: none
    }

    .submit {
        display: none
    }

    .row-category {
        width: 83%;
        margin: 0 auto;
    }

    @media (min-width: 900px) {
        .row-category {
            width: 60%;
            margin: 0 auto;
        }
    }

    .row-category .category-title {
        margin-bottom: 29px;
    }

    .row-category .category-title h1 {
        color: #313131;
        font-size: 22px;
        font-weight: 700
    }

    .row-category .category-all-item {
        background: #fff;
        border: 1px solid #eee;
        padding: 20px 35px;
    }


    .row-category .category-all-item .category-item {
        padding: 13px 8px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }
    .row-category .category-all-item .category-item.cat-parent {
        display: none;
        border-bottom: 2px solid #d1d1d1 !important;
        padding: 23px
    }


    .row-category .category-all-item .category-item i {
        float: left;
        display: none;
    }


    .row-category .category-all-item .category-item.cat-parent i {
        display: inline-block !important;
        float: right;
        margin-left: 9px;
        font-size: 23px;
        border-left: 2px solid #888;
        padding-left: 21px;
        padding-bottom: 4px;
    }
    .row-category .category-all-item .category-item:hover{
       background: #e5eeee;
    }
    .row-category .category-all-item .category-item:hover i {
        font-size: 25px;
        display: inline-block;
    }
    .forms{
        display: none;
    }
 /*   .row-category .category-all-item .category-item.cat-child.checked:hover i:before {
        content: "\f05d" !important;
    }*/

</style>


@extends('layout.indexLayout')


@section('content')

    @include('layout.indexHeader')


    <div class="container" id="app">
        <div class="row">
            <div class="row-category">
                <div class="category-title"><h1>ثبت رایگان آگهی</h1></div>
                <div class="category-all-item">


                    <div v-for=" category in categories" @click="getCatChild(category.id)"  class="cat-main category-item">
                        <i class="fa fa-angle-left"></i>
                        @{{ category.title }}
                    </div>




                    <div  class="category-item cat-parent" :value="category_parent_id" @click="getCatParent(category_parent_id)">
                        <i class="fa fa-angle-right"></i>
                        @{{ categoryName}}
                    </div>





                    <div v-for="row in catChild"  @click="getMajor_for_uni(row.id)" class="cat-child category-item ">
                        <i class="fa fa-angle-left"></i>
                        @{{ row.title}}
                    </div>

                </div>
                <div class="row form-group-lg forms">
                    <form action="">
                        <a @click="last_form()">hjkljkhjkl</a>
                    </form>
                </div>
            </div>
        </div>
    </div>




    @include('layout.indexModal')

@endsection

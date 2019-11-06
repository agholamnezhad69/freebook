@extends('layout.adminLayout')

@section('content')

    <style>
        h2 {
            text-align: right;
            font-size: 16px;
            background: #ccf2d1;
            padding: 11px 11px;
            border: 1px solid #baaaaa;
        }

        .content .panel {
            padding: 8px 10px;
        }

        .row-new {
            margin-top: 10px;
            width: 100%;
            text-align: right;
            direction: rtl;
        }

        .row-new input {
            font-size: 10pt;
            font-family: BYeeekan;
            padding-right: 3px
        }

        .row-new span {
            display: inline-block;
            width: 100px;
        }

        .row-new select {

            width: 133px;

        }

        .row-new.action {
            text-align: left;
        }

        .btn-danger {
            color: #fff !important;
        }

    </style>



    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <div class="content " style="background-color: #fff;height: 700px" id="app">
            <div class="panel panel-default ">
                @if($is_edit == 'edit')

                    <h2>ویرایش دسته</h2>
                @else

                    <h2>ایجاد دسته جدید</h2>

                @endif

                <form ref="form" method="post" action="/admin/addCategory/{{$cat_id}}/{{$is_edit}}">

                    <div class="row-new">
                        <span> عنوان دسته : </span>

                        @if($is_edit == 'edit')

                            <input type="text" name="nameCat" value="{{$cat_name}}">
                        @else

                            <input type="text" name="nameCat" value="">

                        @endif

                    </div>

                    <div class="row-new">
                        <span> دسته والد : </span>

                        <select autocomplete="off" disabled>
                            <option value="0">دسته اصلی</option>
                            @foreach($allCategory as $row)

                                @if($cat_parent_id == $row['id'])

                                    <?php $x = 'selected' ?>

                                    <option value="{{$row['id']}}" {{$x}}>{{$row['title']}}</option>
                                @else

                                    <option value="{{$row['id']}}">{{$row['title']}}</option>


                                @endif

                            @endforeach
                        </select>

                    </div>

                    <div class="row-new action">

                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type="hidden" name="cat_parent_id" value="{{$cat_parent_id}}">



                        @if($is_edit == 'edit')

                            <button class="btn btn-info">ویرایش دسته</button>
                        @else

                            <button class="btn btn-info">افزودن دسته</button>

                        @endif
                    </div>

                </form>
            </div>
        </div>

    </div>


@endsection
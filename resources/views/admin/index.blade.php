@extends('layout.adminLayout')

@section('content')

    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-12">
        <div class="content" style="background-color: #1b4b72;height: 700px">

            <div class="content-top">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                    <div class="content-box">
                        <i class="fa fa-user"></i>
                        <span>5</span>
                        <p>تعداد کاربران</p>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                    <div class="content-box">
                        <i class="fa fa-user"></i>
                        <span>5</span>
                        <p>تعداد کاربران</p>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 ">
                    <div class="content-box">
                        <i class="fa fa-user"></i>
                        <span>5</span>
                        <p>تعداد کاربران</p>
                    </div>

                </div>

            </div>
            <div class="clearfix"></div>
            <div class="panel panel-default ">
                <h2> بخش سفارشات</h2>
                <table class="table" >
                    <thead>
                    <tr>
                        <th>نام سفارش</th>
                        <th>تاریخ خرید</th>
                        <th>شماره پیگیری</th>
                        <th>مبلغ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>20000</td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>20000</td>
                    </tr>
                    <tr>
                        <td>July</td>
                        <td>Dooley</td>
                        <td>july@example.com</td>
                        <td>20000</td>
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection



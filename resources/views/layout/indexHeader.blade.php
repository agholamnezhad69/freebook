<style>
    @font-face {
        font-family: "sahel";
        src: url('/font/Sahel-FD-WOL.eot') format("eot"),
        url('/font/Sahel-FD-WOL.ttf') format("truetype"),
        url('/font/Sahel-FD-WOL.woff') format("woff");
    }

    @font-face {
        font-family: 'BYeeekan' ;
        src: url('/font/BYekan.eot') format('embedded-opentype'),
        url('/font/BYekan.ttf') format('truetype'),
        url('/font/BYekan.woff') format('woff');
    url('/font/BYekan.woff') format('woff');
    }

    ul {
        padding: 0;
        margin: 0;
    }

    li {
        list-style: none;
    }

    a, a:focus, a:active, a:visited, a:hover {
        color: #616161;
        text-decoration: none;
        transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
    }

    body {
        direction: rtl;
        font-size: 14px;
        font-family: BYeeekan;
    }

    /***************************************************start nav*/
    ul.nav.navbar-nav.navbar-left {
        padding-right: 18px;
    }

    i.fa.fa-user {
        font-size: 40px;
        color: #b72222;
    }

    .open > .dropdown-menu {
        display: none;
    }

    @media (max-width: 767px) {
        .navbar-nav .open .dropdown-menu > li > a {
            line-height: 20px;
            text-align: right;
        }
    }

    .collapse.in {
        display: none;
    }

    .navbar-toggle {

        float: left;
        margin-right: unset;
        margin-left: 20px;

    }

    .navbar-inverse {
        background-color: #fff;
        border-color: #ffffff;
    }

    .navbar-inverse .navbar-nav > li > a:focus, .navbar-inverse .navbar-nav > li > a {
        color: #404040;
        background-color: transparent;
    }

    .navbar-inverse .navbar-nav > .open > a, .navbar-inverse .navbar-nav > .open > a:focus, .navbar-inverse .navbar-nav > .open > a:hover {
        color: unset;
        background-color: unset;
    }

    .navbar-inverse .navbar-nav > li > a:focus, .navbar-inverse .navbar-nav > li > a:hover {
        color: #f70000 !important;
        background-color: transparent;
    }

    .navbar-inverse .navbar-toggle {
        border-color: #d3cdcd;
    }

    .navbar-inverse .navbar-toggle .icon-bar {
        background-color: #000;
    }

    .navbar-inverse .navbar-toggle:focus, .navbar-inverse .navbar-toggle:hover {
        background-color: unset;
    }


    #menue .register_advert a {

        display: inline-block;
        color: #fff;
        padding: 5px 7px;
        background: #c00c1a;
        margin-right: 19px;
        margin-top: 11px;
        border-radius: 4px;
    }

    .navbar-header .submit a {
        color: #fff;
        padding: 5px 6px;
        background: #c00c1a;
        margin-right: 19px;
        margin-top: 11px;
        border-radius: 4px;
        float: left;
        margin-left: 5px;
        display: none;
    }

    .navbar-header .register_advert a {
        display: inline-block;
        color: #fff;
        padding: 5px 20px;
        background: #c00c1a;
        margin-right: 19px;
        margin-top: 11px;
        border-radius: 4px;
        float: left;
        margin-left: 10px;
    }


    @media (max-width: 500px) {
        .navbar-header .submit a {
            display: inline-block;
        }

        .navbar-header .register_advert a {
            display: none !important;
        }
    }

    #menue .navbar #bs-example-navbar-collapse-1 {
        border: 1px solid #eee;
        padding: 0 28px;
    }

    .navbar-header .selector {
        display: inline-block;
        margin-right: 20px;
    }

    @media (min-width: 768px) {
        .navbar-header .selector {
            display: none !important;
        }

    }

    @media (max-width: 768px) {
        .nav .selector {
            display: none !important;
        }

    }

    .selector button {
        position: relative;
        border: 1px solid #c8c8c8;
        padding: 6px 12px;
        width: 142px;
        margin-top: 11px;
        box-sizing: border-box;
        background: #fff;
    }

    .selector button:hover {

        border: 1px solid #aaa;

    }

    .selector button span {
        margin-left: 53px;
    }


    .selector button .fa-angle-down {
        background-color: rgba(0, 0, 0, .05);
        position: absolute;
        top: 0;
        left: 0;
        color: #afa6a6;
        padding: 9px;
    }

    .selector > div {
        float: right;
        margin-right: 8px;
    }

    .selector .divar-logo {
        margin-top: 5px;
        display: inline-block;
        width: 40px;
        height: 40px;
        background: url("../images/divar-logo.PNG");
    }

    .main {
        width: 100%;
        float: right;
    }

    .main-row > div {
        float: right;
    }

    .main .main-row {
        width: 100%;
        float: right;
    }

    .main-left .search-city {
        position: relative;
    }

    .main-left .search-city input {

        font-size: 14px;
        padding: 4px 17px;
        width: 100%;
        text-align: right;

    }

    .main-left .search-city input:active {
        border: unset !important;
        border: 1px solid #eee !important;
    }

    .main-left .search-city {

        margin-bottom: 30px;
    }

    .main-left .search-city i {
        position: absolute;
        top: 0px;
        left: 0px;
        background: #706868;
        width: 36px;
        height: 32px;
        display: inline-block;
        text-align: center;
        line-height: 32px;
        color: #fff;

    }

    .main-left .city {
        width: 100%;
        float: right;
    }

    .main-left .city .city-group-header {
        text-align: right;
        padding-right: 7px;
        padding-bottom: 19px;
        color: #757575;
        font-size: 12px;
    }

    .main-left .city .city-group {
        width: 100%;
        float: right;
        padding-left: 5px;
        margin-bottom: 14px;
    }

    .main-left .city .city-group a {
        display: inline-block;
        width: 100%;
        border: 1px solid #c00c1a !important;
        padding: 3px 35px;
        color: #c00c1a;
        margin-bottom: 5px;
        text-align: center;

    }


</style>

<div class="row" id="menue">
    <!-- navbar-inverse :  -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="submit"><a href="">ارسال</a></div>
                <div class="register_advert"><a href="">ثبت رایگان آگهی</a></div>
                <div class="selector">
                    <div class="logo"><a href=""><i class="divar-logo"></i></a></div>
                    <div class="city">
                        <button data-toggle="modal" data-target="#myModal">
                            <span>انتخاب شهر</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>

                </div>


            </div>


            <div class="navbar-collapse collapse in" id="bs-example-navbar-collapse-1" aria-expanded="true" style="">
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown open">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="true">تیم ها <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">پرسپولیس</a></li>
                            <li><a href="#">استقلال</a></li>
                            <li><a href="#">سپاهان</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">برترین بازیکنان</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">گلهای برتر</a></li>
                        </ul>
                    </li>
                    <li><a href="#">درباره ما</a></li>
                    <li><a href="#">بلاگ</a></li>
                    <li><a href="#">چت</a></li>
                    <li><a href="#">تماس با ما</a></li>

                </ul>
                <div class="  nav navbar-nav navbar-right logo">
                    <div class="selector">
                        <div class="logo"><a href=""><i class="divar-logo"></i></a></div>
                        <div class="city">
                            <button data-toggle="modal" data-target="#myModal">
                                <span>انتخاب شهر</span>
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </nav>


</div>
<div class="clearfix"></div>

<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/admin.css">


</head>
<body>

@include('layout.adminHeader')

<div class="main">
    <div class="main-row">
          @include('layout.adminSidebar')
          @yield('content');
    </div>
</div>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
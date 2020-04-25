<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield("CustomMeta")
    <title>{{ config('app.name', 'Laravel') }}</title>
    <title>@yield("title","Human Resource Panel") </title>


    <!-- Bootstrap -->
    <link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset("assets/css/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset("assets/css/nprogress.css")}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset("assets/css/custom.css")}}" rel="stylesheet">

    @yield("CustomCss")
</head>

<body class="nav-md footer_fixed">
<div class="container body">
    <div class="main_container">

        <!-- left sidebar -->
        @include("include.left-sidebar")

        <!-- top navigation header-->
        @include("include.header")
        <!-- /top navigation header -->
        <div class="right_col" role="main">
            <div class="">
                <div class="clearfix"></div>
                <!-- page content -->
                @yield("contents")
                <!-- /page content -->
            </div>
        </div>

        <!-- footer content -->
         @include("include.footer")
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="{{asset("assets/js/jquery.js")}}"></script>
<!-- Bootstrap -->
<script src="{{asset("assets/js/bootstrap.js")}}"></script>
<!-- FastClick -->
<script src="{{asset("assets/js/fastclick.js")}}"></script>

<!-- NProgress -->
<script src="{{asset("assets/js/nprogress.js")}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset("assets/js/custom.js")}}"></script>

@yield("CustomJs")

</body>
</html>

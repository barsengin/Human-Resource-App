<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>


    <!-- Bootstrap -->
    <link href="{{asset("assets/css/bootstrap.css")}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset("assets/css/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset("assets/css/nprogress.css")}}" rel="stylesheet">

    <link href="{{asset("assets/css/animate.css")}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset("assets/css/custom.css")}}" rel="stylesheet">

    @yield("customCss")

</head>

<body class="login">
    <!-- page content -->
    @yield("content")
    <!-- /page content -->

    @yield("customJs")
</body>
</html>

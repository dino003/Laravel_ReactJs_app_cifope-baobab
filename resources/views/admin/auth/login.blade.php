<!DOCTYPE HTML>
<html>
<head>
    <title>KOGNISHARE | ADMIN :: CONNEXION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <link href="{{asset('/admin/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
    <!-- Custom Theme files -->
    <link href="{{asset('/admin/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <!--js-->
    <script src="{{asset('/admin/js/jquery-2.1.1.min.js')}}"></script>
    <!--icons-css-->
    <link href="{{asset('/admin/css/font-awesome.css')}}" rel="stylesheet">
    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
    <!--static chart-->

    <style>
        .login-head {
            background: url({{asset('/admin/images/login.jpg')}})no-repeat;
            background-size: cover;
            min-height: 150px;
        }

    </style>
</head>
<body>
<div class="login-page">
    <div class="login-main">
        <div class="login-head">
            <h1>Administration</h1>
        </div>
        <div class="login-block">
            <form method="POST" action="{{ url('/admin_login') }}">
                {{ csrf_field() }}

                <input type="text" name="email" placeholder="Email" required="" autofocus>
                <input type="password" name="password" class="lock" placeholder="Password">
                <div class="forgot-top-grids">
                    <div class="forgot-grid">
                        <ul>
                            <li>
                                <input type="checkbox" name="remember" id="brand1" value="{{ old('remember') ? 'checked' : ''}}">
                                <label for="brand1"><span></span>Rester connecté</label>
                            </li>
                        </ul>
                    </div>
                    <div class="forgot">
                        <a href="{{ url('/admin_password/reset') }}">Mot de passe oublié ?</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <input type="submit"  value="Connexion">

            </form>
        </div>
    </div>
</div>
<!--inner block end here-->
<!--copy rights start here-->

<!--COPY rights end here-->

<!--scrolling js-->
<script src="{{asset('/admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('/admin/js/scripts.js')}}"></script>
<!--//scrolling js-->
<script src="{{asset('/admin/js/bootstrap.js')}}"> </script>
<!-- mother grid end here-->
</body>
</html>





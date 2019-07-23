@guest

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
            <h1>Kognishare Entreprise</h1>
        </div>
        <div class="login-block">
            <form method="POST" action="{{route('login')}}">
                {{ csrf_field() }}

                <input type="text" name="email" placeholder="Numero de telephone ou Email" required="" autofocus>
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
                        <a href="{{route('password.request')}}">Mot de passe oublié ?</a>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <input type="submit"  value="Connexion">

            </form>
        </div>
    </div>
</div>

<script src="{{asset('/admin/js/bootstrap.js')}}"> </script>
<!-- mother grid end here-->
</body>
</html>

@else


<!DOCTYPE HTML>
<html>
@include('admin.templates.partials.header')

<body>

<div class="page-container">
    <div class="left-content">
        <div class="mother-grid-inner">
            <!--header start here-->
            @include('admin.templates.partials.nav')
            <!--
            <vue-toastr ref="toastr"></vue-toastr>
             <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
            -->
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
    <!--slider menu-->
    @include('admin.templates.partials.menu')

    <div class="clearfix"> </div>
</div>

<div class="loading">
    <i class="fa fa-refresh fa-spin fa-2x fa-tw"></i>
    <br>
    <span>Chargement</span>
</div>
<!--slide bar menu end here-->
@include('admin.templates.partials.footer')
<script>
    $('#photoPencil').click(function(){
        $('#photo').trigger('click');
    });

   

</script>


<script> $(function() { $('textarea').froalaEditor({
        heightMin: 250,
      heightMax: 200
    }) }); </script>





<script type="text/javascript">
            $(document).ready(function() {
                $('input[type="file"]').imageuploadify();
            })
</script>
@yield('script')
@yield('userAjax')
@yield('script_index_user')
@yield('structureid')
@yield('document')
@yield('dossier')
@yield('listePeronnel')
@yield('listeUser')
@yield('affecter')
@yield('retirer')
@yield('document_chef_recu01')
@yield('document_chef_envoye')
@yield('document0110')
</body>


</html>

@endguest
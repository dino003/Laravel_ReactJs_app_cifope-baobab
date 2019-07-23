<head>
    <title>KOGNISHARE | ADMINISTRATION </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/css/froala_style.min.css" rel="stylesheet" type="text/css" />
  
    <!-- Custom Theme files -->
    <link href="{{asset('/admin/css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <!--js-->
    <!--icons-css-->
    <link href="{{asset('/admin/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/build/css/intlTelInput.css')}}">
    <link rel="stylesheet" href="{{asset('/build/css/demo.css')}}">
    <link href="{{asset('css/chats/chat.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/semantic.min.css')}}" rel="stylesheet">



  <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.3.911/styles/kendo.common.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.3.911/styles/kendo.rtl.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.3.911/styles/kendo.silver.min.css"/>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.3.911/styles/kendo.mobile.all.min.css"/>

 


    <link rel="stylesheet" href="{{asset('css/dataTable/dataTables.bootstrap.min.css')}}">

    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="{{asset('css/bootstrap-min.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap-treeview.css')}}" rel="stylesheet">
 <!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">-->
<link href="{{asset('dist/imageuploadify.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('/css/dropzone.css')}}">
    <script src="{{asset('/js/dropzone.js')}}"></script>
    
    <style>
        .login-head {
            background: url({{asset('/admin/images/login.jpg')}})no-repeat;
            background-size: cover;
            min-height: 150px;
        }
        div#load_screen{
            background: #FFF;
            opacity: 1;
            z-index: 10;
            position: fixed;
            top: 0px;
            width: 100%;
            height: 1600px;
        }
        div#load_screen > div#loading{
            color: #FFF;
            width: 120px;
            height: 24px;
            margin: 300px auto;
        }
        div.sidebar-menu a{
            text-decoration:none;
        }

             
.progress {
  height: 35px;

}
.progress .skill {
  font: normal 12px "Open Sans Web";
  line-height: 35px;
  padding: 0;
  margin: 0 0 0 20px;
  text-transform: uppercase;
}
.progress .skill .val {
  float: right;
  font-style: normal;
  margin: 0 20px 0 0;
}

.progress-bar {
  text-align: left;
  transition-duration: 3s;
}   
        


    </style>
   

    


</head>
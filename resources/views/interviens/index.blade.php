@extends('admin.templates.main')


@section('content')
<style type="text/css">
 #imaginary_container{
    margin-top:2%; /* Don't copy this */
}
.stylish-input-group .input-group-addon{
    background: white !important; 
}
.stylish-input-group .form-control{
  border-right:0; 
  box-shadow:0 0 0; 
  border-color:#ccc;
}
.stylish-input-group button{
    border:0;
    background:transparent;
}

/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #318CE7;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #318CE7;
  background-image: #318CE7;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #318CE7;
}

div.bhoechie-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

div.bhoechie-tab div.bhoechie-tab-content:not(.active){
  display: none;
}
</style>


<!------ Include the above in your HEAD tag ---------->

<div class="container">
  <div class="row">
        <div class=" col-xs-10 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="glyphicon glyphicon-folder-open"></h4><br/>Mes dossiers accéssibles
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-repeat"></h4><br/>Recherche multi critères
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-search"></h4><br/>Recherche monocritère
                </a>
             
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                   <div class="row">
      <div class="col-md-1"></div>
       <div class="col-md-8">
             <br>

    <ul class="list-group">
      <?php foreach ($messtructure as  $value): 
           $param=Crypt::encrypt($value->structure->id);
          ?>
  <li class="list-group-item">
 <div class="row"><a href="{{url('DetailService')}}/{{$param}}">
   <div class="col-md-8">  <font color="black"> {{$value->structure->nom_structure}}</font></div>
   <div class="col-md-4" align="right">
       <font color="black"><i class="far fa-folder-open"></i></font>
   </div></a>
 </div>
  
  
  </li>
  
  <?php endforeach ?>
</ul>
  
       </div>
        <div class="col-md-1"></div>
    </div>
                </div>


<div class="bhoechie-tab-content">
    <form method="post"  id="formulaire1000" enctype="multipart/form-data" >
          {{ csrf_field() }}
  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="inputEmail4">Nom du document</label>
      <input type="" class="form-control" name="nom_document">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Auteur</label>
      <input type="" class="form-control" name="auteur">
    </div>
        <div class="form-group col-md-3">
      <label for="inputZip">Type de fichier</label>
      <select class="form-control" name="type">
 <option ></option>
 <option value="pdf.png">PDF</option>
 <option value="DOCX.ico">World</option>
 <option value="Excel.png">Excel</option>
  <option value="point.png">PowerPoint</option>
   <option value="access.png">Access</option>
 <option value="project.png">MSProjet</option>
 <option value="visio.png">Visio</option>
 <option value="zip.png">Zip</option>
 <option value="onenote.png">OneNote</option>
 <option value="publishi.png">Publisher</option>
 
      </select>
    </div>
  </div>
 
  <div class="form-row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <fieldset><legend>Pediode</legend>
        <div class="form-group col-md-6">
      <!--label for="inputCity">Date debut</label-->
      <input type="date" class="form-control"  name="date_debut">
    </div>
    <div class="form-group col-md-6">
      <!--label for="inputState">Date fin</label-->
     <input type="date" class="form-control" name="date_fin">
    </div>
     </fieldset>
    </div>
   
  </div>
  <div class="form-row">

 <div class="form-group col-md-4">
  
 </div>
  <div class="form-group col-md-2">
   
                        
                      <button type="submit" class="btn btn-primary has-spinner1">Recherche <span class="glyphicon glyphicon-search"></span>  </button>
                         
                 

 </div>
  <div class="form-group col-md-12">
   <div id="consult_recherche">
     
   </div>
 </div>
</div>
 
</form>
 </div>
          

                <!-- train section -->
          <div class="bhoechie-tab-content">
             <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8">
       <div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
               <input type="text" class="form-control"  id="search" placeholder="Recherche de documents" >
                    <span class="input-group-addon">
                        
                            <span class="glyphicon glyphicon-search"></span>
                         
                    </span>
                </div>
            </div>
        
    </div>
    <div class="col-md-1"></div>
  </div>
   <div class="row">
    
    <div class="col-md-12">
      <div id="rech"></div>
    </div>
    
  </div>
                </div>


    
              
            </div>
        </div>
  </div>
</div>

@section('document')
<script type="text/javascript">
  $(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>
<script>
  $(function () {
   

      $('#messervice').DataTable()
  })
</script>


<script type="text/javascript" >
$(document).ready(function(){


$(document).on('keyup','#search',function(){

  var query=$(this).val();
  //console.log(query);
   $.ajax({
  url:"{{route('rechercherDoc.action')}}",
  method:'GET',
  data:{query:query},
  dataType:'json',
  success:function(data){
    console.log(data);
     $('#loadingimage').hide();
   $('#rech').html(data.table_data);
    /*$('#rech').text(data.total_data);
    $('#paginate').text(data.paginate_data);*/
  }  ,error: function(data){
       // console.log(data);
    }
})
});

});

</script>
<script type="text/javascript">
  $(document).ready(function () {

      $('.has-spinner1').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);

            //console.log(formData);
        $.ajax({
            url: "{{ url('recherchedocument')}}",
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
             error: function(xhr, status, error) {
  $(btn).buttonLoader('stop');
        swal({
           title: "une erreur s'est produite au cours de la recherche",
           text: "",
            icon: "error",
            button: "ok",
              });
             }
             ,
            success: function (data) {
          
                $(btn).buttonLoader('stop');
                //alert("Data Uploaded: "+data);
            $('#consult_recherche').html(data.table_data);
                   //$("#formulaire1000").trigger("reset");
           
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
      });
  });
</script>
@endsection

@endsection
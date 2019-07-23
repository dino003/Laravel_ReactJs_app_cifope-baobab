@extends('admin.templates.main')

@section('content')
<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
.board{
    width: 97%;
margin: 2px auto;
height: 500px;
background: #fff;
/*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
}
.board .nav-tabs {
    position: relative;
    /* border-bottom: 0; */
    /* width: 80%; */
    margin: 40px auto;
    margin-bottom: 0;
    box-sizing: border-box;

}


p.narrow{
    width: 60%;
    margin: 10px auto;
}

.liner{
    height: 2px;
    background: #ddd;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    /* background-color: #ffffff; */
    border: 0;
    border-bottom-color: transparent;
}

span.round-tabs{
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: white;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}

span.round-tabs.one{
    color: rgb(34, 194, 34);border: 2px solid rgb(34, 194, 34);
}

li.active span.round-tabs.one{
    background: #fff !important;
    border: 2px solid #ddd;
    color: rgb(34, 194, 34);
}

span.round-tabs.two{
    color: #febe29;border: 2px solid #febe29;
}

li.active span.round-tabs.two{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #febe29;
}

span.round-tabs.three{
    color: #3e5e9a;border: 2px solid #3e5e9a;
}

li.active span.round-tabs.three{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #3e5e9a;
}

span.round-tabs.four{
    color: #f1685e;border: 2px solid #f1685e;
}

li.active span.round-tabs.four{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #f1685e;
}

span.round-tabs.five{
    color: #999;border: 2px solid #999;
}

li.active span.round-tabs.five{
    background: #fff !important;
    border: 2px solid #ddd;
    color: #999;
}

.nav-tabs > li.active > a span.round-tabs{
    background: #fafafa;
}
.nav-tabs > li {
    width: 20%;
}
/*li.active:before {
    content: " ";
    position: absolute;
    left: 45%;
    opacity:0;
    margin: 0 auto;
    bottom: -2px;
    border: 10px solid transparent;
    border-bottom-color: #fff;
    z-index: 1;
    transition:0.2s ease-in-out;
}*/
.nav-tabs > li:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #ddd;
    transition:0.1s ease-in-out;
    
}
.nav-tabs > li.active:after {
    content: " ";
    position: absolute;
    left: 45%;
   opacity:1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #ddd;
    
}
.nav-tabs > li a{
   width: 70px;
   height: 70px;
   margin: 20px auto;
   border-radius: 100%;
   padding: 0;
}

.nav-tabs > li a:hover{
    background: transparent;
}

.tab-content{
}
.tab-pane{
   position: relative;
padding-top: 50px;
}
.tab-content .head{
    font-family: 'Roboto Condensed', sans-serif;
    font-size: 25px;
    text-transform: uppercase;
    padding-bottom: 10px;
}
.btn-outline-rounded{
    padding: 10px 40px;
    margin: 20px 0;
    border: 2px solid transparent;
    border-radius: 25px;
}

.btn.green{
    background-color:#5cb85c;
    /*border: 2px solid #5cb85c;*/
    color: #ffffff;
}



@media( max-width : 585px ){
    
    .board {
width: 90%;
height:auto !important;
}
    span.round-tabs {
        font-size:16px;
width: 50px;
height: 50px;
line-height: 50px;
    }
    .tab-content .head{
        font-size:20px;
        }
    .nav-tabs > li a {
width: 50px;
height: 50px;
line-height:50px;
}

.nav-tabs > li.active:after {
content: " ";
position: absolute;
left: 35%;
}

.btn-outline-rounded {
    padding:12px 20px;
    }
}

.user-row {
    margin-bottom: 14px;
}

.user-row:last-child {
    margin-bottom: 0;
}

.dropdown-user {
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover {
    cursor: pointer;
}

.table-user-information > tbody > tr {
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child {
    border-top: 0;
}


.table-user-information > tbody > tr > td {
    border-top: 0;
}
.toppad
{margin-top:20px;
}

.message-item {
margin-bottom: 25px;
margin-left: 40px;
position: relative;
}
.message-item .message-inner {
background: #fff;
border: 1px solid #ddd;
border-radius: 3px;
padding: 10px;
position: relative;
}
.message-item .message-inner:before {
border-right: 10px solid #ddd;
border-style: solid;
border-width: 10px;
color: rgba(0,0,0,0);
content: "";
display: block;
height: 0;
position: absolute;
left: -20px;
top: 6px;
width: 0;
}
.message-item .message-inner:after {
border-right: 10px solid #fff;
border-style: solid;
border-width: 10px;
color: rgba(0,0,0,0);
content: "";
display: block;
height: 0;
position: absolute;
left: -18px;
top: 6px;
width: 0;
}
.message-item:before {
background: #fff;
border-radius: 2px;
bottom: -30px;
box-shadow: 0 0 3px rgba(0,0,0,0.2);
content: "";
height: 100%;
left: -30px;
position: absolute;
width: 3px;
}
.message-item:after {
background: #fff;
border: 2px solid #ccc;
border-radius: 50%;
box-shadow: 0 0 5px rgba(0,0,0,0.1);
content: "";
height: 15px;
left: -36px;
position: absolute;
top: 10px;
width: 15px;
}
.clearfix:before, .clearfix:after {
content: " ";
display: table;
}
.message-item .message-head {
border-bottom: 1px solid #eee;
margin-bottom: 8px;
padding-bottom: 8px;
}
.message-item .message-head .avatar {
margin-right: 20px;
}
.message-item .message-head .user-detail {
overflow: hidden;
}
.message-item .message-head .user-detail h5 {
font-size: 16px;
font-weight: bold;
margin: 0;
}
.message-item .message-head .post-meta {
float: left;
padding: 0 15px 0 0;
}
.message-item .message-head .post-meta >div {
color: #333;
font-weight: bold;
text-align: right;
}
.post-meta > div {
color: #777;
font-size: 12px;
line-height: 22px;
}
.message-item .message-head .post-meta >div {
color: #333;
font-weight: bold;
text-align: right;
}
.post-meta > div {
color: #777;
font-size: 12px;
line-height: 22px;
}
img {
 min-height: 40px;
 max-height: 40px;
}


</style>
 
<div class="container">
<vue-toastr ref="toastr"></vue-toastr>


<section style="background:#efefe9; height: auto;">
        <div class="container">

        
                               <!-- modal full pour afficher image de l'article communaute perso -->
                               <div class="modal fade modal-fullscreen  footer-to-bottom" id="myModalFullscreenFilesPerso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog animated zoomInLeft">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">@{{articleParEmploye.titre}}</h4>

            </div>
            
            <div class="modal-body" v-if="articleParEmploye.image">
                <img :src="articleParEmploye.image" style="max-width:100%; max-height:100%;">
            </div>
            <div class="modal-body" v-if="articleParEmploye.fichier">
            <p>Document joints: <br>
            <a :href="articleParEmploye.fichier" target="_blank">
                 <span class="glyphicon glyphicon-open-file"></span>
                 <strong v-if="articleParEmploye.nomFichier">
                 @{{articleParEmploye.nomFichier}}
                 </strong>

                  <strong v-else>
                     @{{articleParEmploye.fichier}}
                 </strong>
                </a>
        </p>            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
               <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.fin modal pur image communaute perso -->

            
                               <!-- modal full pour afficher image de l'article -->
                               <div class="modal fade modal-fullscreen  footer-to-bottom" id="myModalFullscreenFiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog animated zoomInLeft">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                	<h4 class="modal-title">@{{article.titre}}</h4>

            </div>
            
            <div class="modal-body" v-if="article.image">
                <img :src="article.image" style="max-width:100%; max-height:100%;">
            </div>
            <div class="modal-body" v-if="article.fichier">
            <p>Document joints: <br>
            <a :href="article.fichier" target="_blank">
                 <span class="glyphicon glyphicon-open-file"></span>
                 <strong v-if="article.nomFichier">
                 @{{article.nomFichier}}
                 </strong>

                  <strong v-else>
                     @{{article.fichier}}
                 </strong>
                </a>
        </p>            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
               <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

 

                            <!-- Modal  ajouter ddan communaute de pratique-->
                            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalEmployeCommnaute" class="modal fade" style="display: none;">
                              <div class="modal-dialog" style=" width: 1000px;">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Poster une Information dans la communauté de pratiques</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form role="form" method="post" action="{{url('les_articles')}}" class="form-horizontal"  enctype="multipart/form-data">
                                            {{csrf_field()}}
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Titre</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder="" name="titre"   class="form-control">
                                                  </div>
                                              </div>

                                               <div class="form-group">
                                                  <label class="col-lg-2 control-label">Ajouter un Lien</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" name="lien" class="form-control">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Contenu</label>
                                                  <div class="col-lg-10">
                                                      <textarea rows="10" cols="30" class="form-control"   name="contenu"></textarea>             
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <span class="btn green fileinput-button" >
                                                        <i class="fa fa-picture-o fa fa-white" @click.prevent="afficherWindowpourImage"></i>
                                                        <span @click.prevent="afficherWindowpourImage">Ajouter une image</span>
                                                        <input type="file" id="imageCommunautePratique1" name="image"  style="display:none;">
                                                      </span>
                                                      <span class="btn green fileinput-button" >
                                                        <i class="fa fa-file fa fa-white" @click.prevent="afficherWindowpourFichier"></i>
                                                        <span @click.prevent="afficherWindowpourFichier">Attacher un fichier</span>
                                                        <input type="file" id="fichierCommunautePratique1" name="fichier"  style="display:none;" >
                                                      </span>
                                                      <span class="">
                                                        <input type="text" name="fichier" placeholder="Donnez un nom au fichier" >
                                                      </span>
                                                      <button type="submit" class="btn btn-send" >Enregister</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal ajouter dans communaute de pratiques-->


            <div class="row">
                <div class="board" style="height: auto;">
                    <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                    <div class="board-inner">
                    <ul class="nav nav-tabs" id="myTab">
                   

              
                     <!--
                     <li><a href="#doner" data-toggle="tab" title="completed">
                         <span class="round-tabs four">
                         <span style="font-size: 6px;"> Communaute de pratiques</span>


                         </span> </a>
                     </li>
                     -->
                   
                     
                     </ul></div>

                     <div class="tab-content">

                           

                             
                              
                          

                                            <!--debut -->
                                             


  <div class="row">
 <h1 style="text-align: center;">Articles récents</h1>  </div>
    <div class="qa-message-list" id="wallmessages">

               
            @foreach($articles as $key => $article)
                @if($article->publie)
            <div class="message-item" id="m16">
            <div class="message-inner">
              <div class="message-head clearfix">
                <div class="avatar pull-left"><a href="#"><img src="{{$article->user->photo}}"></a></div>
                <div class="user-detail">
                  <h5 class="handle">{{$article->titre}}</h5>
                 
                  <span style="cursor: pointer;"  class="pull-right"  title="Voir les Commentaires">
                 <a href="{{ url('article', $article->id) }}"> <i class="fa fa-comment fa-2x"></i>
                 @if(count($article->commentaires))
                    <sup style="color:red;">{{count($article->commentaires)}}</sup>
                    @endif
                 </a>
                  </span>

                  <div class="post-meta">
                    <div class="asker-meta">
                      <span class="qa-message-what"></span>
                      <span class="qa-message-when">
                        <!--<span class="qa-message-when-data">Jan 21</span>-->
                      </span>
                      <span class="qa-message-who">
                        <span class="qa-message-who-pad">Par </span>
                        <span class="qa-message-who-data"><a href="#">{{$article->user->prenom}} {{$article->user->name}}</a></span>
                       <br>
                       @if($article->lien)
                        <span class="qa-message-who-pad"> Lien à consulter : <a href="{{$article->lien}}" target="_blank">  {{$article->lien}}</a>
                        </span>
                        @endif

                         @if($article->fichier)
                        <span class="qa-message-who-pad"> Document joint : <a href="{{$article->fichier}}" target="_blank">  {{$article->fichier}}</a>
                        </span>
                        @endif

                      </span>
                    </div>
                  </div>
                </div>
              </div>

                   <!-- image-->
                   @if($article->image)
                   <div class="qa-message-content">
                <img src="{{$article->image}}" style="max-height:90%; max-width:90%;">
              </div>
              @endif 

              <div class="qa-message-content">
                {!!$article->contenu!!}
              </div>
          </div>

         
        </div>

            @endif


              @if($article->partage && Auth::user()->can('Cible-Pub'))
            <div class="message-item" id="m16">
            <div class="message-inner">
              <div class="message-head clearfix">
                <div class="avatar pull-left"><a href="#"><img src="{{$article->user->photo}}"></a></div>
                <div class="user-detail">
                  <h5 class="handle">{{$article->titre}}</h5>
                 
                  <span style="cursor: pointer;"  class="pull-right"  title="Voir les Commentaires">
                 <a href="{{ url('article', $article->id) }}"> <i class="fa fa-comment fa-2x"></i>
                 @if(count($article->commentaires))
                    <sup style="color:red;">{{count($article->commentaires)}}</sup>
                    @endif
                 </a>
                  </span>

                  <div class="post-meta">
                    <div class="asker-meta">
                      <span class="qa-message-what"></span>
                      <span class="qa-message-when">
                        <!--<span class="qa-message-when-data">Jan 21</span>-->
                      </span>
                      <span class="qa-message-who">
                        <span class="qa-message-who-pad">Par </span>
                        <span class="qa-message-who-data"><a href="#">{{$article->user->prenom}} {{$article->user->name}}</a></span>
                       <br>
                       @if($article->lien)
                        <span class="qa-message-who-pad"> Lien à consulter : <a href="{{$article->lien}}" target="_blank">  {{$article->lien}}</a>
                        </span>
                        @endif

                         @if($article->fichier)
                        <span class="qa-message-who-pad"> Document joint : <a href="{{$article->fichier}}" target="_blank">  {{$article->fichier}}</a>
                        </span>
                        @endif

                      </span>
                    </div>
                  </div>
                </div>
              </div>

                   <!-- image-->
                   @if($article->image)
                   <div class="qa-message-content">
                <img src="{{$article->image}}" style="max-height:90%; max-width:90%;">
              </div>
              @endif 

              <div class="qa-message-content">
                {!!$article->contenu!!}
              </div>
          </div>

         
        </div>

            @endif
        @endforeach
          
          
          
         
         
          
          
          
          
         
          
         
          
         
          
        </div>


                                              <!-- fin -->

                               <!-- tab pane active home -->
  

        



                     

                      
                  
                    
 </div>
<div class="clearfix"></div>
</div>

</div>
</div>
</div>

 <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="{{url('editUserPerso')}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="PATCH">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modification</h4>
                    </div>
                    <div class="modal-body">
 
                       
 
                        <div class="form-group">
                            <label for="name">Nom:</label>
                        <input type="text" placeholder="" name="name" class="form-control" value="{{Auth::user()->name}}"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="name">Prenom:</label>
                            <input type="text"  placeholder="" name="prenom" class="form-control" value="{{Auth::user()->prenom}}"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="name">Numero de téléphone:</label>
                            <input type="text"  placeholder="" name="numero" class="form-control" value="{{Auth::user()->numero}}"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="email" placeholder="" name="email" class="form-control" value="{{Auth::user()->email}}"
                                   >
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
</section>
                   

</div>
@endsection
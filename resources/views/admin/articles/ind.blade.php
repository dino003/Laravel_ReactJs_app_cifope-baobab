@extends('admin.templates.main')

@section('content')

<style>
    
.mail-box {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
}
.mail-box aside {
    display: table-cell;
    float: none;
    height: 100%;
    padding: 0;
    vertical-align: top;
}
.mail-box .sm-side {
    background: none repeat scroll 0 0 #e5e8ef;
    border-radius: 4px 0 0 4px;
    width: 25%;
}
.mail-box .lg-side {
    background: none repeat scroll 0 0 #fff;
    border-radius: 0 4px 4px 0;
    width: 75%;
}
.mail-box .sm-side .user-head {
    background: none repeat scroll 0 0 #00a8b3;
    border-radius: 4px 0 0;
    color: #fff;
    min-height: 80px;
    padding: 10px;
}
.user-head .inbox-avatar {
    float: left;
    width: 65px;
}
.user-head .inbox-avatar img {
    border-radius: 4px;
}
.user-head .user-name {
    display: inline-block;
    margin: 0 0 0 10px;
}
.user-head .user-name h5 {
    font-size: 14px;
    font-weight: 300;
    margin-bottom: 0;
    margin-top: 15px;
}
.user-head .user-name h5 a {
    color: #fff;
}
.user-head .user-name span a {
    color: #87e2e7;
    font-size: 12px;
}
a.mail-dropdown {
    background: none repeat scroll 0 0 #80d3d9;
    border-radius: 2px;
    color: #01a7b3;
    font-size: 10px;
    margin-top: 20px;
    padding: 3px 5px;
}
.inbox-body {
    padding: 20px;
}
.btn-compose {
    background: none repeat scroll 0 0 #ff6c60;
    color: #fff;
    padding: 12px 0;
    text-align: center;
    width: 100%;
}
.btn-compose:hover {
    background: none repeat scroll 0 0 #f5675c;
    color: #fff;
}
ul.inbox-nav {
    display: inline-block;
    margin: 0;
    padding: 0;
    width: 100%;
}
.inbox-divider {
    border-bottom: 1px solid #d5d8df;
}
ul.inbox-nav li {
    display: inline-block;
    line-height: 45px;
    width: 100%;
}
ul.inbox-nav li a {
    color: #6a6a6a;
    display: inline-block;
    line-height: 45px;
    padding: 0 20px;
    width: 100%;
}
ul.inbox-nav li a:hover, ul.inbox-nav li.active a, ul.inbox-nav li a:focus {
    background: none repeat scroll 0 0 #d5d7de;
    color: #6a6a6a;
}
ul.inbox-nav li a i {
    color: #6a6a6a;
    font-size: 16px;
    padding-right: 10px;
}
ul.inbox-nav li a span.label {
    margin-top: 13px;
}
ul.labels-info li h4 {
    color: #5c5c5e;
    font-size: 13px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 5px;
    text-transform: uppercase;
}
ul.labels-info li {
    margin: 0;
}
ul.labels-info li a {
    border-radius: 0;
    color: #6a6a6a;
}
ul.labels-info li a:hover, ul.labels-info li a:focus {
    background: none repeat scroll 0 0 #d5d7de;
    color: #6a6a6a;
}
ul.labels-info li a i {
    padding-right: 10px;
}
.nav.nav-pills.nav-stacked.labels-info p {
    color: #9d9f9e;
    font-size: 11px;
    margin-bottom: 0;
    padding: 0 22px;
}
.inbox-head {
    background: none repeat scroll 0 0 #41cac0;
    border-radius: 0 4px 0 0;
    color: #fff;
    min-height: 80px;
    padding: 20px;
}
.inbox-head h3 {
    display: inline-block;
    font-weight: 300;
    margin: 0;
    padding-top: 6px;
}
.inbox-head .sr-input {
    border: medium none;
    border-radius: 4px 0 0 4px;
    box-shadow: none;
    color: #8a8a8a;
    float: left;
    height: 40px;
    padding: 0 10px;
}
.inbox-head .sr-btn {
    background: none repeat scroll 0 0 #00a6b2;
    border: medium none;
    border-radius: 0 4px 4px 0;
    color: #fff;
    height: 40px;
    padding: 0 20px;
}
.table-inbox {
    border: 1px solid #d3d3d3;
    margin-bottom: 0;
}
.table-inbox tr td {
    padding: 12px !important;
}
.table-inbox tr td:hover {
    cursor: pointer;
}
.table-inbox tr td .fa-star.inbox-started, .table-inbox tr td .fa-star:hover {
    color: #f78a09;
}
.table-inbox tr td .fa-star {
    color: #d5d5d5;
}
.table-inbox tr.unread td {
    background: none repeat scroll 0 0 #f7f7f7;
    font-weight: 600;
}
ul.inbox-pagination {
    float: right;
}
ul.inbox-pagination li {
    float: left;
}
.mail-option {
    display: inline-block;
    margin-bottom: 10px;
    width: 100%;
}
.mail-option .chk-all, .mail-option .btn-group {
    margin-right: 5px;
}
.mail-option .chk-all, .mail-option .btn-group a.btn {
    background: none repeat scroll 0 0 #fcfcfc;
    border: 1px solid #e7e7e7;
    border-radius: 3px !important;
    color: #afafaf;
    display: inline-block;
    padding: 5px 10px;
}
.inbox-pagination a.np-btn {
    background: none repeat scroll 0 0 #fcfcfc;
    border: 1px solid #e7e7e7;
    border-radius: 3px !important;
    color: #afafaf;
    display: inline-block;
    padding: 5px 15px;
}
.mail-option .chk-all input[type="checkbox"] {
    margin-top: 0;
}
.mail-option .btn-group a.all {
    border: medium none;
    padding: 0;
}
.inbox-pagination a.np-btn {
    margin-left: 5px;
}
.inbox-pagination li span {
    display: inline-block;
    margin-right: 5px;
    margin-top: 7px;
}
.fileinput-button {
    background: none repeat scroll 0 0 #eeeeee;
    border: 1px solid #e6e6e6;
}
.inbox-body .modal .modal-body input, .inbox-body .modal .modal-body textarea {
    border: 1px solid #e6e6e6;
    box-shadow: none;
}
.btn-send, .btn-send:hover {
    background: none repeat scroll 0 0 #00a8b3;
    color: #fff;
}
.btn-send:hover {
    background: none repeat scroll 0 0 #009da7;
}
.modal-header h4.modal-title {
    font-family: "Open Sans",sans-serif;
    font-weight: 300;
}
.modal-body label {
    font-family: "Open Sans",sans-serif;
    font-weight: 400;
}
.heading-inbox h4 {
    border-bottom: 1px solid #ddd;
    color: #444;
    font-size: 18px;
    margin-top: 20px;
    padding-bottom: 10px;
}
.sender-info {
    margin-bottom: 20px;
}
.sender-info img {
    height: 30px;
    width: 30px;
}
.sender-dropdown {
    background: none repeat scroll 0 0 #eaeaea;
    color: #777;
    font-size: 10px;
    padding: 0 3px;
}
.view-mail a {
    color: #ff6c60;
}
.attachment-mail {
    margin-top: 30px;
}
.attachment-mail ul {
    display: inline-block;
    margin-bottom: 30px;
    width: 100%;
}
.attachment-mail ul li {
    float: left;
    margin-bottom: 10px;
    margin-right: 10px;
    width: 150px;
}
.attachment-mail ul li img {
    width: 100%;
}
.attachment-mail ul li span {
    float: right;
}
.attachment-mail .file-name {
    float: left;
}
.attachment-mail .links {
    display: inline-block;
    width: 100%;
}

.fileinput-button {
    float: left;
    margin-right: 4px;
    overflow: hidden;
    position: relative;
}
.fileinput-button input {
    cursor: pointer;
    direction: ltr;
    font-size: 23px;
    margin: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    transform: translate(-300px, 0px) scale(4);
}
.fileupload-buttonbar .btn, .fileupload-buttonbar .toggle {
    margin-bottom: 5px;
}
.files .progress {
    width: 200px;
}
.fileupload-processing .fileupload-loading {
    display: block;
}
* html .fileinput-button {
    line-height: 24px;
    margin: 1px -3px 0 0;
}
* + html .fileinput-button {
    margin: 1px 0 0;
    padding: 2px 15px;
}
@media (max-width: 767px) {
.files .btn span {
    display: none;
}
.files .preview * {
    width: 40px;
}
.files .name * {
    display: inline-block;
    width: 80px;
    word-wrap: break-word;
}
.files .progress {
    width: 20px;
}
.files .delete {
    width: 60px;
}
}
ul {
    list-style-type: none;
    padding: 0px;
    margin: 0px;
}
 

</style>

<div class="container" id="aTest">
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
<vue-toastr ref="toastr"></vue-toastr>

 <div class="mail-box" style="height: 200px; overflow-y: scroll;">






                  <aside class="sm-side">
                      <div class="user-head">
                          <a class="inbox-avatar" href="javascript:;">
                              <img  width="64" hieght="60" src="{{Auth::user()->photo}}">
                          </a>
                          <div class="user-name">
                              <h5><a href="#">{{Auth::user()->userName(50)}}</a></h5>
                              <span><a href="#">{{Auth::user()->email}}</a></span>
                          </div>
                          <a class="mail-dropdown pull-right" href="javascript:;">
                              <i class="fa fa-chevron-down"></i>
                          </a>
                      </div>
                      <div class="inbox-body">
                          <a href="#" @click.prevent="initAdd"  title="Nouvel Article" id="btnAjouter"    class="btn btn-compose">
                            
                                <span class="badge badge-primary">
                                     <i class="fa fa-plus"></i>
                                 </span>
                                 
                              
                          

                              Nouvel Article
                          </a>
                          <!-- Modal -->
                          <div aria-hidden="true" role="dialog" tabindex="-1" id="myModal0" class="" style="display: none;">
                              <div class="" style=" width: 1000px;">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" @click="initHide" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Poster une Information dans la communauté de pratiques</h4>
                                      </div>
                                      <div class="modal-body">
                                      <form role="form" method="post" action="{{url('les_articles')}}"  class="form-horizontal" enctype="multipart/form-data">
                                        
                                           {{csrf_field()}}                                                
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Sujet</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder="" name="titre" v-model="newArticle.titre" id="" class="form-control">
                                                  </div>
                                              </div>
                                                <!--
                                               <div class="form-group">
                                                  <label class="col-lg-2 control-label">Ajouter un Lien</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" name="lien" class="form-control">
                                                  </div>
                                              </div>
                                              -->
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Contenu</label>
                                                  <div class="col-lg-10">
                                                      <textarea  class="form-control description" name="contenu" v-model="newArticle.contenu"></textarea>             
                                                  </div>
                                              </div>
                                                <div class="form-group">
                                                <p style="text-align:center;">
                                                    <img style="max-height:100px; max-width:100px;" v-if="url" :src="url">
                     
                                                    <span v-if="newArticle.fichier"><i class="fa fa-file fa-2x"></i></span>
                                                    @{{newArticle.fichier.name}}

                                                    </p>

                                                </div>
                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                  <span class="btn green fileinput-button">
                                                        <i class="fa fa-file fa fa-white"></i>
                                                        <span>Ajouter une image</span>
                                                        <input type="file" name="image" @change="onImageChange">
                                                      </span>
                                                      <span class="btn green fileinput-button">
                                                        <i class="fa fa-file fa fa-white"></i>
                                                        <span>Attacher un fichier</span>
                                                        <input type="file" name="fichier" @change="onFichierChange" >
                                                      </span>
                                                      <span class="">
                                                        <input type="text" name="nomFichier" v-model="newArticle.nomFichier" placeholder="Donnez un nom au fichier" >
                                                      </span>
                                                      <button type="submit" v-show="newArticle.titre" class="btn btn-send">Enregister</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->

                          <!-- modal full -->
                          <div class="modal fade modal-fullscreen  footer-to-bottom" id="myModalFullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog animated zoomInLeft">
        <div class="modal-content" style="width: 500px; overflow-x: break-word;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <p class="">@{{article.titre.substr(0, 70)}} </p>
            </div>
            
            <div class="modal-body">
                <p class="" stye="overflow-x:break-word;" v-html="article.contenu"></p>
            </div>

             <div class="modal-body" v-if="article.lien">
             <a :href="article.lien" target="_blank"> <span class="glyphicon glyicon-file"></span>@{{article.lien}}</a>
            </div>
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

                          <!-- fin-->

                               <!-- modal full pour afficher image de l'article -->
                               <div class="modal fade modal-fullscreen  footer-to-bottom" id="myModalFullscreenFiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog animated zoomInLeft">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            </div>
            
            <div class="modal-body" v-if="article.image">
                <img :src="article.image">
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

                          <!-- fin-->
                      </div>
                      <ul class="inbox-nav inbox-divider">
                          <li class="active">
                              <a href="#" style="text-decoration: none;" @click.prevent="filter = 'all'"><i class="fa fa-inbox"></i> Tous les Articles <span class="label label-danger pull-right">@{{totalArticles}}</span></a>

                          </li>
                          <li>
                              <a href="#" style="text-decoration: none;" @click.prevent="filter = 'actif'"><i class="fa fa-share-alt"></i> Articles Publiés <span class="label label-danger pull-right">@{{totalArticlesActifs}}</span></a>
                          </li>
                         
                          <li>
                              <a href="#" style="text-decoration: none;" @click.prevent="filter = 'inactif'"><i class=" fa fa-external-link"></i> Articles non Publiés <span class="label label-danger pull-right">@{{totalArticlesInactif}}</span></a>
                          </li>
                          <li>
                              <a href="#" style="text-decoration: none;" @click.prevent="filter = 'corbeille'"><i class=" fa fa-trash-o"></i> Corbeille <span class="label label-danger pull-right">@{{totalArticlesCorbeille}}</span></a>
                          </li>
                      </ul>
                      <!--
                      <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
                          <li> <h4>Labels</h4> </li>
                          <li> <a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Work </a> </li>
                          <li> <a href="#"> <i class=" fa fa-sign-blank text-success"></i> Design </a> </li>
                          <li> <a href="#"> <i class=" fa fa-sign-blank text-info "></i> Family </a>
                          </li><li> <a href="#"> <i class=" fa fa-sign-blank text-warning "></i> Friends </a>
                          </li><li> <a href="#"> <i class=" fa fa-sign-blank text-primary "></i> Office </a>
                          </li>
                      </ul>

                      <ul class="nav nav-pills nav-stacked labels-info ">
                          <li> <h4>Buddy online</h4> </li>
                          <li> <a href="#"> <i class=" fa fa-circle text-success"></i>Alireza Zare <p>I do not think</p></a>  </li>
                          <li> <a href="#"> <i class=" fa fa-circle text-danger"></i>Dark Coders<p>Busy with coding</p></a> </li>
                          <li> <a href="#"> <i class=" fa fa-circle text-muted "></i>Mentaalist <p>I out of control</p></a>
                          </li><li> <a href="#"> <i class=" fa fa-circle text-muted "></i>H3s4m<p>I am not here</p></a>
                          </li><li> <a href="#"> <i class=" fa fa-circle text-muted "></i>Dead man<p>I do not think</p></a>
                          </li>
                      </ul>
                   

                      <div class="inbox-body text-center">
                          <div class="btn-group">
                              <a class="btn mini btn-primary" href="javascript:;">
                                  <i class="fa fa-plus"></i>
                              </a>
                          </div>
                          <div class="btn-group">
                              <a class="btn mini btn-success" href="javascript:;">
                                  <i class="fa fa-phone"></i>
                              </a>
                          </div>
                          <div class="btn-group">
                              <a class="btn mini btn-info" href="javascript:;">
                                  <i class="fa fa-cog"></i>
                              </a>
                          </div>
                      </div>
                     -->
                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Communauté de Pratiques</h3>
                          <form action="#" class="pull-right position">
                              <div class="input-append">
                                  <input type="text" v-model="search" class="sr-input" placeholder="Rechercher un article...">
                                 
                                  <button class="btn sr-btn" type="button"><i class="fa fa-search"></i></button>

                                

                              </div>
                          </form>
                      </div>
                      <div class="inbox-body">
                                                
                       
                        <!-- -->
                         <div class="mail-option">
                         <!--
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox" style="width: 15px;">
                                 
                                 <div class="btn-group">
                                     <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                         Tous
                                         <i class="fa fa-angle-down "></i>
                                     </a>
                                     <ul class="dropdown-menu">
                                         <li><a href="#"> None</a></li>
                                         <li><a href="#"> Read</a></li> 
                                         <li><a href="#"> Unread</a></li>
                                     </ul>
                                 </div>
                              
                             </div>
                             -->

                             <div class="btn-group" v-show="selectionnePourSup.length > 0">
                                 <a  data-placement="top" data-toggle="dropdown" @click.prevent="supprimerPlusieurs" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-trash"></i>
                                     Supprimer
                                 </a>

                                  <a  data-placement="top" data-toggle="dropdown" @click.prevent="publierPlusieurs" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-share"></i>
                                     Publier/Dépublier
                                 </a>

                                  <a  data-placement="top" data-toggle="dropdown" @click.prevent="publierPlusieursDansLesServices" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-share-alt "></i>
                                     Publication ciblée

                                 </a>
                             </div>
                             <!--
                             <div class="btn-group hidden-phone">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                     More
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>
                            

                             <div class="btn-group">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue">
                                     Move to
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>
                             
                           

                             <ul class="unstyled inbox-pagination">
                                 <li><span>1-50 of 234</span></li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                 </li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                 </li>
                             </ul>
                              -->
                          
                         </div>
                      <!-- -->
                      <div style="height: 500px; overflow-y: scroll;">
                          <table class="table table-inbox table-hover">

                             <thead >
                                    <tr>
                                        <th>Opération</th>

                                        <th>Partage</th>
                                        <th>Sujet</th>
                                        <th>Fichier</th>
                                        <th></th>


                                    </tr>

                            </thead>
                            <tbody>
                          

                                                    
                            <div class="ui active dimmer" v-if="loading">

                            <div class="ui text loader">Chargement...</div>
                            </div>
                              <tr class="unread" v-for="(article, index) in ArticlesFiltres" :key="article.id">
                                  <td class="inbox-small-cells">
                                  <input type="checkbox"  :value="article.id" v-model="selectionnePourSup" class="mail-checkbox"  style="width: 15px;">

                                  </td>
                                  <td class="inbox-small-cells" @click="lienPublicationCible(article.id)" title="Rattacher cet article à des structures"><i class="fa fa-share"></i></td>

                                  <td @click="showArticle(index)" class="view-message  dont-show">@{{article.titre.substr(0, 40)}} 
                                      <span v-if="article.publie" class="label label-success pull-right">générale</span>
                                      <span v-else-if="article.partage" class="label label-primary pull-right">ciblée</span>

                                  <span v-else class="label label-danger pull-right">Non publié</span>
                                </td>
                                  <td title="Voir les fichiers associés" v-if="article.image || article.fichier" @click="showArticleFile(index)" class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td v-else class="view-message  inbox-small-cells"></td>
                                 
                                  <td class="inbox-small-cells"  title="">
                                  <span  v-if="article.structures.length > 0"><i class="fa fa-home"></i>
                                    <sup class="text-danger">@{{article.structures.length}}</sup>
                                  </span>
                                  </td>

                                                             
                                  
                                    </tr>
                             
                             
                             

                             
                              
                              
                          
                          </tbody>
                          </table>
                          </div>
                      </div>
                  </aside>
              </div>
</div>

@endsection



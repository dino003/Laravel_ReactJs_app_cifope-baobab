@extends('admin.templates.main')

@section('content')
 <style type="text/css">



        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 100px;
        }

        table.table td a.settings {
            color: #2196F3;
            display: inline-block;
        }
        table.table td a.delete {
            color: #F44336;
        }
        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            margin: 30px auto;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-wrapper .btn {
            float: right;
            color: #333;
            background-color: #fff;
            border-radius: 3px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        .table-wrapper .btn:hover {
            color: #333;
            background: #f2f2f2;
        }
        .table-wrapper .btn.btn-primary {
            color: #fff;
            background: #03A9F4;
        }
        .table-wrapper .btn.btn-primary:hover {
            background: #03a3e7;
        }
        .table-title .btn {
            font-size: 13px;
            border: none;
        }
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        .table-title {
            color: #fff;
            background: #4b5366;
            padding: 16px 25px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .show-entries select.form-control {
            width: 60px;
            margin: 0 5px;
        }
        .table-filter .filter-group {
            float: right;
            margin-left: 15px;
        }
        .table-filter input, .table-filter select {
            height: 34px;
            border-radius: 3px;
            border-color: #ddd;
            box-shadow: none;
        }
        .table-filter {
            padding: 5px 0 15px;
            border-bottom: 1px solid #e9e9e9;
            margin-bottom: 5px;
        }
        .table-filter .btn {
            height: 34px;
        }
        .table-filter label {
            font-weight: normal;
            margin-left: 10px;
        }
        .table-filter select, .table-filter input {
            display: inline-block;
            margin-left: 5px;
        }
        .table-filter input {
            width: 200px;
            display: inline-block;
        }
        .filter-group select.form-control {
            width: 110px;
        }
        .filter-icon {
            float: right;
            margin-top: 7px;
        }
        .filter-icon i {
            font-size: 18px;
            opacity: 0.7;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 80px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }
        table.table td a:hover {
            color: #2196F3;
        }
        table.table td a.view {
            width: 30px;
            height: 30px;
            color: #2196F3;
            border: 2px solid;
            border-radius: 30px;
            text-align: center;
        }
        table.table td a.view i {
            font-size: 22px;
            margin: 2px 0 0 1px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }
        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }
        .text-success {
            color: #10c469;
        }
        .text-info {
            color: #62c9e8;
        }
        .text-warning {
            color: #FFC107;
        }
        .text-danger {
            color: #ff5b5b;
        }
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }
        .pagination li a:hover {
            color: #666;
        }
        .pagination li.active a {
            background: #03A9F4;
        }
        .pagination li.active a:hover {
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        .overlay {
            height: 0%;
            width: 100%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.9);
            overflow-y: hidden;
            transition: 0.5s;
        }

        .overlay-content {
            position: relative;
            top: 25%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }

        .overlay a {
            padding: 8px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay a:hover, .overlay a:focus {
            color: #f1f1f1;
        }

        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        @media screen and (max-height: 450px) {
            .overlay {overflow-y: auto;}
            .overlay a {font-size: 20px}
            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }

         .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }

            .onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "actif";
    padding-left: 10px;
    background-color: #34A7C1; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "inactif";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 56px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}

       


    </style>

    <div class="container" id="roles">
    <vue-toastr ref="toastr"></vue-toastr>


         <div class="table-wrapper">
       
     
            
             <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Gestion 
                            <b>des Accès</b> </h2>

                    </div>
                    
                    <div class="col-sm-8">
                       @can('Ajouter-Role')
                        <em class="btn btn-primary" @click.prevent="afficherEtdesafficher" id="btnAjouter"><i class="material-icons">&#xE147;</i> <span>Nouveau</span></em>
                       @endcan



                    </div>
                
                </div>
            </div>

             <div class="table-filter">
            <div class="row">
            <!--
                <div class="col-sm-3">
                    <div class="show-entries">
                        <span>Monter</span>
                        <select class="form-control" v-model="paginationApi" @change="listeEmployesPagination">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>30</option>
                            <option>50</option>
                            <option>100</option>
                            <option>200</option>
                            <option>500</option>





                        </select>
                        <span>entités</span>
                        
                    </div>
                </div>
            -->

            <script>
                function inArray(needle, haystack) {
                    var length = haystack.length;
                    for(var i = 0; i < length; i++) {
                        if(haystack[i] == needle) return true;
                    }
                    return false;
                }
            </script>

                <div class="col-sm-9">
                    <div class="filter-group">
                        <input type="text" v-model="search" style="width:250px;"  class="form-control" placeholder="rechercher un groupe...">
                        <input type="text" id="my" style="width: 400px; display:none; background:black; color:white;" v-model="newRole.name"   class="form-control" placeholder="Entrez le nom du groupe à creer...">
                        <button v-show="newRole.name && newRole.name.length > 2" @click.prevent="ajouterRole" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Ajouter</button>


                    </div>
                  
                    <button v-show="selectionnePourSup.length > 0" type="button" @click.prevent="supprimerPlusieurs" class="btn btn-warning"><i class="fa fa-trash"></i></button>

                
                </div>
            </div>
        </div>


                                  <div style="height: 500px; overflow-y: scroll;">

                        <table class="table table-striped table-hover" id="dossier">
                        <div class="ui active dimmer" v-if="loading">

                        <div class="ui loader"></div>
                        </div>
                             <thead >
                                    <tr>
                                    <th></th>

                                    <th> 
                                    <!-- <input type="checkbox" onClick="tog(this)" style="width:15px;"/>-->
                                    </th>
                                        <th>Groupes</th>

                                        <th>Permissions</th>

                                    </tr>

                            </thead>
                            <tbody>
                            
                              
                                <tr v-for="(role, index) in rolesFiltres" :key="role.id"> 
                                <td style="width:15px;">

                                <ul class="list-inline" style="list-style:none;">
                                <li><em @click.prevent="lien(role.id)" style="color:blue; cursor: pointer; display:inline-block;" title="Attribution des permissions"><i class="fa fa-key"></i></em></li>
                                </ul>
                                </td>
                                <td> 
                                <input id="selectionnePourSup"  style="width:15px;" :value="role.id" name="selectionnePourSup[]" v-model="selectionnePourSup" type="checkbox">
                            </td>                  
                          
                                    <td title="double click pour la modification"> <label @dblclick="attributionDePermission(index)" style="font-weight: bold;">@{{role.name}}</label></td>
                                    
                                             
                                        <td >
                                       
                                        
                                        <label v-for="rolePer in role.permissions" class="label label-default" >@{{rolePer.name}} </label>
                                        

                                        </td>
                                       
                                  

                            
                                </tr>
                                
                                
                            </tbody>

                        </table>
                        </div>

                         <!-- modal pour ajouter un Role -->
        <div class="modal fade" tabindex="-1" role="dialog" id="myModalpm">
            <div class="modal-dialog" role="document">
               
                <div class="modal-content" style="width:900px;">

                 <div class="modal-header"  style="background:white;">
                <button  v-show="selectionnGroupPermission.length > 0" @click.prevent="atrribuerPermissions" class="btn btn-primary">Enregistrer</button>

                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Attribution des permissions </h4>

            </div>

            <div class="modal-body" style="width:900px; height: 500px; overflow-y: scroll;">
                   <table class="table table-striped table-hover" id="">
                     
                             <thead >
                                    <tr>
                                  
                                        <th></th>

                                        <th>Permissions</th>

                                    </tr>

                            </thead>
                            <tbody>
                                <input type="hidden" :value="role.id"  v-model="role.id">
                              
                                <tr v-for="(permi, index) in permissions" :key="permi.id"> 

                                <td> 
                                <input   style="width:15px;" :value="permi.id" v-model="selectionnGroupPermission" type="checkbox">
                            </td>                  
                          
                                    <td> <label style="font-weight: bold;">@{{permi.name}}</label></td>
                                    
                                     
                                  

                            
                                </tr>
                                
                                
                            </tbody>

                        </table>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      
        
        <!-- modal pour ajouter un Role -->
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{url('gestion_des_roles')}}" method="POST">
                        {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter nouveau Rôle</h4>
                    </div>
                    <div class="modal-body">
                       
 
                        <div class="form-group">
                            <label for="name">Nom du Groupe:</label>
                            <input type="text" required name="name" id="name" placeholder="" class="form-control">
                        </div>


                         <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="checkbox">
            <strong>Rattacher des Permissions:</strong>
            <br/>
            <div class="row">
            <div class="col-md-12">
            <input type="checkbox" onClick="toggle(this)" style="width:15px;"/> Tout sélectionner<hr>

            @foreach($permission as $value)
            <div class="col-md-6">
                <input style="width:15px;" title="{{ $value->name }}" type="checkbox" name="permission[]" value="{{$value->id}}" class="form-control">
                            {!! $value->name !!} <hr>
                </div>
            @endforeach
            </div>
            </div>
        </div>
    </div>

                       
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                     </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


          

        <!-- modal pour modifier un employé -->

        <div class="modal fade" tabindex="-1" role="dialog" id="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modification d'un Rôle</h4>
                    </div>
                    <div class="modal-body">
 
                       
 
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" placeholder="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Prenom:</label>
                            <input type="text"  placeholder="" class="form-control">
                        </div>

                       

                       

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Modifier</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.fin modal modifier -->
        

    </div>
        
    </div>


      
    @endsection


@section('script')
<script type="text/javascript">
  function toggle(source) {
  checkboxes = document.getElementsByName('selectionnePourSup[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
@endsection

    
   
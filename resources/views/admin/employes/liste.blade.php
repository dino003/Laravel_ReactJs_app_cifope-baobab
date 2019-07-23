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

       
       #myProgress {
    width: 100%;
    background-color: transparent;
    
}
#myBar {
    width: 1%;
    height: 30px;
    background-color: green;
    text-align: center;
}

    </style>

    <div class="container" id="us">
        <vue-toastr ref="toastr"></vue-toastr>

       
        <!--
        <div class="table-filter">
                <div class="row">
                   
                    <div class="col-sm-9">
                        <div class="filter-group">
                            <input type="text" v-model="search" id="rech"  class="form-control"
                                   placeholder="Rechercher un employé ..."
                                   style="width: 450px; ">
                        </div>
                       
                        
                    </div>
                </div>
            </div>
        -->
        <div class="row" id="divCleProduit" style="display:none;">
        <div class="col-md-12" >
        <div class="col-md-4"></div>

        <div class="col-md-8">
       
        <input type="text" v-model="cleProduit" placeholder="Entrez la clé d'accès du produit" style="width:500px; font-size:2em; height:50px; align:center; border:1px solid black; border-radius:90px;">

        <button v-show="cleProduit" class="btn btn-primary" @click.prevent="envoyerCode"><span class="glyphicon glyphicon-ok-sign"></span> Valider</button>
        </div>

                <div class="col-md-2"></div>

        </div>
        </div>

           <div class="row" id="prog" style="display:none;">
        <div id="myProgress" class="col-md-12">
            <div id="myBar">70%</div>
        </div>
        
         </div>
            
                 <div class="table-wrapper" >
               

                 
     
                     <div class="table-title" v-show="!codeActuel">
                <div class="row">
                    <div class="col-sm-12">
                          <h4 style="text-align:center;"> 
                            
                            <strong><em style="color: white; font-weight:bold;">
                                
                                La clé de produit est absente, merci de la renseigner pour pouvoir ajouter des utilisateurs
                            </em></strong>
                            <span title="Ajouter une nouvelle clé de produit" style="cursor:pointer;" @click="afficherEtdesafficher"><i class="fa fa-key fa-2x"></i></span>
                             </h4>

                              

                    </div>
                  
                </div>
            </div>



             <div class="table-title" v-show="codeActuel">
                <div class="row">
                    <div class="col-sm-4">
                        <h2 id="tablePrincipale"> 
                            
                            <strong><em style="color: white; font-weight:bold;">@{{tousLesEmployes}} Utilisateurs sur @{{codeActuel}}</em></strong>
                             </h2>

                             

                    </div>
                    <div class="col-sm-8" >
                       
                        <em class="btn btn-primary" v-show="tousLesEmployes < codeActuel" @click="initAddTask"><i class="material-icons">&#xE147;</i> <span>Nouveau</span></em>
                        @if(Auth::user()->super_admin)
                        <a href="#" v-show="tousLesEmployes < codeActuel" @click="initAddAdmin" class="btn btn-info"><i class="material-icons">&#xE147;</i> <span>Ajouter un admin</span></a>
                        @endif
                        
                        <em class="btn btn-default"  @click.prevent="filter = 'admin'">admin <span class="badge" style="background: green;">@{{totalAdmin}}</span></em>

                        <em class="btn btn-default"  @click.prevent="filter = 'inactif'">Inactifs <span class="badge" style="background: green;">@{{totalEmployesInactif}}</span></em>
                        <em class="btn btn-default"  @click.prevent="filter = 'actif'">Actifs <span class="badge" style="background: green;">@{{totalEmployesActifs}}</span></em>
                        <em class="btn btn-default" @click.prevent="filter = 'all'">Tous <span class="badge" style="background: green;">@{{totalEmployes}}</span></em>
                       
                        <span title="Ajouter une nouvelle clé de produit"  style="cursor:pointer;" @click="afficherEtdesafficher"><i class="fa fa-key fa-2x"></i></span>

                
                    </div>
                </div>
            </div>

            <div class="table-filter" v-show="codeActuel">
            <div class="row">
            
                <div class="col-sm-3">
                    <div class="show-entries">
                        <span>Monter</span>
                        <select class="form-control" v-model="paginationApi" @change="listeEmployesPagination" style="width:80px;">
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
                        <span>Utilisateurs</span>
                        
                    </div>
                </div>
            

                <div class="col-sm-9">
                   <!-- <button type="button" @click.prevent="apiGetEmployePost" class="btn btn-primary"><i class="fa fa-search"></i></button>-->
                    <div class="filter-group">
                        <input type="text" v-model="search"  class="form-control" placeholder="rechercher...">


                    </div>
                    
                    <div class="filter-group">
                        <label>GROUPES</label>
                        <select class="form-control" v-model="roleApi" @change="listeEmployesParGroupe">
                            <option>Tout</option>
                            <option  v-for="(role, index) in rolesApi" :value="role.id" :key="role.id">@{{role.name}}</option>
                            
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>SERVICE</label>
                        <select class="form-control" v-model="serviceApi" @change="listeEmployesParService">
                            <option>Tout</option>
                            <option v-for="(service, index) in servicesApi" :value="service.id" :key="service.id">@{{service.nom_structure}}</option>
                           
                        </select>
                    </div>
                    <button v-show="selectionnePourSup.length > 0" type="button" @click.prevent="activerPlusieursUtilisateurs" class="btn btn-primary"><i class="fa fa-check"></i> / <i class="fa fa-times"></i></button>

                    
                    <button v-show="selectionnePourSup.length > 0" type="button" @click.prevent="supprimerPlusieursUtilisateurs" class="btn btn-danger"><i class="fa fa-trash fa-2x"></i></button>

                
                </div>
            </div>
        </div>

                        <div style="height: 500px; overflow-y: scroll;" v-show="codeActuel">

                        <table  v-if="employes.length > 0" class="table table-striped table-hover" id="dossier">
                        <div class="ui active dimmer" v-if="loading">

                        <div class="ui loader"></div>
                        </div>
                             <thead >
                                    <tr>
                                    <th></th>

                                        <th>Photo</th>

                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Groupes</th>
                                        <th>Email</th>

                                        <th>Etat du compte</th>
                                        <th>Actions</th>
                                    </tr>

                            </thead>
                            <tbody>
                                <tr  v-for="(employe, index) in filteredTodos" :key="employe.id">
                                    <td> 
                                    @can('Supprimer-Utilisateur')

                                    <input  style="width:15px;" :value="employe.id" v-model="selectionnePourSup" type="checkbox">
                                    @endcan
                                    </td>
                   
                           <td> <sup v-if="employe.admin"><em style="color:red;">admin</em></sup>
                               <img :src="employe.photo" width="50px" style="border:1px; border-radius:50px" />
                               </td>
                                    <td> <label @dblclick="initUpdate(index)">@{{employe.name}}</label></td>
                                    <td><label @dblclick="initUpdate(index)">@{{employe.prenom}}</label></td>
                                    <td>
                                    <label class="label label-warning" v-for="(role, index) in employe.roles">@{{role.name}}</label>&nbsp
                                    </td>
                                    <td><label @dblclick="initUpdate(index)">@{{employe.email}}</label> </td>

                                    <td v-if="employe.active" >
                                        

                            <span  style="color:green;"> <i class="fa fa-check"></i> actif</span>
                           
                                        </td>

                                         <td v-else>
                                        

                                        <span class="" style="color:red;"> <i class="fa fa-times"></i> inactif</span>
                                       
                                                    </td>

                                 


                            <td style="width: 60px;">

                            

                              <ul class="list-inline" style="list-style:none;">
                              

                              <li><em @click="lien(employe.id)" style="color:blue; cursor: pointer; display:inline-block;" title="Rôles && permissions"><i class="fa fa-key"></i></em></li>
                              
                               
                              </ul>
                            
                        </td>
                                </tr>

                               
                            </tbody>

                            

                        </table>

                         <div v-if="employes.length === 0" class="ui segment">
                                    <p style="text-align:center;"> Aucun utilisateur dans cette section</p>
                                </div>
                        </div>
                       

                    
                
            
        
        <!-- modal pour ajouter un employé -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter nouvel Utilisateur</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error.id">@{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" name="name" id="name" placeholder="" class="form-control"
                                   v-model="user.name">
                        </div>

                        <div class="form-group">
                            <label for="name">Prenom:</label>
                            <input type="text" name="prenom" id="name" placeholder="" class="form-control"
                                   v-model="user.prenom">
                        </div>

                        <div class="form-group">
                            <label for="name">Numero de telephone:</label>
                            <input type="text" name="numero" id="name" placeholder="" class="form-control"
                                   v-model="user.numero">
                        </div>

                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="text" name="email" id="name" placeholder="" class="form-control"
                                   v-model="user.email">
                        </div>
                          

                       
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" v-show="user.name && user.prenom && user.email" @click="createTask" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


              <!-- modal pour ajouter un employé  admin-->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_admin_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter nouvel Administrateur</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errorsAdmin.length > 0">
                            <ul>
                                <li v-for="error in errorsAdmin" :key="error.id">@{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" name="name" id="name" placeholder="" class="form-control"
                                   v-model="admin.name">
                        </div>

                        <div class="form-group">
                            <label for="name">Prenom:</label>
                            <input type="text" name="prenom" id="name" placeholder="" class="form-control"
                                   v-model="admin.prenom">
                        </div>

                        <div class="form-group">
                            <label for="name">Numero de telephone:</label>
                            <input type="text" name="numero" id="name" placeholder="" class="form-control"
                                   v-model="admin.numero">
                        </div>

                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="text" name="email" id="name" placeholder="" class="form-control"
                                   v-model="admin.email">
                        </div>

                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" v-show="admin.name && admin.prenom && admin.email" @click="createAdmin" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- fin admin  -->


        <!-- modal pour modifier un employé -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modification</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error.id">@{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label for="name">Nom:</label>
                            <input type="text" placeholder="" class="form-control"
                                   v-model="update_employe.name">
                        </div>

                        <div class="form-group">
                            <label for="name">Prenom:</label>
                            <input type="text"  placeholder="" class="form-control"
                                   v-model="update_employe.prenom">
                        </div>

                        <div class="form-group">
                            <label for="name">Numero:</label>
                            <input type="text"  placeholder="" class="form-control"
                                   v-model="update_employe.numero">
                        </div>

                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="text"   placeholder="" class="form-control"
                                   v-model="update_employe.email">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" @click="updateTask" class="btn btn-primary">Modifier</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.fin modal modifier -->

        
        <!-- modal pour modifier un role -->

        <div class="modal fade" tabindex="-1" role="dialog" id="role_modifier">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modification des Accès</h4>
                    </div>
                    <div class="modal-body">
 
                       
                       
                         <div class="form-group">
                         <div class="row">
                         <div class="col-md-12">
                            <label for="name">Assigner Roles ( facultatif)</label>
                            </div>

                        <label class="checkbox-inline" v-for="role in allRoles">

                    <input :checked="{checked: role === update_employe_role.roles}" style="width:15px;" type="checkbox"  name="roles[]"  class="form-control">
                        @{{ role }} 
                    </label>
                    </div>


                        </div>

                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                       
                            <label for="name">Assigner des permisssions à cet utilisateur ( facultatif)</label>
                            </div>
                            @foreach($permissions as $key => $permission)
                            <div class="col-md-12">
                         <label class="checkbox-inline">

                            <input style="width:15px;" type="checkbox" v-model="update_employe_role.permissions" name="permission[]" id="name" value="{{$permission->id}}" class="form-control">
                                {{ $permission->name }} 
                            </label>
                            </div>
                            @endforeach


                     </div>

                        </div>


                        

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" @click="updateTask" class="btn btn-primary">Modifier</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.fin modal role -->
        

    </div>
        
    </div>


      
    @endsection

    
   
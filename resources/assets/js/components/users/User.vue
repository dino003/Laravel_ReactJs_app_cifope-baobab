
<template>
    <div class="table-wrapper">
        <div class="ui active dimmer" v-if="loading">

            <div class="ui loader"></div>
        </div>
        
        <div class="table-filter">
                <div class="row">
                   
                    <div class="col-sm-9">
                        <div class="filter-group">
                            <input type="text" v-model="search" id="rech"  class="form-control"
                                   placeholder="Rechercher un employé ..."
                                   style="width: 450px; ">
                        </div>
                       
                        
                        <span class="filter-icon"><i class="fa fa-filter"></i></span>
                    </div>
                </div>
            </div>
            
        

             <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Gestion du  
                            <b>Personnel</b> </h2>

                    </div>
                    <div class="col-sm-8">
                       
                        <em class="btn btn-primary" @click="initAddTask()"><i class="material-icons">&#xE147;</i> <span>Nouveau</span></em>
                        <a href="#" @click="exporter" class="btn btn-info"><i class="material-icons">&#xE24D;</i> <span>Exporter en Excel</span></a>
                        <em class="btn btn-default"  @click.prevent="filter = 'inactif'">Inactifs <span class="badge" style="background: green;">{{totalEmployesInactif}}</span></em>
                        <em class="btn btn-default"  @click.prevent="filter = 'actif'">Actifs <span class="badge" style="background: green;">{{totalEmployesActifs}}</span></em>
                        <em class="btn btn-default" @click.prevent="filter = 'all'">Tous <span class="badge" style="background: green;">{{totalEmployes}}</span></em>



                    </div>
                </div>
            </div>

            
                        <table class="table table-striped table-hover" id="dossier">
                             <thead >
                                    <tr>
                                        <th>Photo</th>

                                        <th>Nom</th>
                                        <th>Prénoms</th>
                                        <th>Numero</th>
                                        <th>Email</th>

                                        <th>Etat</th>
                                        <th>Actions</th>
                                    </tr>

                            </thead>
                            <tbody>
                               
                                <tr v-for="(employe, index) in filteredTodos" :key="employe.id">
                                    <td style="display:none;">{{ index + 1 }}</td>
                   
                           <td> 
                               <img :src="employe.photo" width="50px" style="border:1px; border-radius:50px" />
                               </td>
                                    <td> <label @dblclick="initUpdate(index)">{{employe.name}}</label></td>
                                    <td><label @dblclick="initUpdate(index)">{{employe.prenom}}</label></td>
                                    <td><label @dblclick="initUpdate(index)">{{employe.numero}}</label> </td>
                                    <td><label @dblclick="initUpdate(index)">{{employe.email}}</label> </td>

                                    <td v-if="employe.active" >
                                        <div class="onoffswitch">

                        <input type="checkbox" class="onoffswitch-checkbox"  checked>
                        <label class="onoffswitch-label" for="myonoffswitch">
                            <span class="onoffswitch-inner"  @click="changerStatut(employe.id)" ></span>
                            <span class="onoffswitch-switch" @click="changerStatut(employe.id)"></span>
                        </label>
                    </div>
                                        </td>

                                    <td v-else class="onoffswitch">
                                     <div class="onoffswitch">
                                         <input type="checkbox" class="onoffswitch-checkbox">
     <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"  @click="changerStatut(employe.id)"></span>
        <span class="onoffswitch-switch" @click="changerStatut(employe.id)"></span>
    </label>
</div>

                                     </td>


                            <td>

                            

                              <ul style="list-style:none;">
                                <li><a href="#" style="color:red; display:inline-block;" @click="deleteEmploye(index)" title="Supprimer"><i class="fa fa-trash"></i></a></li>
                              </ul>
                            
                        </td>
                                </tr>
                            </tbody>

                        </table>
                       

                    
                
            
        
        <!-- modal pour ajouter un employé -->
        <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter nouvel employé</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors" :key="error.id">{{ error }}</li>
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

        <!-- fin modal pour ajouter un employé -->

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
                                <li v-for="error in errors" :key="error.id">{{ error }}</li>
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
        

    </div>

</template>
 
<script>

    export default {

        data(){
            return {
                user: {
                    name: '',
                    prenom: '',
                    email: '',
                    numero:'',
                    active: true

                },
                errors: [],
                employes: [],
                structures: [],
                update_employe: {},
                loading: false,
                filter: 'all',
                search: ''
                // pagination: {'current_page': 1 }
               
            }
        },

        mounted()
        {
            this.listeEmployes()
        },

        computed: {
            totalEmployes() {
                return this.employes.length
            },

             totalEmployesActifs() {
                return this.employes.filter(employe => employe.active).length
            },

             totalEmployesInactif() {
                return this.employes.filter(employe => !employe.active).length
            },

            filteredTodos (){
            if(this.filter === 'actif'){
                return this.employes.filter(employe => employe.active)
            }else if(this.filter === 'inactif'){
                 return this.employes.filter(employe => !employe.active)

            }else{
               return this.employes.filter((employe) => {
                 return employe.name.match(this.search)

               }
            )

            }
        }

        },

        methods: {
            initAddTask()
            {
                this.errors = [];
                $("#add_task_model").modal("show");
            },
            createTask()
            {
                this.loading = true
                 this.employes.push({
                 name: this.user.name,
                    prenom: this.user.prenom,
                    numero: this.user.numero,
                    email: this.user.email,
                    active: true,
            })
                axios.post('/management_des_employe', {
                    name: this.user.name,
                    prenom: this.user.prenom,
                    numero: this.user.numero,
                    email: this.user.email,

                })
                    .then(response => {
 
                        this.reset();
                        //this.listeEmployes();
                        this.$root.$refs.toastr.s("Enregistré avec succès");

 
                        $("#add_task_model").modal("hide");
 
                    }).then(_ => {
                        this.loading = false
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
 
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }

                         if (error.response.data.errors.numero) {
                            this.errors.push(error.response.data.errors.numero[0]);
                        }

                         if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
                    });
            },
            reset()
            {
                this.user.name = '';
                this.user.prenom = '';
                this.user.numero = '';
                this.user.email = '';
            },

            initUpdate(index)
            {
                this.errors = [];
                $("#update_task_model").modal("show");
                this.update_employe = this.employes[index];
            },

             updateTask()
            {
                this.loading = true

                axios.put('/management_des_employe/' + this.update_employe.id, {
                    name: this.update_employe.name,
                    prenom: this.update_employe.prenom,
                    numero: this.update_employe.numero,
                    email: this.update_employe.email,
                })
                    .then(response => {

                        $("#update_task_model").modal("hide");

                    }).then(_ => {
                        this.loading = false
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
 
                        if (error.response.data.errors.prenom) {
                            this.errors.push(error.response.data.errors.prenom[0]);
                        }

                         if (error.response.data.errors.numero) {
                            this.errors.push(error.response.data.errors.numero[0]);
                        }

                         if (error.response.data.errors.email) {
                            this.errors.push(error.response.data.errors.email[0]);
                        }
                    });
            },

             deleteEmploye(index)
            {
                let conf = confirm("Vraiment supprimer cet employé ?");
                if (conf === true) {
                    this.loading = true
 
                    axios.delete('/management_des_employe/' + this.employes[index].id)
                        .then(response => {
 
                            this.employes.splice(index, 1);


 
                        }).then(_ => {
                            this.loading = false
                        }).then(_ => {
                            this.$root.$refs.toastr.s("L' employé a été supprimé !");
                        }) 
                        .catch(error => {
                            console.log(error);
                        });
                }
            },

        listeEmployes()
        {
            this.loading = true
            axios.get('management_des_employe') 
            .then(response => {
              console.log(response.data)
              this.employes = response.data.employes
              this.structures = response.data.structures
               // this.pagination = response.data.pagination;
 
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })

        },

        exporter(e)
        {
        e.preventDefault();
        axios.get('exporter')
        .then(response => {
            if(response.status===200){
                this.$root.$refs.toastr.s("Telechargement terminé");

            }
        })
        .catch(function (error) {
          console.log(error); 
        });

        },

        changerStatut: function(id){
            this.loading = true
        axios.get('changement_de_satatut_en_ajax/' +id)
        .then(response => {
            console.log(response)
            if(response.status===200){
                this.listeEmployes();

            }
             }).then(_ => {
                    this.loading = false
                }).then(_ => {
                    this.$root.$refs.toastr.s("L'état a été mis a jour");
                 }) 
        .catch(function (error) {
          console.log(error); 
        });  

      }

      }
    }
</script>
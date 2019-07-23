
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import Vue from 'vue'; 
import VueResource from 'vue-resource'

import Toastr from 'vue-toastr';





require('vue-toastr/src/vue-toastr.scss');



Vue.component('vue-toastr',Toastr);
Vue.use(VueResource)





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let $employe = document.querySelector('#us')

if($employe)
{
    const app = new Vue({
        el: '#us',
    
        data(){
            return {
                user: {
                    name: '',
                    prenom: '',
                    email: '',
                    numero:'',
                    active: true,
    
    
                },
    
                admin: {
                    name: '',
                    prenom: '',
                    email: '',
                    numero:'',
                    active: true,
                    admin: true,
    
    
                },
    
                errors: [],
                rolesApi: [],
                servicesApi: [],
                roleApi: '',
                serviceApi: '',
                paginationApi: '',
                errorsAdmin: [],
                employes: [],
                tousLesEmployes: '',
                codeActuel: '',
                cleProduit: '',

                structures: [],
                update_employe: {},
                loading: false,
                filter: 'all',
                search: '',
                updateRole: [],
                userRole: [],
                userPermission: [],
                allRoles: [],
                allPermissions: [],
                update_employe_role: {},
                selectionnePourSup: []
    
                // pagination: {'current_page': 1 }
               
            }
        },
    
        mounted()
        {
            this.listeEmployes()
            this.apiGetTotalUtilisateurs()
        },
        
    
        computed: {
            totalEmployes() {
                return this.employes.length
            },
    
            totalAdmin()
            {
                return this.employes.filter(employe => employe.admin).length  
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
    
            }else if(this.filter === 'admin'){
                return this.employes.filter(employe => employe.admin)
    
            }
            else{
                const searchTerm = this.search.toLowerCase();
                const searchTermPrenom = this.search.toLowerCase();
                const searchTermEmail = this.search.toLowerCase();



               return this.employes.filter((employe) => {
                 return employe.name.toLowerCase().includes(searchTerm) 
                 || employe.prenom.toLowerCase().includes(searchTermPrenom) 
                 || employe.email.toLowerCase().includes(searchTermEmail) 

               
    
               }
            )
    
            }

            
        }
    
        },
        /*

        watch: {
            'tousLesEmployes': function(){
                this.listeEmployes()
                this.listeEmployesPagination()
                this.listeEmployesParGroupe()
                this.listeEmployesParService()
            }
        },
        */
        
    
        methods: {
            initAddTask()
            {
                this.errors = [];
                $("#add_task_model").modal("show");
            },

            afficherEtdesafficher()
            {
                $('#divCleProduit').toggle('slow')
               // $('#btnAjouter').hide('fast')
    
    
            },
            /*
             if(response.status === 200)
                    {
                        
                    }

            */

         

            createTask()
            {
                this.loading = true
               
                axios.post('/management_des_employe', {
                    name: this.user.name,
                    prenom: this.user.prenom,
                    numero: this.user.numero,
                    email: this.user.email
                   
    
                })
                    .then(response => {
                        this.reset();
                        this.listeEmployes();
                        this.apiGetTotalUtilisateurs()

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

            supprimerPlusieursUtilisateurs()
            {
                
                    let conf = confirm('Vraiment supprimer ces utilisateurs ?')

                    if(conf === true)
                    {
                        this.loading = true
                   
                        axios.post('/supprimer_plusieurs_utilisateurs', {
                            id: this.selectionnePourSup
                           
                        }).then(_ => {
                            this.loading = false
                            this.selectionnePourSup = []
                            this.listeEmployes();
                            this.$root.$refs.toastr.s("Supprimé avec succès");
                        })
                        .catch(error => {
                           console.log(error)
                        });
    
                    }

                
               
            
            },

            activerPlusieursUtilisateurs()
            {
                
                        this.loading = true
                   
                        axios.post('/activer_plusieurs_utilisateurs', {
                            id: this.selectionnePourSup
                           
                        }).then(_ => {
                            this.loading = false
                            this.selectionnePourSup = []
                            this.listeEmployes();
                            this.$root.$refs.toastr.s("Les états ont été mis à jour ");
                        })
                        .catch(error => {
                           console.log(error)
                        });
    
                    

                
               
            
            },

            reset()
            {
                this.user.name = '';
                this.user.prenom = '';
                this.user.numero = '';
                this.user.email = '';
            },
    
            initAddAdmin()
            {
                this.errorsAdmin = [];
                $("#add_admin_model").modal("show");
            },
            createAdmin()
            {
                this.loading = true
                /*
                 this.employes.push({
                 name: this.user.name,
                    prenom: this.user.prenom,
                    numero: this.user.numero,
                    email: this.user.email,
                    active: true,
            })
            */
                axios.post('/ajouter_admin', {
                    name: this.admin.name,
                    prenom: this.admin.prenom,
                    numero: this.admin.numero,
                    email: this.admin.email,
    
                })
                    .then(response => {
    
                        this.resetAdmin();
                        this.listeEmployes();
                        this.$root.$refs.toastr.s("Enregistré avec succès");
    
    
                        $("#add_admin_model").modal("hide");
    
                    }).then(_ => {
                        this.loading = false
                    })
                    .catch(error => {
                        this.errorsAdmin = [];
                        if (error.response.data.errorsAdmin.name) {
                            this.errorsAdmin.push(error.response.data.errorsAdmin.name[0]);
                        }
    
                        if (error.response.data.errorsAdmin.prenom) {
                            this.errorsAdmin.push(error.response.data.errorsAdmin.prenom[0]);
                        }
    
                         if (error.response.data.errorsAdmin.numero) {
                            this.errorsAdmin.push(error.response.data.errorsAdmin.numero[0]);
                        }
    
                         if (error.response.data.errorsAdmin.email) {
                            this.errorsAdmin.push(error.response.data.errorsAdmin.email[0]);
                        }
                    });
            },
            resetAdmin()
            {
                this.admin.name = '';
                this.admin.prenom = '';
                this.admin.numero = '';
                this.admin.email = '';
            },
    
    
            lien(id)
            {
                let base_url = window.location.protocol+'//'+window.location.host

                window.location.href = base_url + '/modification_des_acces/' +id;
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
              this.servicesApi = response.data.servicesApi
              this.rolesApi = response.data.rolesApi


             
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
    
        },

        apiGetTotalUtilisateurs()
        {
            axios.get('api_get_total_utilisateurs') 
            .then(response => {
              this.tousLesEmployes = response.data.users
              this.codeActuel = response.data.codeActuel
            
            }) .catch( (error) => {
                console.log(error) 
              })
    
        },

        listeEmployesPagination()
        {
           // this.loading = true
            axios.post('api_get_employe_pagination', {
                paginationApi: this.paginationApi,
               

            }) 
            .then(response => {
              console.log(response.data)
              this.employes = response.data.users.data
             // this.servicesApi = response.data.servicesApi
             // this.rolesApi = response.data.rolesApi


             
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
    
        },

        envoyerCode()
        {
              // this.loading = true
              axios.post('entrer_la_cle', {
                cleProduit: this.cleProduit,

            }) 
            .then(response => {

                if(response.status === 200)
                {
                    
                $('#divCleProduit').hide('fast')

                this.cleProduit = ''

                this.movepm()

                // this.apiGetTotalUtilisateurs()

                   // this.$root.$refs.toastr.s("Code vérifié");
      
                }else{
                    this.$root.$refs.toastr.e(response.data.message);

                }

               

               })
            .catch( (error) => {
              console.log(error) 
            })
        },

        movepm() {

            $('#prog').show('fast')
            var elem = document.getElementById("myBar"); 
            let fun = this.apiGetTotalUtilisateurs()
           // let mess = this.$root.$refs.toastr.s("Code vérifié");
            var width = 1;
            var id = setInterval(frame, 100);
            function frame() {
              if (width >= 100) {
                    clearInterval(id);
                    elem.innerHTML = width * 1 + '% Code accepté ';
                   
                    setTimeout(function(){
                    $('#prog').hide('slow')
                    },2000)

                    fun
                    

                    $('#tablePrincipale').show('fast')


                } else {
                      $('#tablePrincipale').hide('fast')

                    width++; 
                    elem.style.width = width + '%'; 
                    elem.innerHTML = width * 1 + '% Vérification du code';
                }
            }


        },

        disqueUtilisateur() {

            $('#disque').show('fast')
            var elem = document.getElementById("disqueBar"); 
            var width = 70;
            var id = setInterval(frame, 100);
            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                    $('#disque').hide('fast')

                } else {
                    width++; 
                    elem.style.width = width + '%'; 
                    elem.innerHTML = width * 1 + '% Vérification du code';
                }
            }


        },

        listeEmployesParGroupe()
        {
           // this.loading = true
            axios.post('api_get_employe_par_groupe', {
                roleApi: this.roleApi
               

            }) 
            .then(response => {
             // console.log(response.data)
              this.serviceApi = ''
              this.employes = response.data.users
             // this.servicesApi = response.data.servicesApi
             // this.rolesApi = response.data.rolesApi


             
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
    
        },

        listeEmployesParService()
        {
           // this.loading = true
            axios.post('api_get_employe_par_service', {
                serviceApi: this.serviceApi
               

            }) 
            .then(response => {
              //console.log(response.data)
              this.roleApi = ''
              this.employes = response.data.users
             // this.servicesApi = response.data.servicesApi
             // this.rolesApi = response.data.rolesApi


             
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
    
        },


        apiGetEmployePost()
        {
            this.loading = true
            
            axios.post('api_get_employe_post', {
               // paginationApi: this.paginationApi,
                serviceApi: this.serviceApi,
                roleApi: this.roleApi
               

            }) .then(response => {
                console.log(response.data)
                this.employes = response.data.employes.data
               
      
              })
            .then(_ =>{
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
    });

}

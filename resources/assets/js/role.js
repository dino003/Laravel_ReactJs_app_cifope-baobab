import './bootstrap';

import Vue from 'vue'; 

import Toastr from 'vue-toastr';





require('vue-toastr/src/vue-toastr.scss');



Vue.component('vue-toastr',Toastr);


const app = new Vue({
    el: '#roles',

    data(){
        return{
            loading: false,
            permissions: [],
            roles: [],
            search: '',
            selectionnGroupPermission: [],

            selectionnePourSup: [],
            newRole: {
                name: ''
            },
            role: {
                name: '',
                id: ''
            }
        }
    },

    mounted(){
        this.apiGetRoles()
        this.apiGetPermissions()
    },

    computed:{
        rolesFiltres()
        {
            const searchTermEmail = this.search.toLowerCase();

            return this.roles.filter( (role) => {
             return role.name.toLowerCase().includes(searchTermEmail) 
         })
        }
    },

    methods: {
        apiGetRoles()
        {
            this.loading = true
            axios.get('api_get_roles') 
            .then(response => {
              //console.log(response.data)
              this.roles = response.data
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
    
        },

        apiGetPermissions()
        {
            this.loading = true
            axios.get('api_get_permissions') 
            .then(response => {
              //console.log(response.data)
              this.permissions = response.data
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
    
        },

        ajouterRole()
        {
            this.loading = true
         
            axios.post('/gestion_des_roles', {
                name: this.newRole.name,
               

            })
                .then(response => {

                    this.newRole.name = ''
                    this.apiGetRoles();
                    this.$root.$refs.toastr.s("Enregistré avec succès");


                    $("#my").hide("fast");
                    $('#btnAjouter').show('fast')


                }).then(_ => {
                    this.loading = false
                }) .catch(error => {
                    console.log(error)
                 });

        },

         tog(source) {
            vj = this.selectionnePourSup
            for(var i=0, n=vj.length;i<n;i++) {
              vj[i].checked = source.checked;
            }
          },

        lien(id)
        {
            let base_url = window.location.protocol+'//'+window.location.host

            window.location.href = base_url + '/gestion_des_roles/' +id+ '/edit'
        },

        attributionDePermission(index)
        {
            
            $("#myModalpm").modal({
                backdrop: 'static',
                keyboard: false
            });
            
          // $("#myModalpm").fadeIn('slow')
            this.role = this.roles[index];
        },

        afficherEtdesafficher()
        {
            $('#my').show('slow')
            $('#btnAjouter').hide('fast')


        },

        atrribuerPermissions()
        {
    
                    this.loading = true
               
                    axios.post('/api_post_ajouter_permissions', {
                        role: this.role.id,
                        permission: this.selectionnGroupPermission
                       
                    }).then(_ => {
                        this.loading = false

                        this.selectionnGroupPermission = []
                        this.apiGetRoles();
                        this.$root.$refs.toastr.s("Les permissions ont été attribuées");
                        $("#myModalpm").modal("hide");

                    })
                    .catch(error => {
                       console.log(error)
                    });      
        
        },


        supprimerPlusieurs()
        {
       
                let conf = confirm('Vraiment supprimer ces roles ?')

                if(conf === true)
                {
                    this.loading = true
               
                    axios.post('/supprimer_plusieurs_role', {
                        id: this.selectionnePourSup
                       
                    }).then(_ => {
                        this.loading = false
                        this.selectionnePourSup = []
                        this.apiGetRoles();
                        this.$root.$refs.toastr.s("Supprimé avec succès");
                    })
                    .catch(error => {
                       console.log(error)
                    });

                }

            
           
        
        },
    }

});
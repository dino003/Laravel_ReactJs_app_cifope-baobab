
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import Vue from 'vue'; 

import Toastr from 'vue-toastr';





require('vue-toastr/src/vue-toastr.scss');



Vue.component('vue-toastr',Toastr);


let $trace = document.querySelector('#trace')

if($trace)
{
    new Vue({
        el: '#trace',
        data(){
            return{
                loading: false,
                
                resultatDeRecherche: [],
                search: '',
                structuresApi: [],
                tf: 'bonjour',
                archive: {
                premiereDate: '',
                deuxiemeDate: '',
                service: '',
                operation: '',
                document: '',
                heure: ''
                }
            }
        },

        mounted()
        {
            this.apiGetStructure()
        },

        computed:{

            totalResultat() {
                return this.resultatDeRecherche.length
            },

            datefor()
            {
              //  return archive.premiereDate.getMonth()
                return this.archive.premiereDate.Date('d-m-y')

            },

            premiereD(){  // expects Y-m-d
                var splitDate = this.archive.premiereDate.split('-');
                if(splitDate.count == 0){
                    return null;
                }
            
                var year = splitDate[0];
                var month = splitDate[1];
                var day = splitDate[2]; 
            
                return day + '\/' + month + '\/' + year;
            },

            deuxiemeD(){  // expects Y-m-d
                var splitDate = this.archive.deuxiemeDate.split('-');
                if(splitDate.count == 0){
                    return null;
                }
            
                var year = splitDate[0];
                var month = splitDate[1];
                var day = splitDate[2]; 
            
                return day + '\/' + month + '\/' + year;
            },

            
            filteredResultat (){
                    const searchTermDocument = this.search.toLowerCase();
                    const searchTermService = this.search.toLowerCase();
                    const searchTermHeure = this.search.toLowerCase();
    
    
    
                   return this.resultatDeRecherche.filter((archive) => {
                     return archive.document.toLowerCase().includes(searchTermDocument) 
                     || archive.service.toLowerCase().includes(searchTermService) 
                     || archive.heure.toLowerCase().includes(searchTermHeure) 
    
                   
        
                   }
                )
        
                
            }
        },

        methods:{
            getTrace(){
                this.loading = true
            
            axios.post('api_get_tracabilite', {
                premiereDate: this.archive.premiereDate,
                deuxiemeDate: this.archive.deuxiemeDate,
                operation: this.archive.operation
               // service: this.archive.service
               

            }) .then(response => {
                console.log(response.data)
                this.resultatDeRecherche = response.data
               
      
              })
            .then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
            },

            apiGetStructure()
            {
                this.loading = true
            axios.get('apiGetStructure') 
            .then(response => {
              console.log(response.data)
              this.structuresApi = response.data.structures


             
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })
            },

             changeDateFormat(inputDate){  // expects Y-m-d
                var splitDate = inputDate.split('-');
                if(splitDate.count == 0){
                    return null;
                }
            
                var year = splitDate[0];
                var month = splitDate[1];
                var day = splitDate[2]; 
            
                return month + '\\' + day + '\\' + year;
            }
        }
    })
}

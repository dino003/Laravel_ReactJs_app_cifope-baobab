
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
//Vue.component('articl', require('./components/articles/Article.vue'));

let $articles = document.querySelector('#aTest')

if($articles)
{
    const urlG = window.location.protocol+'//'+window.location.host

    new Vue({
        el: '#aTest',

        data (){
            return{
                article: {
                    titre: '',
                    contenu: '',
                    fichier: '',
                    image: '',
                    nomFichier: '',
                    lien: ''
                },
                newArticle: {
                    titre: '',
                    contenu: '',
                    fichier: '',
                    image: '',
                    nomFichier: '',
                    lien: ''
                },
                articles: [],
                loading: false,
               
                 filter: 'all',
                 search: '',
                 test: '',
                 url: null,
                 selectionnePourSup: []
                // form: new FormData
                
            }
    
        
        },
    
        mounted() {
            this.getArticles()
        },
    
        computed: {
            
             totalArticles() {
                    return this.articles.length
                },
    
                 totalArticlesActifs() {
                    return this.articles.filter(article => article.publie).length
                },
    
                 totalArticlesInactif() {
                    return this.articles.filter(article => !article.publie).length
                },

                totalArticlesCorbeille() {
                    return this.articles.filter(article => !article.active).length
                },
    
            ArticlesFiltres(){
                 if(this.filter === 'actif'){
                    return this.articles.filter(article => article.publie)
                }else if(this.filter === 'inactif'){
                     return this.articles.filter(article => !article.publie)
    
                }
                else if(this.filter === 'corbeille'){
                    return this.articles.filter(article => !article.active)
   
               }
                else{
                    const searchTermEmail = this.search.toLowerCase();

                   return this.articles.filter( (article) => {
                    return article.titre.toLowerCase().includes(searchTermEmail) 
                })
    
                }
            }
        },
    
        methods: {
            publierArticle(id) {
                 this.loading = true
            axios.get('publier_en_ajax/' +id)
            .then(response => {
               // console.log(response)
                
                 }).then(_ => {
                        this.loading = false
                    }).then(_ => {
                        this.$root.$refs.toastr.s("L'état a été mis à jour ! ");
                     }) 
            .catch(function (error) {
              console.log(error); 
            });  
            },

            supprimerPlusieurs()
            {
           
                    let conf = confirm('Vraiment supprimer ces articles ?')

                    if(conf === true)
                    {
                        this.loading = true
                   
                        axios.post('/supprimer_plusieurs_article', {
                            id: this.selectionnePourSup
                           
                        }).then(_ => {
                            this.loading = false
                            this.selectionnePourSup = []
                            this.getArticles();
                            this.$root.$refs.toastr.s("Supprimé avec succès");
                        })
                        .catch(error => {
                           console.log(error)
                        });
    
                    }

                
               
            
            },

            publierPlusieurs()
            {
                this.loading = true
               
                axios.post('/publier_plusieurs', {
                    id: this.selectionnePourSup
                   
                }).then(_ => {
                    this.loading = false
                    this.selectionnePourSup = []
                    this.getArticles();
                    this.$root.$refs.toastr.s("Les etats ont été mis à jour");
                })
                .catch(error => {
                   console.log(error)
                });
            },

            publierPlusieursDansLesServices()
            {
                this.loading = true
               
                axios.post('/publier_plusieurs_dans_les_services', {
                    id: this.selectionnePourSup
                   
                }).then(_ => {
                    this.loading = false
                    this.selectionnePourSup = []
                    this.getArticles();
                    this.$root.$refs.toastr.s("Les etats ont été mis à jour");
                })
                .catch(error => {
                   console.log(error)
                });
            },

            publierArticleDansLesServices(id) {
                this.loading = true
           axios.get('publier_dans_les_services/' +id)
           .then(response => {
              // console.log(response)
               
                }).then(_ => {
                       this.loading = false
                   }).then(_ => {
                       this.$root.$refs.toastr.s("L'état a été mis à jour ! ");
                    }) 
           .catch(function (error) {
             console.log(error); 
           });  
           },
    
            getArticles() 
            {
                this.loading = true
                this.$http.get('les_articles') 
                .then(response => {
                 // console.log(response.data)
                  this.articles = response.data
     
                }).then(_ =>{
                    this.loading = false
                })
                .catch( (error) => {
                  console.log(error) 
                })  
                
            },
            
            showArticle(index){
                $("#myModalFullscreen").modal("show");
                this.article = this.articles[index];


            },
            showArticleFile(index){
                $("#myModalFullscreenFiles").modal("show");
                this.article = this.articles[index];


            },

            initAdd(){
                $("#myModal0").slideDown('slow')
                $("#btnAjouter").hide()

            },

            initHide(){
                $("#myModal0").slideUp('slow')
                $("#btnAjouter").show()

            },
    
             onImageChange(e) {
                   this.newArticle.image = e.target.files[0]
                   this.url = URL.createObjectURL(this.newArticle.image)


                  // console.log(this.url)
                   
                },
    
                 onFichierChange(e) {
                    this.newArticle.fichier = e.target.files[0]
                    //console.log(this.newArticle.fichier)
                },

                resetNewArticle()
                {
                    this.newArticle.titre = '';
                    this.newArticle.contenu = '';
                    this.newArticle.image = '';
                    this.newArticle.fichier = '';
                    this.newArticle.lien = '';
                    this.newArticle.nomFichier = '';


                },
               
    
               initAddArticle()
                {
                    this.errors = [];
                    $("#add_task_model").modal("show");
                },

                lienPublicationCible(id)
                 {
                    window.location.href = urlG + '/publication_article_cible/' +id;
                },

                formSubmit(e) {

                    e.preventDefault();
    
                    let currentObj = this;
    
     
    
                    const config = {
    
                        headers: { 'content-type': 'multipart/form-data' }
    
                    }
    
     
    
                    let formData = new FormData();
    
                    formData.append('image', this.newArticle.image);
                    formData.append('titre', this.newArticle.titre)
                    formData.append('fichier', this.newArticle.fichier)
                    formData.append('contenu', this.newArticle.contenu)
                    formData.append('lien', this.newArticle.lien)
                    formData.append('nomFichier', this.newArticle.nomFichier)
     
                    this.loading = true

                    axios.post('/les_articles', formData, config)
    
                    .then(response => {
                       
                       // console.log(currentObj)
                       this.initHide()
                       this.resetNewArticle();
                       this.getArticles()

                       this.$root.$refs.toastr.s("Enregistré avec succès");

    
    
                    }).then(_ => {
                        this.loading = false
                    })
    
                    .catch(error => {
    
                        currentObj.output = error;
    
                    });
    
                },

             supprimerArticle(index)
             {
                let conf = confirm("Vraiment supprimer cet article ?");
                if (conf === true) {
                    this.loading = true
    
                    axios.delete('/suppression_article/' + this.articles[index].id)
                        .then(response => {
    
                            this.articles.splice(index, 1);
    
    
    
                        }).then(_ => {
                            this.loading = false
                        }).then(_ => {
                            this.$root.$refs.toastr.s("L' article a été supprimé !");
                        }) 
                        .catch(error => {
                            console.log(error);
                        });
                }
            }
        }
        
        
    });
}

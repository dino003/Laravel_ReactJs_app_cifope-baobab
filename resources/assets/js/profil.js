
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
let $profil = document.querySelector('#profil')

if($profil)
{
    
 new Vue({
    el: '#profil',
   
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
            comment: {
                commentaire: '',
                article_id: ''
            },

            nouvelArticleParEmploye: {
                titre: '',
                contenu: '',
                fichier: '',
                image: '',
                nomFichier: '',
                lien: ''
            },

            articleParEmploye: {
                titre: '',
                contenu: '',
                fichier: '',
                image: '',
                nomFichier: '',
                lien: ''
            },
            articles: [],
            loading: false,
            comm: '',
            artId: '',
            commentaires: [],
            articlesPerso: [],
            loadingPerso: false,
            url: null
            
        }
    },

    mounted(){
        this.lesArticlesPerso()
    },

    computed:{
        computedArticles(){
            return this.articles
        },

        computedCommentaires(){
            return this.commentaires

        },
        
        compterCommentaires(){
            return this.commentaires.length
        }
    },

    methods: {

        addCommentaire(){
            if(this.comment.commentaire)
            {
               /*
                this.commentaires.push({
                    commentaire: this.comment.commentaire
                })
                */
                

                axios.post('ajouter_comm', {
                    article_id: this.article.id,
                    commentaire: this.comment.commentaire
                  })
                  .then( (response) => {              
                    console.log(response.data); 
                    if(response.status===200){
                     // this.commentaires = response.data.commentaires;
                      this.comment.commentaire = '';
                     // this.lesCommentairesDeLarticle(this.article.id,index)
                     this.getArticles()

                    }
          
                  })
                  .catch(function (error) {
                    console.log(error); 
                  });

            }
        },

        onImageChange(e) {
            this.nouvelArticleParEmploye.image = e.target.files[0]
            this.url = URL.createObjectURL(this.nouvelArticleParEmploye.image)

         },

          onFichierChange(e) {
             this.nouvelArticleParEmploye.fichier = e.target.files[0]

         },

         resetnouvelArticleParEmploye()
         {
             this.nouvelArticleParEmploye.titre = '';
             this.nouvelArticleParEmploye.contenu = '';
             this.nouvelArticleParEmploye.image = '';
             this.nouvelArticleParEmploye.fichier = '';
             //this.nouvelArticleParEmploye.lien = '';
             this.nouvelArticleParEmploye.nomFichier = '';


         },

         formSubmit(e) {

            e.preventDefault();

            let currentObj = this;



            const config = {

                headers: { 'content-type': 'multipart/form-data' }

            }



            let formData = new FormData();

            formData.append('image', this.nouvelArticleParEmploye.image);
            formData.append('titre', this.nouvelArticleParEmploye.titre)
            formData.append('fichier', this.nouvelArticleParEmploye.fichier)
            formData.append('contenu', this.nouvelArticleParEmploye.contenu)
          //  formData.append('lien', this.nouvelArticleParEmploye.lien)
            formData.append('nomFichier', this.nouvelArticleParEmploye.nomFichier)

            this.loading = true

            axios.post('/les_articles', formData, config)

            .then(response => {
               
               // console.log(currentObj)
               this.initHide()
               this.resetnouvelArticleParEmploye();
               //this.getArticles()

               this.$root.$refs.toastr.s("Votre article a été posté avec succès");
                this.lesArticlesPerso()


            }).then(_ => {
                this.loading = false
            })

            .catch(error => {

                currentObj.output = error;

            });

        },

        showArticle(index){
            $("#myModalFullscreenFiles").modal("show");
            this.article = this.articles[index];

        },
        showFormPourPosterDansCommunaute(){
            $("#myModalEmployeCommnaute").modal("show");
        },

        afficherWindowpourImage(){
                $('#imageCommunautePratique').trigger('click');
            
        },

        afficherWindowpourFichier(){
            $('#fichierCommunautePratique').trigger('click');
        
    },
        

        afficherComm(index)
        {
            $("#commentaiesA").modal({
                backdrop: 'static',
                keyboard: false
            });
          //  $('#commentaiesA').modal("show")
            this.article = this.articles[index];

        },

        getArticles(){
         this.loading = true
        this.$http.get('articles_publies') 
        .then(response => {
          console.log(response.data)
          this.articles = response.data

        }).then(_ =>{
            this.loading = false
        })
        .catch( (error) => {
          console.log(error) 
        })  
        },

        lesCommentairesDeLarticle(id, index)
        {
            $("#commentaiesA").modal({
                backdrop: 'static',
                keyboard: false
            });
          //  $('#commentaiesA').modal("show")
            this.article = this.articles[index];

            this.loading = true

            this.$http.get('les_commentaires/' +id) 
            .then(response => {
              console.log(response.data)
              this.commentaires = response.data
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })  
        },

        pagePourCommentaire(article){
           
            let base_url = window.location.protocol+'//'+window.location.host
            window.location.href = base_url + '/article/' +article;

        },

        lesArticlesPerso(){
            this.loading = true
            this.$http.get('les_articles_perso') 
            .then(response => {
              console.log(response.data)
              this.articlesPerso = response.data
    
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })  
        },
        showArticlePerso(index){
            $("#myModalFullscreenFilesPerso").modal("show");
           // this.articleParEmploye = this.articlesPerso[index];
            

        },
        initAdd(){
            $("#formCo").slideDown('slow')
            $("#closeForm").show()
            $("#btnAjouter").hide()


            

        },

        initHide(){
            $("#formCo").slideUp('slow')
            $("#closeForm").hide()

            $("#btnAjouter").show()

        }
    }


});
}

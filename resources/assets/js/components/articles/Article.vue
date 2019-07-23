<style>

img {
    vertical-align: middle;
}

.img-responsive {
    display: block;
    height: auto;
    max-width: 100%;
}

.img-rounded {
    border-radius: 3px;
}

.img-thumbnail {
    background-color: #fff;
    border: 1px solid #ededf0;
    border-radius: 3px;
    display: inline-block;
    height: auto;
    line-height: 1.428571429;
    max-width: 100%;
    moz-transition: all .2s ease-in-out;
    o-transition: all .2s ease-in-out;
    padding: 2px;
    transition: all .2s ease-in-out;
    webkit-transition: all .2s ease-in-out;
}

.img-circle {
    border-radius: 50%;
}

.timeline-centered {
    position: relative;
    margin-bottom: 30px;
}

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before {
        content: '';
        position: absolute;
        display: block;
        width: 4px;
        background: #f5f5f6;
        /*left: 50%;*/
        top: 20px;
        bottom: 20px;
        margin-left: 30px;
    }

    .timeline-centered .timeline-entry {
        position: relative;
        /*width: 50%;
        float: right;*/
        margin-top: 5px;
        margin-left: 30px;
        margin-bottom: 10px;
        clear: both;
    }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry.begin {
            margin-bottom: 0;
        }

        .timeline-centered .timeline-entry.left-aligned {
            float: left;
        }

            .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
                margin-left: 0;
                margin-right: -18px;
            }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
                    left: auto;
                    right: -100px;
                    text-align: left;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
                    float: right;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
                    margin-left: 0;
                    margin-right: 70px;
                }

                    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
                        left: auto;
                        right: 0;
                        margin-left: 0;
                        margin-right: -9px;
                        -moz-transform: rotate(180deg);
                        -o-transform: rotate(180deg);
                        -webkit-transform: rotate(180deg);
                        -ms-transform: rotate(180deg);
                        transform: rotate(180deg);
                    }

        .timeline-centered .timeline-entry .timeline-entry-inner {
            position: relative;
            margin-left: -20px;
        }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
                position: absolute;
                left: -100px;
                text-align: right;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
                    display: block;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
                        font-size: 15px;
                        font-weight: bold;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
                        font-size: 12px;
                    }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
                background: #fff;
                color: #737881;
                display: block;
                width: 40px;
                height: 40px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
                text-align: center;
                -moz-box-shadow: 0 0 0 5px #f5f5f6;
                -webkit-box-shadow: 0 0 0 5px #f5f5f6;
                box-shadow: 0 0 0 5px #f5f5f6;
                line-height: 40px;
                font-size: 15px;
                float: left;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
                    background-color: #303641;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
                    background-color: #ee4749;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
                    background-color: #00a651;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
                    background-color: #21a9e1;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
                    background-color: #fad839;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
                    background-color: #cc2424;
                    color: #fff;
                }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
                position: relative;
                background: #f5f5f6;
                padding: 1em;
                margin-left: 60px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
                    content: '';
                    display: block;
                    position: absolute;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 9px 9px 9px 0;
                    border-color: transparent #f5f5f6 transparent transparent;
                    left: 0;
                    top: 10px;
                    margin-left: -9px;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2, .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
                    color: #737881;
                    font-family: "Noto Sans",sans-serif;
                    font-size: 12px;
                    margin: 0;
                    line-height: 1.428571429;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
                        margin-top: 15px;
                    }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
                    font-size: 16px;
                    margin-bottom: 10px;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
                        color: #303641;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
                        -webkit-opacity: .6;
                        -moz-opacity: .6;
                        opacity: .6;
                        -ms-filter: alpha(opacity=60);
                        filter: alpha(opacity=60);
                    }

</style>
<template>


   
 

	<div class="row container" style="top:10px;">
       
      

  <div class="row">
       <div class="ui active dimmer" v-if="loading">

            <div class="ui loader"></div>
        </div>
   <div class="col-md-12">
            <div class="col-md-6">
                 <div class="filter-group">
                            <input type="text" id="rech" v-model="search"  class="form-control"
                                   placeholder="Rechercher un article ..."
                                   style="width: 450px; ">
                        </div>
                       
                        
            </div>
            <div class="col-md-6">
                            <em class="btn btn-default" @click.prevent="filter = 'all'">Tous <span class="badge" style="background: green;">{{totalArticles}}</span></em>
                             <em class="btn btn-default" @click.prevent="filter = 'actif'">Publiés <span class="badge" style="background: green;">{{totalArticlesActifs}}</span></em>


                        <em class="btn btn-default" @click.prevent="filter = 'inactif'">Non Publiés <span class="badge" style="background: green;">{{totalArticlesInactif}}</span></em>

            </div>
             
        </div>
        </div>
    
       

    <!--   -->

    <div class="container">
                 <div class="ui piled segment container" v-for="article in ArticlesFiltres" :key="article.id">
                     <img :src="article.image" style="max-width: 300px;" v-if="article.image">
                     
  <h4 class="ui header">{{article.titre}}</h4>
        <p style="text-align: justify;">{{article.contenu}}</p>

        <p v-if="article.fichier">Document joints: <br>
            <a :href="article.fichier" target="_blank"> <span class="glyphicon glyphicon-open-file"></span>{{article.nomFichier}}</a>
        </p>

         <p v-if="article.lien">Lien a consulter: <br>
            <a :href="article.lien" target="_blank"> <span class="glyphicon glyicon-file"></span>{{article.lien}}</a>
        </p>
   
    <div class="extra content" v-if="article.publie">
      <span class="right floated" style="color: green;">
        Article publié <span class="glyphicon glyphicon-check"></span>
      </span>
      <span>
       
             <label>Fermer</label>

        <input type="checkbox" v-model="article.publie" @click="publierArticle(article.id)" tabindex="0" class="" style="width: 20px;">
      
      </span>
    </div>
    
    <div class="extra content pull right" v-else>
      <span class="right floated" style="color: red;">
        Article non publié <span class="glyphicon glyphicon-time"></span>
      </span>
      <span>
       
             <label>Publier</label>

        <input type="checkbox" v-model="article.publie" @click="publierArticle(article.id)" tabindex="0" style="width: 20px;" checked>
      
      </span>
    </div>

    
</div>
       
</div>

<!--  -->
   


	</div>

</template>

<script>
export default {
    data (){
        return{
            article: {
                titre: '',
                contenu: '',
                fichier: null,
                image: null,
                nomFichier: ''
            },
            articles: [],
            loading: false,
           
             filter: 'all',
             search: '',
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

        ArticlesFiltres(){
             if(this.filter === 'actif'){
                return this.articles.filter(article => article.publie)
            }else if(this.filter === 'inactif'){
                 return this.articles.filter(article => !article.publie)

            }else{
               return this.articles.filter((article) => {
                return article.titre.match(this.search)
            })

            }
        }
    },

    methods: {
        publierArticle(id) {
             this.loading = true
        axios.get('publier_en_ajax/' +id)
        .then(response => {
            console.log(response)
            
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
              console.log(response.data)
              this.articles = response.data
 
            }).then(_ =>{
                this.loading = false
            })
            .catch( (error) => {
              console.log(error) 
            })  
            
        },

         onImageChange(e) {
               this.article.image = e.target.files[0]
               //console.log(e)
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },

             onFichierChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
           

           initAddArticle()
            {
                this.errors = [];
                $("#add_task_model").modal("show");
            },
            addArticle()
            {
               // this.loading = true
                  //  var file = this.$refs.fileInput.files[0]

                
               // this.form.append('image', this.article.image)
               // const config = { headers: { 'Content-Type': 'multipart/form-data'}}
                axios.post('/les_articles', {
                    titre: this.article.titre,
                    contenu: this.article.contenu,
                    image: this.article.image,
                
                   

                })
                    .then(response => {
                        console.log(response)
 
                       // this.reset();
                        //this.listearticles();
                       // this.$root.$refs.toastr.s("Enregistré avec succès");
                        
                        // if(response.status===200){
                             /*
                            this.articles.push({
                             titre: this.article.titre,
                                 contenu: this.article.contenu,
                   
                    //publie: true,
                                 })
                                 */
                                //  this.getArticles()

                                 
                           // }
                            
 
                        //$("#add_task_model").modal("hide");
 
                    })//.then(_ => {
                       // this.loading = false
                  //  })
                    .catch(error => {
                       console.log(error)
                        
                    });
            },
            reset()
            {
                this.article.titre = '';
                this.article.contenu = '';
                
            },
    }
    
}
</script>



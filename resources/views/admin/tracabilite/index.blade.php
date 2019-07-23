@extends('admin.templates.main')

@section('content')
<style>
.container{
    margin-top:30px;
}

.filter-col{
    padding-left:10px;
    padding-right:10px;
}
</style>
<div class="container" id="trace">


        <div id="filter-panel" class="">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-inline" role="form">
                    
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-perpage">Du *</label>
                          

                            <input type="date" v-model="archive.premiereDate" name="premiereDate" id="pref-perpage" class="form-control">                               
                        </div> <!-- form group [rows] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-search">Au *</label>
                            <input type="date" v-model="archive.deuxiemeDate" name="deuxiemeDate" class="form-control input-sm" id="pref-search">
                        </div><!-- form group [search] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">Opérations (optionel)</label>
                            <select id="pref-orderby" class="form-control" v-model="archive.operation" name="operation">
                            <option selected value="TOUT">TOUT</option>

                                <option value="AJOUT">Ajout</option>
                                <option value="CONSULTATION">Consultation</option>
                                <option value="SUPPRESSION">Suppression</option>


                            </select>                                
                        </div> <!-- form group [order by] --> 
                        <!--
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="pref-orderby">Services (optionel)</label>
                            <select id="pref-orderby" class="form-control" v-model="archive.service" name="service">
                            <option selected disabled="">service</option>
                                <option v-for="(service, index) in structuresApi" :key="service.id" :value="service.id">@{{service.nom_structure}}</option>


                            </select>                                
                        </div> 
                        -->
                        <!-- form group [order by] --> 

                        <div class="form-group"> 
                        <!--   
                            <div class="checkbox" style="margin-left:10px; margin-right:10px;">
                                <label><input type="checkbox" style="width:15px;"> Remember parameters</label>
                            </div>
                            
                            <button type="submit" class="btn btn-default filter-col">
                                <span class="glyphicon glyphicon-record"></span> Save Settings
                            </button>  
                            -->

                            
                         <button v-show="archive.premiereDate && archive.deuxiemeDate" @click.prevent="getTrace" type="submit" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel">
                             <span class="glyphicon glyphicon-search"></span> 
                         </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>    
       
	
   <div class="ui segment" v-show="archive.premiereDate">

        <input v-if="resultatDeRecherche.length > 0" type="text" style="width: 280px;"  placeholder="Rechercher dans les resultats" v-model="search" class="form-control input-sm pull-right" id="pref-search">
   <p style="text-align:center; font-size:1.5em;">
   <em v-if="archive.premiereDate">Les opérations du <strong style="color:red"> @{{premiereD}}</strong></em>
   <em v-if="archive.deuxiemeDate"> au <strong style="color:red;">@{{deuxiemeD}}</strong> </em><br>
        <p style="text-align:center; font-size:1em;"> 
        <em v-if="archive.operation">Trié par : <strong  style="color:red;">@{{archive.operation}}</strong></em> ===>

     <!-- <em v-if="archive.service"> Dans : <strong  style="color:red;">@{{archive.service}}</strong></em>-->
     <em v-if="filteredResultat.length > 0"> <strong  style="color:red;">@{{totalResultat}} </strong>Resultats</em>

         </p>

   </p>


                            
                        
   
   </div>    

        <div class="ui segment" v-if="archive.premiereDate && filteredResultat.length > 0"
            style="height: 500px; overflow-y: scroll;">
        <table class="table table-responsive">

        
<div class="ui segment" v-if="loading">
            <p>Chargement ...</p>
            <p>Chargement ...</p>
            <p>Chargement ...</p>


            <div class="ui active dimmer inverted">
                <div class="ui loader"></div>
            </div>
        </div>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">DATE</th>
      <th scope="col">HEURE</th>
      <th scope="col">AUTEUR</th>
      <th scope="col">OPERATION</th>
      <th scope="col">DOCUMENT</th>
      <th scope="col">SERVICE</th>





     
    </tr>
  </thead>
  <tbody>
  
    <tr v-for="(archive, index) in filteredResultat">
      <th scope="row">#</th>
      <td>@{{archive.date_formatee}}</td>
      <td>@{{archive.heure}}</td>
      <td>@{{archive.auteur}}</td>
      <td>@{{archive.operation}}</td>
      <td>@{{archive.document}}</td>
      <td>@{{archive.service}}</td>

      
    </tr>
    
    
  </tbody>
</table> 
        
        </div>

        <div class="ui segment" v-else>
            <p style="text-align:center;">AUCUN RESULTAT NE CORRESPOND A VOTRE RECHERCHE !</p>
        </div>





</div>

@endsection
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/exporter', 'UserController@export')->name('exporter.excel');

Route::get('/erreur_500', function(){
    return view('errors.500');
})->name('erreur.500');

Route::get('/erreur_404', function(){
    return view('errors.404');
})->name('erreur.404');

// accueil
Route::get('/', 'HomeController@accueil')->name('accueil');


Route::get('/acceuil', function () {
    return view('admin.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/gestion_des_employes_ajax', 'EmployeController@liste')->name('employes.index.vue');

Route::resource('management_des_employe', 'EmployeController', ['except' => ['create', 'edit']]);
Route::post('api_get_employe_pagination', 'EmployeController@apiGetEmployePagination');
Route::post('api_get_employe_par_groupe', 'EmployeController@apiGetEmployeParGroupe');
Route::post('api_get_employe_par_service', 'EmployeController@apiGetEmployeParService');

Route::post('entrer_la_cle', 'AccueilController@cleProduit');
Route::get('api_get_total_utilisateurs', 'EmployeController@apiGetTotalUtilisateurs');

Route::post('ajouter_admin', 'EmployeController@storeAdmin');

Route::post('completer_profil', 'UserController@storeProfil');
Route::get('poster_message', 'EmployeController@posterMessage');
Route::get('profil_user', 'EmployeController@profilUser');

//roles et permissions
Route::resource('gestion_des_roles', 'RoleController');
Route::get('roles', 'RoleController@getRoles');
Route::get('modification_des_acces/{id}', 'EmployeController@editRoleForUser');
Route::patch('modification_des_acces/{id}', 'EmployeController@updateRoleForUser')->name('modif.acces');
Route::get('getRoleAndPermissionForUser/{id}', 'EmployeController@editRoleForUser');

Route::get('api_get_roles', 'RoleController@apiGetRoles');
Route::get('api_get_permissions', 'RoleController@apiGetPermissions');
Route::post('api_post_ajouter_permissions', 'RoleController@storePermission');
Route::post('supprimer_plusieurs_role', 'RoleController@supprimerPlusieurs');





Route::get('/changement_de_satatut_en_ajax/{id}', 'EmployeController@changerStatutAjax');

Route::get('/todo', function () {
    return view('taches.tacheIndex');
});


/*
*les articles
*/

Route::get('les_articles', 'ArticleController@index');
Route::post('les_articles', 'ArticleController@store');
Route::get('publier_en_ajax/{id}', 'ArticleController@publierArticle');
Route::get('articles_publies', 'ArticleController@getArticlesPublies');
Route::post('ajouter_comm', 'ArticleController@storeCommentaireSurAffiche')->name('insert');
Route::get('les_commentaires/{idArticle}', 'ArticleController@getCommentairesByArticles');
Route::get('article/{article}', 'ArticleController@showArticle');
Route::get('profil', 'EmployeController@profil')->name('profil');
Route::get('les_commentaires_articles/{id}', 'ArticleController@les_commentaires_articles');
Route::get('les_articles_perso', 'ArticleController@lesArticlesPerso');
Route::get('publication_article_cible/{id}', 'ArticleController@publicationCible'); // pour voir une affiche
Route::patch('publication/{id}', 'ArticleController@attacherUnArticleAPlusieursServices')->name('publication');
Route::get('yu/{id}', 'ArticleController@re');
Route::delete('suppression_article/{id}', 'ArticleController@destroy');
Route::get('publier_dans_les_services/{idArticle}', 'ArticleController@publierArticleDansLesServices');

Route::post('supprimer_plusieurs_article', 'ArticleController@supprimerPlusieurs');
Route::post('publier_plusieurs', 'ArticleController@publierPlusieurs');
Route::post('publier_plusieurs_dans_les_services', 'ArticleController@publierPlusieursDansLesServices');
Route::post('supprimer_plusieurs_utilisateurs', 'EmployeController@supprimerPlusieursUtilisateurs');
Route::post('activer_plusieurs_utilisateurs', 'EmployeController@activerPlusieursUtilisateurs');


Route::get('rr/{id}', 'ArticleController@str');


Route::get('/communaute', function () {
    return view('admin.articles.ind');
})->name('communaute.pratiques');


Route::get('get_auth', 'UserController@get_auth');
Route::post('modif', 'UserController@updatePassword');
/*
* fin
*/

//route nouveau chat

Route::get('conversations', 'MessagerieController@index')->name('tchat');
Route::get('conversations/{user}', 'MessagerieController@index');
Route::get('convers', 'Api\MessageController@index');
Route::get('convers/{user}', 'Api\MessageController@show');
Route::post('convers/{user}', 'Api\MessageController@store');
Route::get('ced', function(){
    return view('welcoma');
});
Route::post('/formSubmit', 'UserController@formSubmit');





//fin



Route::get('/gestion_des_employes', 'UserController@index')->name('employes.index');
Route::get('/employes', 'UserController@create')->name('employes.create');
Route::post('/employes', 'UserController@store')->name('employes.store');
Route::put('mise_a_jour/{id}','UserController@changerStatut')->name('changer');
Route::get('/resultat_recherche_des_employes', 'UserController@rechercherUnEmploye')->name('cherch');


Route::get('/fiche_employe/{id}', 'UserController@fiche')->name('fiche.employe');
Route::post('picture', 'UserController@update_avatar')->name('changer.photo');
Route::get('/page_de_profil', 'UserController@profil')->name('page.profil');


// chat
Route::get('start_conversation', 'ChatController@indexUserList')->name('chat.users.list');
//Route::get('chat', 'ChatController@index')->name('chat.list');
Route::get('chat_conversation/{id}', 'ChatController@conversation')->name('conversation');

Route::get('chat_conversationAjax/{id}', 'ChatController@conversationAjax')->name('conversation.ajax');

Route::get('markAsRead/{id}', 'ChatController@markMessageLu');
Route::get('/resultat_recherche_des_amis', 'ChatController@chercherCorrespondant')->name('cherch');

// ici concerne le chat avec vuejs

Route::get('start_conversationVue', 'ChatController@vueListUser')->name('chat.users.list.vue');
Route::get('conversationVue', 'ChatController@chatVue')->name('chat.vue');
Route::get('conversation/{id}', 'ChatController@chatConversation')->name('chat.vue.conversation');
Route::post('chat/{id}', 'ChatController@insertText')->name('insertText');

Route::get('auth', function(){
    return Auth::user();
});

Route::get('dernier_message/{id}', 'ChatController@dernierMessage');


//tracabilite

Route::get('gestion_des_tracabilites', 'ArchiveController@index');
Route::post('api_get_tracabilite', 'ArchiveController@getTracabilite');



// fonction que j'ai ajouté pour la consultation dans la tracabilité
Route::get('consultation_pour/{iddocument}/structure/{idstructure}', 'DocumentServiceController@DocConsultingAjouter');





//Gestion des structure Admin
Route::get('ListeStructure','StructureController@index');
Route::post('AddStructure','StructureController@store');
Route::post('UpdateStructure','StructureController@update');
Route::post('AddSousStructure','StructureController@StoreSousStructure');
Route::get('DetailStructure/{id}','StructureController@show');
Route::get('deleteStructure/{id}','StructureController@deleteStructure');
Route::get('SousDossier/{id}/structure/{structure}','StructureController@showdossier');
//Fin

// //Gestion des dossiers
 Route::post('AddDossier','DossierController@store');
Route::post('UpdateDossier','DossierController@update');
 Route::get('deleteDossier/{id}','DossierController@deleteDossier');
 Route::post('AddSousDossier','DossierController@AddSousDossier');
// //fin


//Route Mediatheque
    Route::get('ListePhoto','MediathequeController@ListePhoto');
    Route::post('AddMediatheque','MediathequeController@store');
    Route::get('deletePhoto/{id}','MediathequeController@delete');
    
    //Route::get('FiltresDepartementPhoto/{id}','MediathequeController@FiltresDepartementPhoto');
    //Route::get('FiltresMentionPhoto/{id}','MediathequeController@FiltresMentionPhoto');
    Route::get('ListeVideo','MediathequeController@ListeVideo');
    //Route::get('FiltresDepartementVideo/{id}','MediathequeController@FiltresDepartementVideo');
    //Route::get('FiltresMentionVideo/{id}','MediathequeController@FiltresMentionVideo');
    Route::post('UpdateMediatheque','MediathequeController@update');
//

    //Document gestion

Route::get('ListeDocumentAjax','DocumentController@ListeDocumentAjax');
Route::post('AddDocumentAjax/{id}','DocumentController@AddDocumentAjax');
Route::get('deleteDocument/{id}','DocumentController@delete');
Route::post('AddDocument','DocumentController@AddDocument');
    //Fin gestion des document


//Gestion des lien
//lien pour tous 
Route::post('AddLien','LienController@store');
Route::get('deleteLien/{id}','LienController@delete');
Route::post('UpdateLien','LienController@update');
//fin
//

//route d'affetation
Route::get('AffectationEmploye','AffectationController@AffectationEmploye');
Route::get('AffectationDocument','AffectationController@AffectationDocument');
Route::post('AddAffectationEmploye','AffectationController@AddAffectationEmploye');
//


//Document, video, dossier propre a l'utilisateur
Route::get('Mesdossiers','MesdossierController@index');
Route::post('Addmesdossier','MesdossierController@store');
Route::get('deleteMydossier/{id}','MesdossierController@delete');
Route::post('UpadeMondossier','MesdossierController@update');

Route::get('DetailMonDossier/{id}','MesdossierController@show');
Route::post('AddSousMondossier','MesdossierController@AddSousMondossier');
Route::post('AddMesdocument','MesdocumentController@AddDocument');
Route::get('Mesdocumentdelete/{id}','MesdocumentController@delete');

Route::get('Mesvideopersonnel','MesvideoController@index');

Route::get('Deletevideopersonnel/{id}','MesvideoController@delete');
Route::post('AddMesvideo','MesvideoController@store');
Route::post('UpdateMesVideos','MesvideoController@update');
//fin
Route::get('Service/','InterviensController@index');
Route::get('DetailService/{id}','InterviensController@show');

Route::get('SousDossierService/{id}/structure/{structure}','InterviensController@showdossier');
Route::post('AffeterEmployeAjax','AffectationController@affeter');
Route::post('RetireEmployeAjax','AffectationController@RetireEmployeAjax');
//Document utilisateur
Route::get('DocumentService','DocumentController@DocumentUser');
Route::post('AddDocumentService','DocumentserviceController@store');
Route::get('deleteDocumentServie/{id}','DocumentserviceController@delete');
Route::get('TreeViewStructure','StructureController@treeViewStructure');

Route::get('ajout/{option}/us/{id}','InterviensController@ajout');
Route::get('visualise/{option}/us/{id}','InterviensController@visualise');
//
Route::get('TreeViewStructureAffecter','AffectationController@treeViewStructureAffectation');

Route::get('responsable/{option}/us/{id}','InterviensController@responsable');
Route::post('AddDocumentServiceMultiple','DocumentserviceController@AddDocumentServiceMultiple');

Route::get('progressbar/{id}','StructureController@CapaciteStokage');
Route::get('capaciteStokageUtilisateur','MesdocumentController@capacite');
Route::get('treeViewMesDossier','MesdossierController@treeViewMesDossier');
Route::get('/documentRecherche/action','InterviensController@rechercheDoc')->name('rechercherDoc.action');
Route::post('recherchedocument','InterviensController@RechercheMultipleCritere');
Route::get('telecharger/{iddocument}/structure/{idstructure}',"DocumentserviceController@DocConsulting");
Route::get('Executable','BureauController@BureauUser');
Route::get('configRacourcieApp','BureauController@configBureau');
Route::post('AddRacourcie','BureauController@store');
Route::get('Lancer/{id}','BureauController@BureauUser');
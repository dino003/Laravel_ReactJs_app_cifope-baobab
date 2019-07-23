<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Session;
use App\User;
use App\Article;
use App\Structure;
use Carbon\Carbon;
use App\Interviens;
use App\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Notifications\NouvelArticle;
use Spatie\Permission\Models\Permission;
use App\Notifications\NouvelArticleCible;
use App\Notifications\NouvelArticleParMail;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        setlocale(LC_TIME, 'French');

      
    }

    public function accueil()
    {
        return view('admin.articles.ind');

    }

    public function str($id)
    {
        $usersId=Interviens::where('structure_id',$id)
        ->get();
        $tab = [];
        foreach($usersId as $key => $us)
        {
           $tab[]=$us->user;
        }
        
        return $tab;


     // return $usersId->toArray();


        //return $users->toArray();
    }

    
    
  

    public function index()
    {
        $articles = Article::orderBy('id', 'desc')
                            ->with('structures')

                            ->get();
    

        return response()->json($articles);
    }

    public function getArticlesPublies()
    {
        $articles = Article::orderBy('id', 'desc')
        ->where('publie', 1)
        ->with('user')
        ->with('commentaires')
        ->with('structures')
        ->get();
    

        return response()->json($articles);
    }

    public function les_commentaires_articles($id){
        $article = Article::findOrFail($id);

        $commentaires = Commentaire::where('article_id', $article->id)
        ->with('user')
        ->get();

        return $commentaires;
    }

    // les articles d'un service donné

    public function lesArticlesDuService($id)
    {
        $service = Structure::findOrFail($id);

        $lesArticles = $service->articles;

        return response()->json($lesArticles);
    }

    // les services pour un article donné

    public function lesServicesDeCetarticle($id)
    {
        $article = Article::findOrFail($id);

        $lesServices = $article->structures;

        return response()->json($lesServices);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        

        $article = new Article;
        $article->contenu = $request->contenu;
        $article->titre = $request->titre;
        $article->user_id = Auth::id();

        if ($request->hasFile('fichier')){
            //recuperation du nom de fichier
            $fullName=$request->file('fichier')->getClientOriginalName();
            //recuperation du nom san l'extention
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            //Recuperation de l'extension
            $extension=$request->file('fichier')->getClientOriginalExtension();
            //creation du nom unique pour l'image
            $nameTosore=$name.'_'.time().'.'.$extension;
            $destination= public_path('/uploads/docs/');
            $path=$request->file('fichier')->move($destination, $nameTosore);
            $url_fichier = url('/uploads/docs/'.$nameTosore);

            $article->fichier = $url_fichier;
            if($request->get('nomFichier'))
            {
                $article->nomFichier = $request->nomFichier.'.'.$extension;
            }


        }

        if($request->hasFile('image')){
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename ));

            $img_path = url('/uploads/avatars/'.$filename);


           // $input['image'] = $filename;
            $article->image = $img_path;


        }

        $article->save();
        return back();

    }

    public function publierArticle($id)
    {
        $article = Article::where('id', $id)->firstOrFail();

      

        if(!$article->publie)
        {
            $users = User::get();
            foreach($users as $key => $user)
            {
                if(App::environment() === 'production')
                {
                     $user->notify(new NouvelArticleParMail($article));

                }

               // $user->notify(new NouvelArticle($article));


    
            }
        }
       
        $article->date_publication = now();

        $article->publie = !$article->publie;

        if($article->partage)
        {
            $article->partage = !$article->partage;

        }


       


        $article->save();

        return $article;
    }

    public function publierArticleDansLesServices($idArticle)
    {
        // recuperation de l'article
        $article = Article::where('id', $idArticle)->firstOrFail();


    
        // retourne les structures de l'article 
        $structure_articles = $article->structures;


        foreach ($structure_articles as $key => $stArticle) {

            // recupereb les utilisateurs de chaque structure 
            $usersdeLastructure = $stArticle->users;
           // dd($usersdeLastructure);
            if(count($usersdeLastructure))
            {
                //dd($usersdeLastructure);

                foreach($usersdeLastructure as $key => $user)
                {
                      
                //$userObjet = User::find($user->id);
                                   // dd($article);
                     if(!$article->partage)
                     {
                        if(App::environment() === 'production')
                        {
                             $user->notify(new NouvelArticleParMail($article));
         
                        }

                       
                        
                       // $user->givePermissionTo('Cible-Pub');
                        $user->assignRole('Th');

                       
         
                     }

                     //revoquer les permissions ici

                     $user->removeRole('Th');

                    
                }
            }
        }


    // fin si artice partagé
   

    if($article->publie)
    {
       $article->publie = !$article->publie;
    }

   $article->partage = !$article->partage;
   $article->update(['date_publication' => Carbon::now()]);
       // dd($structure_article);

        $article->save();

        return $article;
    }

    public function publicationCible($id)
    {
        $article = Article::find($id);
        $structures = Structure::get();

        $articlesStructures = DB::table("article_structure")->where("article_structure.article_id",$id)
        ->pluck('article_structure.structure_id','article_structure.structure_id')
        ->all();

          return view('admin.articles.publicationCible', compact('article', 'structures', 'articlesStructures'));                      
    }

    public function attacherUnArticleAPlusieursServices(Request $request, $id)
    {
        $this->validate($request, [
            'structures' => 'required',
        ]);

        $article = Article::find($id);
        if($request->input('structures'))
        {
            $article->structures()->sync($request->input('structures'));

            Session::flash('success', 'Attaché avec succès.');


        }


        return redirect()->route('communaute.pratiques');
    }

    public function destroy($id)
    {
        
      $article = Article::find($id);
      $article->delete();

      return '';
    }

    public function supprimerPlusieurs(Request $request)
    {
        if($request->id)
        {
            foreach($request->id as $id)
            {
                Article::destroy($id);
            }
        }

    }

    public function publierPlusieurs(Request $request)
    {
        if($request->id)
        {
            foreach($request->id as $id)
            {
                $article = Article::find($id);
                
        if(!$article->publie)
        {
            $users = User::get();
            foreach($users as $key => $user)
            {
                if(App::environment() === 'production')
                {
                     $user->notify(new NouvelArticleParMail($article));

                }

               // $user->notify(new NouvelArticle($article));


    
            }
        }
       
        $article->date_publication = now();

        $article->publie = !$article->publie;

        if($article->partage)
        {
            $article->partage = !$article->partage;

        }


       


        $article->save();

            }
        }
    }

    public function publierPlusieursDansLesServices(Request $request)
    {
        if($request->id)
        {
            foreach($request->id as $id)
            {
                $article = Article::find($id);

                  // retourne les structures de l'article 
        $structure_articles = $article->structures;


        foreach ($structure_articles as $key => $stArticle) {

            // recupereb les utilisateurs de chaque structure 
            $usersdeLastructure = $stArticle->users;
           // dd($usersdeLastructure);
            if(count($usersdeLastructure))
            {
                //dd($usersdeLastructure);

                foreach($usersdeLastructure as $key => $user)
                {
                      
                //$userObjet = User::find($user->id);
                                   // dd($article);
                     if(!$article->partage)
                     {
                        if(App::environment() === 'production')
                        {
                             $user->notify(new NouvelArticleParMail($article));
         
                        }

                       
                        
                       // $user->givePermissionTo('Cible-Pub');
                        $user->assignRole('Th');

                       
         
                     }

                     //revoquer les permissions ici

                     $user->removeRole('Th');

                    
                }
            }
        }


    // fin si artice partagé
   

    if($article->publie)
    {
       $article->publie = !$article->publie;
    }

   $article->partage = !$article->partage;
   $article->update(['date_publication' => Carbon::now()]);
       // dd($structure_article);

        $article->save();
            }
        }

    }

    public function re($id)
    {
        $arti = Article::find($id);
        $sem = $arti->structures;
        return response()->json($sem);
    }

    /**
     * les commentaires
     */

    public function storeCommentaireSurAffiche(Request $request)
    {
        $this->validate($request, [
            'commentaire' => 'required|min:2',
        ]);
            $comm = new Commentaire;
            $comm->commentaire = $request->get('commentaire');
            $comm->article_id = $request->get('article_id');
            $comm->user_id = Auth::id();
            $comm->save();

        return $comm;
    }

     public function getCommentairesByArticles($idArticle)
     {
       // $article = Article::findOrFAil($idArticle);
        // $commentaires = $article->commentaires();
        $commentaires = Commentaire::where('article_id', $idArticle)
        ->orderBy('id', 'desc')
        ->with('user')
        ->with('article')
        ->get();
         return response()->json($commentaires);
 
     }

     public function showArticle(Article $article)
     {
        //$article = Article::find($id);

       $commentaires = Commentaire::orderBy('id', 'desc')
                                    ->where('article_id', $article->id)
                                    ->get();
        /*
             return response()->json([
                 'article' => $article,
                 'commentaires' => $commentaires
             ]); 
             */
            return view('employes.showArticle', compact('article', 'commentaires'));                      

     }

     public function lesArticlesPerso()
     {
         $lesArticlesPerso = Article::where('user_id', Auth::user()->id)
         ->orderBy('id', 'desc')
         ->with('user')
         ->get();

         return $lesArticlesPerso;
     }
}

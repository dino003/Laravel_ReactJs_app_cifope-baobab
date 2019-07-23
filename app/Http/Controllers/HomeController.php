<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $articles = Article::orderBy('id', 'desc')
                            ->where('publie', 1)
                            ->get();

             $permissionAverifier = Permission::pluck('name','name')->all();

         if(Auth::user()->hasAnyPermission($permissionAverifier))
         {
            return view('employes.profil', compact('articles'));                
         }
         else{
                return view('employes.aucunAcces');                

         }

    }

    public function accueil()
    {
        $articles = Article::orderBy('id', 'desc')
                            ->where('publie', 1)
                            ->get();

             $permissionAverifier = Permission::pluck('name','name')->all();

         if(Auth::user()->hasAnyPermission($permissionAverifier))
         {
            return view('employes.profil', compact('articles'));                
         }
         else{
                return view('employes.aucunAcces');                

         }
 
    }
}

<?php

namespace App\Http\Controllers;

use App\Mesvideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MesvideoController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
      
    }
   
   public function index(){
       $video=Mesvideo::where('user_id',Auth::user()->id)->get();
   	return view('mesvideos.index',compact('video'));
   }

   public function store(Request $request){
       $this->validate($request, [
           'titre_lien' => 'required',
           'url' => 'required'
       ]);

       $mesvideo=new Mesvideo();
       $mesvideo->titre_lien=$request->input('titre_lien');
       $mesvideo->url=$request->input('url');
       $mesvideo->user_id=Auth::user()->id;
       $mesvideo->save();

       Session::flash('success', 'Ajout effectué ');

       return back();
   }

   public function update(Request $request){
       $this->validate($request, [
           'titre_lien' => 'required',
           'url' => 'required'
       ]);
       $mesvideo=Mesvideo::find($request->input('id'));
       $mesvideo->titre_lien=$request->input('titre_lien');
       $mesvideo->url=$request->input('url');
       $mesvideo->user_id=Auth::user()->id;
       $mesvideo->save();
       Session::flash('success', 'Modification effectuer ');

       return back();
   }
   public function delete($id)
   {
       Mesvideo::destroy($id);
       Session::flash('success', 'Suppression effectuer ');

       return back();

   }
}

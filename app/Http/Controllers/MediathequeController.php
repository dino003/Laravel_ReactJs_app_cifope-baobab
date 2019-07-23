<?php

namespace App\Http\Controllers;

use App\Mediatheque;
use App\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MediathequeController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
      
    }
    
    public function ListePhoto(){
       $photos=Mediatheque::where('type','photo')->orderBy('created_at','desc')->paginate(20);
   	$depert=Structure::orderby('nom_structure')->get();
   	return view('admin.mediatheque.gestionphoto',compact('depert','photos'));
   }


public function ListeVideo(){
       $video=Mediatheque::where('type','video')->orderBy('created_at','desc')->paginate(20);
    $depert=Structure::orderby('nom_structure')->get();
    return view('admin.mediatheque.gestionvideo',compact('depert','video'));
   }

    public function store(Request $request){

        $this->validate($request, [
            'titre' => 'required|max:191',

            'type_fichier' => 'required|max:191'
        ]);

        $mediatheque=new Mediatheque();

        if ($request->hasFile('fichier')){
            //recuperation du nom de fichier
            $fullName=$request->file('fichier')->getClientOriginalName();
//recuperation du nom san l'extention
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            //Recuperation de l'extension
            $extension=$request->file('fichier')->getClientOriginalExtension();
            //creation du nom unique pour l'image
            $nameTosore=$name.'_'.time().'.'.$extension;
            $destination= public_path('/uploads/mediatheque/');
            $path=$request->file('fichier')->move($destination, $nameTosore);

        }
        else{
            $nameTosore=$request->input('lien');
        }


        $mediatheque->titre=$request->input('titre');
        $mediatheque->nom_media=$nameTosore;
        $mediatheque->type=$request->input('type_fichier');
        $mediatheque->structure_id=$request->input('structure_id');
        $mediatheque->save();
        Session::flash('success','Fichier ajouter !');

        return  back();
    }

    public function delete($id){
        $mediat=Mediatheque::find($id);
        if ($mediat->type=='photo'){
            $chemin= public_path('/uploads/mediatheque/');
            $doc=$chemin.''.$mediat->nom_media;
            if (file_exists ( $doc)){
                unlink($doc);
                Mediatheque::destroy($id);
            }
        }else{
            Mediatheque::destroy($id);
        }

        Session::flash("success","Document supprimer");
        return  back();
    }


 public function update(Request $request){

        $this->validate($request, [
            'titre' => 'required|max:191',

            'type_fichier' => 'required|max:191'
        ]);



        if ($request->hasFile('fichier')){
            //recuperation du nom de fichier
            $fullName=$request->file('fichier')->getClientOriginalName();
//recuperation du nom san l'extention
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            //Recuperation de l'extension
            $extension=$request->file('fichier')->getClientOriginalExtension();
            //creation du nom unique pour l'image
            $nameTosore=$name.'_'.time().'.'.$extension;
            $destination= public_path('/uploads/mediatheque/');
            $path=$request->file('fichier')->move($destination, $nameTosore);

        }
        else{
            $nameTosore=$request->input('lien');
        }

        $mediatheque=Mediatheque::find($request->input('id'));
        $mediatheque->titre=$request->input('titre');
        $mediatheque->nom_media=$nameTosore;
        $mediatheque->type=$request->input('type_fichier');
        $mediatheque->structure_id=$request->input('structure_id');
        $mediatheque->save();
        Session::flash('success','Modification effectuer !');

        return  back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class DossierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }

    public function store(Request $request){
        $this->validate($request, [
            'nom_dossier' => 'required'
        ]);

        foreach ($request->input('nom_dossier') as $value) {
            $dossier=new Dossier();
            $dossier->nom_dossier=$value;
            $dossier->structure_id=$request->input('structure_id');
            $dossier->user_id=Auth::user()->id;
            $dossier->save();
        }

        Session::flash('success', 'Ajout effectué ');

        return back();
    }


    public function AddSousDossier(Request $request){
        $this->validate($request, [
            'nom_dossier' => 'required'
        ]);

        foreach ($request->input('nom_dossier') as $value) {
            $dossier=new Dossier();
            $dossier->nom_dossier=$value;
            $dossier->structure_id=$request->input('structure_id');
            $dossier->dossier_id=$request->input('dossier_id');
            $dossier->user_id=Auth::user()->id;
            $dossier->save();
        }

        Session::flash('success', 'Ajout effectué ');

        return back();
    }

    public function update(Request $request){
        $this->validate($request, [
            'nom_dossier' => 'required'
        ]);


        $dossier= Dossier::find($request->input('id'));
        $dossier->nom_dossier=$request->input('nom_dossier');
        $dossier->save();


        Session::flash('success', 'Modification effectué ');

        return back();
    }

    public function deleteDossier($id){
        Dossier::destroy($id);
        Session::flash('success', 'Suppression effectué ');

        return back();
    }

}

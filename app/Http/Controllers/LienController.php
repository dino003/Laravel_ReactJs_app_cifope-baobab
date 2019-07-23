<?php

namespace App\Http\Controllers;

use App\Lien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LienController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function store(Request $request){



        $this->validate($request, [
            'titre_lien' => 'required|max:100',
            'url'=>'required'

        ]);

        $lien=new Lien();
        $lien->titre_lien=$request->input('titre_lien');
        $lien->url=$request->input('url');
        $lien->structure_id=$request->input('structure_id');
        $lien->user_id=Auth::user()->id;
        $lien->save();

        Session::flash('success','Ajout de lien effectué');
        return  back();
    }

    public function update(Request $request){

        $this->validate($request, [
            'titre_lien' => 'required|max:100',
            'url'=>'required'

        ]);

        DB::table('liens')
            ->where('id',$request->input('id'))
            ->update([
                'titre_lien'=>$request->input('titre_lien'),
                'url'=>$request->input('url')
            ]);

        Session::flash('success','Modification de lien effectuée');
        return  back();
    }


    public function delete($id){

        Lien::destroy($id);
        Session::flash('success','Suppression de lien effectuée');
        return  back();
    }
}

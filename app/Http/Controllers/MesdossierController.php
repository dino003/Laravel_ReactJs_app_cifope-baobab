<?php

namespace App\Http\Controllers;

use App\Mesdocument;
use App\Mesdossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
class MesdossierController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
      
    }
    
    public function index(){
        $mesdossier=Mesdossier::whereNull('mesdossier_id')->where('user_id',Auth::user()->id)->orderby('nom_dossier')->get();
        return view('mesdossiers.index',compact('mesdossier'));
    }

    public function store(Request $request){

        $this->validate($request, [
            'nom_dossier' => 'required'
        ]);

        foreach ($request->input('nom_dossier') as $value) {
            $dossier=new Mesdossier();
            $dossier->nom_dossier=$value;
            $dossier->user_id=Auth::user()->id;
            $dossier->save();
        }

        Session::flash('success', 'Ajout effectué ');

        return back();
    }

    public function AddSousMondossier(Request $request){

        $this->validate($request, [
            'nom_dossier' => 'required'
        ]);

        foreach ($request->input('nom_dossier') as $value) {
            $dossier=new Mesdossier();
            $dossier->nom_dossier=$value;
            $dossier->user_id=Auth::user()->id;
            $dossier->mesdossier_id=$request->input('mesdossier_id');
            $dossier->save();
        }

        Session::flash('success', 'Ajout effectué ');

        return back();
    }

    public function show($id){
         $id=Crypt::decrypt($id);
        $dossier=Mesdossier::find($id);
        $sousdossier=Mesdossier::where('mesdossier_id',$id)->orderby('nom_dossier')->get();
        $document=Mesdocument::where('mesdossier_id',$id)->orderby('nom_document')->get();
        return view('mesdossiers.show',compact('dossier','sousdossier','document'));
    }
    public function update(Request $request){
        $this->validate($request, [
            'nom_dossier' => 'required'
        ]);
        $dossier=Mesdossier::find($request->input('id'));
        $dossier->nom_dossier=$request->input('nom_dossier');
        $dossier->save();

        Session::flash('success', 'Modification effectuer ');

        return back();
    }

    public function delete($id){
        Mesdossier::destroy($id);
        Session::flash('success', 'Dossier supprimer ');

        return back();
    }

     public function treeViewMesDossier(){

      $dossier=Mesdossier::where('user_id',Auth::user()->id)->get();
      //DB::select('select * from mesdossiers where user_id='.Auth::user()->id);
      //spriteCssClass: "rootfolder"
      foreach ($dossier as $key => $value) {
        $param=Crypt::encrypt($value->id);
        $url=url('DetailMonDossier',$param);
 $img="<img src='".asset('assets/icone/icone-dossier.png')."' width='15'>";
        $sub_data['id']=$value->id;
        $sub_data['name']=$value->nom_dossier;
        $sub_data['text']=$img.''.$value->nom_dossier;
        $sub_data['selectable']="true";
        //$sub_data['state']['expanded']="false";
      //  $sub_data['state']['disabled']="true";
        //$sub_data['state']['checked']="false";
        //$sub_data['state']['selected']="true";

       $sub_data['href']=$url;
        $sub_data['mesdossier_id']=$value->mesdossier_id;
        $data[]=$sub_data;

      }
     // dd($data);
      foreach ($data as $key => &$value)
       {
        $output[$value['id']]=&$value;
      }
 foreach ($data as $key => &$value) {
 
   if($value['mesdossier_id'] && isset($output[$value["mesdossier_id"]])){

    $output[$value['mesdossier_id']]["nodes"][]= &$value;

   }

 }
    foreach ($data as $key => &$value) {
     
if($value['mesdossier_id'] && isset($output[$value["mesdossier_id"]])){

   unset($data[$key]);

   }

    }
 return response()->json($data);
    //return json_encode($data);
      /*//echo '<pre>';
      print_r($data);
      echo '</pre>';*/
    }
}

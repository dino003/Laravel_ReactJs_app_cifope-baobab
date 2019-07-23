<?php

namespace App\Http\Controllers;

use App\Document;
use App\Dossier;
use App\Lien;
use App\User;
use App\Structure;
use App\Interviens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Documentservice;
use App\Repository\Repository;
class StructureController extends Controller
{

   public function __construct(Repository $repository)
    {
        $this->middleware('auth');
          $this->r=$repository;
      
    }
    
   public function index(){

    //$structure=DB::select('SELECT id, nom_structure, getpath(id) AS path FROM structures ');

       $structure=Structure::orderby('nom_structure')->get();
    //dd($structure);
       $structure10=Structure::all();
       $nbr_structure=Structure::count();
        
       return view('admin.structure.index',compact('structure','nbr_structure','$structure10'));
   }

   public function store(Request $request){
       $this->validate($request, [
           'nom_structure' => 'required'
       ]);

  foreach ($request->input('nom_structure') as $value) {
      $structue=new Structure();
    $structue->nom_structure=$value;
    $structue->save();
  }

       Session::flash('success', 'Ajout effectué ');

       return back();
   }


public function StoreSousStructure(Request $request){
  $this->validate($request, [
           'nom_structure' => 'required',
            'structure_id' => 'required'
       ]);

$i=0;
$nom_structure=$request->input('nom_structure');
$structure_id=$request->input('structure_id');

for ($i=0; $i <count($request->input('nom_structure')) ; $i++) { 
   
   if (count($request->input('structure_id'))==1) {
  $structue=new Structure();
    $structue->nom_structure=$nom_structure[$i];
     $structue->structure_id=$structure_id[0];
    $structue->save();
   } else {
    $structue=new Structure();
    $structue->nom_structure=$nom_structure[$i];
     $structue->structure_id=$structure_id[$i];
    $structue->save();
   }
   
     
 
}

Session::flash('success', 'Ajoute de sous structure effectué ');

        return back();

}
    public function update(Request $request){
        $this->validate($request, [
            'nom_structure' => 'required'
        ]);


            $structue= Structure::find($request->input('id'));
            $structue->nom_structure=$request->input('nom_structure');
            $structue->save();


        Session::flash('success', 'Modification effectué ');

        return back();
    }

    public function show($id){
      $id=Crypt::decrypt($id);
     $structure=Structure::find($id);
      $personnel=Interviens::where('structure_id',$id)->get();
   







  $user=[];
      foreach($personnel as $value) {
        $user[]=$value->id;
      }
      $pernonnel_non_affecter=DB::table('users')->join('interviens','interviens.user_id','=','users.id')->join('structures','structures.id','=','interviens.structure_id')->whereNotIn('users.id', $user)->where('interviens.structure_id','!=',$id)->orderby('name')->get();
      //$personnel=Interviens::join('users','users.id','=','interviens.user_id')->where('structure_id',$id)->get();
      $SousStructure=Structure::where('structure_id',$id)->orderby('nom_structure')->paginate(20);
      $dossier=Dossier::where('structure_id',$id)->whereNull('dossier_id')->orderby('nom_dossier')->paginate(20);
        $lien=Lien::where('structure_id',$id)->orderBy('id','DESC')->paginate(20);

  $document=Documentservice::where('structure_id',$id)->where('genres_document','tous_le_service')->whereNull('dossier_id')->get();
      return view('admin.structure.show',compact('structure','dossier','SousStructure','lien','personnel','pernonnel_non_affecter','document'));
    }


    public function showdossier($id,$structure){
        $id=Crypt::decrypt($id);
          $structure=Crypt::decrypt($structure);
  $structure=Structure::find($structure);
      $SousStructure=Structure::where('structure_id',$structure->id)->orderby('nom_structure')->paginate(20);
 $personnel=Interviens::where('structure_id',$id)->get();
 $user=[];
      foreach($personnel as $value) {
        $user[]=$value->id;
      }
     $pernonnel_non_affecter=DB::table('users')->join('interviens','interviens.user_id','=','users.id')->join('structures','structures.id','=','interviens.structure_id')->whereNotIn('users.id', $user)->where('interviens.structure_id','!=',$id)->orderby('name')->get();
     
        $lien=Lien::where('structure_id',$structure->id)->orderBy('id','DESC')->paginate(20);
      $dossier=Dossier::where('structure_id',$structure->id)->orderby('nom_dossier')->paginate(20);
      $Detaildossier=Dossier::find($id);
       $sousdossier=Dossier::where('dossier_id',$id)->orderby('nom_dossier')->paginate(20);
        $document=Documentservice::where('dossier_id',$id)->where('structure_id',$structure->id)->orderby('id','desc')->get();
      return view('admin.structure.show',compact('structure','dossier','SousStructure','sousdossier','Detaildossier','lien','document','personnel','pernonnel_non_affecter'));
    }


    public function deleteStructure($id){
        Structure::destroy($id);
        Session::flash('success', 'Suppression effectué ');

        return back();
    }

    public function treeViewStructure(){

      $structure=DB::select('select * from structures');
      
      foreach ($structure as $key => $value) {
        $param=Crypt::encrypt($value->id);
        $url=url('DetailStructure',$param);
        $img="<img src='".asset('assets/img/icone.png')."' width='15'>";

        $sub_data['id']=$value->id;
        $sub_data['name']=$value->nom_structure;
        $sub_data['text']=$img.' '.$value->nom_structure;
        $sub_data['href']=$url;
        $sub_data['structure_id']=$value->structure_id;
        $data[]=$sub_data;

      }
     // dd($data);

      foreach ($data as $key => &$value) {
        $output[$value['id']]=&$value;
      }
 foreach ($data as $key => &$value) {
 
   if($value['structure_id'] && isset($output[$value["structure_id"]])){

    $output[$value['structure_id']]["nodes"][]= &$value;

   }

 }
    foreach ($data as $key => &$value) {
     
if($value['structure_id'] && isset($output[$value["structure_id"]])){

   unset($data[$key]);

   }

    }
 return response()->json($data);
    //return json_encode($data);
      /*//echo '<pre>';
      print_r($data);
      echo '</pre>';*/
    }


    public function CapaciteStokage($id){
     
    $doss=Dossier::where('structure_id',$id)->get();
  //  dd($doss);
    $table_dossier = [];
    foreach($doss as $va) {
      $table_dossier[]=$va->id;

    }
    $sum1=Document::whereIn('dossier_id',$table_dossier)->sum('doc_size');
    $sum2=Documentservice::where('structure_id',$id)->sum('doc_size');
    $total=$sum1 + $sum2;
   $size=$this->r->formatBytes($total);
  
   $view=view('progressBar.progress',compact('size','total'))->render();
    //dd($view);
   return response()->json($view);
    }



    
}

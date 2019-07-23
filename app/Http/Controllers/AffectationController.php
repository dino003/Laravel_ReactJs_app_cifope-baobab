<?php

namespace App\Http\Controllers;

use App\Interviens;
use Illuminate\Http\Request;
use App\User;
use App\Structure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Documentservice;
class AffectationController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function AffectationEmploye(){
        $users= User::orderBy('name')
        ->where('active', '=', '1')
        ->get();
          $structure=Structure::orderby('nom_structure')->get();

    	return view('admin.affectation.employe_affectation',compact('users','structure'));
    }


public function AffectationDocument(){
   $structure=Structure::orderby('nom_structure')->get();
        return view('admin.affectation.document_affectation',compact('structure')); 
} 
    public function AddAffectationEmploye(Request $request){
    	$this->validate($request, [
            'users' => 'required',
             'structure' => 'required'
        ]);

$chef=$request->input('chef');
//dd($chef);
$ajoutfichier=$request->input('ajoutfichier');
$visualisation=$request->input('visualisation');
$user=$request->input('users');
$i=0;


         foreach ($request->input('structure') as $value) {

for ($i=0; $i < count($request->input('users')) ; $i++) { 
  
 $nbr=Interviens::where('structure_id',$value)->where('user_id',$user[$i])->count();

 if ($nbr==0) {
  if ($chef==$user[$i]) {
   $le_chef=1;
   $ajout=1;
   $visuel=1;
   $chef="";
   }
 else {
$le_chef=0;
if (!empty($request->input('ajoutfichier'))) {
 /*for ($j=0; $j <count($ajoutfichier) ; $j++) { 
      if ($ajoutfichier[$j]==$user[$i]) {
       $ajout=1;
      }else{
        $ajout=0;
      }
    }*/

    if (in_array($user[$i], $ajoutfichier)) {
      $ajout=1;
    }
    else{
      $ajout=0;
    }
}else{ 
$ajout=0;
}

if (!empty($request->input('visualisation'))) {
 /*for ($k=0; $k <count($visualisation) ; $k++) { 
     if ($visualisation[$k]==$user[$i]) {
       $visuel=1;
     }else{
      $visuel=0;
     }
   }*/
   if (in_array($user[$i], $visualisation)) {
     $visuel=1;
   }
   else{
    $visuel=0;
   }
}else{
  $visuel=0;
}
    
   
   


   }

   $instervien=new Interviens;
   $instervien->user_id=$user[$i];
   $instervien->structure_id=$value;
   $instervien->chef=$le_chef;
   $instervien->ajout=$ajout;
   $instervien->visualise=$visuel;

    // autre affectation 
    $userA = User::where('id', $user[$i])->firstOrFail();
    $structureA = Structure::where('id', $value)->firstOrFail();
    $userA->structures()->attach($structureA);
 
 
    // fin autre affectation
   $instervien->save();
 }
  


 }

}

       Session::flash('success','Affectation effectuée');
        return  back();
}

    public function affeter(Request $request){
  
$nbr=Interviens::where('structure_id',$request->get('Structure'))->where('user_id',$request->get('employe'))->count();
if ($nbr==0) {
   $intervention=new Interviens();
                 $intervention->user_id=$request->get('employe');
                 $intervention->structure_id=$request->get('Structure');
                 $intervention->save();
}
$users=User::find($request->get('employe'));
$str=Structure::find($request->get('Structure'));
         $data =array(
            'name_user'=>$users->name,
            'prenom_user'=>$users->prenom,
            'nom_structure'=>$str->nom_structure
          );
          return Response($data);
    }

    public function RetireEmployeAjax(Request $request){
        Interviens::destroy($request->get('inetrviens'));
          return Response('Employe retire');
    }


     public function treeViewStructureAffectation(){

      $structure=DB::select('select * from structures');
      
      foreach ($structure as $key => $value) {
        $param=Crypt::encrypt($value->id);
        $url=url('DetailStructure',$param);
        $checked='<input type="checkbox" name="structure_id[]"  value="'.$value->id.'" style="width : 1em ; 
   height : 1em ; " >';
        $sub_data['id']=$value->id;
        $sub_data['name']=$value->nom_structure;
        $sub_data['text']=$value->nom_structure;
        $sub_data['checked']='';
       // $sub_data['href']=$url;
        $sub_data['structure_id']=$value->structure_id;
        $data[]=$sub_data;

      }
     // dd($data);

      foreach ($data as $key => &$value) {
        $output[$value['id']]=&$value;
      }
 foreach ($data as $key => &$value) {
 
   if($value['structure_id'] && isset($output[$value["structure_id"]])){

    $output[$value['structure_id']]["items"][]= &$value;

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


    public function FormulairGliserDeposer(Request $request){
    $structure=Structure::find($request->get('id'));
  $document=Documentservice::where('structure_id',$request->get('id'))->where('genres_document','tous_le_service')->get();
$output=view('admin.affectation.GliserDeposer',compact('document','structure'))->render();

           $data =array(
            'table_data'=>$output
            
          );
             return response($data);
}
}

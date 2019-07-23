<?php

namespace App\Http\Controllers;

use App\Document;
use App\Dossier;
use App\Interviens;
use App\Lien;
use App\Structure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Documentservice;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
class InterviensController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
      
    }
    public function index(){
            
        $messtructure=Interviens::where('user_id',Auth::user()->id)->get();
        return view('interviens.index',compact('messtructure'));
    }

    public function show($id){
         $id=Crypt::decrypt($id);

        $structure=Structure::find($id);
       
    $personnel1=Interviens::where('structure_id',$id)->where('user_id',Auth::user()->id)->get();
    //dd($personnel);
    foreach ($personnel1 as  $value) {
    $role=Interviens::find($value->id);
    }

    $personnel=Interviens::where('structure_id',$id)->where('user_id','!=',Auth::user()->id)->get();
     //$role=Interviens::find($value->id);
   // dd($role);
        //$personnel=Interviens::join('users','users.id','=','interviens.user_id')->where('structure_id',$id)->get();
        //$SousStructure=Structure::where('structure_id',$id)->orderby('nom_structure')->paginate(20);
$document=Documentservice::where('structure_id',$id)->where('genres_document','tous_le_service')->whereNull('dossier_id')->get();
        $dossier=Dossier::where('structure_id',$id)->whereNull('dossier_id')->orderby('nom_dossier')->paginate(20);
$documentenvoye=Documentservice::where('structure_id',$id)->where('user_id',Auth::user()->id)->where('genres_document','au_cherf')->get();


        $lien=Lien::where('structure_id',$id)->orderBy('id','DESC')->paginate(20);
        $service="service";
         $document_chef=Documentservice::where('structure_id',$structure->id)->where('genres_document','au_cherf')->get();
        return view('interviens.show',compact('structure','dossier','lien','personnel','service','document','role','documentenvoye','document_chef'));
    }


    public function showdossier($id,$structure){

            $id=Crypt::decrypt($id);
                $structure=Crypt::decrypt($structure);
        $structure=Structure::find($structure);
        //$SousStructure=Structure::where('structure_id',$structure->id)->orderby('nom_structure')->paginate(20);
       $personnel1=Interviens::where('structure_id',$structure->id)->where('user_id',Auth::user()->id)->get();
    //dd($personnel);
    foreach ($personnel1 as  $value) {
    $role=Interviens::find($value->id);
    }
   $personnel=Interviens::where('structure_id',$id)->where('user_id','!=',Auth::user()->id)->get();
        $lien=Lien::where('structure_id',$structure->id)->orderBy('id','DESC')->paginate(20);
        $dossier=Dossier::where('structure_id',$structure->id)->orderby('nom_dossier')->paginate(20);
        $Detaildossier=Dossier::find($id);
        $sousdossier=Dossier::where('dossier_id',$id)->orderby('nom_dossier')->paginate(20);
        $document=Documentservice::where('dossier_id',$id)->where('structure_id',$structure->id)->orderby('nom_document')->get();
         $service="service";

         $documentenvoye=Documentservice::where('structure_id',$structure->id)->where('user_id',Auth::user()->id)->where('genres_document','au_cherf')->get();
 $document_chef=Documentservice::where('structure_id',$structure->id)->where('genres_document','au_cherf')->get();

        return view('interviens.show',compact('structure','dossier','sousdossier','Detaildossier','lien','document','personnel','service','role','documentenvoye','document_chef'));
    }

public function ajout($option,$id){
    $id=Crypt::decrypt($id);
    $option=Crypt::decrypt($option);
    $intervien=Interviens::find($id);

    $intervien->ajout=$option;
    $intervien->save();

    Session::flash('success', 'Mis a jour ');
    return back();
}


public function visualise($option,$id){
      $id=Crypt::decrypt($id);
    $option=Crypt::decrypt($option);
    $intervien=Interviens::find($id);

    $intervien->visualise=$option;
    $intervien->save();

    Session::flash('success', 'Mis a jour ');
    return back();
}

public function responsable($option,$id){

  $id=Crypt::decrypt($id);
    $option=Crypt::decrypt($option);
    $intervien=Interviens::find($id);
     $personnel=Interviens::where('structure_id',$intervien->structure_id)->where('user_id','!=',$intervien->user_id)->get();
     //dd($personnel);
    if ($option==1) {
  $intervien->ajout=$option;
     $intervien->visualise=$option;
    } 
     $intervien->chef=$option;
    $intervien->save();

    // $personnel=Interviens::where('structure_id',$id)->where('user_id','!=',$option)->get();
foreach ($personnel as $value) {
      $intervien=Interviens::find($value->id);
      $intervien->chef=0;
    $intervien->save();
}
   

    Session::flash('success', 'Mis a jour ');
    return back();


}

public function rechercheDoc(Request $request){

   if($request->ajax())
        {
           
 $query = $request->get('query');
  $strUser=Interviens::where('user_id',Auth::user()->id)->where('visualise',1)->get();
        
      $table = [];
    foreach($strUser as $va) {
      $table[]=$va->structure_id;

    }

     if ($query!='') {
        //$val10=1;
        $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->where('nom_document','like','%'.$query.'%')->get();

        if (count($document)==0) {
        
      $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$query.'%')->get();
        }


 $val10 = view('interviens.rechercheDoc',compact('document','val10','query'))->render();
     } else {
     
      $val10='';


     }
     

            $data =array(
                'table_data'=>$val10
            );

            return Response($data);

        }
  
}

public function RechercheMultipleCritere(Request $request){

  $strUser=Interviens::where('user_id',Auth::user()->id)->where('visualise',1)->get();
     // dd($strUser);  
      $table = [];
    foreach($strUser as $va) {
      $table[]=$va->structure_id;

    }
  $query="";
$nom_document=$request->input('nom_document');
$auteur=$request->input('auteur');
$type=$request->input('type');
$date_debut=$request->input('date_debut');
$date_fin=$request->input('date_fin');

//************************************debut conbinaison sur le nom du document**********************//
// nom du document
if (!empty($nom_document) AND empty($auteur) AND empty($type) AND empty($date_debut) AND empty($date_fin)) {

 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->where('nom_document','like','%'.$nom_document.'%')->get();
}

///nom du document + l'auteur


if (!empty($nom_document) AND !empty($auteur) AND empty($type) AND empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('nom_document','like','%'.$nom_document.'%')->get();
}

//recherche nom document + type fichier

if (!empty($nom_document) AND empty($auteur) AND !empty($type) AND empty($date_debut) AND empty($date_fin)) {
 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->where('icone','like','%'.$type.'%')->where('nom_document','like','%'.$nom_document.'%')->get();
}
//nom du document + la date
if (!empty($nom_document) AND empty($auteur) AND empty($type) AND !empty($date_debut) AND empty($date_fin)) {
 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->where('date_ajout',$date_debut)->where('nom_document','like','%'.$nom_document.'%')->get();
    }


//nom document + date1 + date2
if (!empty($nom_document) AND empty($auteur) AND empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->whereBetween('date_ajout',array($date_debut,$date_fin))->where('nom_document','like','%'.$nom_document.'%')->get();

   }

//nom document + auteur + type
if (!empty($nom_document) AND !empty($auteur) AND !empty($type) AND empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('nom_document','like','%'.$nom_document.'%')->where('icone','like','%'.$type.'%')->get();
}

//nom document + auteur + date
if (!empty($nom_document) AND !empty($auteur) AND empty($type) AND !empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('nom_document','like','%'.$nom_document.'%')->where('date_ajout',$date_debut)->get();
}

//nom document + auteur + date1 + date
if (!empty($nom_document) AND !empty($auteur) AND empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('nom_document','like','%'.$nom_document.'%')->whereBetween('date_ajout',array($date_debut,$date_fin))->get();
}


//nom document + type + date
if (!empty($nom_document) AND empty($auteur) AND !empty($type) AND !empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->where('icone','like','%'.$type.'%')->where('nom_document','like','%'.$nom_document.'%')->where('date_ajout',$date_debut)->get();
}


//nom document + type + date1 + date

if (!empty($nom_document) AND empty($auteur) AND !empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->where('icone','like','%'.$type.'%')->where('nom_document','like','%'.$nom_document.'%')->whereBetween('date_ajout',array($date_debut,$date_fin))->get();
}

//nom+type+auteur+date1+date
if (!empty($nom_document) AND !empty($auteur) AND !empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('nom_document','like','%'.$nom_document.'%')->where('icone','like','%'.$type.'%')->whereBetween('date_ajout',array($date_debut,$date_fin))->get();
}

//nom document + type + date+auteur
if (!empty($nom_document) AND !empty($auteur) AND !empty($type) AND !empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->where('icone','like','%'.$type.'%')->where('nom_document','like','%'.$nom_document.'%')->where('date_ajout',$date_debut)->Where('users.name','like','%'.$auteur.'%')->get();
}

//************************************Fin conbinaison sur le nom du document**********************//





//********************************Conbinaison sur l'auteur du document********////
//auteur

if (empty($nom_document) AND !empty($auteur) AND empty($type) AND empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->get();
}

//auteur + type

if (empty($nom_document) AND !empty($auteur) AND !empty($type) AND empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('icone','like','%'.$type.'%')->get();
}


//auteur + date
if (empty($nom_document) AND !empty($auteur) AND empty($type) AND !empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('date_ajout',$date_debut)->get();
}



//auteur + date1 + date2
if (empty($nom_document) AND !empty($auteur) AND empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->whereBetween('date_ajout',array($date_debut,$date_fin))->get();
}


//auteur + type + date
if (empty($nom_document) AND !empty($auteur) AND !empty($type) AND !empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->where('date_ajout',$date_debut)->where('icone','like','%'.$type.'%')->get();
}

//auteur + type + date1 + date 2

if (empty($nom_document) AND !empty($auteur) AND !empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->Where('users.name','like','%'.$auteur.'%')->whereBetween('date_ajout',array($date_debut,$date_fin))->where('icone','like','%'.$type.'%')->get();
}
//****************Fin conbinaison****/////



//***********************Combinaison sur le type
//type
if (empty($nom_document) AND empty($auteur) AND !empty($type) AND empty($date_debut) AND empty($date_fin)) {
 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->where('icone','like','%'.$type.'%')->get();
}

//type +date
if (empty($nom_document) AND empty($auteur) AND !empty($type) AND !empty($date_debut) AND empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->where('date_ajout',$date_debut)->where('icone','like','%'.$type.'%')->get();
}

//type +date1 +date 2

if (empty($nom_document) AND empty($auteur) AND !empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
  $document=Documentservice::whereIn('structure_id',$table)->join('users','users.id','=','documentservices.user_id')->where('genres_document','tous_le_service')->whereBetween('date_ajout',array($date_debut,$date_fin))->where('icone','like','%'.$type.'%')->get();
}

//fin conbinaison

//date uniquement
if (empty($nom_document) AND empty($auteur) AND empty($type) AND !empty($date_debut) AND empty($date_fin)) {
 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->where('date_ajout',$date_debut)->get();
    }

//date1 + date 2
if (empty($nom_document) AND empty($auteur) AND empty($type) AND !empty($date_debut) AND !empty($date_fin)) {
 $document=Documentservice::whereIn('structure_id',$table)->where('genres_document','tous_le_service')->whereBetween('date_ajout',array($date_debut,$date_fin))->get();

   }




 $val10 = view('interviens.rechercheDoc',compact('document','val10','query'))->render();
    $data =array(
                'table_data'=>$val10
            );

          return Response($data);
}

    
}

<?php

namespace App\Http\Controllers;

use App\Document;
use App\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Interviens;
use App\Documentservice;
use App\Repository\Repository;
use App\User;
use App\Structure;
class DocumentController extends Controller
{
  public function __construct(Repository $repository)
    {
        $this->r=$repository;
        $this->middleware('auth');
    }

public function DocumentUser(){
  $user=Interviens::where('user_id',Auth::user()->id)->get();
  $user_id=[];
  $struture_id=[];
  foreach ($user as  $value) {
   $user_id[]=$value->user_id;
   $struture_id[]=$value->structure_id;
  }
  $dossier=Dossier::whereIn('structure_id',$struture_id)->get();
  $id_dossier=[];
  foreach ($dossier as  $row) {
    $id_dossier[]=$row->id;
  }
  $document=Documentservice::whereIn('structure_id',$struture_id)->get();

  return view('document.index',compact('document'));
}

    public function ListeDocumentAjax(Request $request){


        if ($request->ajax())
        {
            $query = $request->get('query');
            $document=Document::where('dossier_id',$query)->orderby('id','DESC')->paginate(20);
            $output=view('admin.include.structure.listeDocumentAjax',compact('document','query'))->render();

            $data =array(
                'table_data'=>$output,

            );

            return Response($data);

        }
    }



public function AddDocument(Request $request){
  $this->validate($request,[

            
            'file'=>'required'

        ]);
//dd($_FILES);
  $i=0;
        //$type=$_FILES['file']['type'];
if($request->hasfile('file'))
         {
      foreach ($request->file('file') as $fichier) {
 $extensionWord=array('doc','dot','docx','dotx',"docm");
$excelExtension=array("xlsx","xlsm","xlsb","xltx","xltm","xls","xlt","xls","xml","xlam","xla","xlw","xlr");

$PowerExtension=array("pptx","pptm", "ppsm", "ppt","potx","potm","pot","ppsx","pps","ppam","ppa");
$AccesExtension = array('mde','accde','adp','accdp','accdr' );
$OneNoteExtension = array('one','onepkg');
$VisioExtension = array('vsd','vst','vsdm');
$ProjetExtension = array('mpt','mpp');
$PublisheExtension = array('pub');
$PdfExtension = array('pdf');
$CompresseExtension = array('rar','zip');

  $name=pathinfo($fichier->getClientOriginalName(),PATHINFO_FILENAME);
   $extension=$fichier->getClientOriginalExtension();
     //verification d'extention
                   if (in_array($extension, $CompresseExtension)) {
                    $icone='zip.png';
                     $type_document="Archive winrar zip";
                   }

                   if (in_array($extension, $PdfExtension)) {
                    $icone='pdf.png';
                     $type_document="Adobe Acrobat Document";
                   }

                   if (in_array($extension, $extensionWord) ) {
                    $icone='DOCX.ico';
                     $type_document="Document Microsoft Word";
                   }

                   if (in_array($extension, $excelExtension) ) {
                    $icone='Excel.png';
                     $type_document="Document Microsoft Excel";
                   }
                   if (in_array($extension, $PowerExtension) ) {
                    $icone='point.png';
                    $type_document="Document Microsoft PowerPoint";
                   }
                   if (in_array($extension, $AccesExtension) ) {
                    $icone='access.png';
                    $type_document="Document Microsoft Access";
                   }
                    if (in_array($extension, $OneNoteExtension) ) {
                    $icone='onenote.png';
                    $type_document="Document Microsoft OneNote";
                   }
                   if (in_array($extension, $VisioExtension) ) {
                    $icone='visio.png';
                    $type_document="Document Microsoft Visio";
                   }
                   if (in_array($extension, $ProjetExtension) ) {
                    $icone='projet.png';
                    $type_document="Document Microsoft MS Projet";
                   }
                   if (in_array($extension, $PublisheExtension) ) {
                    $icone='publishi.png';
                    $type_document="Document Microsoft Publisher";
                   }

 $type=$_FILES['file']['type'][$i];
$taille=$this->r->FileGetSize($fichier->getSize(),true,true);
$size=$fichier->getSize();

  if (isset($icone))
              {

              $nameTosore=$name.'_'.time().'.'.$extension;
                $fichier->move(public_path().'/uploads/docs/', $nameTosore); 
                    
                  $document=new Documentservice();
            $document->nom_document=$nameTosore;
             //$document->titre_document=$request->input('titre_document');
                $document->genres_document =$request->input('genre_document');
            $document->type=$type;
            $document->icone=$icone;
             $document->type_document=$type_document;
              $document->taille=$taille;
              $document->structure_id=$request->input('structure_id');
                $document->user_id=Auth::user()->id;
                 $document->doc_size=$size;
                  $document->dossier_id=$request->input('id');
                  $document->date_ajout=date("Y-m-d");
            $document->save();
              }



      }

    }




 Session::flash("success","Document enregistre");
                     return  back();

   
}



//fonction qui donne la taille d'un fichier




//fin  


    public function delete($id){
 $document=Documentservice::find($id);
        $chemin= public_path('/uploads/docs/');
        $doc=$chemin.''.$document->nom_document;
        if (file_exists ( $doc)){
            unlink($doc);
            Documentservice::destroy($id);
        }
        Session::flash("success","Document supprimer");
        return  back();
    }


    public function post_upload(){

    $input = Input::all();
    $rules = array(
        'file' => 'image|max:3000',
    );

    $validation = Validator::make($input, $rules);

    if ($validation->fails())
    {
      return Response::make($validation->errors->first(), 400);
    }

    $file = Input::file('file');

        $extension = File::extension($file['name']);
        $directory = path('public').'uploads/'.sha1(time());
        $filename = sha1(time().time()).".{$extension}";

        $upload_success = Input::upload('file', $directory, $filename);

        if( $upload_success ) {
          return Response::json('success', 200);
        } else {
          return Response::json('error', 400);
        }
  }

}

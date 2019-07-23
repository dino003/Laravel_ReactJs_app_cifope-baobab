<?php

namespace App\Http\Controllers;

use App\Mesdocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Repository\Repository;
use App\Mesdossier;
use Illuminate\Support\Facades\Auth;

class MesdocumentController extends Controller
{

   public function __construct(Repository $repository)
    {
        $this->middleware('auth');
         $this->r=$repository;
      
    }
    
    public function AddDocument(Request $request){
        $this->validate($request,[


            'file'=>'required'

        ]);
$i=0;
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
                $fichier->move(public_path().'/uploads/documentpersonnel/', $nameTosore); 

             $document=new Mesdocument();
        $document->nom_document=$nameTosore;
        $document->type=$type;
        $document->icone=$icone;
        $document->mesdossier_id=$request->input('mesdossier_id');
        $document->type_document=$type_document;
        $document->taille=$taille;
          $document->doc_size=$size;
        $document->save();
              }





      }




  }

        Session::flash('success', ' Document ajouter ');

        return back();
    }

 

    public function delete($id){
        $document=Mesdocument::find($id);
        $chemin= public_path('/uploads/documentpersonnel/');
        $doc=$chemin.''.$document->nom_document;
        if (file_exists ( $doc)){
            unlink($doc);
            Mesdocument::destroy($id);
        }
        Session::flash("success","Document supprimer");
        return  back();
    }


    public function capacite(){
      $doss=Mesdossier::where('user_id',Auth::user()->id)->get();

      $table_dossier = [];
    foreach($doss as $va) {
      $table_dossier[]=$va->id;

    }

      $total=Mesdocument::whereIn('mesdossier_id',$table_dossier)->sum('doc_size');
      $size=$this->r->formatBytes($total);
      $view=view('mesdossiers.capacite',compact('total','size'))->render();
       return response()->json($view);
    }
}

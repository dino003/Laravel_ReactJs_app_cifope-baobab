<?php

namespace App\Http\Controllers;

use App\User;
use App\Archive;
use App\Structure;
use App\Documentservice;
use Illuminate\Http\Request;
use App\Repository\Repository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DocumentAjoute;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class DocumentserviceController extends Controller
{
  private $r;

  public function __construct(Repository $repository)
    {
        $this->r=$repository;
        $this->middleware('auth');
    }


  public function store(Request $request){
  $this->validate($request,[

            
            'file'=>'required|file|max:200000000000'

        ]);
//dd($_FILES);
  //dd($request->input('id'));
        $type=$_FILES['file']['type'];
        //traitement des fichier

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


        if ($request->hasFile('file')){
                //recuperation du nom de fichier
                $fullName=$request->file('file')->getClientOriginalName();
//recuperation du nom san l'extention
                $name=pathinfo($fullName,PATHINFO_FILENAME);
                //Recuperation de l'extension
                $extension=$request->file('file')->getClientOriginalExtension();
               
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
                   

                    $taille=$this->r->FileGetSize($request->file('file')->getSize(),true,true);
                     $size=$request->file('file')->getSize();
                   //  dd($request->file('file')->getSize());
                //creation du nom unique pour l'image
                  if (isset($icone)) {
                    
                   $nameTosore=$name.'_!'.time().'.'.$extension;
                
                $destination= public_path('/uploads/docs/');
                $path=$request->file('file')->move($destination, $nameTosore);
                  }
                  else{
                    Session::flash("success","Vous aviez tenté d'ajouter un fichier de type ".$extension." , ce type de fichier n'est pas pris en charge par le systeme");
                     return  back();
                  }

            }

                    //$det=url('/uploads/docs/').'/'.$nameTosore;
            $document=new Documentservice();
            $document->nom_document=$nameTosore;
             $document->genres_document =$request->input('genre_document');
            $document->type=$type;
            $document->icone=$icone;
             $document->type_document=$type_document;
              $document->taille=$taille;
             $document->structure_id=$request->input('id');
                $document->user_id=Auth::user()->id;
                 $document->doc_size=$request->file('file')->getSize();
                  $document->date_ajout=date("Y-m-d");
            $document->save();

            Session::flash('success', ' Document ajouté ');
             $data="Document ajouter";
        return response()->json($data);
}




public function AddDocumentServiceMultiple(Request $request){
    $this->validate($request, [
            'id' => 'required',
            'file' => 'required',
            'genre_document'=>'required'
        ]);
$i=0;
//dd($request->file('file'));

    foreach ($request->input('id') as $value) {
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
             $document->genres_document =$request->input('genre_document');
            $document->type=$type;
            $document->icone=$icone;
             $document->type_document=$type_document;
              $document->taille=$taille;
             $document->structure_id=$value;
                $document->user_id=Auth::user()->id;
                $document->doc_size=$size;
                  $document->date_ajout=date("Y-m-d");
            $document->save();
           
             $this->r->tracabilite($document->id,'Ajouter',$value);

            $da = now();

            $dt = $da->format('d-m-Y');
             $structure = Structure::where('id', $value)->firstOrFail();


             $this->r->archiveTracabilite(
              Auth::user()->userName(50),
              'AJOUT',
              $structure->nom_structure,
              date("H:i:s"),
              now(),
              $document->nom_document,
              $dt
              
          );

         // $user = User::where('email', 'boris03djoman@gmail.com')->firstOrFail();
         // $user->notify(new DocumentAjoute($document, $structure));
          
          $structuresUsers = $structure->users;
         // dd($structuresUsers);

          foreach($structuresUsers as $key => $structureUser)
          {
            if(App::environment() === 'production')
            {
                 $structureUser->notify(new DocumentAjoute($document, $structure));

            }
        }
        

             
              }



      }



         }




    }

    Session::flash("success","Document enregistré");
                     return  back();

}





public function DocConsulting($iddocument,$idstructure)
{
  // $iddocument=Crypt::decrypt($iddocument);
         // $idstructure=Crypt::decrypt($idstructure);

  $document=Documentservice::find($iddocument);
  $structure=Structure::find($idstructure);

 
  //$chemin= asset('/uploads/docs')."/".$document->nom_document;
  $file= public_path(). "/uploads/docs/".$document->nom_document;;   
/*$headers = array(
        'Content-Type: ' . mime_content_type( $file ),
    );*/

    $da = now();

    $dt = $da->format('d-m-Y');

    $this->r->archiveTracabilite(
      Auth::user()->userName(50),
      'CONSULTATION',
      $structure->nom_structure,
      date("H:i:s"),
      now(),
      $document->nom_document,
      $dt

      
  );
    $this->r->tracabilite($document->id,'Consultation',$structure->id);

  

    return response()->download($file);
  //return response()->download("/uploads/docs", $document->nom_document, $headers);
}



public function DocConsultingAjouter($iddocument,$idstructure)
{
  // $iddocument=Crypt::decrypt($iddocument);
         // $idstructure=Crypt::decrypt($idstructure);

  $document=Documentservice::find($iddocument);
  $structure=Structure::find($idstructure);

 
  //$chemin= asset('/uploads/docs')."/".$document->nom_document;
  $file= public_path(). "/uploads/docs/".$document->nom_document;;   
/*$headers = array(
        'Content-Type: ' . mime_content_type( $file ),
    );*/

    $da = now();

    $dt = $da->format('d-m-Y');

    $this->r->archiveTracabilite(
      Auth::user()->userName(50),
      'CONSULTATION',
      $structure->nom_structure,
      date("H:i:s"),
      now(),
      $document->nom_document,
      $dt

      
  );
    //$this->r->tracabilite($document->id,'Consultation',$structure->id);

  

    return response()->download($file);
  //return response()->download("/uploads/docs", $document->nom_document, $headers);
}







    public function delete($id){
           $id=Crypt::decrypt($id);

 $document=Documentservice::find($id);

        $chemin= public_path('/uploads/docs/');
        $doc=$chemin.''.$document->nom_document;
        if (file_exists ( $doc)){
         $this->r->tracabilite($document->id,'Suppresion',$document->structure_id);

        
            unlink($doc);
            Documentservice::destroy($id);
        }

        $da = now();

        $dt = $da->format('d-m-Y');

        $structure = Structure::where('id', $document->structure_id)->firstOrFail();

        $this->r->archiveTracabilite(
         Auth::user()->userName(50),
         'SUPPRESSION',
          $structure->nom_structure,
          date("H:i:s"),
          now(),
          $document->nom_document,
          $dt
          
      );

    
        Session::flash("success","Document supprimé");
        return  back();
    }

}

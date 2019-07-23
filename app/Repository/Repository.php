<?php
namespace App\Repository;

use App\Archive;
use App\Structure;
use App\Documentservice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * Created by IntelliJ IDEA.
 * User: Guei Roland
 * Date: 08/02/2018
 * Time: 09:34
 */

class Repository{

  private $archive;

  public function __construct(Archive $archive)
  {
    $this->archive = $archive;
  }

//Fonction qui retourne la taille d'un fichier
public function FileGetSize($size, $aShort=true, $aCheckIfFileExist=true){
 
  if(empty($size)) return '0 '.($aShort ? 'o':'octets');
  $l = array();
  $l[] = array('name'=>'octets', 'abbr'=>'o', 'size'=>1);
  $l[] = array('name'=>'kilo octets', 'abbr'=>'ko', 'size'=>1024);
  $l[] = array('name'=>'mega octets', 'abbr'=>'Mo', 'size'=>1048576);
  $l[] = array('name'=>'giga octets', 'abbr'=>'Go', 'size'=>1073741824);
  $l[] = array('name'=>'tera octets', 'abbr'=>'To', 'size'=>1099511627776);
  $l[] = array('name'=>'peta octets', 'abbr'=>'Po', 'size'=>1125899906842620);
  foreach($l as $k=>$v){
    if($size<$v['size']){
      return round($size/$l[$k-1]['size'], 2).' '.($aShort ? $l[$k-1]['abbr']:$l[$k-1]['name']);
    }
  }
  $l = end($l);
  return round($size/$l['size'], 2).' '.($aShort ? $l['abbr']:$l['name']);  
}

public function formatBytes($bytes, $precision = 2) {
    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)."GB";
    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)."MB";
    else if ($bytes > 1024) return round($bytes / 1024, $precision)."KB";
    else return ($bytes)."B";
}





public function archiveTracabilite($auteur, $operation, $service, $heure, $laDate, $document, $date_formatee)
{
     
   return  $this->archive->newQuery()->create([
        'auteur' =>$auteur,
        'operation' =>$operation,
        'service' => $service,
        'heure' => $heure,
        'laDate' => $laDate,
        'document' => $document,
        'date_formatee' => $date_formatee
    ]);
}

public function tracabilite($document,$operation,$structure){
  $date=date("Y-m-d");
  $chemin= public_path('tracabilite/').$date.'.json';
   $nom_du_fichier=$date.'.json';
    $doc=Documentservice::find($document);
    $structure=Structure::find($structure);
 $tableau_pour_json =["0"=>[
    'iduser'=>Auth::user()->id,
  'nom'=>Auth::user()->name, 
'iddocument'=>$doc->id,
'document'=>$doc->nom_document,
'idstructure'=>$structure->id,
'structure'=>$structure->nom_structure,
 'operation'=>$operation,
'dateHeure'=> date("d-m-Y H:i:s"),
'date'=>date("d-m-Y")
]
] ;

   if (file_exists ($chemin)){

     
     $json=file_get_contents($chemin);
     $table=json_decode($json);
     
   $tableau=[
    'iduser'=>Auth::user()->id,
  'nom'=>Auth::user()->name, 
'iddocument'=>$doc->id,
'document'=>$doc->nom_document,
'idstructure'=>$structure->id,
'structure'=>$structure->nom_structure,
 'operation'=>$operation,
'dateHeure'=> date("d-m-Y H:i:s"),
'date'=>date("d-m-Y")
];
     /*$nbr=count($table);
     $n=$nbr+1;*/
    $tableau_pour_json=array_push($table, $tableau);
$contenu_json =json_encode($table);
unlink($chemin);
$fichier = fopen("tracabilite/".$nom_du_fichier, 'w+');
    fwrite($fichier, $contenu_json);

// Fermeture du fichier
fclose($fichier);
         




        }
        else{
 $contenu_json =json_encode($tableau_pour_json);

    $fichier = fopen("tracabilite/".$nom_du_fichier, 'w+');
    fwrite($fichier, $contenu_json);

// Fermeture du fichier
fclose($fichier);
        }

}



public function get_ip() {
  // IP si internet partagé
  if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    return $_SERVER['HTTP_CLIENT_IP'];
  }
  // IP derrière un proxy
  elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    return $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  // Sinon : IP normale
  else {
    return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
  }
}



}
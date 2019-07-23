<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bureau;
use Illuminate\Support\Facades\Auth;
use App\Repository\Repository;
use Illuminate\Support\Facades\Session;
class BureauController extends Controller
{

  public function __construct(Repository $repository)
    {
        $this->r=$repository;
        $this->middleware('auth');
    }

public function BureauUser($id){
/*$WshShell = new COM("WScript.Shell"); 
$oExec = $WshShell->Run("mspaint.exe", 3, true); */
$racourcie=Bureau::find($id);
if ($racourcie->pc_ip==$this->r->get_ip()) {
	//$command="C:\Windows\\regedit.exe";
	//dd($racourcie->chemin);
//$test=
exec("start ".$racourcie->chemin,$output,$return_var);
//exec( $racourcie->chemin [, array &$output [, int &$return_var ]] );

return back();
}else{
  return back();
}

/*$shell_output = fopen("shelloutput.bat","w+" ); //On crée ou on ouvre un fichier .bat  
$line="shp2pgsql -s ".$srid." -c ".$shape." ".$table." ".$bd." > ".$fichierSql;
fwrite($shell_output,$line);  //on ecrit ds ce fichier bat la ligne du dessus
$line2="\n"."exit";// on va a la ligne et on tape la commande pour fermer la fenetre dos
fwrite($shell_output,$line2);
fclose($shell_output);  //on ferme le fichier bat
exec("start shelloutput.bat" ); // on exécute ce fichier bat*/

}

public function configBureau() {

 $listeracourcie=Bureau::where('pc_ip',$this->r->get_ip())->get();
  return view('bureau.config',compact('listeracourcie'));
}

public function store(Request $request){

	$this->validate($request, [
            
            'file' => 'required',
            'racourcie'=>'required',
            'nom_racourcie'=>'required'
        ]);


	$i=0;

    	  if($request->hasfile('file'))
         {

         	foreach ($request->file('file') as $fichier) {
         	$name=pathinfo($fichier->getClientOriginalName(),PATHINFO_FILENAME);
             $extension=$fichier->getClientOriginalExtension();
             $nameTosore=$name.'_'.time().'.'.$extension;
               $fichier->move(public_path().'/uploads/iconeracourcie/icone/', $nameTosore); 
                  
                 $bureau=new Bureau();
                 $bureau->chemin=$request->input('racourcie');
                 $bureau->icone=$nameTosore;
                 $bureau->pc_ip=$this->r->get_ip();
                 $bureau->nom_racourcie=$request->input('nom_racourcie');
                 $bureau->save();

         	}
         	
         }



      Session::flash("success","enregistré");
                     return  back();

}



}

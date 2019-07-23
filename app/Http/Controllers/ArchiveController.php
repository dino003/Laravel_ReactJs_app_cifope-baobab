<?php

namespace App\Http\Controllers;

use App\Archive;
use App\Structure;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $structures = Structure::select('id', 'nom_structure')->get();

       // $da = now();

        //$dt = $da->format('d-m-Y');
        //dd($dt);
        return view('admin.tracabilite.index', compact('structures'));
    }

    public function apiGetStructure()
    {
      $structures = Structure::get();

      return response()->json($structures);

    }

    public function getTracabilite(Request $request)
    {
       $premiereDate = $request->get('premiereDate');
       $deuxiemeDate = $request->get('deuxiemeDate');
       $operation = $request->get('operation');

       $tableauOperation = ['AJOUT', 'SUPPRESSION', 'CONSULTATION'];

       //dd($tableauOperation);

       //dd($premiereDate);
       //$service = $request->get('service');


      // $serviceO = Structure::find($service);

       //dd($service);

      // $serviceP = $serviceO->nom_structure;

      

       if($operation)
       {
         if(in_array($operation, $tableauOperation))
         {
           $resultatsArchives = Archive::whereBetween('laDate', [$premiereDate, $deuxiemeDate])
        ->where('operation',$operation)
        // ->where('service',$service)
        ->orderby('id', 'desc')

         ->get(); 

         }
         else{
           $resultatsArchives = Archive::whereBetween('laDate', [$premiereDate, $deuxiemeDate])
        //->where('operation',$operation)
        // ->where('service',$service)
        ->orderby('id', 'desc')

         ->get(); 
         }
       

       }

       /*

       elseif(!$operation)
       {
        $resultatsArchives = Archive::whereBetween('laDate', [$premiereDate, $deuxiemeDate])
        ->where('operation',$operation)
         //->where('service',$service)
         ->get(); 

       }
       
       elseif($operation && !$serviceP)
       {
        $resultatsArchives = Archive::whereBetween('laDate', [$premiereDate, $deuxiemeDate])
        ->where('operation',$operation)
        // ->where('service',$service)
         ->get(); 

       }
       */
       else {
        $resultatsArchives = Archive::whereBetween('laDate', [$premiereDate, $deuxiemeDate])
        ->orderby('id', 'desc')
         ->get(); 
       }

  
       return response()->json($resultatsArchives); 
    }
}

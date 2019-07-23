<?php

namespace App\Http\Controllers;

use App\Codes;
use App\SessionGenerale;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    
    public function yyo()
    {
        $lesCles = Codes::select('id', 'code', 'nombre_utilisateurs')->get();
        //$zz = $lesCles->toArray();

        $tab = [];
        foreach($lesCles as $v)
        {
           // dd($v);
            $tab[] = $v->code;
        }

        dd($tab);
    }

    public function cleProduit(Request $request)
    {
        $lesClesCollection = Codes::select('id', 'code', 'nombre_utilisateurs')->get();

       // $lesCles = $lesClesCollection->toArray();

       $tab = [];
       foreach($lesClesCollection as $v)
       {
          // dd($v);
           $tab[] = $v->code;
       }

       // dd($lesCles);

        $cle = $request->get('cleProduit');


        if(in_array($cle, $tab))
        {
            $cleReference = Codes::where('code', $cle)->firstOrFail();

            $ancienneCle = SessionGenerale::get();
            foreach($ancienneCle as $key => $anCle)
            {
                $anCle->delete();
            }

            $sess = new SessionGenerale;

            $sess->code_systeme = $cle;
            $sess->nombre = $cleReference->nombre_utilisateurs;
    
            $sess->save();

            $message = 'Code accepté';

           // return response()->json($message);

            return response()->json([
                'message'    => $message,
            ], 200);

        }else{
            $message = 'Ce code n\'est pas valide';

            return response()->json([
                'message'    => $message,
            ], 201);

            //return response()->json($message);
        }

           
    }
}

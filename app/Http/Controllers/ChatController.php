<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Chat;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        setlocale(LC_TIME, 'French');

      
    }

    

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function indexUserList()
    {
       // $moi = Auth::user()->id;

        //$employeAChoisirs = User::where('id', '!=', $moi)->get();

        //return view('chats.indexUserList', compact('employeAChoisirs'));

        $emps = User::all();
        $chatso = Chat::all();



            return response()->json(['emps' => $emps,
                                    'chatso' =>$chatso 
                                            ]);

    }

    public function dernierMessage($id)
    {
        $moi = Auth::user()->id;
        $dernierMessage = DB::table('chats')
            ->where('emmeteur_id', $id)
            ->where('receveur_id', $moi)
            ->orWhere('emmeteur_id', $moi)
            ->where('receveur_id', $id)
            ->latest()
            ->first();

        if(isset($dernierMessage))
        {
            $dernier = str_limit($dernierMessage->message, 35);


            return response()->json($dernier);

        }
    }

    /*
        
    *
    */

    public function vueListUser()
    {
         $employes = User::orderBy('created_at', 'DESC')
            ->where('id', '!=', Auth::user()->id)
            ->get();

            
        
        
        return response()->json($employes);
    }

    public function chatVue()
    {
        return view('chats.chatVue');
    }

    public function chatConversation($id)
    {
         $moi = Auth::user()->id;

         $user1 = User::findOrFail($id);

        $messageso = Chat::where('emmeteur_id', $moi)->where('receveur_id', $id)
            ->orWhere('emmeteur_id', $id)
            ->where('receveur_id', $moi)
            ->orderBy('id', 'asc')
            ->take(60)
            ->get();

            $messages = $messageso->reverse();

            return response()->json(['messages' => $messages,
                                    'user1' =>$user1 
                                            ]);
        //return response()->json($messages);
    }

   


    /**
     * @param Request $req
     */
    public function insertText(Request $req, $id)
    {

            $moi = Auth::user()->id;

            $rece = $req->receveur_id;

            $user = User::findOrFail($id);

            /*
            $conversation = Chat::create([

                'emmeteur_id' => Auth::user()->id,
                'receveur_id' => $rece,
                'message' => $req->message
            ]);
            */

            $chat = new Chat;
            $chat->emmeteur_id = $moi;
            $chat->receveur_id = $id;
            $chat->message = $req->message;
            $chat->save();
                
                 $messageso = Chat::where('emmeteur_id', $moi)->where('receveur_id', $id)
                                ->orWhere('emmeteur_id', $id)
                                ->where('receveur_id', $moi)
                                ->orderBy('id', 'asc')
                                ->take(60)
                                ->get();

                $messagesp = $messageso->reverse();
                    
                return response()->json(['messagesp' => $messagesp,
                                    'user' =>$user 
                                            ]);
            //return $messagesp;

            
        
        /*
         if($request->hasFile('fichier')){
            $avatar = $request->file('fichier');
           
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
           
            $path = $_FILES['fichier']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $extension_image = array('jpeg', 'jpg', 'JPEG', 'JPG', 'png', 'PNG', 'gif');
            $extension_autre = array('pdf', 'zip', 'xlsx', 'doc');

                if(in_array($ext, $extension_image))
                {
                    Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/chats/' . $filename ));
                    $chat->type = "image";
                }
                elseif(in_array($ext, $extension_autre))
                {
                     $avatar->move(public_path('/uploads/chats/' . $filename ));
                     $chat->type = "fichier";
                }
                else
                {
                    $chat->type = "text";
                }
           

            $chat->chemin_fichier = url('/uploads/chats/'.$filename);

            $chat->fichier = $filename;

        }
        */

    }

    public function conversationAjax($id)
    {
        $moi = Auth::user()->id;
        $employes = User::where('id', '!=', $moi)->get();

        $ami = User::find($id);


        $messageso = Chat::where('emmeteur_id', $moi)->where('receveur_id', $ami->id)
            ->orWhere('emmeteur_id', $ami->id)
            ->where('receveur_id', $moi)
            ->orderBy('id', 'desc')
            ->take(60)
            //->orderBy('id
            ->get();

            $messages = $messageso->reverse();

    return view('chats.chatPage', compact('ami', 'messages', 'employes'));

    }

    public function conversation($id)
    {
        $moi = Auth::user()->id;
        $employes = User::where('id', '!=', $moi)->get();

        $ami = User::find($id);


        $messageso = Chat::where('emmeteur_id', $moi)->where('receveur_id', $ami->id)
            ->orWhere('emmeteur_id', $ami->id)
            ->where('receveur_id', $moi)
            ->orderBy('id', 'desc')
            ->take(60)
            //->orderBy('id
            ->get();

            $messages = $messageso->reverse();

             $messageNonLus = Chat::where('emmeteur_id', $id)
            ->where('receveur_id', $moi)
            ->where('status', '0')
            ->get();
            //dd($messageNonLus);
            if(isset($messageNonLus))
            {

                foreach($messageNonLus as $mess)
                {
                    $mess = new Chat;
                    $mess->update(['status' => 1]);

                    //dd($mess);
                    $mess->save();
                }
            }


        return view('chats.index', compact('ami', 'messages', 'employes'));

    }

    public function chatPage($id)
    {
        $moi = Auth::user()->id;

        $correspondant = User::find($id);


        $messages = Chat::where('emmeteur_id', $moi)->where('receveur_id', $correspondant->id)
            ->orWhere('emmeteur_id', $correspondant->id)
            ->where('receveur_id', $moi)
            ->get();


        return view('chats.chatPage', compact('correspondant', 'messages'));
    }

    public function chercherCorrespondant(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('query');

            $employeRecherches = User::where('name','like','%'.$query.'%')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('name')
                    ->orWhere('prenom','like','%'.$query.'%')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('name')
                    ->orWhere('numero','like','%'.$query.'%')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('name')
                    ->get();
            
           

            $output = view('chats.resultatRechercheEmployes',compact('employeRecherches'))->render();

            $data =array(
                'table_data'=>$output
            );

            return Response($data);

        }
    }
}

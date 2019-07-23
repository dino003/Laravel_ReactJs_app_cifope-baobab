<?php

namespace App\Http\Controllers;

use Excel;
use Image;
use Session;
use App\User;
use App\Profil;
use Illuminate\Http\Request;
use App\Exports\EmployesListe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NouvelleInscription;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }

    public function formSubmit(Request $request)

    {

    	$imageName = time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('images'), $imageName);

        $name = $request->get('name');

        

        return response()->json([
            'success'=>'You have successfully upload image.',
            'name' => $name

        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexvue()
    {
        return view('admin.employes.liste');
    }

    public function get_auth()
    {
        return Auth::user();
    }

    public function index()
    {
        //returne la liste des employés

        
        $employes = User::orderBy('created_at', 'DESC')
            //->where('id', '!=', Auth::user()->id)
            ->get();
        
	    $roles=Role::all();
        
        return view('admin.employes.index', compact('employes', 'roles'));
                 //$employes = User::all();
       // return view('admin.employes.indexAjax');
    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user= new User;
        $motDePasse = str_random(8);

        $user->name = $request->name;
		$user->prenom = $request->prenom;
		$user->numero = $request->numero;

		$user->email = $request->email;
        $user->password = bcrypt($motDePasse);

       
		$user->save();
       
                
            $user->notify(new NouvelleInscription($user->email, $motDePasse));

        
          $sucess="Un E-mail a été envoyé à l'adresse {$user->email} Le mot de passe est :  ".$motDePasse;
        
       // return view('professeur.index', compact('professeurs','sucess'));

         Session::flash('success', 'Enregistré avec succès : '.$sucess);		

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = User::where('id', $id)->firstOrFail();
        
        return view('admin.employes.show', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.employes.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /*
     * 
     * Fonction pur changer la photo de profil
     */
    
     public function update_avatar(Request $request){

        // Handle the user upload of avatar
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if($request->hasFile('photo')){
            $avatar = $request->file('photo');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
             //$path = $_FILES['photo']['type'];
            //$ext = pathinfo($path, PATHINFO_EXTENSION);
            //dd($path);
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename ));

            $user = Auth::user();
            $img_path = url('/uploads/avatars/'.$filename);
            $user->photo = $img_path;
            $user->save();
        }
       // Session::flash('success', 'Photo de profile changée avec succès.');
        //return view('etudiants.profile', array('user' => Auth::user()) );
        //return back();

    }

    public function changerStatut($id)
    {

        $user = User::where('id', $id)->firstOrFail();

        $user->active = !$user->active;

        if($user->active)
        {
            $etat = "Actif";
        }
        else
        {
            $etat = "Inactif";

        }


        $user->save();

        Session::flash("success","{$user->prenom} {$user->name} est maintenant {$etat}");

        return back();


    }



    /*
     * Fonction pour exporter en excel
     */
    public function export() 
    {
        return Excel::download(new EmployesListe, 'employe.xlsx');
    }

    /*
     * Rechercher un employé
     * @param $request
     * return response data
     */


    public function rechercherUnEmploye(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('query');

            if($query != '')
            {
                $users = User::where('name','like','%'.$query.'%')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('name')
                    ->orWhere('prenom','like','%'.$query.'%')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('name')
                    ->orWhere('numero','like','%'.$query.'%')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('name')
                    ->paginate(60);
            }
            else
            {
                echo 'rien';

            }

            $output = view('admin.employes.resultatRechercheEmployes',compact('users'))->render();

            $data =array(
                'table_data'=>$output
            );

            return Response($data);

        }
    }

    // retourne le profil de l'employé avec toutes ses infos

    public function fiche($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        return view('admin.employes.fiche', compact('user'));
    }

    public function profil()
    {
        return view('employes.profil');
    }

    public function storeProfil(Request $request)
    {
        $profil= new Profil;
        

        $profil->fonction = $request->get('fonction');
		$profil->nom_organisme = $request->get('nom_organisme');
        $profil->matricule = $request->get('matricule');
        $profil->adresse = $request->get('adresse');
        $profil->telecopie = $request->get('telecopie');
        $profil->civilite = $request->get('civilite');
        $profil->naissance = $request->get('naissance');
        $profil->numeroTelephone = $request->get('numeroTelephone');
        $profil->pays = $request->get('pays');
        $profil->user_id = Auth::user()->id;


		$profil->save();
       
                
         Session::flash('success', 'Enregistré avec succès');

         return back();

    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->get('old'), $hashedPassword)) {
            //Change the password
            $user->fill([
                'password' => Hash::make($request->get('password'))
            ])->save();

            $request->session()->flash('success', 'Votre mot de passe a été changé avec succès.');

            return back();

        }

        $request->session()->flash('failure', 'La modufication a échoué veuillez recommencer.');

        return back();


    }


}

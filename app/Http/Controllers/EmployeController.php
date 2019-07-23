<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\User;

use App\Article;
use App\Structure;
use App\SessionGenerale;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;

use Spatie\Permission\Models\Permission;
use App\Notifications\NouvelleInscription;


class EmployeController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
      
    }

    public function tester()
    {
        /*
        $us = User::all();

        foreach($us as $key => $user)
        {
            if(!empty($user->getRoleNames()))
            {
                foreach($user->getRoleNames() as $v)
                {
                    echo $user->name.''.$v;
                }
            }
        }
        */
        $users = User::with('roles')->get();
        return dd($users);

    }

    public function liste()
    {
        if (!Auth::user()->hasPermissionTo('Voir-Utilisateur') ) {
            return view('401');
        }
        $roles2 = Role::pluck('name','name')->all();
        $permissions = Permission::orderBy('name')->get();
        $employes = User::with('roles')
        ->with('permissions')
        ->get();


        return view('admin.employes.liste', compact('roles2', 'permissions', 'employes'));

    }

    public function apiGetEmployePost(Request $request)
    {
        $pagination =  50 ;
        $roles = $request->get('roleApi');
        $service = $request->get('serviceApi');

       // dd($service);

               if($roles && $service)
               {
                $employes = User::with('roles')
                ->with('permissions')
                //->where('fieldA', $valueA)
                ->whereHas('roles', function($query)
                {
                    $query->where('name', $roles);
                })
                ->whereHas('structures', function($query)
                {
                    $query->where('nom_structure', $service);
                })
                ->orderBy('id', 'desc')->paginate($pagination);

               } 

               // si le service n'existe pas
               if($roles && !$service)
               {
                $employes = User::with('roles')
                ->with('permissions')
                //->where('fieldA', $valueA)
                ->whereHas('roles', function($query, Request $request)
                {
                    $query->where('id', $request->get('roleApi'));
                })
                ->orderBy('id', 'desc')->paginate($pagination);

               } 

               // si le role n'existe pas

               if(!$roles && $service)
               {
                $employes = User::with('roles')
                ->with('permissions')
                //->where('fieldA', $valueA)
                ->whereHas('structures', function($query)
                {
                    $query->where('nom_structure', $service);
                })
                ->orderBy('id', 'desc')->paginate($pagination);

               } 

               // si la pagination n'existe pas

               if($roles && $service)
               {
                $employes = User::with('roles')
                ->with('permissions')
                //->where('fieldA', $valueA)
                ->whereHas('roles', function($query)
                {
                    $query->where('name', $roles);
                })
                ->whereHas('structures', function($query)
                {
                    $query->where('nom_structure', $service);
                })
                ->orderBy('id', 'desc')->paginate(50);
            }


                //si le role seulement existe
            if($roles && !$service)
               {
                $employes = User::with('roles')
                ->with('permissions')
                //->where('fieldA', $valueA)
                ->whereHas('roles', function($query)
                {
                    $query->where('name', $roles);
                })
                ->orderBy('id', 'desc')->paginate(50);

               } 

               //si le service seulement existe
               if(!$roles && $service)
               {
                $employes = User::with('roles')
                ->with('permissions')
                //->where('fieldA', $valueA)
               
                ->whereHas('structures', function($query)
                {
                    $query->where('nom_structure', $service);
                })
                ->orderBy('id', 'desc')->paginate(50);
            }

             

            
            return response()->json([
                    'employes' => $employes
                   
                ], 200); 

            }

    public function index()
    {
        

             $employes = User::with('roles')
                                ->with('permissions')
                                ->orderBy('id', 'desc')
                                ->get();

            $servicesApi = Structure::select('id', 'nom_structure')->get();
            $rolesApi = Role::where('name', '!=', 'Th')->get();

            

            //$employes = User::orderBy('created_at', 'DESC')
            //->where('id', '!=', Auth::user()->id)
           // ->get();
         //$employes = User::all();
        // $structures = Structure::all();
            
            return response()->json([
                    'employes' => $employes,
                    'servicesApi' => $servicesApi,
                    'rolesApi' => $rolesApi
                   
                ], 200); 


            

    }

    public function supprimerPlusieursUtilisateurs(Request $request)
    {
        if($request->id)
        {
            foreach($request->id as $id)
            {
                User::destroy($id);
            }
        }
    }

    public function activerPlusieursUtilisateurs(Request $request)
    {

        if($request->id)
        {
            foreach($request->id as $id)
            {
                $user = User::where('id', $id)->firstOrFail();

                $user->active = !$user->active;
        
               
                $user->save();    
             }
        }
        
    }

    public function apiGetEmployePagination(Request $request)
    {
        $pagination = $request->get('paginationApi');

             $users = User::with('roles')
                                ->with('permissions')
                                ->orderBy('id', 'desc')
                                ->paginate($pagination);

           // $servicesApi = Structure::select('id', 'nom_structure')->get();
           // $rolesApi = Role::where('name', '!=', 'Th')->get();

            

            //$users = User::orderBy('created_at', 'DESC')
            //->where('id', '!=', Auth::user()->id)
           // ->get();
         //$users = User::all();
        // $structures = Structure::all();
            
            return response()->json([
                    'users' => $users
                   // 'servicesApi' => $servicesApi,
                   // 'rolesApi' => $rolesApi
                   
                ], 200); 


            

    }

    public function apiGetEmployeParGroupe(Request $request)
    {
        $role = $request->get('roleApi');

             $users = User::role($role)
                                ->with('roles')
                                ->with('permissions')
                                ->orderBy('id', 'desc')
                                ->get();
                               // User::role('writer')->get();

           // $servicesApi = Structure::select('id', 'nom_structure')->get();
           // $rolesApi = Role::where('name', '!=', 'Th')->get();

            

            //$users = User::orderBy('created_at', 'DESC')
            //->where('id', '!=', Auth::user()->id)
           // ->get();
         //$users = User::all();
        // $structures = Structure::all();
            
            return response()->json([
                    'users' => $users
                   // 'servicesApi' => $servicesApi,
                   // 'rolesApi' => $rolesApi
                   
                ], 200); 


            

    }

    public function apiGetEmployeParService(Request $request)
    {
        $serviceN = $request->get('serviceApi');

        //dd($service);

        $service = Structure::where('id', $serviceN)->firstOrFail();

        $users = $service->users;

            /*
             $users = User::role($role)
                                ->with('roles')
                                ->with('permissions')
                                ->orderBy('id', 'desc')
                                ->get();
                               // User::role('writer')->get();
                               */

            return response()->json([
                    'users' => $users
                   
                ], 200); 


            

    }

    public function editRoleForUser($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->where('name', '!=', 'Th')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $permission = Permission::where('name', '!=', 'Cible-Pub')->get();
        $userPermissionAll = $user->Permissions;
        $userPermission = DB::table("model_has_permissions")->where("model_has_permissions.model_id",$id)
        ->pluck('model_has_permissions.permission_id','model_has_permissions.permission_id')
        ->all();

       
        return view('admin.employes.fiche',compact('userPermissionAll', 'user', 'permission', 'roles','userRole', 'userPermission'));
    }

    public function updateRoleForUser(Request $request, $id)
    {
        $user = User::find($id);

        if($request->input('roles'))
        { 
            if(count(DB::table('model_has_roles')->where('model_id',$id)->get()))
            {
                DB::table('model_has_roles')->where('model_id',$id)->delete();

            }
            $user->assignRole($request->input('roles'));


        }
        else
        {
            DB::table('model_has_roles')->where('model_id',$id)->delete();

        }

        if($request->input('permission'))
        {
            if(count(DB::table('model_has_permissions')->where('model_id',$id)->get() ))
            {
                DB::table('model_has_permissions')->where('model_id',$id)->delete();

            }

            $user->givePermissionTo($request->input('permission'));


        }else {
            DB::table('model_has_permissions')->where('model_id',$id)->delete();
        }

         Session::flash('success', 'Les accès ont été modifiés.');

        return back();
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

         $this->validate($request, [
            'name'  => 'required|max:255',
            'prenom' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'numero' => 'numeric',
        ]);  
          $user = new User();
            $motDePasse = str_random(8);

          $user->name = $request->get('name');
          $user->prenom = $request->get('prenom');
          $user->email = $request->get('email');
          $user->numero = $request->get('numero');
        $user->password = bcrypt($motDePasse);


        $user->save();

        
      

        if(App::environment() === 'production')
        {
            $user->notify(new NouvelleInscription($user->email, $motDePasse));

        }



         return response()->json([
                    'user'    => $user,
                    'message' => 'Enregistré avec succès'
                ], 200);  

     }

     public function storeAdmin(Request $request)
     { 
 
          $this->validate($request, [
             'name'  => 'required|max:255',
             'prenom' => 'required',
             'email' => 'required|string|email|max:255|unique:users',
             'numero' => 'numeric',
         ]);  
           $user = new User();
             $motDePasse = str_random(8);
 
           $user->name = $request->get('name');
           $user->prenom = $request->get('prenom');
           $user->email = $request->get('email');
           $user->numero = $request->get('numero');
           $user->admin = true;
         $user->password = bcrypt($motDePasse);

         
         $user->save();

         if ($request->get('roles') ) {
            $user->assignRole($request->get('roles'));

         }
        
         if(App::environment() === 'production')
         {
             $user->notify(new NouvelleInscription($user->email, $motDePasse));
 
         }
 
 
 
          return response()->json([
                     'user'    => $user,
                     'message' => 'Enregistré avec succès'
                 ], 200);  
 
      }
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json($user);
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
         $this->validate($request, [
            'name'  => 'required|max:255',
            'prenom' => 'required',
           //'email' => 'required|string|email|max:255|unique:users',
            'numero' => 'numeric',
        ]);  
            /*
        $user = User::find($id);
        $user->name = $request->get('name');
          $user->prenom = $request->get('prenom');
          $user->email = $request->get('email');
          $user->numero = $request->get('numero');
          //$user->delete();
            $user->save(); 

           return response()->json([
            'message' => 'Modification enregistrée!'
        ], 200);
        */
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);

    }


    public function updatePerso(Request $request)
    {
         $this->validate($request, [
            'name'  => 'required|max:255',
            'prenom' => 'required',
           //'email' => 'required|string|email|max:255|unique:users',
            'numero' => 'numeric',
        ]);  
            /*
        $user = User::find($id);
        $user->name = $request->get('name');
          $user->prenom = $request->get('prenom');
          $user->email = $request->get('email');
          $user->numero = $request->get('numero');
          //$user->delete();
            $user->save(); 

           return response()->json([
            'message' => 'Modification enregistrée!'
        ], 200);
        */
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->prenom = $request->get('prenom');
        $user->email = $request->get('email');
        $user->numero = $request->get('numero');


        //$user->update($request->all());

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
      $user = User::find($id);
      $user->delete();

      return '';
    }

     public function changerStatutAjax($id)
    {

        $user = User::where('id', $id)->firstOrFail();

        $user->active = !$user->active;

       


        $user->save();

        return $user;


    }

    
    public function rechercherUnEmploye(Request $request)
    {
        if($request->ajax())
        {
            $query = $request->get('query');

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
            

            $output = view('admin.employes.resultatRechercheEmployes',compact('users'))->render();

            $data =array(
                'table_data'=>$output
            );

            return Response($data);

        }
    }
    public function profil()
    {
        $articles = Article::orderBy('id', 'desc')
                            ->where('publie', 1)
                            ->orWhere('partage', 1)
                            ->orderBy('date_publication')
                            ->get();

        $no = Auth::user()->Notifications()
                         // ->orderBy('')  
                          ->get();
       // dd($no);
       
                           // dd($articles);

            $permissionAverifier = Permission::pluck('name','name')->all();

         if(Auth::user()->hasAnyPermission($permissionAverifier))
         {
            return view('employes.profil', compact('articles', 'no'));                
         }
         else{
                return view('employes.aucunAcces');                

         }


    }

    public function posterMessage()
    {
        return view('employes.posterMessage');
    }

    public function profilUser()
    {
        return view('employes.profilUser');
    }

    public function apiGetTotalUtilisateurs()
    {
        $users = User::count();

        $codeActuel = SessionGenerale::first();
        $nombreAutorise = $codeActuel->nombre;

       // return $users;

        return response()->json([
            'users'    => $users,
            'codeActuel' => $nombreAutorise
        ], 200); 
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use DB;
use Auth;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('permission:Role-Voir');
       // $this->middleware('permission:Ajouter-Role', ['only' => ['create','store']]);
        //$this->middleware('permission:Modifier-Role', ['only' => ['edit','update']]);


       // $this->middleware('permission:Role-Supprimer', ['only' => ['destroy']]);
    }

    public function tyy()
    {
       // $addr = "C:\Program Files (x86)\FileZilla FTP Client\filezilla.exe";
        $addr = "code";

         exec($addr,$output, $return);
        return back();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function apiGetRoles()
        {

            $roles = Role::orderBy('id', 'desc')
            ->where('name', '!=', 'Th')
            ->with('permissions')
            ->get();
            return response()->json($roles);
        }

        public function apiGetPermissions()
        {

            $permissions = Permission::orderBy('id', 'desc')
            ->where('name', '!=', 'Cible-Pub')
            ->get();
            return response()->json($permissions);
        }

    public function index()
    {
        
        if (!Auth::user()->hasPermissionTo('Voir-Role') ) {
            return view('401');
        }
        
       // $roles = Role::orderBy('id','DESC')->get();

        //return response()->json($roles);
        $permission = Permission::where('name', '!=', 'Cible-Pub')->get();

         $roles = Role::orderBy('id', 'desc')->where('name', '!=', 'Th')->get();
        // dd($permissionAverifier);

      
        // $user->hasAnyPermission($permissionAverifier);



        return view('admin.roles.index', compact('permission', 'roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|unique:roles,name',
           // 'permission' => 'required',
        ]);

            $role = new Role();
            $role->name = $request->get('name');
            $role->save();
       // $role = Role::create(['name' => $request->input('name')]);
       // $role->syncPermissions($request->input('permission'));


       // return back();
    }

    public function storePermission(Request $request)
    {
        /*
        $this->validate($request, [
           // 'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        */
            $role = Role::find($request->get('role'));



        if($request->get('permission'))
        {
            foreach($request->get('permission') as $permi)
            {
                $role->givePermissionTo($permi);
            }
        }
       // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Modifier-Role') ) {
            return view('401');
        }
        $role = Role::find($id);
        $permission = Permission::where('name', '!=', 'Cible-Pub')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

          $rolePermis =  $role->permissions()->get();  


        return view('admin.roles.edit',compact('role', 'rolePermis','permission','rolePermissions'));
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
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        if($request->input('permission'))
        {
            $role->syncPermissions($request->input('permission'));

        }else {
            Session::flash('info', 'LA modification a échoué ; Vous devez rattacher au moins une permission à ce groupe !');

            return back();
        }
        $role->save();

        


        Session::flash('success', 'Le Rôle a été modifié.');

        return redirect()->route('gestion_des_roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Le Role a été supprimé');
    }

    public function supprimerPlusieurs(Request $request)
    {
        if($request->id)
        {
            foreach($request->id as $id)
            {
                Role::destroy($id);
            }
        }

    }
}

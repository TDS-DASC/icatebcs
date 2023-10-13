<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Assign;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        
        //if(Auth::user()->hasRole('Admin')){
            
            $roles = Role::with('permissions')->get();
            $permissions = Permission::all()->groupBy('category');

            return view("admin.roles.index", compact('roles', 'permissions'));
        //}else{
            //return auth::user();
            //return redirect()->back();
        //}
    }

    public function create()
    {
        $permissions = Permission::all();
        return response()->json([
            'message' => "Lista de permisos",
            'data' => $permissions
        ], 200);
    }

    public function store(Request $request)
    {

        $request ->validate([
            'name' => 'required|unique:roles'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);
        if ($role){
            return redirect()->back()->with('success', 'ok');
        }
    }

    public function show($id)
    {
        
        $role = Role::where('id' ,$id)->with('permissions')->get();
        
        //$user = User::find(1);
        //$user->assignRole('Admin');
        return $role;
    }
    public function get($id){
        $role = Role::where('id',$id)->with('permissions')->get();
        return response()->json([
            'message' => 'Permisos',
            'data' => $role
        ], 200);
    }

    public function edit($id)
    {
        $role = Role::where('id',$id)->with('permissions')->get();
        
        $permissions = Permission::all()->groupBy('category');
        $permissions = Permission::all()->groupBy('category')->sortBy('category');
          

        return $permissions;
        
        return view("admin.roles.edit", compact('role','permissions'))->with('success', 'ok');
    }

    public function update(Request $request)
    {
        $role = Role::find($request->id);
        //$role->update($request->name);
        if($role){
            $role->permissions()->sync($request->permissions);
            $role->update($request->all());

            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'No se pudieron actualizar los permisos');
    }

    public function destroy($id)
    {
        
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'No se pudo eliminar el rol');
    }
}

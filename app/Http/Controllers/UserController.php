<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\Center;

use File;

class UserController extends Controller
{
    public function index(){
        $users = User::where('id','!=', 1)->with('roles', 'center')->get();
        $roles = Role::all();
        $centers = Center::all();

        return view('admin.users.index', compact('users', 'roles', 'centers'));
    }
    
    public function store(Request $request){
        //return $request;
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|string|max:255',
            'password' => ['required', 'confirmed',Password::min(8)
                                                   ->letters()
                                                   ->mixedCase()
                                                   ->numbers()
                                                   ->symbols()]
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'center_id' => $request->center_id,
        ]);
        
        if($user){
            if(isset($request->role_id)){
                $user->roles()->sync([$request->role_id]);
            }
            if($request->hasFile('profile_photo_path')){
    
                $file = $request->file('profile_photo_path');
                $name_file = $user->id."_user".".".$file->getClientOriginalExtension();
    
                $path = $request->file('profile_photo_path')->storeAs(
                    'public/user/covers/', $name_file
                );
    
                $user->profile_photo_path = $name_file;
                $user->save();
            }
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'No se pudo guardar el usuario');
    }
    
    public function update(Request $request){
        $user = User::where('id',$request->id)->first();
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id.'|string|max:255',
        ];
        if(isset($request['password']) && $request['password']!=''){
            $password = $request['password'];
            $rules['password'] = ['required', 'confirmed',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()];
            $request->validate($rules);
            $request['password'] = bcrypt($request['password']);
        }else{
            $request->validate($rules);
            $request['password'] = $user->password;
        }
        //$user->roles()->sync([1]);
        //return $user;
        if($user){
            if($user->profile_photo_path != "cover.jpg" && $request->profile_photo_path != 'cover.jpg'){
                $path = storage_path() . "/app/public/user/covers/".$user->profile_photo_path;

                //borrar imagen
                if (File::exists($path)) {

                    File::delete($path);

                    $user->profile_photo_path = 'cover.jpg';
                }
            }
            if($request->hasFile('profile_photo_path')){

                $file = $request->file('profile_photo_path');
                $name_file = $user->id."_user".".".$file->getClientOriginalExtension();

                $path = $request->file('profile_photo_path')->storeAs(
                  'public/user/covers/', $name_file
                );
                $user->profile_photo_path = $name_file;
            }
            $user->save();
            $user->update($request->except(['profile_photo_path']));
            if (isset($request->role_id)){
                $user->roles()->sync([$request->role_id]);
            }else{
                $user->roles()->sync([]);
            }

            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'No se pudo actualizar el usuario');
        
    }
    public function destroy($id){
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'No se pudo eliminar el rol');
    }
}

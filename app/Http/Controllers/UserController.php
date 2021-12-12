<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Profile;
use DB;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function index()
    {        
      
        $users = User::join('profile', 'users.id', '=', 'profile.user_id')->get();
        
        return response()->json($users);
       
    }

    public function search($search)
    { 
        $users = User::join('profile', 'users.id', '=', 'profile.user_id')->where('first_name','LIKE','%'.$search.'%')->orWhere('last_name','LIKE','%'.$search.'%')->orWhere('description','LIKE','%'.$search.'%')->get(); 
        return response()->json($users);       
    }

    public function date($start,$end)
    {
            
        $users = User::join('profile', 'users.id', '=', 'profile.user_id')->get();  
        $data = [];
        for ($i=0; $i < count($users); $i++) { 
           $created = $users[$i]->created_at->format('Y/m/d');
           $change = str_replace('/','-', $created);
    
           if($start >= $change and $end <= $change) 
           {
            $data = Arr::prepend($data, $users[$i]);
           }
        }    
        return response()->json($data);
    }

    public function store(Request $request)
    {        
        $users = new User();
        $users->first_name = $request->get('first_name');     
        $users->last_name = $request->get('last_name'); 
        $users->description = $request->get('description');
        $users->email = $request->get('email');
        $users->password = bcrypt($request->get('password'));         
        $users->save();
        $userLast = User::latest('id')->first();

        $profile = new Profile();       
        $profile->user_id = $userLast->id;        
        $profile->save();

        return response()->json('users created!');
    }

    public function email($email)
    { 
        $count = User::where('email','=',$email)->count();         
        return $count;
    }

    public function profile(Request $request) {
        $profile = Profile::latest('id')->first();

        if ($request->hasFile('images')) {
            $file   = $request->file('images');
            $cadena = time() . $file->getClientOriginalName();
            $name   = str_replace(' ', '', $cadena);   
            $file->move(public_path() . '/img/', $name);            
            $profile->ima_profile = $name;
        }
        else
        {
            $profile->ima_profile = 'user.png';
        }
       
        $profile->save();

        return response()->json('imagen charge!');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }


    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $users->first_name = $request->get('first_name');
        $users->description = $request->get('description');
        $users->save();

        return response()->json('users updated!');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        $profile = Profile::where('user_id','=',$id)->first();
        $profile->delete();

        return response()->json('users deleted!');
    }
}

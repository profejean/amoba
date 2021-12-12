<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data1 = [

            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),        
            'username' => $request->get('username'),
            'password' => $request->get('password')      
        ];  
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('services.passport.login_endpoint'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 100,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "post",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => array(                
                "content-type: application/json"
            ),
        ));
   

        $response = curl_exec($curl);
        $e = curl_error($curl);

        curl_close($curl);

        if ($e) {         

            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());

        }else{       

            $res = json_decode($response, true); 
            $data = [$res,$request->get('username')];
            return response()->json($data);              
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();       
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->description = $request->get('description');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return $user;
       
    }

    public function logout()
    {    
        auth()->user()->tokens->each(function ($token, $key) {     
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }


    public function viewLogin()
    { 
        return view('users.login');
    }

    public function currentUser()
    { 
        return response()->json(Auth::user(), 200);
    }


}

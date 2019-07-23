<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Affichecommentaire;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail, Illuminate\Support\Facades\Password;

class ApiAuthController extends Controller
{
    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only('username', 'email', 'password');
        $rules = [
            'username' => 'max:255|unique:users',
            'name' => 'max:255',

            'email' => 'required|email|max:255|unique:users',  
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()]);
        }
        $username = $request->username;
        $name = $request->name;

        $email = $request->email;
        $password = $request->password;
        User::create(['username' => $username, 'name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        return $this->login($request);
    }

    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()], 401);
        }
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Ces identifiants ne correspondent à aucun compte.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Erreur de connexion, Veuillez réessayer.'], 500);
        }

        $user_email = User::where('email', $request->email)->first();

        $user = User::find($user_email->id);
        			//->with('seminaires_user_par_suivre')
                    //->withCount('seminaires_user_par_suivre')
                   // ->find($user_email->id);

        if(!$user){
            return response()->json(['error' => 'Non connecté'], 401);
        }
        // all good so return the token
        
        return [
            'success' => true, 
            'token'=>  $token, 
            'user' => $user 
        ];
        
        /*
        return response()->json(
    collect([
        'token' => $token,
        'user' => $user,
    ])->toJson()
);
        */
       // return response()->json($user);
    }
    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    public function getUsers(){
        $users = User::all();
        return response()->json($users);
    }

    public function test(){
    	$aff =  Affichecommentaire::orderBy('id', 'desc')->get();

    	return response()->json($aff);


    }

    public function use($id){
    	$user = User::find($id);

    	return $user;
    }

}

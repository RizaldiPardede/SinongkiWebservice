<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\admin;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
class adminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function create_user(Request $request)
    {
        $password = Hash::make($request->password);
        $user = admin::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $password,
            ]);
        $id = $user->id_admin;
        return response()->json([
                'success' => true,
                'message' => 'Create user Success',
                'id' => $id,
                ]);
    }
    public function getUserByEmail(Request $request)
    {
        $user = admin::where('email',$request->email)->first();
        return response()->json([
        'user' => [
        'nama' => $user->nama,
        'email' => $user->email,
        'id'=>$user->id_admin
            ]   
            
        ]);

    }

    public function updatenama(Request $request)
    {
        $email = $request->email;
        $nama = $request -> nama;
        $user = admin::where('email',$email);
        
        $user->update([
            'nama'=> $nama
        ]);
        
        

        return response()->json([
            'success' => true,
            'message' => 'name update success',
            
            ]);
        

    }

    public function updatepassword(Request $request)
    {   
        $email = $request->email;
        $password = Hash::make($request->password);
        $user = admin::where('email',$email);
        
        $user->update([
            'password'=> $password
        ]);
        
        

        return response()->json([
            'success' => true,
            'message' => 'password update success',
            
            ]);

    }

    public function updateemail(Request $request)
    {
        $email = $request->email;
        $newemail = $request->newemail;
        $user = admin::where('email',$email);
        
        $user->update([
            'email'=> $newemail
        ]);
        
        

        return response()->json([
            'success' => true,
            'message' => 'email update success',
            
            ]);

    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = admin::where('email', $email)->first();
        $id = $user->id_admin;
        if (!$user) {
        return response()->json([
            'status' => 'Error',
            'message' => 'user not exist',
        ], 404);
        }

        if (!Hash::check($password, $user->password)) {
        return response()->json([
            'status' => 'Error',
            'message' => 'wrong password',
        ], 400);
        }

        $user->token = $this->jwt($user); //
        $user->save();

        return response()->json([
        'success' => true,
        'message' => 'Successfully logged in',
        'id'=>$id,
        'token'=> $user->token
        ], 200);
    }
    protected function jwt(admin $admin)
    {
    $payload = [
        'iss' => 'lumen-jwt', //issuer of the token
        'sub' => $admin->id_admin, //subject of the token
        'iat' => time(), //time when JWT was issued.
        'exp' => time() + 60 * 60 //time when JWT will expire
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //function register
    public function register(Request $request){
        $fields = $request->validate([
            'name'      => ['required','string','max:255'],
            'email'     => ['required','string','email','unique:users'],
            'password'  => ['required','string','confirmed','min:8'],
            // 'role'      => ['null']       
        ]);

        // created user
        $user = User::create([
            'name'      => $fields['name'],
            'email'     => $fields['email'],
            'password'  => bcrypt($fields['password']),
            // 'role'      => $fields['2'] 
        ]);

        // Create token
        $token = $user->createToken($request->userAgent())->plainTextToken;

        $response = [
            'msg' => 'Successfully Register!!',
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);        
    }

    //function Login
    public Function login (Request $request){
        $fields = $request->validate([            
            'email'     => ['required','string'],
            'password'  => ['required','string'],
                    
        ]);        

        //check email
        $user = User::where('email' , $fields['email'])->first();        

        //check password
        //check(12345678, $2y$10$hEU90PMUBZbyNqRpyWTLgOHrxeVu6oPILKvgVO4QJkR69ZABEdx/S)

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            
            return response()->json([
                'success' =>  false,
                'message' => 'The password is incorrect.'
            ],401);

        } else {
            // ลบ token เก่าออก แล้วค่อยสร้างใหม่
            $user->tokens()->delete();

            // Create token insert ลง ตาราง personal_access_tokens
            // $token = $user->createToken($request->userAgent(), ["2"])->plainTextToken; // created role ตอนสร้าง user เพื่่่อนำมาใช้งานกำหนดสิทธิ์ ของ User 

            $token = $user->createToken($request->userAgent())->plainTextToken;
            $response = [
                'msg' => 'Successfully login!!',
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);
        }        
    }

    // function logout
    public function logout(Request $request){

        Auth::user()->tokens()->delete();
        return [
            'msg' => 'Successfully logged out'
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;


class PassportAuthController extends Controller
{
    //
    
    
    public function registerUser(Request $request){

        $this ->validate( $request, [
            'name' => 'required|string',
            'password' => 'required|min:8',
            'gender' => 'required',
            'orientation' => 'required',
            'status' => 'required',
            'intention' => 'required',
            'age' => 'required',
            'email' => 'required|email',
            'surname' => 'required'
        ], [
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'email.required' => 'Email is required'
        ]);

        try {
        
            $user = User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'gender' => $request->gender,
                'orientation' => $request->orientation,
                'status' => $request->status,
                'intention' => $request->intention,
                'age' => $request->age,
                'email' => $request->email,
                'surname' => $request->surname
            ]);
        
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            if($codigoError == 1062) {
                return response()->json([
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }

        }

        $token = $user -> createToken('LaravelAuthApp') -> accessToken;
        return response()->json(['token' => $token], 200);

    }

    public function loginUser(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($data)){
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
            
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request){

        //idle...does nothing.......
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\User;

class UserController extends Controller
{
    //

    public function showAllUsers(){

        try {
            
            return User::all();

        } catch(QueryException $error) {
            return $error;
        }
    }

    public function showProfile(Request $request){

        $id = $request->input('id');

        try {

            return User::all()->where('id', '=', $id)
            ->makeHidden(['password'])->keyBy('id');

        } catch (QueryException $error) {
            return $error;
        }
    }
    

    public function registerUser(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:8',
            'gender' => 'required',
            'orientation' => 'required',
            'status' => 'required',
            'intention' => 'required',
            'age' => 'required',
            'email' => 'required|email'
        ], [
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'email.required' => 'Email is required'
        ]);

        try {
        
            return User::create($validatedData);
        
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            if($codigoError == 1062) {
                return response()->json([
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }

        }

    }

    public function updateProfile(Request $request){

        $id = $request->input('id');

        $validatedUpdate = $request->validate([
            'id' => 'required',
            'email' => 'required|min:8',
            'name' => 'required|string',
            'gender' => 'required',
            'orientation' => 'required',
            'status' => 'required',
            'intention' => 'required',
            'age' => 'required',
            'surname' => 'required'
        ], [
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'email.required' => 'Email is required'
        ]);

        try {
            return User::where('id', '=', $id)
                    ->update($validatedUpdate);

        } catch (QueryException $error) {
            $eCode = $error->errorInfo[1];

            if($eCode == 1062) {
                return response()->json([
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }
        }
    }    
}

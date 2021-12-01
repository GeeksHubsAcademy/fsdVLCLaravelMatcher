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

        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $orientation = $request->input('orientation');
        $status = $request->input('status');
        $intention = $request->input('intention');
        $age = $request->input('age');
        $surname = $request->input('surname');

        try {
            
            return User::create(
                [
                    'email' => $email,
                    'name' => $name,
                    'password' => $password,
                    'gender' => $gender,
                    'orientation' => $orientation,
                    'status' => $status,
                    'intention' => $intention,
                    'age' => $age,
                    'surname' => $surname
                ]
                );
        
        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            if($codigoError == 1062) {
                return response()->json([
                    'error' => "E-mail ya registrado anteriormente"
                ]);
            }

        }

    }
}

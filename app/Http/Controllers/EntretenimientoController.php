<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entretenimiento;

use Illuminate\Database\QueryException;

class EntretenimientoController extends Controller
{
    //

    public function addAficion(Request $request){

        $iduser = $request->input('iduser');
        $idhobbie = $request->input('idhobbie');

        try {

            Entretenimiento::create(
                [
                    'iduser' => $iduser,
                    'idhobbie' => $idhobbie
                ]
            );

        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];

            return response()->json([
                'error' => $codigoError
            ]);
        }
    }

    public function showAficionProfile(Request $request){
        $id = $request->input('id');

        try {

            return Entretenimiento::selectRaw('hobbies.descripcion, users.email, users.name')
            ->join('users', 'entretenimientos.iduser', '=', 'users.id')
            ->join('hobbies', 'entretenimientos.idhobbie', '=', 'hobbies.id')
            ->where('entretenimientos.iduser', '=', $id)
            ->get();
           
        } catch (QueryException $error) {
            return $error;
        }
    }
}

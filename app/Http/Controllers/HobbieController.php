<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hobbie;
use Illuminate\Database\QueryException;

class HobbieController extends Controller
{
    //

    public function addHobbie(Request $request) {

        $descripcion = $request->input('descripcion');

        try {

            Hobbie::create(
                [
                    'descripcion' => $descripcion
                ]
            );

        } catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            return response()->json([
                'error' => $codigoError
            ]);
        }

    }
}

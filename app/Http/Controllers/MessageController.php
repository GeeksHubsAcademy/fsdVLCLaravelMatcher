<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    //

    public function addMessage(Request $request){

        $body = $request->input('body');
        $idusuario = $request->input('idusuario');

        try {

            return Message::create(
                [
                    'body' => $body,
                    'idusuario' => $idusuario
                ]
                );

        } catch (QueryException $error) {
            $codigoError = $error->errorInfo[1];

            
                return response()->json([
                    'error' => $codigoError
                ]);
            
        }

    }

    public function showAllMessages(){

        try {
            
            return Message::all();

        } catch(QueryException $error) {
            return $error;
        }
        
    }

    public function showMessagesProfile(Request $request){
        $id = $request->input('id');

        try {

            return Message::selectRaw('messages.body AS mensajito , users.name AS nombre, users.intention AS buscando, users.age')
            ->join('users', 'messages.idusuario', '=', 'users.id')
            ->where('messages.idusuario', '=', $id)
            ->orderBy('messages.created_at', 'ASC')
            ->get();
           
            

        } catch (QueryException $error) {
            return $error;
        }
    }

    public function deleteMessage(Request $request){
        $id = $request->input('id');

        $mensajeEncontrado = Message::where('id', '=', $id);

        if(!$mensajeEncontrado){
            return response() ->json([
                'success' => false,
                'message' => 'Message not found',
            ], 400);
        }

        if($mensajeEncontrado -> delete()){

            return response() ->json([
                'success' => true,
                'message' => 'Message deleted',
            ], 200);

        } else {
            return response() ->json([
                'success' => false,
                'message' => 'Message can not be deleted',
            ], 500);
        }
    }
    
}

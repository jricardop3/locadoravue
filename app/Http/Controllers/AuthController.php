<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        //autenticação por e-mail e senha
        $credenciais = $request->all(['email', 'password']);
        //retornar um JWT
        $token = auth('api')->attempt($credenciais);
        if ($token){
            return response(['Token' => $token]);
        }
        
        return response(['Erro' => 'Usuario ou senha invalido!'], 403);
    }
    public function logout(){
        auth('api')->logout();
        return response()->json(['msg'=>'Logout Efetuado com sucesso, bye']);
    }
    public function refresh(){
         /** @var \Tymon\JWTAuth\JWTGuard $authGuard */ 
 
         $authGuard = auth('api');
         $token = $authGuard->refresh();
        return response()->json(['token'=>$token]);
    }
    public function me(){

          return response()->json(auth()->user());
    }
}

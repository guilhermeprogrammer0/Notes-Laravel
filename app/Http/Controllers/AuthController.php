<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginSubmit(Request $request){
        $request->validate(
            //rules
            [
                'text_username'=>'required|email',
                'text_password'=>'required|min:6|max:16'
            ],
            //mensagens
            [
                'text_username.required'=> 'O username é obrigatório',
                'text_username.email'=> 'O username deve ser um email válido',
                'text_password.required'=> 'O pasasword é obrigatório',
                'text_password.min'=> 'O password deve ter pelo menos :min caracteres',
                'text_password.max'=>'O password deve ter no máximo :max caracteres'
            ]
            );
        $username = $request->input('text_username');
        $password = $request->input('text_password');
        /*try{
            DB::connection()->getPdo();
            echo "Conexão em sucesso!";
        }
        catch(\PDOException $e){
            echo "ERRO ao conectar a base: " .$e->getMessage();

        }*/
       /* $UserModel = new User();
        $users = $UserModel->all()->toArray();
        echo "</pre>";
        print_r($users);
    }
    public function logout(){
        echo "logout";
    }*/
    $user = User::where('username',$username)
                ->where('deleted_at',NULL)
                ->first();

    if(!$user){
        return redirect()->back()->withInput()->with('loginError','Username ou password incorretos.');
    }

    if(!password_verify($password,$user->password)){
        return redirect()->back()->withInput()->with('loginError','Username ou password incorretos.');
    }

    $user->last_login = date('Y-m-d H:i:s');
    $user->save();
    echo "Ok!";
    session([
        'user'=>[
        'id'=> $user->id,
        'username'=> $user->username
   ] ]);
}
}

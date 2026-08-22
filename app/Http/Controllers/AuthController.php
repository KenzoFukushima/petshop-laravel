<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login () {
        return view('login');
    }

    public function loginSubmit(Request $request) {
        $request->validate(
            [
                'emailUser' => 'required|min:8',
                'passwordUser' => 'required|min:6',
            ],
            [
                'emailUser.required' => 'O campo email é obragatório',
                'emailUser.email' => 'Email inválido.',
                'emailUser.min' => 'Precisa ter no mínimo 8 caracteres',

                'passwordUser.required' => 'O campo senha é obrigatório.',
                'passwordUser.min' => 'Precisa ter no mínimo 6 caracteres',

            ]
        );

        $emailUser = $request->input('emailUser');
        $password = $request->input('passwordUser');
        
        $user = User::where('email', $emailUser)->whereNull('deleted_at')->first();

        if(!$user){
            return redirect()->back()
                    ->withInput()
                    ->with('login_error','Username ou password incorretos!');
        } else {
            if(!password_verify($password,$user->password)){
                return redirect()->back()
                        ->withInput()
                        ->with('login_error','Username ou password incorretos!');
            }
        }
        
        $user->last_login = date('Y-m-d H:i:s');
        $user->save(); //Persistir no BD
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
        ]);


       return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dono;
use App\Models\Pet;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login () {
        return view('login');
    }

    public function index()
{
    return view('dashboard', [
        'totalDonos' => Dono::count(),
        'totalPets' => Pet::count(),
    ]);
}

    public function loginSubmit(Request $request) {
        $request->validate(
            [
                'emailUser' => 'required|email|min:8',
                'passwordUser' => 'required',
            ],
            [
                'emailUser.required' => 'O campo email é obrigatório.',
                'emailUser.email' => 'Email inválido.',
                'emailUser.min' => 'Precisa ter no mínimo 8 caracteres.',

                'passwordUser.required' => 'O campo senha é obrigatório.',
            ]
        );

        $emailUser = $request->input('emailUser');
        $password = $request->input('passwordUser');
        

        $user = User::where('email', $emailUser)->whereNull('deleted_at')->first();

        if(!$user){
            return redirect()->back()
                    ->withInput()
                    ->with('login_error','E-mail ou password incorretos!');
        }

        if(!password_verify($password, $user->password)){
            return redirect()->back()
                    ->withInput()
                    ->with('login_error','E-mail ou password incorretos!');
        }
        
        $user->last_login = date('Y-m-d H:i:s');
        $user->save(); 

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
        ]);

        return redirect('/');
    }

    public function logout(){
        session()->forget('user');
        return redirect()->route('login');
    }

}

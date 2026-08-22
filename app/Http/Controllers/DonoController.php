<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dono;
use App\Services\Operations;

class DonoController extends Controller
{
    public function index()
    {
        $donos = Dono::all();

        return view('listaDono', [
            'donos' => $donos
        ]);
    }

    public function newDono()
    {
        return view('new_dono', [
            'titulo' => 'Cadastrar Dono',
            'descricao' => 'Cadastre um novo dono para o Pet Shop.',
            'action' => route('newDonoSubmit'),
            'botao' => 'Cadastrar Dono',
            'cancelUrl' => route('listaDono'),
        ]);
    }

    public function newDonoSubmit(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:100',
            'email' => 'required|email|max:100',
            'telefone' => 'required|max:20',
            'cpf' => 'nullable|max:14',
            'endereco' => 'nullable|max:255',
        ]);

        $dono = new Dono();

        $dono->nome = $request->nome;
        $dono->email = $request->email;
        $dono->telefone = $request->telefone;
        $dono->cpf = $request->cpf;
        $dono->endereco = $request->endereco;

        $dono->save();

        return redirect()->route('listaDono');
    }

    public function editDono($id)
    {
        $decrypted_id = Operations::decryptId($id);

        $dono = Dono::find($decrypted_id);

        if (!$dono) {
            return redirect()->route('listaDono');
        }

        return view('edit_dono', [
            'dono' => $dono,
            'titulo' => 'Editar Dono',
            'descricao' => 'Altere os dados do dono abaixo.',
            'action' => route('edit.dono.submit'),
            'botao' => 'Salvar alterações',
            'cancelUrl' => route('listaDono'),
        ]);
    }

    public function editDonoSubmit(Request $request)
    {
        if ($request->dono_id === null) {
            return redirect()->route('listaDono');
        }

        $request->validate([
            'nome' => 'required|min:2|max:100',
            'email' => 'required|email|max:100',
            'telefone' => 'required|max:20',
            'cpf' => 'nullable|max:14',
            'endereco' => 'nullable|max:255',
        ]);

        $id = Operations::decryptId($request->dono_id);

        $dono = Dono::find($id);

        if (!$dono) {
            return redirect()->route('listaDono');
        }

        $dono->nome = $request->nome;
        $dono->email = $request->email;
        $dono->telefone = $request->telefone;
        $dono->cpf = $request->cpf;
        $dono->endereco = $request->endereco;

        $dono->save();

        return redirect()->route('listaDono');
    }

    public function deleteDono($id)
    {
        $decrypted_id = Operations::decryptId($id);

        $dono = Dono::find($decrypted_id);

        if (!$dono) {
            return redirect()->route('listaDono');
        }

        $dono->delete();

        return redirect()->route('listaDono');
    }
}
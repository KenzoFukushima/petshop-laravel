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

    private function formatarCpf($cpf)
    {
        
        $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpfLimpo) !== 11) {
            return $cpf;
        }

        return sprintf(
            '%s%s%s.%s%s%s.%s%s%s-%s%s',
            ...str_split($cpfLimpo)
        );
    }
    public function newDono()
    {
        return view('new_dono', [
            'titulo' => 'Cadastrar Dono',
            'descricao' => 'Cadastre um novo dono para o Pet Shop.',
            'action' => route('newDonoSubmit'),
            'botao' => 'Cadastrar Dono',
            'cancelUrl' => route('telaListaDono'),
        ]);
    }

    public function newDonoSubmit(Request $request)
    {
        $request->validate([
                'nome' => 'required|min:2|max:100',
                'email' => 'required|email|min:8|max:100',
                'telefone' => 'required|max:20',
                'cpf' => 'nullable|max:14|min:11',
                'endereco' => 'nullable|max:255',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.min' => 'O nome é no mínimo 2 caracteres',
                'email.required' => 'O Email é obrigatório',
                'email.email' => 'Email inválido.',
                'email.min' => 'Precisa ter no mínimo 8 caracteres.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
                'cpf.max' => 'O CPF inválido',
                'cpf.min' => 'O CPF inválido',
                'endereco.max' => 'O endereço deve ter no máximo 255 caracteres.',
            ]
        );
        $dono = new Dono();

        $dono->nome = $request->nome;
        $dono->email = $request->email;
        $dono->telefone = $request->telefone;
        $dono->cpf = $request->cpf ? $this->formatarCpf($request->cpf) : null;

        $dono->endereco = $request->endereco;

        $dono->save();

        return redirect()->route('telaListaDono');
    }

    public function editDono($id)
    {
        $decrypted_id = Operations::decryptId($id);

        $dono = Dono::find($decrypted_id);

        if (!$dono) {
            return redirect()->route('telaListaDono');
        }

        return view('edit_dono', [
            'dono' => $dono,
            'titulo' => 'Editar Dono',
            'descricao' => 'Altere os dados do dono abaixo.',
            'action' => route('edit.dono.submit'),
            'botao' => 'Salvar alterações',
            'cancelUrl' => route('telaListaDono'),
        ]);
    }

    public function editDonoSubmit(Request $request)
    {
        if ($request->dono_id === null) {
            return redirect()->route('telaListaDono');
        }

        $request->validate([
                'nome' => 'required|min:2|max:100',
                'email' => 'required|email|min:8|max:100',
                'telefone' => 'required|max:20',
                'cpf' => 'nullable|max:14',
                'endereco' => 'nullable|max:255',
            ],
            [
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.min' => 'O nome é no mínimo 2 caracteres',
                'email.email' => 'Email inválido.',
                'telefone.required' => 'O campo telefone é obrigatório.',
                'telefone.max' => 'O telefone deve ter no máximo 20 caracteres.',
                'cpf.max' => 'O CPF inválido',
                'cpf.min' => 'O CPF inválido',
                'endereco.max' => 'O endereço deve ter no máximo 255 caracteres.',
            ]
        );

        $id = Operations::decryptId($request->dono_id);

        $dono = Dono::find($id);

        if (!$dono) {
            return redirect()->route('telaListaDono');
        }

        $dono->nome = $request->nome;
        $dono->email = $request->email;
        $dono->telefone = $request->telefone;
        $dono->cpf = $request->cpf ? $this->formatarCpf($request->cpf) : null;
        $dono->endereco = $request->endereco;

        $dono->save();

        return redirect()->route('telaListaDono');
    }

    public function deleteDono($id)
    {
        $decrypted_id = Operations::decryptId($id);

        $dono = Dono::find($decrypted_id);

        if (!$dono) {
            return redirect()->route('telaListaDono');
        }

        $dono->delete();

        return redirect()->route('telaListaDono');
    }
}
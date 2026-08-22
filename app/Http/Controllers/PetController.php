<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Dono;
use App\Services\Operations;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class PetController extends Controller
{
    public function newPet($id_dono)
    {
        $decrypted_id = Operations::decryptId($id_dono);

        $dono = Dono::find($decrypted_id);

        if (!$dono) {
            return redirect()->route('home');
        }

        return view('pets.new_pet', [
            'dono' => $dono,
            'id_dono' => $id_dono
        ]);
    }

    public function newPetSubmit(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:100',
            'especie' => 'required|min:2|max:50',
            'raça' => 'nullable|max:100',
            'peso' => 'nullable|numeric',
            'idade' => 'nullable|integer|min:0',
        ], [
            'nome.required' => 'O nome do pet é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',
            'especie.required' => 'A espécie é obrigatória.',
            'especie.min' => 'A espécie deve ter pelo menos :min caracteres.',
            'especie.max' => 'A espécie deve ter no máximo :max caracteres.',
            'raça.max' => 'A raça deve ter no máximo :max caracteres.',
            'peso.numeric' => 'O peso deve ser um número.',
            'idade.integer' => 'A idade deve ser um número inteiro.',
            'idade.min' => 'A idade não pode ser negativa.',
        ]);

        $id_dono = Operations::decryptId($request->id_dono);

        $pet = new Pet();
        $pet->id_dono = $id_dono;
        $pet->nome = $request->nome;
        $pet->especie = $request->especie;
        $pet->raça = $request->raça;
        $pet->peso = $request->peso;
        $pet->idade = $request->idade;
        $pet->save();

        return redirect()->route('home');
    }

    public function editPet($id)
    {
        $decrypted_id = Operations::decryptId($id);

        $pet = Pet::find($decrypted_id);

        return view('pets.edit_pet', ['pet' => $pet]);
    }

    public function editPetSubmit(Request $request)
    {
        if ($request->pet_id === null) {
            return redirect()->route('home');
        }

        $request->validate([
            'nome' => 'required|min:2|max:100',
            'especie' => 'required|min:2|max:50',
            'raça' => 'nullable|max:100',
            'peso' => 'nullable|numeric',
            'idade' => 'nullable|integer|min:0',
        ], [
            'nome.required' => 'O nome do pet é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',
            'especie.required' => 'A espécie é obrigatória.',
            'especie.min' => 'A espécie deve ter pelo menos :min caracteres.',
            'especie.max' => 'A espécie deve ter no máximo :max caracteres.',
            'raça.max' => 'A raça deve ter no máximo :max caracteres.',
            'peso.numeric' => 'O peso deve ser um número.',
            'idade.integer' => 'A idade deve ser um número inteiro.',
            'idade.min' => 'A idade não pode ser negativa.',
        ]);

        // Desencriptar o ID
        $id = Operations::decryptId($request->pet_id);

        // Carregar o pet
        $pet = Pet::find($id);

        if (!$pet) {
            return redirect()->route('home');
        }

        $pet->nome = $request->nome;
        $pet->especie = $request->especie;
        $pet->raça = $request->raça;
        $pet->peso = $request->peso;
        $pet->idade = $request->idade;
        $pet->save();

        return redirect()->route('home');
    }

    public function deletePet($id)
    {
        try {
            $decrypted_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return 'Estou excluindo o pet com ID = ' . $decrypted_id;
    }
}
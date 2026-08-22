<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Dono;
use App\Services\Operations;

class PetController extends Controller
{

    public function index()
    {
        $pets = Pet::all();

        return view('listaPet', [
            'pets' => $pets
        ]);
    }
    public function newPet($id_dono)
    {
        $decrypted_id = Operations::decryptId($id_dono);
        $dono = Dono::find($decrypted_id);

        if (!$dono) {
            return redirect()->route('home');
        }

        return view('pets.new_pet', [
            'dono' => $dono,
            'id_dono' => $id_dono,
        ]);
    }

    public function newPetSubmit(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:100',
            'especie' => 'required|max:50',
            'raça' => 'nullable|max:100',
            'peso' => 'nullable|numeric',
            'idade' => 'nullable|date',
        ], [
            'nome.required' => 'O nome do pet é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',
            'especie.required' => 'A espécie é obrigatória.',
            'especie.max' => 'A espécie deve ter no máximo :max caracteres.',
            'raça.max' => 'A raça deve ter no máximo :max caracteres.',
            'peso.numeric' => 'O peso deve ser um número.',
            'idade.date' => 'A data deve ser válida.',
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

        return redirect()->route('dono.show', [
            'id' => $request->id_dono
        ]);
    }

    public function editPet($id)
    {
        $decrypted_id = Operations::decryptId($id);
        $pet = Pet::with('dono')->find($decrypted_id);

        if (!$pet) {
            return redirect()->route('home');
        }

        return view('pets.edit_pet', ['pet' => $pet]);
    }

    public function editPetSubmit(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:100',
            'especie' => 'required|max:50',
            'raça' => 'nullable|max:100',
            'peso' => 'nullable|numeric',
            'idade' => 'nullable|date',
        ], [
            'nome.required' => 'O nome do pet é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',
            'especie.required' => 'A espécie é obrigatória.',
            'especie.max' => 'A espécie deve ter no máximo :max caracteres.',
            'raça.max' => 'A raça deve ter no máximo :max caracteres.',
            'peso.numeric' => 'O peso deve ser um número.',
            'idade.date' => 'A data deve ser válida.',
        ]);

        $id = Operations::decryptId($request->pet_id);
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

        return redirect()->route('dono.show', [
            'id' => Operations::encryptId($pet->id_dono)
        ]);
    }

    public function deletePet($id)
    {
        $decrypted_id = Operations::decryptId($id);
        $pet = Pet::find($decrypted_id);

        if ($pet) {
            $id_dono = $pet->id_dono;
            $pet->delete();

            return redirect()->route('dono.show', [
                'id' => Operations::encryptId($id_dono)
            ]);
        }

        return redirect()->route('home');
    }

    public function show($id)
    {
        $decrypted_id = Operations::decryptId($id);

        $dono = Dono::with('pets')->find($decrypted_id);

        if (!$dono) {
            return redirect()->route('donos.index');
        }

        return view('donos.show', [
            'dono' => $dono
        ]);
    }
}
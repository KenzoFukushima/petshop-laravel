@extends('layout.cadastro')

@section('form-fields')

    {{-- Dono --}}
    <div class="mb-3">

        <label for="id_dono" class="form-label fw-semibold">
            Dono
        </label>

        <input
            type="text"
            id="dono_pesquisa"
            class="form-control @error('id_dono') is-invalid @enderror"
            list="lista-donos"
            placeholder="Pesquise pelo nome do dono"
            value="{{ old('dono_nome', isset($dono) ? $dono->nome : '') }}"
            autocomplete="off"
        >

        <datalist id="lista-donos">

            @foreach ($donos as $donoItem)

                <option
                    value="{{ $donoItem->nome }}"
                    data-id="{{ $donoItem->id }}"
                >

            @endforeach

        </datalist>

        <input
            type="hidden"
            name="id_dono"
            id="id_dono"
            value="{{ old('id_dono', isset($id_dono) ? $id_dono : '') }}"
        >

        @error('id_dono')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Nome --}}
    <div class="mb-3">

        <label for="nome" class="form-label fw-semibold">
            Nome do pet
        </label>

        <input
            type="text"
            name="nome"
            id="nome"
            class="form-control @error('nome') is-invalid @enderror"
            value="{{ old('nome') }}"
            placeholder="Digite o nome do pet"
            required
        >

        @error('nome')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Espécie --}}
    <div class="mb-3">

        <label for="especie" class="form-label fw-semibold">
            Espécie
        </label>

        <select
            name="especie"
            id="especie"
            class="form-select @error('especie') is-invalid @enderror"
            required
        >

            <option value="">
                Selecione a espécie
            </option>

            <option value="Cachorro" {{ old('especie') == 'Cachorro' ? 'selected' : '' }}>
                Cachorro
            </option>

            <option value="Gato" {{ old('especie') == 'Gato' ? 'selected' : '' }}>
                Gato
            </option>

            <option value="Ave" {{ old('especie') == 'Ave' ? 'selected' : '' }}>
                Ave
            </option>

            <option value="Coelho" {{ old('especie') == 'Coelho' ? 'selected' : '' }}>
                Coelho
            </option>

        </select>

        @error('especie')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Raça --}}
    <div class="mb-3">

        <label for="raça" class="form-label fw-semibold">
            Raça
        </label>

        <input
            type="text"
            name="raça"
            id="raça"
            class="form-control @error('raça') is-invalid @enderror"
            value="{{ old('raça') }}"
            placeholder="Digite a raça"
        >

        @error('raça')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Peso --}}
    <div class="mb-3">

        <label for="peso" class="form-label fw-semibold">
            Peso (kg)
        </label>

        <input
            type="number"
            name="peso"
            id="peso"
            step="0.01"
            min="0"
            class="form-control @error('peso') is-invalid @enderror"
            value="{{ old('peso') }}"
            placeholder="Ex.: 12.50"
        >

        @error('peso')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Data de nascimento --}}
    <div class="mb-3">

        <label for="idade" class="form-label fw-semibold">
            Data de nascimento
        </label>

        <input
            type="date"
            name="idade"
            id="idade"
            class="form-control @error('idade') is-invalid @enderror"
            value="{{ old('idade') }}"
        >

        @error('idade')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    <script>
        const donoPesquisa = document.getElementById('dono_pesquisa');
        const idDono = document.getElementById('id_dono');
        const opcoesDono = document.querySelectorAll('#lista-donos option');

        donoPesquisa.addEventListener('input', function () {

            idDono.value = '';

            opcoesDono.forEach(function (opcao) {

                if (opcao.value === donoPesquisa.value) {
                    idDono.value = opcao.dataset.id;
                }

            });

        });
    </script>

@endsection
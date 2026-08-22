@extends('layout.main_layout')

@section('page-title')
    Donos
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3>Lista de Donos</h3>
        <p class="text-muted mb-0">
            Cadastros de clientes do PetShop
        </p>
    </div>

    <a href="#" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>
        Novo Dono
    </a>

</div>


<div class="card shadow-sm">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($donos as $dono)

                    <tr>

                        <td>
                            <i class="fas fa-user me-2 text-primary"></i>
                            {{ $dono->nome }}
                        </td>

                        <td>
                            {{ $dono->email }}
                        </td>

                        <td>
                            {{ $dono->telefone }}
                        </td>

                        <td>
                            {{ $dono->cpf ?? 'Não informado' }}
                        </td>

                        <td>
                            <a href="#"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#"
                               class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
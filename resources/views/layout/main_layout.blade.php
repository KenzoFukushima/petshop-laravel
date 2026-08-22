<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PetShop</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

</head>

<body class="bg-light">

    <div class="d-flex">

        {{-- MENU LATERAL --}}
        <div class="bg-primary text-white p-3 vh-100 border-end" style="width: 240px; position: fixed;">

            {{-- Logo --}}
            <div class="text-center mb-5">

                <h4>
                    <i class="fas fa-paw"></i>
                    PETSHOP
                </h4>

                <small class="text-secondary">
                    SYSTEM
                </small>

            </div>


            {{-- Menu --}}
            <div class="d-grid gap-2">

                <a href="{{ route('dashboard') }}" class="btn btn-primary text-start text-white">

                    <i class="fas fa-home me-2"></i>
                    Dashboard

                </a>


                <a href="{{ route('telaListaDono') }}" class="btn btn-primary text-start text-white">

                    <i class="fas fa-users me-2"></i>
                    Donos

                </a>


                <a href="{{ route('telaListaPet') }}" class="btn btn-primary text-start text-white">

                    <i class="fas fa-paw me-2"></i>
                    Pets

                </a>

            </div>


            {{-- Sair --}}
            <div class="position-absolute bottom-0 start-0 p-3" style="width: 240px;">

                <a href="{{ route('logout') }}" class="btn btn-danger text-start w-100 texto-red">

                    <i class="fas fa-sign-out-alt me-2"></i>
                    Sair

                </a>

            </div>

        </div>


        {{-- ÁREA PRINCIPAL --}}
        <div style="margin-left: 240px; width: calc(100% - 240px);">


            {{-- TOPO --}}
            <nav class="navbar bg-white shadow-sm px-4">

                <div>

                    <h5 class="mb-0">
                        @yield('page-title')
                    </h5>

                </div>


                <div>

                    <span class="text-muted">
                        <i class="fas fa-user me-1"></i>
                        {{ session('user')['username'] }}
                    </span>

                </div>

            </nav>


            {{-- CONTEÚDO --}}
            <main class="p-4">

                @yield('content')

            </main>


        </div>

    </div>


    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}">
    </script>

</body>
</html>
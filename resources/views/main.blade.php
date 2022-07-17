<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        .div-loading {
            position: fixed;
            z-index: 99999;
            height: 100%;
            width: 100%;
            background: #000000b3;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <title>@yield('title')</title>

</head>
<body>

    <header class="container">
        <div class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4 fw-bold"><span class="text-primary ">Sisteminha</span>Saúdinha</span>
            </a>

            <nav>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'map' ? 'active' : ''}}" {{$navLink == 'patients' ? 'aria-current="page"' : ''}}>Mapa de Internação</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'peoples' ? 'active' : ''}}" {{$navLink == 'peoples' ? 'aria-current="page"' : ''}}>Pessoas</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'reception' ? 'active' : ''}}" {{$navLink == 'reception' ? 'aria-current="page"' : ''}}>Recepção</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'attendance' ? 'active' : ''}}" {{$navLink == 'attendance' ? 'aria-current="page"' : ''}}>Atendimento</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'appointment' ? 'active' : ''}}" {{$navLink == 'appointment' ? 'aria-current="page"' : ''}}>Consulta</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'outpatient' ? 'active' : ''}}" {{$navLink == 'outpatient' ? 'aria-current="page"' : ''}}>Ambulatório</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'surgery' ? 'active' : ''}}" {{$navLink == 'surgery' ? 'aria-current="page"' : ''}}>Cirurgias</a></li>
                    <li class="nav-item"><a href="{{route('people.index')}}" class="nav-link {{$navLink == 'professionals' ? 'active' : ''}}" {{$navLink == 'professionals' ? 'aria-current="page"' : ''}}>Profissionais</a></li>
                </ul>
            </nav>

        </div>
    </header>

    <div data-backdrop="static" class="div-loading" id="div-loading">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <main class="mx-5 my-5">

        <div class="container-fluid bg-primary py-2 pl-10 rounded-top">
            <h1 class="text-white fs-4">@yield('title')</h1>
        </div>

        <div class="border border-primary rounded-bottom">

            <div class="p-3">

                @yield('content')

            </div>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('js/helper.js')}}" type="text/javascript"></script>

    @yield('scripts')

    <script>

        @if (Session::has('success'))
            Swal.fire({
                title: "{{ Session::pull('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @elseif (Session::has('error'))
            Swal.fire({
                title: "{{ Session::pull('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

    </script>

</body>
</html>

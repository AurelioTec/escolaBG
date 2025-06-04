<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Favio Aurelio, GuitHub: AurelioTec">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/blade/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/scriptTop.js') }}"></script>
    <style>
        :root {
            --sidebar-width: 250px;
            --top-nav-height: 56px;
            --primary-color: #343a40;
            /* Cor principal do site */
            --secondary-color: #6c757d;
            /* Cor secundária */
        }

        body {
            padding-top: 0;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        .card-body i {
            transition: transform 0.2s ease-in-out;
        }

        .card-body:hover i {
            transform: scale(1.2);
        }

        /* Layout principal */
        .app-container {
            display: flex;
            flex: 1;
            width: 100%;
            margin-top: var(--top-nav-height);
        }

        /* Menu lateral */
        .lateral {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
            background-color: var(--primary-color);
            color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-brand {
            padding: 1rem 1rem 0.5rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand img {
            height: 40px;
            width: auto;
        }

        .sidebar-brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
        }

        .user-name {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-top: 3px;
        }

        /* Navbar */
        .main-navbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--top-nav-height);
            z-index: 1030;
            background-color: var(--primary-color);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: left 0.3s ease;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }

        /* Conteúdo principal */
        .main-content {
            flex: 1;
            min-height: calc(100vh - var(--top-nav-height));
            overflow-y: auto;
            padding: 20px;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s ease;
            background-color: #fff;
        }

        .nav-link img {
            border-radius: 50%;
            object-fit: cover;
        }

        /* Barra de rolagem personalizada */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Botão de toggle para sidebar */
        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.25rem;
            padding: 0.5rem;
            cursor: pointer;
            margin-right: 10px;
        }

        .navbar-actions {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Responsividade */
        @media (max-width: 992px) {
            :root {
                --sidebar-width: 220px;
            }
        }

        /* Melhorias para DataTables */
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_length {
            padding: 10px 0;
        }

        .sair :hover {
            color: #3498db;
            text-decoration: none;
            transition: 0.3s;
        }

        /* Ajustes para modais */
        .modal-dialog {
            margin: 1rem auto;
        }

        #modalContent {
            transition: opacity 0.3s ease;
        }

        .modal-loading #modalContent {
            opacity: 0.5;
            pointer-events: none;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
    <script>
        $(document).ready(function() {

            if ($.fn.dataTable.isDataTable('.tabela')) {
                $('.tabela').DataTable().destroy();
            }

            $('.tabela').DataTable({
                "responsive": true,
                "pageLength": 5 // Define o número de registros por página
            });
            $('#provincia').change(function() {
                var provinciaId = $(this).val();
                if (provinciaId) {
                    $.ajax({
                        url: 'aluno/municipios/' + provinciaId,
                        type: 'GET',
                        success: function(data) {
                            $('#municipio').empty().append(
                                '<option value="" disabled>Selecione um Município</option>'
                            );
                            $('#cidade').empty().append(
                                '<option value="" disabled>Selecione a cidade</option>'
                            );

                            $.each(data, function(key, municipio) {
                                $('#municipio').append('<option value="' + municipio
                                    .id + '">' + municipio.muninome + '</option>');
                                $('#cidade').append('<option value="' + municipio.id +
                                    '">' + municipio.muninome + '</option>');
                            });
                            $('#municipio').prop('disabled', false);
                            $('#cidade').prop('disabled', false);
                        }
                    });
                } else {
                    $('#municipio').empty().append('<option value="">Selecione um município</option>').prop(
                        'disabled', true);
                    $('#cidade').empty().append('<option value="">Selecione a cidade</option>').prop(
                        'disabled', true);
                }
            });
            /*
                        function buscarAluno($id) {
                            var alunoId = $id; // Pega o ID armazenado no atributo data-id
                            // Aqui você pode fazer uma requisição AJAX para buscar as informações no banco de dados
                            $.ajax({
                                url: 'aluno/inscriao/' + alunoId,
                                alunoId, // Rota que irá buscar as informações do aluno (ajuste conforme sua rota)
                                method: 'GET',
                                success: function(response) {
                                     alert(response.id);
                                    if (response && response.id) {
                                        // Preenchendo os campos do modal com os dados do aluno
                                        $('#alunoId').val(response.id);
                                        $('#Genero').text(response.genero);
                                        $('#nomeAluno').text(response.nomealuno);
                                        $('#nomeluno').val(response.nomealuno);
                                        $('#dataNascimento').text(response.datanascimento);
                                        var foto = response.foto ? '/img/upload/aluno/' + response.foto :
                                            'default-foto.jpg';
                                        $('.foto-aluno').attr('src', foto);

                                        $('#alunoid').val(response.id);
                                        $('#Generos').text(response.genero);
                                        $('#nomeAlunos').text(response.nomealuno);
                                        $('#nomelunos').val(response.nomealuno);
                                        $('#dataNascimentos').text(response.datanascimento);
                                    }
                                },
                                error: function() {

                                }
                            });

                        }
            */

            $(document).ready(function() {
                // Usar delegação de eventos para elementos dinâmicos
                $(document).on('click', '[id^="matriculaid"]', function(e) {
                    e.preventDefault();
                    var alunoId = $(this).data('id');
                    buscarAluno(alunoId);
                });

                // Função para buscar aluno
                function buscarAluno(id) {
                    $.ajax({
                        url: 'aluno/inscriao/' + id,
                        method: 'GET',
                        beforeSend: function() {
                            // Limpar campos enquanto carrega
                            $('#Genero, #nomeAluno, #dataNascimento').text('Carregando...');
                            $('.foto-aluno').attr('src', 'default-foto.jpg');
                        },
                        success: function(response) {
                            if (response && response.id) {
                                // Preencher os campos do modal
                                $('#alunoId').val(response.id);
                                $('#Genero').text(response.genero || 'Não informado');
                                $('#nomeAluno').text(response.nomealuno || 'Não informado');
                                $('#nomeluno').val(response.nomealuno || '');
                                $('#dataNascimento').text(response.datanascimento ||
                                    'Não informado');

                                var foto = response.foto ? '/img/upload/aluno/' + response
                                    .foto : 'default-foto.jpg';
                                $('.foto-aluno').attr('src', foto);

                                // Abrir o modal após carregar os dados
                                $('#Matricula').modal('show');
                            } else {
                                Swal.fire('Erro', 'Dados do aluno não encontrados', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Erro', 'Falha ao carregar dados do aluno', 'error');
                            console.error('Erro na requisição:', xhr.responseText);
                        }
                    });
                }
            });

            // Evento para capturar o clique na âncora
            $('#confirmar').on('click', function() {
                buscarAluno($(this).data('id'));
            });


            // Função corrigida para carregar a turma
            function carregarTurma(classe, periodo) {
                if (classe && periodo) { // Usando "&&" para verificar ambas as condições
                    $.ajax({
                        url: 'aluno/turmas/' + classe + '/' + periodo,
                        type: 'GET',
                        success: function(data) {
                            // Limpando os selects antes de carregar
                            $('#turma').empty().append('<option value="" disabled>Turma</option>');
                            $.each(data, function(key, turma) {
                                $('#turma').append('<option value="' + turma.id + '">' + turma
                                    .descricao + '</option>');
                                $('#turmas').append('<option value="' + turma.id + '">' + turma
                                    .descricao + '</option>');
                            });
                        } // Fechando o parêntese corretamente
                    });
                }
            }

            // Ação quando o modal Matricula for exibido
            $('#Matricula').on('shown.bs.modal', function() {
                // Função chamada inicialmente quando o modal for exibido
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();

                // Chama a função com os valores iniciais
                carregarTurma(classe, periodo);

                // Evento de mudança no campo "classe"
                $('#classe').change(function() {
                    classe = $(this).val(); // Atualiza o valor de "classe"
                    carregarTurma(classe, periodo); // Chama a função com o novo valor de "classe"
                });

                // Evento de mudança no campo "periodo"
                $('#periodo').change(function() {
                    periodo = $(this).val(); // Atualiza o valor de "periodo"
                    carregarTurma(classe, periodo); // Chama a função com o novo valor de "periodo"
                });
            });
            // Ação quando o modal Confirmação for exibido
            $('#Confirmar').on('shown.bs.modal', function() {
                // Função chamada inicialmente quando o modal for exibido
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();

                // Chama a função com os valores iniciais
                carregarTurma(classe, periodo);

                // Evento de mudança no campo "classe"
                $('#classe').change(function() {
                    classe = $(this).val(); // Atualiza o valor de "classe"
                    carregarTurma(classe, periodo); // Chama a função com o novo valor de "classe"
                });

                // Evento de mudança no campo "periodo"
                $('#periodo').change(function() {
                    periodo = $(this).val(); // Atualiza o valor de "periodo"
                    carregarTurma(classe, periodo); // Chama a função com o novo valor de "periodo"
                });
            });

            // Função corrigida para carregar a turma
            function getTurma(classe, periodo) {
                if (classe && periodo) { // Usando "&&" para verificar ambas as condições
                    $.ajax({
                        url: 'relatorio/turma/' + classe + '/' + periodo,
                        type: 'GET',
                        success: function(data) {
                            // Limpando os selects antes de carregar
                            $('#Turma').empty().append('<option value="" disabled>Turma</option>');
                            $.each(data.turma, function(key, turma) {
                                $('#Turma').append('<option value="' + turma.descricao + '">' +
                                    turma
                                    .descricao + '</option>');
                                if (index === 0 && turma.sala) {
                                    $('#sala').val(turma.sala);
                                }
                            });
                        } // Fechando o parêntese corretamente
                    });
                }
            }
            $('#getTurma').on('shown.bs.modal', function() {
                // Função chamada inicialmente quando o modal for exibido
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();
                // Chama a função com os valores iniciais
                getTurma(classe, periodo);

                // Evento de mudança no campo "classe"
                $('#classe').change(function() {
                    classe = $(this).val(); // Atualiza o valor de "classe"
                    getTurma(classe, periodo); // Chama a função com o novo valor de "classe"
                });

                // Evento de mudança no campo "periodo"
                $('#periodo').change(function() {
                    periodo = $(this).val(); // Atualiza o valor de "periodo"
                    getTurma(classe, periodo); // Chama a função com o novo valor de "periodo"
                });
            });
            $('#pesquisar').on('click', function(e) {
                e.preventDefault(); // Impede a submissão tradicional do formulário
                var sala = $('#sala').val();
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();
                var turma = $('#turmaMatricula').val();
                var anoletivo = $('#Anolectivo').val();

            });
        });

        $(document).ready(function() {
            // Função corrigida para carregar a turma
            function getAlunoTurma(classe, periodo) {

                if (classe && periodo) { // Usando "&&" para verificar ambas as condições
                    $.ajax({
                        url: 'matricula/alunoturma/' + classe + '/' + periodo,
                        type: 'GET',
                        success: function(data) {
                            // Limpando os selects antes de carregar
                            $('#turmaMatricula').empty().append(
                                '<option value="" disabled>Turma</option>');
                            $.each(data.turmas, function(index, turma) {
                                $('#turmaMatricula').append('<option value="' + turma
                                    .descricao + '">' +
                                    turma.descricao + '</option>');
                                $('sala').val(turma.salas);
                            });
                        } // Fechando o parêntese corretamente
                    });
                }
            }
            $('#getAlunoTurma').on('shown.bs.modal', function() {
                // Função chamada inicialmente quando o modal for exibido
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();

                // Chama a função com os valores iniciais
                getAlunoTurma(classe, periodo);

                // Evento de mudança no campo "classe"
                $('#classe').change(function() {
                    classe = $(this).val(); // Atualiza o valor de "classe"
                    getAlunoTurma(classe, periodo); // Chama a função com o novo valor de "classe"
                });

                //Evento de mudança no campo "periodo"
                $('#periodo').change(function() {
                    periodo = $(this).val(); // Atualiza o valor de "periodo"
                    getAlunoTurma(classe, periodo); // Chama a função com o novo valor de "periodo"
                });
            });

            $('#pesquisar').on('click', function(e) {
                e.preventDefault(); // Impede a submissão tradicional do formulário
                var sala = $('#sala').val();
                var classe = $('#classe').val();
                var periodo = $('#periodo').val();
                var turma = $('#turma').val();
                var anoletivo = $('#Anolectivo').val();
            });
        });

        $(document).on('click', '.btn-alterar', function() {
            var id = $(this).data('id'); // Pega o ID do botão clicado
            $('#idmatricula').val(id); // Preenche o campo oculto no modalstra o ID em um <span> por exemplo
        });
        // Função corrigida para carregar a turma
        function alterarResultado() {
            var id = $(this).data('id');
            $('#exibeId').text(id);
            $.ajax({
                url: '/matricula/alteresultado',
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // se Laravel
                },
                data: {
                    idmatricula: $('#idmatricula').val(),
                    numatricula: $('#numatricula').val(),
                    resultado: $('#resultado').val()
                },
                success: function(response) {
                    if (response.status === 'sucesso') {
                        Swal.fire('Sucesso', response.mensagem, 'success');
                        $('#alterResultado').modal('hide');
                        location.reload();
                    } else {
                        Swal.fire('Erro', response.mensagem, 'error').then(() => {
                            // Fechar o modal (assumindo que está usando Bootstrap Modal)
                            $('#alterResultado').modal('hide');

                            // Atualizar a página
                            location.reload();
                        });


                    }
                },
                error: function(xhr) {
                    console.error('Erro na requisição', xhr);
                }
            });
        }
    </script>
</head>

<body>
    <!-- Menu Lateral -->
    <nav class="lateral" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('img/blade/logo.png') }}" alt="Logo">
            <div class="sidebar-brand-text">
                <a class="nav-link" href="{{ route('home') }}">
                    <h1 class="brand-title">{{ config('app.name', 'Laravel') }} </h1>
                </a>
                @auth
                    <span class="user-name">{{ Auth::user()->name }}</span>
                @endauth
            </div>
        </div>
        <ul class="nav flex-column px-2">
            @include('base.menu')
        </ul>
    </nav>

    <!-- Navbar Principal -->
    <nav class="main-navbar navbar navbar-expand">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>

        <div class="navbar-actions">
            @if (Auth::check() && $funcionario && $funcionario->foto)
                <a class="nav-link" href="{{ route('utilizador.perfil') }}">
                    <img src="{{ asset('img/upload/funcio/' . $funcionario->foto) }}" height="30" width="30"
                        alt="Imagem do Usuário" class="rounded-circle">
                </a>
            @else
                <a class="nav-link" href="{{ route('utilizador.perfil') }}">
                    <img src="{{ asset('img/blade/logo.png') }}" height="30" width="30" alt="Logo"
                        class="rounded-circle">
                </a>
            @endif
            <a class="nav-link text-white sair" href="{{ route('sair') }}">Sair</a>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="app-container">
        <main class="main-content" id="mainContent">
            @yield('conteudo')
        </main>
    </div>

    @include('sweetalert::alert')

    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Controlar o toggle da sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const navbar = document.querySelector('.main-navbar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // Estado inicial do sidebar (aberto por padrão)
            let sidebarOpen = true;

            // Função para alternar o sidebar
            function toggleSidebar() {
                sidebarOpen = !sidebarOpen;

                if (sidebarOpen) {
                    sidebar.style.transform = 'translateX(0)';
                    navbar.style.left = 'var(--sidebar-width)';
                    mainContent.style.marginLeft = 'var(--sidebar-width)';
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    navbar.style.left = '0';
                    mainContent.style.marginLeft = '0';
                }
            }

            // Evento de clique no toggle
            sidebarToggle.addEventListener('click', toggleSidebar);

            // Ajustar layout quando a janela for redimensionada
            window.addEventListener('resize', function() {
                if (window.innerWidth <= 768 && sidebarOpen) {
                    toggleSidebar();
                } else if (window.innerWidth > 768 && !sidebarOpen) {
                    toggleSidebar();
                }
            });

        });
    </script>
</body>

</html>

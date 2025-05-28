@extends('base.app')
@section('titulo')
    -Aluno/turma
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-4 m-0">
            <div class=" text-center d-inline-flex justify-content-center align-items-center gap-4">
                <h5 id="printClasse">Classe:{{ $header->turma->classe }}</h5>
                <h5 id="printTurma">Turma:{{ $header->turma->descricao }}</h5>
                <h5 id="printPeriodo">Periodo:{{ $header->turma->periodo }}</h5>
                <h5>Sala:{{ $header->turma->sala }}</h5>
                <h5>Ano Lectivo:{{ $header->turma->anolectivo }}</h5>
            </div>
            <div class="align-itens-right">
                <a href="{{ route('relatorio.turmaluno', ['imprimir' => 'OK', 'turma' => $header->turma->descricao, 'classe' => $header->turma->classe, 'periodo' => $header->turma->periodo, 'anoletivo' => $header->turma->anolectivo]) }}"
                    class="btn btn-primary text-light" target="_blank" title="imprimir lista de aluno por turma">
                    <i class="fa fa-print"></i>
                </a>

                <a href="#getAlunoTurma" data-bs-toggle="modal" data-bs-target="#getAlunoTurma"
                    class="btn btn-warning text-light" title="Pesquisar alunos por turma">
                    <i class="fa fa-search"></i>
                </a>
            </div>
        </div>
        <hr class="mb-0">
        <table id="tabAlunoTurma" class="display tabela pt-2" style=" width:100%;">
            <thead>
                <tr>
                    <th>Ord.</th>
                    <th>Nº Matricula</th>
                    <th>Nome Completo</th>
                    <th>Idade</th>
                    <th>Genero</th>
                    <th>Obs</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp

                @foreach ($alunos as $aluno)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $aluno->numatricula }}</td>
                        <td>
                            <a href="{{ route('perfil.aluno', Crypt::encrypt($aluno->inscricaos_id)) }}"
                                class="text-dark text-decoration-none" title="Clicar para ver o perfil do aluno">
                                {{ $aluno->inscricao->nomealuno }}
                            </a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($aluno->inscricao->datanascimento)->age }}</td>
                        <td>{{ $aluno->inscricao->genero }}</td>
                        <td>{{ 'Aluno ' . $aluno->tipomatricula }}</td>
                        <td>
                            @if ($aluno->resultado === NULL)
                                <button type="button" data-bs-toggle="modal" data-bs-target="#alterResultado"
                                    data-id="{{ $aluno->id }}" class="btn btn-warning btn-alterar btn-sm">
                                    Sem resultado
                                </button>
                            @elseif ($aluno->resultado === 'Não apto')
                                <button type="button" data-bs-toggle="modal" data-bs-target="#alterResultado"
                                    data-id="{{ $aluno->id }}"
                                    class="btn btn-danger btn-alterar  btn-sm">
                                    {{ $aluno->resultado }}
                                </button>
                            @else 
                                <button type="button" data-bs-toggle="modal" data-bs-target="#alterResultado"
                                    data-id="{{ $aluno->id }}"
                                    class="btn btn-success btn-alterar  btn-sm">
                                    {{ $aluno->resultado }}
                                </button>
                            @endif
                            <button type="button" data-bs-toggle="modal" data-bs-target="#alterResultado"
                                data-id="{{ $aluno->id }}" class="btn btn-primary btn-alterar  btn-sm">
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Modal Pesquisar aluno turma -->
    <div class="modal fade " id="getAlunoTurma" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-lg tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Buscar aluno/turma</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form action="{{ route('relatorio.turmaluno') }}" id="FormAlunoTurma" method="GET"
                            class="row g-3">
                            @csrf
                            <input type="hidden" name="sala" id="sala">
                            <div class="col-3">
                                <label for="classe" class="form-label">Classe</label>
                                <select id="classe" class="form-control" name="classe" required>
                                    <option value="7ª">7ª</option>
                                    <option value="8ª">8ª</option>
                                    <option value="9ª">9ª</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="periodo" class="form-label">Período</label>
                                <select id="periodo" class="form-control" name="periodo" required>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="turma" class="form-label">Turma</label>
                                <select class="form-select" id="turmas" name="turma" required>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="anolectivo" class="form-label">Ano Letivo</label>
                                <select id="anolectivo" class="form-control" name="anolectivo" required>
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal resultado final -->
    <div class="modal fade " id="alterResultado" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-sm tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Alterar resultado final</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <form class="row g-3" method="post" onsubmit="event.preventDefault(); alterarResultado();">
                            @csrf
                            <input type="hidden" id="idmatricula" name="idmatricula">
                            <div class="col-12">
                                <label for="resultado" class="form-label">Resultado</label>
                                <select id="resultado" class="form-control" name="resultado" required>
                                    <option value="Apto">Aprovado</option>
                                    <option value="Não Apto">Reprovado</option>
                                </select>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function acessoNegado() {
            Swal.fire({
                icon: 'warning',
                title: 'Acesso negado',
                text: 'Você não tem permissão para aprovar matricula',
            });
        }

        function infoAprovado() {
            Swal.fire({
                icon: 'warning',
                title: 'Atenção',
                text: 'A matricula ja se encontra aprovada!',
            });
        }
        /*  function confirmar(url) {
              Swal.fire({
                  icon: "warning",
                  title: "Tem certeza que deseja confrimar a matricula!??",
                  showDenyButton: true,
                  showConfirmButton: true,
                  confirmButtonText: "Sim",
                  denyButtonText: `Não`
              }).then((result) => {
                  if (result.isConfirmed) {
                      fetch(url, {
                              method: 'GET',
                              headers: {
                                  'Accept': 'application/json', // Definindo que esperamos uma resposta JSON
                                  'X-Requested-With': 'XMLHttpRequest' // Tornar a requisição AJAX
                              }
                          }).then(response => response.json()) // Converter a resposta para JSON
                          .then(data => {
                              // Processar a resposta do servidor
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Sucesso',
                                  text: 'Matricula aprovada com sucesso!',
                              }); 
                              location.reload();// Exibe a mensagem de sucesso
                              // Aqui você pode atualizar a página ou realizar outras ações
                          })
                  } 
              });
          }*/

        function editar(valor) {
            $('#id').val(valor.id);
            $('#nome').val(valor.nome);
            $('#nagente').val(valor.nagente);
            $('#datanascimento').val(valor.datanascimento);
            $('#categoria').val(valor.categoria);
            $('#genero').val(valor.genero);
            $('#habilitacao').val(valor.habilitacao);
            $('#telf').val(valor.telf);
            $('#funcao').val(valor.funcao);
            $('#email').val(valor.user.email);
        }

        function limpar() {
            $('#nome').val("");
            $('#nagente').val("");
            $('#datanascimento').val("");
            $('#categoria').val("");
            $('#genero').val("");
            $('#habilitacao').val("");
            $('#telf').val("");
            $('#funcao').val("");
        }
    </script>
    </main>
@endsection

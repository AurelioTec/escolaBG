@extends('base.app')
@section('titulo')
    -Maticula
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-4 m-0">
            <h4 class="mb-0">Lista alunos matriculados</h4>
            <div class="align-items-right">
                <a href="#getAlunoTurma" data-bs-toggle="modal" data-bs-target="#getAlunoTurma"
                    class="btn btn-warning text-light" title="Pesquisar aluno por turma">
                    <i class="fa fa-search"></i>
                </a>
                <a href="{{ route('aluno.cadastrar') }}" class="btn btn-success text-light" title="Matricular novo aluno">
                    <i class="fa fa-circle-plus"></i>
                </a>
            </div>
        </div>
        <hr class="mb-0">
        <table id="tabMatricula" class="display tabela pt-2" style=" width:100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nº de Matricula</th>
                    <th>Nome</th>
                    <th>Turma</th>
                    <th>Periodo</th>
                    <th>Sala</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($matriculados as $matri)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $matri->numatricula }}</td>
                        <td><a href="{{ route('perfil.aluno', Crypt::encrypt($matri->inscricaos_id)) }}"
                                class="text-dark text-decoration-none" title="Clicar para ver o perfil do aluno">
                                {{ $matri->inscricao->nomealuno }}
                            </a></td>
                        <td>{{ $matri->turma->codigo }}</td>
                        <td>{{ $matri->turma->periodo }}</td>
                        <td>{{ $matri->turma->sala }}</td>
                        <td>{{ $matri->estado }}</td>
                        <td>
                            @php

                            @endphp

                            @if (Auth::check() &&
                                    (Auth::user()->tipo === 'Admin' || Auth::user()->tipo === 'Diretor' || Auth::user()->tipo === 'Pedagogico'))
                                @switch($matri->estado)
                                    @case('Pendente')
                                        <a href="{{ route('matricula.confirmar', Crypt::encrypt($matri->id)) }}"
                                            class="btn text-success" title="Aprovar matricula">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                    @break

                                    @case('Aprovada')
                                        <a href="#" data-bs-toggle="modal" onclick="infoAprovado()" class="btn text-success"
                                            title="Aprovar matricula">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                    @break
                                @endswitch
                            @else
                                <a href="#" data-bs-toggle="modal" onclick="acessoNegado()" class="btn text-success"
                                    title="Aprovar matricula">
                                    <i class="fa fa-check-circle"></i>
                                </a>
                            @endif
                            <a href="{{ route('relatorio.ficha', [$matri->turma->anolectivo, Illuminate\Support\Facades\Crypt::encryptString($matri->id)]) }}"
                                class="btn text-primary" target="_blank" rel="noopener noreferrer"
                                title="Imprimir ficha de matricula">
                                <i class="fa fa-print"></i>
                            </a>
                            <a href="{{ asset('storage/' . $matri->anexo) }}" class="btn text-warning" target="_blank"
                                rel="noopener noreferrer" title="Baixar o anexo">
                                <i class="fa fa-paperclip"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Matricula -->
    <div class="modal fade " id="Matricula" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Matricular aluno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="container-fluid">
                        <div class="aluno-perfil d-flex align-items-center mb-4 p-3 border rounded">
                            <img src="" alt="Foto do Aluno" class="foto-aluno rounded-circle me-3" width="100"
                                height="100">
                            <div>
                                <h5 class="mb-1"><strong>Nome:</strong> <span id="nomeAluno"></span></h5>
                                <p class="mb-0"><strong>Gênero:</strong> <span id="Genero"></span></p>
                                <p class="mb-0"><strong>Data de Nascimento:</strong> <span id="dataNascimento"></span>
                                </p>

                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('aluno.matricular') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="alunoId" id="alunoId">
                            <input type="hidden" name="nomeAluno" id="nomeluno">
                            <input type="hidden" name="anoletivo" id="anoletivo">
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
                                <select class="form-select" id="turma" name="turma" required>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="lestrangeira" class="form-label">L.Estrangeira</label>
                                <select class="form-select" id="lestrangeira" name="lestrangeira" required>
                                    <option value="Inglês">Inglês</option>
                                    <option value="Francês">Francês</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label for="encarregado" class="form-label">Encarregado</label>
                                <input type="text" class="form-control" id="encarregado" name="encarregado"
                                    maxlength="120">
                            </div>

                            <div class="col-6">
                                <label for="telfencarregado" class="form-label">Telf.Encarregado</label>
                                <input type="tel" class="form-control" id="telfencarregado" name="telfencarregado"
                                    maxlength="15">
                            </div>

                            <div class="col-md-8">
                                <label for="anexo" class="form-label">Anexar(*certificado,*termos, boletim de nota) em
                                    PDF max 2MB</label>
                                <input type="file" class="form-control" id="anexo" name="anexo">
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-primary">Matricular</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                                <label for="turmaMatricula" class="form-label">Turma</label>
                                <select class="form-select" id="turmaMatricula" name="turma" required>
                                </select>
                            </div>

                            <div class="col-3">
                                <label for="Anolectivo" class="form-label">Ano Letivo</label>
                                <select id="Anolectivo" class="form-control" name="anolectivo" required>

                                    <option value="{{ $ultimoAno }}">{{ $ultimoAno }}</option>
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

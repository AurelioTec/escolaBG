@extends('base.app')
@section('titulo')
    -Turmas
@endsection
@section('conteudo')
    <div class="container bg-light">
        <div class="card-header d-flex justify-content-between align-items-center pt-5">
            <h4 class="mb-0">Lista de turmas</h4>
            <a href="#"
               class="btn btn-success text-light" title="Atualizar mini pauta">
                <i class="fa fa-refresh"></i>
            </a>
        </div>
        <hr class="mb-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabelaNotas">
                <thead class="table-dark">
                <tr>
                    <th rowspan="2" class="text-center bg-secondary ">Nº</th>
                    <th rowspan="2" class="text-center bg-secondary ">Nome do Aluno</th>
                    <th colspan="3" class="text-center bg-secondary ">1º Trimestre</th>
                    <th colspan="3" class="text-center bg-secondary ">2º Trimestre</th>
                    <th colspan="3" class="text-center bg-secondary ">3º Trimestre</th>
                    <th rowspan="2" class="text-center bg-secondary ">MFD</th>
                    <th rowspan="2" class="text-center bg-secondary ">Ações</th>
                </tr>
                <tr>
                    <!-- 1º Trimestre -->
                    <th class="bg-info">MAC</th>
                    <th class="bg-info">NPT</th>
                    <th class="bg-info">MT1</th>

                    <!-- 2º Trimestre -->
                    <th class="bg-warning">MAC</th>
                    <th class="bg-warning">NPT</th>
                    <th class="bg-warning">MT2</th>

                    <!-- 3º Trimestre -->
                    <th class="bg-success">MAC</th>
                    <th class="bg-success">NPT</th>
                    <th class="bg-success">MT3</th>
                </tr>
                </thead>

                <tbody id="corpoTabela">
                @php
                    $i = 1;
                @endphp
                @foreach( $alunos as $aluno)
                    <tr>
                        <td class="bg-secondary-subtle text-center">{{ $i++ }}</td>
                        <td class="bg-secondary-subtle ">{{ $aluno->inscricao->nomealuno}}</td>
                        <td name="mac1" class="bg-info text-dark">12</td>
                        <td name="npt1" class="bg-info text-dark">19</td>
                        <td name="mt1" class="bg-info text-primary">17</td>
                        <td name="mac2" class="bg-warning text-dark">10</td>
                        <td name="npt2" class="bg-warning text-dark">14</td>
                        <td name="mt2" class="bg-warning text-primary">12</td>
                        <td name="mac3" class="bg-success text-dark">18</td>
                        <td name="npt3" class="bg-success text-dark">16</td>
                        <td name="mt3" class="bg-success text-primary">17</td>
                        <td name="mfd" class="bg-primary-subtle text-center text-primary">15</td>
                        <td class="bg-secondary-subtle text-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#alterResultado"
                                    data-id="{{ Crypt::encrypt($aluno->id) }}" class="btn btn-warning  btn-sm"
                                    title="Editar notas">
                                <i class="fa fa-edit"> </i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <!-- Os dados serão inseridos aqui via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Matricula -->
    <div class="modal fade " id="alterResultado" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg tela" role="document">
            <div class="modal-content bg-light">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitleId">Lançar notas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div id="loadingIndicator" class="text-center py-5" style="display: none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                        <p class="mt-2">Carregando dados do aluno...</p>
                    </div>
                    <div id="modalContent">
                        <div class="container-fluid">
                            <div class="aluno-perfil d-flex align-items-center mb-4 p-3 border rounded">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="" alt="Foto do Aluno" class="foto-aluno rounded-circle me-3"
                                                     width="100" height="100">
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <h5 class="mb-1"><strong>Nome:</strong> <span id="nomeAluno"></span>
                                                    </h5>
                                                    <p class="mb-0"><strong>Gênero:</strong> <span id="Genero"></span>
                                                    </p>
                                                    <p class="mb-0"><strong>idade:</strong> <span
                                                            id="dataNascimento"></span>
                                                    </p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <h5 class=""><strong>Turma:</strong> <span
                                                                id="nomeAluno"></span></h5>
                                                        <p class=""><strong>Classe:</strong> <span
                                                                id="Genero"></span>
                                                        </p>
                                                        <p class=""><strong>Periodo:</strong> <span
                                                                id="dataNascimento"></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <form action="{{ route('aluno.matricular') }}" method="POST"
                                              enctype="multipart/form-data"
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
                                                <select class="form-select" id="lestrangeira" name="lestrangeira"
                                                        required>
                                                    <option value="Inglês">Inglês</option>
                                                    <option value="Francês">Francês</option>
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label for="encarregado" class="form-label">Encarregado</label>
                                                <input type="text" class="form-control" id="encarregado"
                                                       name="encarregado"
                                                       maxlength="120">
                                            </div>

                                            <div class="col-6">
                                                <label for="telfencarregado" class="form-label">Telf.Encarregado</label>
                                                <input type="tel" class="form-control" id="telfencarregado"
                                                       name="telfencarregado" maxlength="15">
                                            </div>

                                            <div class="col-md-8">
                                                <label for="anexo" class="form-label">Anexar(*certificado,*termos,
                                                    boletim
                                                    de nota)
                                                    em
                                                    PDF max 2MB</label>
                                                <input type="file" class="form-control" accept="application/pdf"
                                                       id="anexo"
                                                       name="anexo">
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="submit" class="btn btn-primary">Matricular</button>
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <script>
            function editar(valor) {
                $('#id').val(valor.id);
                $('#classe').val(valor.classe);
                $('#codigo').val(valor.codigo);
                $('#descricao').val(valor.descricao);
                $('#periodo').val(valor.periodo);
                $('#sala').val(valor.sala);
                $('#anolectivo').val(valor.anolectivo);
                $('#submit').text('Salvar');
                $('#modalTitleId').text("Editar turma");
            }

            function limpar() {
                $('#id').val("");
                $('#classe').val("");
                $('#codigo').val("");
                $('#descricao').val("");
                $('#periodo').val("");
                $('#sala').val("");
                $('#anolectivo').val("");
            }
        </script>
        </main>
@endsection

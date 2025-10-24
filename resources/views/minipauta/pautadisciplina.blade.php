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
                    <th rowspan="2"class="text-center bg-secondary ">Nº</th>
                    <th rowspan="2"class="text-center bg-secondary ">Nome do Aluno</th>
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
                        <td name="npt3"  class="bg-success text-dark">16</td>
                        <td name="mt3"  class="bg-success text-primary">17</td>
                        <td name="mfd" class="bg-primary-subtle text-center text-primary">15</td>
                        <td class="bg-secondary-subtle text-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#alterResultado"
                                    data-id="{{ $aluno->id }}" class="btn btn-warning btn-alterar btn-sm" title="Editar notas">
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

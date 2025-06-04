@extends('base.app')
@section('titulo')
    -Home
@endsection
@section('conteudo')
    <div class="container bg-light py-4">
        <div class="row g-3">
            <!-- Card Component (Reusable Style) -->
            @php
                $cards = [
                    ['icon' => 'graduation-cap', 'color' => 'info', 'title' => 'Total Matrículas', 'value' => $total],
                    [
                        'icon' => 'check-circle',
                        'color' => 'success',
                        'title' => 'Alunos por Matricular',
                        'value' => $inscriPendente,
                    ],
                    ['icon' => 'hourglass-half', 'color' => 'warning', 'title' => 'Novas', 'value' => $MatriNova],
                    [
                        'icon' => 'chalkboard-teacher',
                        'color' => 'danger',
                        'title' => 'Aluno / Turma',
                        'value' => "$total / $totalTurmasDif",
                    ],
                    [
                        'icon' => 'chalkboard-teacher',
                        'color' => 'primary',
                        'title' => 'Total de Turmas',
                        'value' => $totalTurmas,
                    ],
                    [
                        'icon' => 'users',
                        'color' => 'dark',
                        'title' => 'Turmas com Alunos',
                        'value' => $turmaAlunosMatri,
                    ],
                    ['icon' => 'person-dress', 'color' => 'pink', 'title' => 'Feminino', 'value' => $countG],
                    ['icon' => 'male', 'color' => 'primary', 'title' => 'Masculino', 'value' => $total - $countG],
                    [
                        'icon' => 'user-friends',
                        'color' => 'warning',
                        'title' => 'Total de Vagas',
                        'value' => $totalVagasRestantes,
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="card text-center shadow-sm border-0">
                        <div class="card-body py-3">
                            <div class="mb-2">
                                <i class="fas fa-{{ $card['icon'] }} text-{{ $card['color'] }} fa-2x"></i>
                            </div>
                            <h6 class="fw-bold mb-1">{{ $card['title'] }}</h6>
                            <p class="mb-0 text-muted" style="font-size: 0.85rem">{{ $card['value'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

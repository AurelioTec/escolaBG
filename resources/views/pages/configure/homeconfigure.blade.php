@extends('base.app')
@section('titulo')
    -Configure
@endsection
@section('conteudo')
    <div class="container bg-light py-4">
        <div class="row g-3">
            <!-- Card Component (Reusable Style) -->
            @php
                $cards = [
                    [
                        'icon' => 'cog',
                        'color' => 'white-50',
                        'title' => 'Configuração Inicial',
                        'link' => 'configure.ini'
                    ],
                    [
                        'icon' => 'users',
                        'color' => 'white-50',
                        'title' => 'Utilizador',
                        'link' => 'utilizador.lista'
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="col-6 col-sm-4 col-md-3">

                    <div class="card text-center shadow-sm border-0">
                        <a href="{{ route($card['link'])}}" class="text-decoration-none text-dark">
                            <div class="card-body py-3">
                                <div class="mb-2">
                                    <i class="fa fa-{{$card['icon']}} aria-hidden="true" text-{{ $card['color'] }}></i>
                                </div>
                                <h6 class="fw-bold mb-1">{{ $card['title'] }}</h6>
                                <p class="mb-0 text-muted" style="font-size: 0.85rem"></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

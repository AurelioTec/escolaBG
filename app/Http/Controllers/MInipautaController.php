<?php

namespace App\Http\Controllers;

use App\Models\Funcionarios;
use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;

class MInipautaController extends Controller
{

public function index($idTurma){

   $idturma= decrypt($idTurma);
    $userId = Auth::id();
    $funcionario = Funcionarios::where('Users_id', $userId)->first();


    //  Buscar os alunos matriculados na turma
    $alunos = Matricula::where('turmas_id', $idturma)
        ->with('inscricao')
        ->get()
        ->sortBy(fn($matricula) => $matricula->inscricao->nomealuno);

    return view('minipauta.pautadisciplina', compact('funcionario','alunos'));
}

}

<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Inscricao;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        $userId = Auth::id();
        $anoletivo = ConfigIni::orderBy('anoletivo', 'desc')
            ->pluck('anoletivo')
            ->first();
        // Total de matrículas
        $total = Matricula::whereHas('turma', function ($query) use ($anoletivo) {
            $query->where('anolectivo', $anoletivo);
        })
            ->count();
        // inscrição Pendente
        $inscriPendente = Inscricao::where('estado', 'Pendente')
            ->count();
        // Matrículas por genero
        $countG = DB::table('matriculas')
            ->join('inscricaos', 'matriculas.inscricaos_id', '=', 'inscricaos.id')
            ->join('turmas', 'matriculas.turmas_id', '=', 'turmas.id')
            ->where('inscricaos.genero', 'F')
            ->where('inscricaos.estado', 'Matriculado')
            ->where('turmas.anolectivo', $anoletivo)
            ->count('matriculas.id');

        // Matrículas do tipo "Novo"
        $MatriNova = Matricula::where('tipomatricula', 'Novo')
            ->whereHas('turma', function ($q) use ($anoletivo) {
                $q->where('anolectivo', $anoletivo);
            })
            ->count();

        // Contar o total de turmas existentes
        $totalTurmas = Turma::where('anolectivo', $anoletivo)
            ->count();

//consulta do total de vagas restates
        $vagasRestantes = DB::table('turmas')
            ->leftJoin('matriculas', 'turmas.id', '=', 'matriculas.turmas_id')
            ->select(
                'turmas.id',// ou outro campo identificador
                'turmas.limite',
                DB::raw('COUNT(matriculas.id) as total_matriculados'),
                DB::raw('(turmas.limite - COUNT(matriculas.id)) as vagas_restantes')
            )
            ->where('turmas.anolectivo', $anoletivo)
            ->groupBy('turmas.id', 'turmas.limite')
            ->get();
         $totalVagasRestantes = $vagasRestantes->sum('vagas_restantes');

        // Contar quantas turmas têm alunos matriculados
        $turmasComAlunos = Matricula::join('turmas', 'turmas.id', '=', 'matriculas.turmas_id')
            ->selectRaw('matriculas.turmas_id, COUNT(*) as total')
            ->where('turmas.anolectivo', $anoletivo)
            ->groupBy('matriculas.turmas_id')
            ->get();
        $turmaAlunosMatri = $turmasComAlunos->count();

        // Se desejar também saber a quantidade total de alunos matriculados por turma, como já estava no seu código
        $MatriPorTurma = Matricula::join('turmas', 'turmas.id', '=', 'matriculas.turmas_id')
            ->selectRaw('matriculas.turmas_id, COUNT(*) as total')
            ->where('turmas.anolectivo', $anoletivo)
            ->groupBy('matriculas.turmas_id')
            ->get();
        $porcentagem = $totalTurmas > 0 ? ($turmaAlunosMatri / $totalTurmas) * 100 : 0;
        $totalTurmasDif = Matricula::distinct('turmas_id')
            ->whereHas('turma', function ($q) use ($anoletivo) {
                $q->where('anolectivo', $anoletivo);
            })
            ->count('turmas_id');


        $funcionario = Funcionarios::where('Users_id', $userId)->first(); // Acessa o funcionário relacionado
        return view('pages.home', compact(
            'user',
            'countG',
            'funcionario',
            'total',
            'inscriPendente',
            'MatriNova',
            'porcentagem',
            'MatriPorTurma',
            'totalTurmas',
            'totalTurmasDif',
            'totalVagasRestantes',
            'turmasComAlunos',
            'turmaAlunosMatri',
        ));
    }
}

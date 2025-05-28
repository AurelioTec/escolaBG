<?php

namespace App\Http\Controllers;

use App\Helpers\Funcoes;
use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Inscricao;
use App\Models\matricula;
use App\Models\Turma;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $funcionario = Funcionarios::where('Users_id', $userId)->first();
        // Acessa o funcionário relacionado
        $ultimoAno = Configini::orderBy('anoletivo', 'desc')->first()->anoletivo;
        $matriculados = Matricula::whereHas('turma', function ($query) use ($ultimoAno) {
            $query->where('anolectivo', '=', $ultimoAno);
        })->get();
        // Pega o primeiro registro
        $config = ConfigIni::where('anoletivo', $ultimoAno)
            ->selectRaw('anoletivo, salas')
            ->get();

        $title = 'Atenção!';
        $text = "Deseja aprovar a matricula do aluno!?";
        confirmDelete($title, $text);
        return view('pages.matricula', compact('matriculados', 'funcionario', 'config', 'ultimoAno'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $matricula = null;

        if (isset($request->id)) {
            // Buscar a matrícula existente
            $matricula = Matricula::find($request->id);
        } else {
            $matricula = new Matricula();
        }

        // Verificar se o aluno já está matriculado na mesma turma
        $existeMatricula = Matricula::where('inscricaos_id', $request->alunoId)
            ->where('turmas_id', $request->turma)
            ->where('estado', 'Ativo')
            ->exists();

        if ($existeMatricula) {
            // Se já estiver matriculado, exibe mensagem de erro
            Alert::error('Erro', 'Este aluno já está matriculado nesta turma.');
            return redirect()->back();
        }

        // Verificar o número de alunos já matriculados na turma
        $numAlunos = Matricula::where('turmas_id', $request->turma)->count();
        $limitedatuma = Turma::where('id', $request->turma)->first();
        $totalvagas = $limitedatuma->limite - $numAlunos;

        if ($totalvagas == 0) {
            // Exibir mensagem se o limite foi alcançado
            Alert::error('Turma cheia', 'A turma selecionada já atingiu o limite de alunos estipulado.');
            return redirect()->back();
        }

        // Obter o ano atual e inicial do nome
        $anoAtual = date('Y');
        $inicialNome = strtoupper(substr($request->nomeAluno, 0, 1));

        // Obter o maior número de matrícula existente no ano e inicial fornecidos
        $ultimoNumMatricula = Matricula::where('numatricula', 'like', "{$anoAtual}{$inicialNome}%")
            ->orderBy('numatricula', 'desc')
            ->value('numatricula');

        $nunmatricula = Funcoes::gerarNumeroMatricula($request->nomeAluno, $ultimoNumMatricula);

        // Tratamento de anexo
        if ($request->hasFile('anexo')) {
            $request->validate([
                'anexo' => 'required|file|mimes:pdf|max:2048',
            ]);

            $documento = $request->file('anexo');
            $extensao = $documento->extension();
            $inicialNome = strtoupper(substr($request->nomeAluno, 0, 1));
            $docNome = $request->nomeAluno . '.' . $extensao;

            $diretorio = 'docs/upload/aluno/' . $inicialNome . $nunmatricula;

            // Cria o diretório automaticamente e armazena o arquivo
            $caminho = $documento->storeAs($diretorio, $docNome, 'public');

            $matricula->anexo = $caminho; // salva o caminho completo relativo ao disco "public"
        }

        $matricula->inscricaos_id = $request->alunoId;
        $matricula->turmas_id = $request->turma;
        $matricula->lestrangeira = $request->lestrangeira;
        $matricula->encarregado = $request->encarregado;
        $matricula->telfencarregado = $request->telfencarregado;
        $matricula->tipomatricula = "Novo";
        $matricula->estado = "Pendente";
        $matricula->numatricula = $nunmatricula;
        $matricula->datamatricula = Carbon::now()->toDateString();
        $matricula->users_id = $userId;

        // Alterar o estado da inscrição e salvar matrícula
        $inscricao = Inscricao::find($request->alunoId);
        if (!$inscricao) {
            Alert::error('Erro', 'Aluno não encontrado');
            return redirect()->back();
        }

        $inscricao->estado = 'Matriculado';
        $inscricao->save();
        $matricula->save();

        if ($matricula) {
            Alert::success('Sucesso', 'Aluno matriculado com sucesso.<br>Faltam ' . $totalvagas . ' alunos para atingir o limite de vagas.');
            return redirect()->back();
        } else {
            Alert::error('Erro', 'Erro ao matricular o aluno');
            return redirect()->back();
        }
    }

    /**
     * suspender a mtricula do aluno
     *
     * @param  mixed $id
     * @return void
     */
    public function suspender($id)
    {
        $idmatricula = Crypt::decrypt($id);
        $matricula = Matricula::findOrFail($idmatricula);
        $matricula->estado = 'Suspensa';
        $matricula->save();

        if ($matricula) {
            Alert::success('Sucesso', 'Matricula suspensa com sucesso');
            return redirect()->back();
        } else {
            Alert::error('Erro', 'Erro ao suspender a matricula');
            return redirect()->back();
        }
    }

    public function confirmar($id)
    {
        $idmatricula = Crypt::decrypt($id);
        $matricula = Matricula::find($idmatricula);
        if (!$matricula) {
            Alert::success('Erro', 'Numero de Matricula não encontrada');
            return redirect()->back();
        } else {
            $matricula->estado = 'Aprovada';
            $matricula->save();
            Alert::success('Sucesso', 'Matricula aprovada com sucesso');
            return redirect()->back();;
        }
    }

    public function alterarResultado(Request $request)
    {
        $request->validate([
            'idmatricula' => 'required|exists:matriculas,id',
            'resultado' => 'required|in:Apto,Não Apto'
        ]);

        $matricula = Matricula::find($request->idmatricula);
        if (!$matricula) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => 'Número de matrícula não encontrado.',
            ], 404); // Código HTTP 404 (não encontrado)
        }

        if ($matricula->id)
            $matricula->resultado = $request->resultado;
        if ($matricula->save()) {
            return response()->json([
                'status' => 'sucesso',
                'mensagem' => 'Resultado alterado com sucesso.',
                'valor' => $matricula->resultado
            ]);
        }
    }

    /**
     * getTurmas
     *
     * @param  mixed $classe
     * @param  mixed $periodo
     * @return void
     */
    public function getTurmas($classe, $periodo)
{
    // Obter o ano letivo atual (mais recente)
    $anoAtual = ConfigIni::orderBy('anoletivo', 'desc')
        ->value('anoletivo');
    
    // Obter todos os anos letivos distintos para dropdowns
    $todosAnos = ConfigIni::orderBy('anoletivo', 'desc')
        ->pluck('anoletivo')
        ->unique()
        ->values()
        ->all();

    // Buscar turmas filtradas
    $turmas = Turma::select('id', 'descricao', 'anolectivo', 'sala')
        ->where('classe', $classe)
        ->where('periodo', $periodo)
        ->where('anolectivo', $anoAtual) // Filtra pelo ano atual
        ->orderBy('descricao')
        ->get();

    return response()->json([
        'turmas' => $turmas,
        'anos' => $todosAnos, // Retorna array com todos os anos
        'ano_atual' => $anoAtual // Ano filtrado
    ]);
}
}
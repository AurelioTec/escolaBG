<?php

namespace App\Http\Controllers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anoletivo = ConfigIni::orderBy('anoletivo', 'desc')
            ->pluck('anoletivo')
            ->first();
        //consul para mostra as turmas cadastradas e as vagas restantes em cada turma    
        $turmas = Turma::where('anolectivo', $anoletivo)
            ->withCount(['matriculas' => function ($query) use ($anoletivo) {
                $query->where('estado', 'Aprovada') // Filtra apenas matrículas aprovadas
                    ->whereHas('turma', function ($q) use ($anoletivo) {
                        $q->where('anolectivo', $anoletivo);
                    });
            }])
            ->get()
            ->map(function ($turma) {
                $turma->vagas_restantes = $turma->limite - $turma->matriculas_count;
                return $turma;
            });

        $config = ConfigIni::where('estado', 'aberto')
            ->selectRaw('estado, anoletivo, salas')
            ->get();
        $userId = Auth::id();
        $title = 'Atenção!';
        $text = "Tens a certesa que desejas excluir a turma!?";

        confirmDelete($title, $text);
        $funcionario = Funcionarios::where('Users_id', $userId)->first();
        if (!$turmas) {
            Alert::error('danger', 'Nenhuma turma configurada no ano lectivo ' . $anoletivo);
            return redirect()->back();
        } else {
            return view('pages.turma', compact('turmas', 'config', 'funcionario'));
        }
    }


    public function store(Request $request)
    {
        //nagente 	nome 	datanascimento 	genero 	telf 	habilitacao 	categoria 	especialidade 	users_id 	foto
        $turma = null;
        if (isset($request->id)) {
            //procurar um elemento no banco de dados usar o find
            $turma = Turma::find($request->id);
        } else {
            $turma = new Turma();
        }
        $turma->classe = $request->classe;
        $turma->codigo = $request->codigo;
        $turma->descricao = $request->descricao;
        $turma->periodo = $request->periodo;
        $turma->sala = $request->sala;
        $turma->limite = $request->limite;
        $turma->anolectivo = $request->anolectivo;
        $turma->save();
        if ($turma) {
            if (isset($request->id)) {
                Alert::success('Sucesso', 'Dados da turma atualizadas');
                return redirect()->back();
            } else {
                Alert::success('Sucesso', 'Turma adicionado com sucesso');
                return redirect()->back();
            }
        } else {
            Alert::error('Error', 'Erro ao cadastrar a turma');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Turma $turmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Turma $turmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turma $turmas)
    {
        //
    }

    //função para deletar
    public function deletar($id)
    {

        Turma::find(Crypt::decrypt($id))->delete();
        Alert::success('Sucesso', 'Turma excluida!');
        return redirect()->back();
    }
}
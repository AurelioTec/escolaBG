<?php

use App\Http\Controllers\ConfigIniController;
use App\Http\Controllers\FuncionariosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PerfilAlunoController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MInipautaController;
use App\Models\ConfigIni;
use App\Models\Funcionarios;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('sair', function () {
    Auth::logout();
    return view('auth.login');
})->name('sair');

Route::group(['middleware' => "auth"], function () {


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return redirect()->route('home');
    });
    //rotas Configini

    Route::get('configure/home', [ConfigIniController::class, 'index'])->name('configure.home');
   Route::get('configure/configini',[ConfigIniController::class, 'configureIni'])->name('configure.ini');
    Route::post('configure/configini/post', [ConfigIniController::class, 'store'])->name('config.guardar');
    Route::delete('configure//encerrar/{id}', [ConfigIniController::class, 'encerrar'])->name('config.encerrar');
    //Rotas Usuarios
    Route::get('utilizador/lista', [UserController::class, 'index'])->name('utilizador.lista');
    Route::post('utilizador/cadastrar', [UserController::class, 'store'])->name('utilizador.cadastrar');
    Route::post('utilizador/updatepass', [UserController::class, 'updatePassword'])->name('utilizador.update');
    Route::post('Utilizador/updatefoto', [FuncionariosController::class, 'updateProfilePicture'])->name('utilizador.updatefoto');
    Route::get('Utlizador/perfil', [UserController::class, 'show'])->name('utilizador.perfil');
    Route::delete('Utilizador/excluir/{id}', [UserController::class, 'deletar'])->name('utilizador.excluir');
    //Rotas Funcionarios
    Route::get('funcionario', [FuncionariosController::class, 'index'])->name('funcionario');
    Route::post('funcionario', [FuncionariosController::class, 'store'])->name('funcionario.cadastrar');
    Route::delete('funcionario/excluir/{id}', [FuncionariosController::class, 'deletar'])->name('funcionario.excluir');
    //Rotas aluno
    Route::get('aluno/municipios/{id}', [InscricaoController::class, 'getMunicipios'])->name('municipios');
    Route::get('aluno/turmas/{classe}/{periodo}', [InscricaoController::class, 'getTurmas'])->name('turmas');
    Route::get('aluno/inscriao/{id}', [InscricaoController::class, 'getAlunoById'])->name('alunoId');
    Route::get('aluno', [InscricaoController::class, 'index'])->name('inscricao');
    Route::post('aluno', [InscricaoController::class, 'store'])->name('aluno.cadastrar');
    Route::get('aluno/excluir/{id}', [InscricaoController::class, 'deletar'])->name('aluno.excluir');
    Route::get('aluno/perfil/{id}', [PerfilAlunoController::class, 'show'])->name('perfil.aluno');
    //Rotas turma
    Route::get('turma', [TurmaController::class, 'index'])->name('turma');
    Route::post('turma', [TurmaController::class, 'store'])->name('turma.cadastrar');
    Route::delete('excluir/{id}', [TurmaController::class, 'deletar'])->name('turma.excluir');
    //Rotas matricula
    Route::get('matricula', [MatriculaController::class, 'index'])->name('matricula');
    Route::post('aluno/matricular', [MatriculaController::class, 'store'])->name('aluno.matricular');
    Route::get('matricula/confirmar/{id}', [MatriculaController::class, 'confirmar'])->name('matricula.confirmar');
    Route::get('matricula/suspender/{id}', [MatriculaController::class, 'suspender'])->name('matricula.suspender');
    Route::get('matricula/alunoturma/{classe}/{periodo}', [MatriculaController::class, 'getTurmas'])->name('matricula.turma');
    Route::put('matricula/alteresultado', [MatriculaController::class, 'alterarResultado'])->name('matricula.resultado');
    //Route::delete('delete/{id}', [FuncionariosController::class, 'deletar'])->name('funcionario.apagar');
    //Rotas Relatorio
    Route::get('relatorio', [RelatorioController::class, 'index'])->name('relatorio');
    Route::get('relatorio/turma/{classe}/{periodo}', [RelatorioController::class, 'getTurmas'])->name('relatorio.turma');
    Route::get('matricula/turmaluno', [RelatorioController::class, 'show'])->name('relatorio.turmaluno');
    Route::get('relatorio/ficha/{anoletivo}/{id}', [RelatorioController::class, 'getFicha'])->name('relatorio.ficha');
    Route::get('relatorio/usuario', [RelatorioController::class, 'getUser'])->name('relatorio.usuario');
    Route::get('relatorio/matricula', [RelatorioController::class, 'getMatricula'])->name('relatorio.matricula');
    Route::get('relatorio/a/', [RelatorioController::class, 'getWarningAlert'])->name('relatrio.alerta');
    //Rotas de Notas
    Route::get('minipauta/disciplina/{idTurma}',[MInipautaController::Class, 'index'])->name('minipauta.disciplina');
});


Auth::routes();

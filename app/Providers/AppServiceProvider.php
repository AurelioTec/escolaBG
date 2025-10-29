<?php

namespace App\Providers;

use App\Models\ConfigIni;
use App\Models\Funcionarios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            static $escola = null;

            if (!$escola) {
                $escola = ConfigIni::orderBy('anoletivo', 'desc')
                    ->pluck('escola')
                    ->first();
            }
            // ✅ Dados do utilizador autenticado
            $user = Auth::user();
            $userId = Auth::id();
            $funcionario = Funcionarios::where('Users_id', $userId)->first();

            // Partilhar com todas as views
            $view->with([
                'escola' => $escola,
                'funcionario' => $funcionario,
                'user' => $user,
            ]);

            // Partilhar com todas as views
            $view->with([
                'escola' => $escola,
                'user' => $user
            ]);

            $view->with('escola', $escola);
        });

        require_once app_path('Helpers/Funcoes.php');
        $this->register();

        Gate::define('Administrador', function ($user) {
            return $user->tipo === 'Admin';
        });
        Gate::define('Director', function ($user) {
            return $user->tipo === 'Diretor';
        });

        Gate::define('Pedagogico', function ($user) {
            return $user->tipo === 'Pedagogico';
        });

        Gate::define('Tecnico', function ($user) {
            return $user->tipo === 'Tecnico';
        });
    }
}

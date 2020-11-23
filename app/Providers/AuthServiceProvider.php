<?php

namespace App\Providers;

use App\Models\PermissaoModel;
use App\Models\UsuarioPermissaoModel;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(now()->addHour(1));
        Passport::refreshTokensExpireIn(now()->addDays(1));

        foreach ($this->listaPermissoes() as $permissao) {

            Gate::define(strtoupper($permissao->permissao), function($user) use($permissao) {

                $permissaoUsuario = UsuarioPermissaoModel::where('id_permissao', $permissao->id_permissao)
                                                            ->where('id_usuario', $user->id)->get();

                if($permissaoUsuario != null)
                {
                    if($permissaoUsuario->count() == 1)
                    {
                        return true;
                    }
                    return false;
                }
                return false;
            });
        }
    }

    private function listaPermissoes(){
        return PermissaoModel::all();
    }
}

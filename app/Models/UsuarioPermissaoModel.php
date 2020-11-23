<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioPermissaoModel extends Model
{
    use HasFactory;

    protected $table = 'usuario_permissao';
    protected $primaryKey = 'id_usuario_permissao';
    public $timestamps = false;
    
}

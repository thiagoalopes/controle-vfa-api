<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServidorModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_servidores';
    protected $primaryKey = 'id_servidor';
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'matricula',
        'cargo',
        'cpf',
        'data_admisssao',
        'inativo',
    ];
}

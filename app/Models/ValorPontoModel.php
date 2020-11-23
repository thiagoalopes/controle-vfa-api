<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorPontoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_valor_ponto';
    protected $primaryKey = 'id_valor_ponto';
    public $timestamps = false;

}

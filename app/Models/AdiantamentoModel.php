<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdiantamentoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_adiantamentos';
    protected $primaryKey = 'id_adiantamentos';
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\RelatorioModelImpl;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelatorioModel extends Model
{
    use HasFactory, RelatorioModelImpl;

    protected $table = 'relatorio_vfa';
    protected $primaryKey = 'id_os_fte';
    public $timestamps = false;
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeServicoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_os';
    protected $primaryKey = 'id_os';
    public $timestamps = false;
}

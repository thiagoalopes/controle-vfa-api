<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdemDeServicoServidorModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_os_fte';
    protected $primaryKey = 'id_os_fte';
    public $timestamps = false;
}

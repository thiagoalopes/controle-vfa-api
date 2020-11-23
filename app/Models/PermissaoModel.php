<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissaoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_permissao';
    protected $primaryKey = 'id_permissao';
    public $timestamps = false;
}

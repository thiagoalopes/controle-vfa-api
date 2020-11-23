<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelamentoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_parcelamentos';
    protected $primaryKey = 'id_parcelamentos';
    public $timestamps = false;
}

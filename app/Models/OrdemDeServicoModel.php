<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdemDeServicoModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_os';
    protected $primaryKey = 'id_os';
    public $timestamps = false;

    protected $fillable = [
        'num_os',
        'ano_os'
    ];

    public static function rules()
    {
        return [
            'num_os'=>'required|max:4|regex:/^[0-9]+$/',
            'ano_os'=>'required|max:4|regex:/^[0-9]+$/',
        ];
    }

    public static function messages()
    {
        return [
            'num_os.required' => 'Campo obrigatório',
            'num_os.max' => 'Limite máximo de :max números',
            'num_os.regex' => 'O :attribute só deve conter números',
            'ano_os.required' => 'Campo obrigatório',
            'ano_os.max' => 'Limite máximo de :max números',
            'ano_os.regex' => 'O :attribute só deve conter números',

        ];
    }
}


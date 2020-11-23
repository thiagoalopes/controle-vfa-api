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

    protected $fillable = [
        'valor_ponto',
        'vigente'
    ];

    public static function rules()
    {
        return [
            'valor_ponto'=>'required|regex:/^[0-9]{1,2}\.[0-9]{2}$/',
            'vigente'=>'required|in:true,false',
        ];
    }

    public static function messages()
    {
        return [
            'valor_ponto.required' => 'Campo obrigatório',
            'valor_ponto.regex' => 'O :attribute deve ter o formato entre 0,00 a 99.99',
            'vigente.required' => 'Campo obrigatório',
            'vigente.in' => 'Informe apenas um dos valores (true, false)',
        ];
    }

}

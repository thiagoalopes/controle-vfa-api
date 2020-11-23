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

    public static function rules()
    {
        return [
            'nome'=>'required|max:64|regex:/^[^0-9]+$/',
            'matricula'=>'sometimes|max:10|regex:/^[0-9]+$/|unique:tbl_servidores',
            'cargo'=>'required|in:TTE,FTE,AGENTE',
            'inativo'=>'required|in:true,false',
            'cpf'=>'required|cpf|unique:tbl_servidores',
            'data_admissao'=>'required|date_format:d/m/Y',
        ];
    }

    public static function messages()
    {
        return [
            'nome.required' => 'Campo obrigatório',
            'nome.max' => 'Limite máximo de :max caracteres',
            'nome.regex' => 'O :attribute só deve conter caracteres',
            'matricula.required' => 'Campo obrigatório',
            'matricula.regex' => 'A :attribute só deve conter números',
            'matricula.unique' => 'A :attribute já está cadastrada',
            'matricula.max' => 'Limite máximo de :max números',
            'cargo.required' => 'Campo obrigatório',
            'cargo.in' => 'Informe apenas um dos valores :attribute',
            'inativo.required' => 'Campo obrigatório',
            'inativo.in' => 'Informe apenas um dos valores (true, false)',
            'cpf.required' => 'Campo obrigatório',
            'cpf.cpf' => 'Não é um cpf válido',
            'cpf.unique' => 'O :attribute já está cadastrado',
            'data_admissao.required' => 'Campo obrigatório',
            'data_admissao.date_format' => 'Data fora do formato :format',
        ];
    }

}

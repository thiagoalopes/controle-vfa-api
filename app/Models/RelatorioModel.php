<?php

namespace App\Models;

use Params;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RelatorioModel extends Model
{
    use HasFactory;

    protected $table = 'relatorio_vfa';
    protected $primaryKey = 'id_os_fte';
    public $timestamps = false;


    public static function search($params = null)
    {
        $query = null;
        dd(self::first()->getColumnsNames());

        if(!empty($params['idServidor']))
        {
            $query = self::where('id_servidor', $params['idServidor']);
        }

        if(!empty($params['numeroOrdemDeServico']))
        {
            $numrOs = preg_split("/[\/\- ]/", $params['numeroOrdemDeServico']);
            if(count($numrOs) == 2)
            {
                $query = self::where('os', $numrOs['0'])->where('ano', $numrOs['1']);
            }
        }

        if(!empty($params['sort']))
        {
            $query = self::orderBy();
        }

        return $query->get();
    }

    private function getColumnsNames()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

}

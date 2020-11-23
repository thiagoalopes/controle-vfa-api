<?php

namespace App\Models\Traits;

trait RelatorioModelImpl
{
    public static function search($params = null)
    {
        $query = null;

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

        return $query->get();
    }
}
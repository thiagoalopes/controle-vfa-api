<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\RelatorioModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RelatorioController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::any(['RELATORIO_LER']))
        {
            return response()->json(RelatorioModel::all());
        }
        return response(null, 403);

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if(Gate::any(['RELATORIO_LER']))
        {
            return RelatorioModel::search($request->all());
        }
        return response(null, 403);
    }

}

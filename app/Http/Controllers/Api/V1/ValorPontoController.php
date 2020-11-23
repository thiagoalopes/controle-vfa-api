<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\ValorPontoModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ValorPontoController extends Controller
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
        if(Gate::any(['VALOR_PONTO_LER']))
        {
            return response()->json(ValorPontoModel::all());
        }
        return response(null, 403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::any(['VALOR_PONTO_INSERIR']))
        {
            $validator = Validator::make(
                $request->all(), ValorPontoModel::rules(), ValorPontoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $valorPonto = ValorPontoModel::create(
                $validator->valid()
            );

            return response(null, 201,
                ['Location'=>route('valor_ponto.show',['id'=>$valorPonto->id_valor_ponto])]);
        }
        return response(null, 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::any(['VALOR_PONTO_LER']))
        {
            $valorPonto = ValorPontoModel::find($id);

            if($valorPonto == null)
            {
                throw new NotFoundHttpException('Valor do ponto não encontrado');
            }

            return response()->json($valorPonto, 200);
        }
        return response(null, 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::any(['VALOR_PONTO_ATUALIZAR']))
        {
            $valorPonto = ValorPontoModel::find($id);

            if($valorPonto == null)
            {
                throw new NotFoundHttpException('Valor do ponto não encontrado');
            }

            $validator = Validator::make(
                $request->all(), $valorPonto::rules(), ValorPontoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $valorPonto->update(
                $validator->valid()
            );
            return response()->json($valorPonto, 200);
        }
        return response(null, 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::any(['VALOR_PONTO_DELETAR']))
        {
            $valorPonto = ValorPontoModel::find($id);

            if($valorPonto == null)
            {
                throw new NotFoundHttpException('Valor do ponto não encontrado');
            }

            $valorPonto->delete();

            return response(null, 200);
        }
        return response(null, 403);
    }
}

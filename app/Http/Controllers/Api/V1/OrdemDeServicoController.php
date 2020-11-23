<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\OrdemDeServicoModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdemDeServicoController extends Controller
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
        if(Gate::any(['ORDEM_SERVICO_LER']))
        {
            return response()->json(OrdemDeServicoModel::all());
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
        if(Gate::any(['ORDEM_SERVICO_INSERIR']))
        {
            $validator = Validator::make(
                $request->all(), OrdemDeServicoModel::rules(), OrdemDeServicoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $ordemDeServico = OrdemDeServicoModel::create(
                $validator->valid()
            );

            return response(null, 201,
                ['Location'=>route('ordem_servico.show',['id'=>$ordemDeServico->id_os])]);
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
        if(Gate::any(['ORDEM_SERVICO_LER']))
        {
            $ordemServico = OrdemDeServicoModel::find($id);

            if($ordemServico == null)
            {
                throw new NotFoundHttpException('Ordem de serviço não encontrada');
            }

            return response()->json($ordemServico, 200);
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
        if(Gate::any(['ORDEM_SERVICO_ATUALIZAR']))
        {
            $ordemServico = OrdemDeServicoModel::find($id);

            if($ordemServico == null)
            {
                throw new NotFoundHttpException('Ordem de serviço não encontrada');
            }

            $validator = Validator::make(
                $request->all(), OrdemDeServicoModel::rules(), OrdemDeServicoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $ordemServico->update(
                $validator->valid()
            );
            return response()->json($ordemServico, 200);
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
        if(Gate::any(['ORDEM_SERVICO_DELETAR']))
        {
            $ordemServico = OrdemDeServicoModel::find($id);

            if($ordemServico == null)
            {
                throw new NotFoundHttpException('Ordem de serviço não encontrada');
            }

            $ordemServico->delete();

            return response(null, 200);
        }
        return response(null, 403);
    }
}

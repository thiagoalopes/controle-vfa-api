<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Models\OrdemDeServicoServidorModel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdemDeServicoServidorController extends Controller
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
        if(Gate::any(['ORDEM_SERVICO_SERVIDOR_LER']))
        {
            return response()->json(OrdemDeServicoServidorModel::all());
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
        if(Gate::any(['ORDEM_SERVICO_SERVIDOR_INSERIR']))
        {
            $validator = Validator::make(
                $request->all(), OrdemDeServicoServidorModel::rules(), OrdemDeServicoServidorModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $ordemDeServicoServidor = OrdemDeServicoServidorModel::create(
                $validator->valid()
            );

            return response(null, 201,
                ['Location'=>route('ordem_servico_servidor.show',['id'=>$ordemDeServicoServidor->id_os_fte])]);
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
        if(Gate::any(['ORDEM_SERVICO_SERVIDOR_LER']))
        {
            $ordemServicoServidor = OrdemDeServicoServidorModel::find($id);

            if($ordemServicoServidor == null)
            {
                throw new NotFoundHttpException('Ordem de serviço do servidor não encontrada');
            }

            return response()->json($ordemServicoServidor, 200);
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
        if(Gate::any(['ORDEM_SERVICO_SERVIDOR_ATUALIZAR']))
        {
            $ordemServicoServidor = OrdemDeServicoServidorModel::find($id);

            if($ordemServicoServidor == null)
            {
                throw new NotFoundHttpException('Ordem de serviço não encontrada');
            }

            $validator = Validator::make(
                $request->all(), OrdemDeServicoServidorModel::rules(), OrdemDeServicoServidorModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $ordemServicoServidor->update(
                $validator->valid()
            );
            return response()->json($ordemServicoServidor, 200);
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
        if(Gate::any(['ORDEM_SERVICO_SERVIDOR_DELETAR']))
        {
            $ordemServicoServidor = OrdemDeServicoServidorModel::find($id);

            if($ordemServicoServidor == null)
            {
                throw new NotFoundHttpException('Ordem de serviço do servidor não encontrada');
            }

            $ordemServicoServidor->delete();

            return response(null, 200);
        }
        return response(null, 403);
    }
}

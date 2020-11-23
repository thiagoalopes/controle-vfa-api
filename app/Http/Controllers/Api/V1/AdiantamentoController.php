<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\AdiantamentoModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdiantamentoController extends Controller
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
        if(Gate::any(['ADIANTAMENTO_LER']))
        {
            return response()->json(AdiantamentoModel::all());
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
        if(Gate::any(['ADIANTAMENTO_INSERIR']))
        {
            $validator = Validator::make(
                $request->all(), AdiantamentoModel::rules(), AdiantamentoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $adiantamento = AdiantamentoModel::create(
                $validator->valid()
            );

            return response(null, 201,
                ['Location'=>route('adiantamento.show',['id'=>$adiantamento->id_adiantamento])]);
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
        if(Gate::any(['ADIANTAMENTO_LER']))
        {
            $adiantamento = AdiantamentoModel::find($id);

            if($adiantamento == null)
            {
                throw new NotFoundHttpException('Adiantamento não encontrado');
            }

            return response()->json($adiantamento, 200);
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
        if(Gate::any(['ADIANTAMENTO_ATUALIZAR']))
        {
            $adiantamento = AdiantamentoModel::find($id);

            if($adiantamento == null)
            {
                throw new NotFoundHttpException('Adiantamento não encontrado');
            }

            $validator = Validator::make(
                $request->all(), AdiantamentoModel::rules(), AdiantamentoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $adiantamento->update(
                $validator->valid()
            );
            return response()->json($adiantamento, 200);
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
        if(Gate::any(['ADIANTAMENTO_DELETAR']))
        {
            $adiantamento = AdiantamentoModel::find($id);

            if($adiantamento == null)
            {
                throw new NotFoundHttpException('Adiantamento não encontrado');
            }

            $adiantamento->delete();

            return response(null, 200);
        }
        return response(null, 403);
    }
}

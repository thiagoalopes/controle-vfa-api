<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\ParcelamentoModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ParcelamentoController extends Controller
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
        if(Gate::any(['PARCELAMENTO_LER']))
        {
            return response()->json(ParcelamentoModel::all());
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
        if(Gate::any(['PARCELAMENTO_INSERIR']))
        {
            $validator = Validator::make(
                $request->all(), ParcelamentoModel::rules(), ParcelamentoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $parcelamento = ParcelamentoModel::create(
                $validator->valid()
            );

            return response(null, 201,
                ['Location'=>route('parcelamento.show',['id'=>$parcelamento->id_parcelamento])]);
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
        if(Gate::any(['PARCELAMENTO_LER']))
        {
            $parcelamento = ParcelamentoModel::find($id);

            if($parcelamento == null)
            {
                throw new NotFoundHttpException('Parcelamento não encontrado');
            }

            return response()->json($parcelamento, 200);
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
        if(Gate::any(['PARCELAMENTO_ATUALIZAR']))
        {
            $parcelamento = ParcelamentoModel::find($id);

            if($parcelamento == null)
            {
                throw new NotFoundHttpException('Parcelamento não encontrado');
            }

            $validator = Validator::make(
                $request->all(), ParcelamentoModel::rules(), ParcelamentoModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $parcelamento->update(
                $validator->valid()
            );
            return response()->json($parcelamento, 200);
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
        if(Gate::any(['PARCELAMENTO_DELETAR']))
        {
            $parcelamento = ParcelamentoModel::find($id);

            if($parcelamento == null)
            {
                throw new NotFoundHttpException('Parcelamento não encontrado');
            }

            $parcelamento->delete();

            return response(null, 200);
        }
        return response(null, 403);
    }
}

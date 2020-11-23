<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\ServidorModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServidorController extends Controller
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
        if(Gate::any(['SERVIDOR_LER']))
        {
            return response()->json(ServidorModel::all());
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
        if(Gate::any(['SERVIDOR_INSERIR']))
        {
            $validator = Validator::make(
                $request->all(), ServidorModel::rules(), ServidorModel::messages());

                if($validator->fails())
                {
                    return response()->json($validator->errors(), 422);
                }

                $servidor = ServidorModel::create(
                    $validator->valid()
                );

            return response(null, 201, ['Location'=>route('servidores.show',['id'=>$servidor->id_servidor])]);
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
        if(Gate::any(['SERVIDOR_LER']))
        {
            $servidor = ServidorModel::find($id);

            if($servidor == null)
            {
                throw new NotFoundHttpException('Servidor não encontrado');
            }
            return response()->json($servidor, 200);
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
        if(Gate::any(['SERVIDOR_ATUALIZAR']))
        {
            $servidor = ServidorModel::find($id);

            if($servidor == null)
            {
                throw new NotFoundHttpException('Servidor não encontrado');
            }

            $rules = ServidorModel::rules();

            //Sobrecrita das regras para validação do unique no update
            $rules['matricula'] .= ',matricula,'.$id.',id_servidor';
            $rules['cpf'] .= ',cpf,'.$id.',id_servidor';

            $validator = Validator::make(
                $request->all(), $rules, ServidorModel::messages());

            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }

            $servidor->update(
                $validator->valid()
            );
            return response()->json($servidor, 200);
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
        if(Gate::any(['SERVIDOR_DELETAR']))
        {
            $servidor = ServidorModel::find($id);

            if($servidor == null)
            {
                throw new NotFoundHttpException('Servidor não encontrado');
            }

            $servidor->delete();

            return response(null, 200);
        }
        return response(null, 403);
    }

}

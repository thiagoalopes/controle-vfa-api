<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\ServidorModel;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

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
        if(Gate::any(['LER']))
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
        if(Gate::any(['INSERIR']))
        {

            $validator = Validator::make(
                $request->all(),
                [
                    'nome'=>'required',
                    'matricula'=>'required',
                    'cargo'=>'required',
                    'inativo'=>'required',
                    'cpf'=>'required',
                    'data_admissao'=>'required',
                ]);

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
        if(Gate::any(['LER']))
        {
            return response()->json(ServidorModel::find($id));
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
        if(Gate::any(['ATUALIZAR']))
        {
            return response()->json(ServidorModel::all());
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
        if(Gate::any(['DELETAR']))
        {
            $usuario = User::where('id', $id)->first();
            $usuario->delete();

            return response(null, 200);
        }

        return response(null, 403);
    }

}

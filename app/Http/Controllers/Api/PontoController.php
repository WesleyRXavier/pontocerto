<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PontoController extends Controller
{
    public function todosRegistros()
    {

        $reg = Registro::all();
        return response()->json($reg);
    }

    public function reg_usuario($usuario)
    {
        $pontos = DB::table('registros')->where('id', $usuario)->get();
        return response()->json($pontos);
        //return "todos os registros do funcioanrio fulano de tal";
    }
    public function gravar(Request $request)
    {
        $data_hora = Carbon::now();
        $reg = new Registro();
        $reg->localizacao = $request->local;
        $reg->user_id = $request->usuario;
        $reg->reg_id = $request->tipo;
        $reg->data = $data_hora->toDateString();
        $reg->hora = $data_hora;
//valida o pin
        $validacao = Validator::make($request->all(), [
            'pin' => 'required|numeric',
        ]);
        if ($validacao->fails()) {
            $erro = $validacao->errors();
            return response()->json($erro, 400);

        }

        if ($request->pin == 1111) {
            //    $reg->save();
            //   return response()->json($reg);
            return "Pin correto";
        } else {
            return "Pin invalido";
        }

    }

    public function registroData($usuario, $inicio, $fim)
    {

        $pontos = DB::table('registros')->whereBetween('data', [$inicio, $fim])->where('id', '=', $usuario)->orderBy('data', 'desc')->get();
        return response()->json($pontos);

    }

}

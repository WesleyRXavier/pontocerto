<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Acesso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcessoController extends Controller
{

    public function index()
    {
        $acessos = Acesso::all();
        return response()->json($acessos);
    }

    public function store(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'descricao' => 'max:255',
        ]);
        if ($validacao->fails()) {
            $erro = $validacao->errors();
            return response()->json($erro, 400);

        }

        //apos validado
        try {
            $acesso = new Acesso();
            $acesso->nome = $request->nome;
            $acesso->descricao = $request->descricao;
            $acesso->save();
            return response()->json($acesso);
        } catch (Exception $erro) {
            return " Erro ao gravar Erro:"+$erro;
        }
    }

    public function show(Request $request, int $id)
    {

        $acesso = Acesso::find($id);
        if ($acesso) {
            return response()->json($acesso);
        } else {
            return "Não Localizado";
        }

    }

    public function update(Request $request, int $id)
    {
        $validacao = Validator::make($request->all(), [
            'nome' => 'required|max:255',
            'descricao' => 'max:255',
        ]);
        if ($validacao->fails()) {
            $erro = $validacao->errors();
            return response()->json($erro, 400);

        }
        try {
            $acesso = Acesso::find($id);
            $acesso->A_nome = $request->nome;
            $acesso->A_descricao = $request->descricao;
            $acesso->save();
            return response()->json($acesso);
        } catch (Exception $erro) {
            return " Erro ao gravar Erro:"+$erro;
        }
    }

    public function destroy(Request $request, int $id)
    {

        $acesso = Acesso::find($id);
        if ($acesso) {
            try {
                $acesso->delete();
                return response()->json("Deletado com sucesso");
            } catch (Exception $erro) {
                return response()->json("Erro: "+$erro);
            }
            return "Deletado com sucesso";
        } else {
            return "Não Localizado";
        }
    }
}

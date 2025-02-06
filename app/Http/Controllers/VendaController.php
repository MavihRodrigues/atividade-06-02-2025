<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaStoreFormRequest;
use App\Http\Requests\VendaUpdateFormRequest;
use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function store(VendaStoreFormRequest $request)
    {
        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'data_venda' => $request->data_venda,
            'subtotal' => 0,
            'desconto' => $request->desconto,
            'total' => 0
        ]);

        $subtotal = 0;

        foreach ($request->itens as $item) {
            $subtotal += $item['quantidade'] * $item['preco'];
            $produto = Produto::find($item['produto_id']);
            if ($produto->quantidade_estoque == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'não'
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Dados Cadastrados'
        ]);
    }

    public function index()
    {
        $venda = Venda::all();

        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }

    public function show($id)
    {
        $venda = Venda::find($id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'A venda não foi cadastrado ou não foi encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $venda
        ]);
    }

    public function update(VendaUpdateFormRequest $request, $id)
    {
        $venda = Venda::find($id);

        if (isset($request->nome)) {
            $venda->nome = $request->nome;
        }

        if (isset($request->codigo)) {
            $venda->codigo = $request->codigo;
        }

        if (isset($request->preco)) {
            $venda->preco = $request->preco;
        }

        if (isset($request->quantidade_estoque)) {
            $venda->quantidade_estoque = $request->quantidade_estoque;
        }

        $venda->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);
    }

    public function destroy($id)
    {
        $venda = Venda::find($id);

        if ($venda == null) {
            return response()->json([
                'status' => false,
                'message' => 'A venda não foi encontrado'
            ]);
        }

        $venda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Excluído com sucesso'
        ]);
    }
}

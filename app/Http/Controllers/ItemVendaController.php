<?php

namespace App\Http\Controllers;

use App\Models\ItemVenda;
use Illuminate\Http\Request;

class ItemVendaController extends Controller
{
    public function store(Request $request)
    {
        $itemvenda = ItemVenda::create([
            'venda_id' => $request->nome,
            'produto_id' => $request->email,
            'quantidade' => $request->telefone,
            'preco_unitario' => $request->endereco,
            'subtotal_item' => $request->subtotal_intem
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Dados Cadastrados',
            'data' => $itemvenda
        ]);
    }

    public function index()
    {
        $itemvenda = ItemVenda::all();

        return response()->json([
            'status' => true,
            'data' => $itemvenda
        ]);
    }

    public function show($id)
    {
        $itemvenda = ItemVenda::find($id);

        if ($itemvenda == null) {
            return response()->json([
                'status' => false,
                'message' => 'Não foi cadastrado ou não foi encontrado'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $itemvenda
        ]);
    }

    public function update(Request $request, $id)
    {
        $itemvenda = ItemVenda::find($id);

        if (isset($request->venda_id)) {
            $itemvenda->venda_id = $request->venda_id;
        }

        if (isset($request->produto_id)) {
            $itemvenda->produto_id = $request->produto_id;
        }

        if (isset($request->quantidade)) {
            $itemvenda->quantidade = $request->quantidade;
        }

        if (isset($request->preco_unitario)) {
            $itemvenda->preco_unitario = $request->preco_unitario;
        }

        if (isset($request->subtotal_item)) {
            $itemvenda->subtotal_item = $request->subtotal_item;
        }


        $itemvenda->update();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ]);
    }

    public function destroy($id)
    {
        $itemvenda = ItemVenda::find($id);

        if ($itemvenda == null) {
            return response()->json([
                'status' => false,
                'message' => 'O item não foi encontrado'
            ]);
        }

        $itemvenda->delete();

        return response()->json([
            'status' => true,
            'message' => 'Excluído com sucesso'
        ]);
    }
}

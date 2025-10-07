<?php

namespace App\Http\Controllers;

use App\Models\Medicamentos;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MedicamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = Medicamentos::all();

        $contador = $registros->count();

        if($contador > 0) {
            return response()->json([
                'sucess' => true,
                'message' => 'Medicamentos encontrados com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200);  // Retorna HTTP 200 (OK) com os dados e a contagem
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum medicamento encontrado.',
            ], 404); // Retorna HTTP 404 (Not Found) se não houver registros
        }
    }

    
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'stock' => 'required',
            'utility' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); // Retorna HTTP 400 (Bad Request) se houver erro de validação
        }

        // Criando um produto no banco de dados
        $registros = Medicamentos::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Medicamentos cadastrados com sucesso!',
                'data' => $registros
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar um medicamento'
            ], 500); // Retorna HTTP 500 (Internal Server Error) se o cadastro falhar
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscando um produto pelo ID
        $registros = Medicamentos::find($id);

        // Verificando se o produto foi encontrada
        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Medicamento localizada com sucesso!',
                'data' => $registros
            ], 200); // Retorna HTTP 200 (OK) com os dados do produto
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Medicamento não localizado.',
            ], 404); // Retorna HTTP 404 (Not Found) se o produto não for encontrada
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'stock' => 'required',
            'utility' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); // Retorna HTTP 400 se houver erro de validação
        }

        // Encontrando um produto no banco
        $registrosBanco = Medicamentos::find($id);

        if (!$registrosBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Medicamento não encontrado'
            ], 404);
        }

        // Atualizando os dados
        $registrosBanco->name = $request->name;
        $registrosBanco->price = $request->price;
        $registrosBanco->brand = $request->brand;
        $registrosBanco->stock = $request->stock;
        $registrosBanco->utility = $request->utility;

        // Salvando as alterações
        if ($registrosBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Medicamento atualizado com sucesso!',
                'data' => $registrosBanco
            ], 200); // Retorna HTTP 200 se a atualização for bem-sucedida
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar o medicamento'
            ], 500); // Retorna HTTP 500 se houver erro ao salvar
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Encontrando um produto no banco
        $registros = Medicamentos::find($id);

        if (!$registros) {
            return response()->json([
                'success' => false,
                'message' => 'Medicamento não encontrado'
            ], 404); // Retorna HTTP 404 se o produto não for encontrado
        }
     // Deletando um produto
    if ($registros->delete()){
        return response()->json([
            'success' => true,
            'message' => 'Medicamento deletado com sucesso'
        ],200); // Retorna HTTP 200 se a exclusão for bem-sucedida
    }

    return response()->json([
        'success' => false,
        'message' => 'Erro ao deletar um medicamento'
    ], 500); // Retorna HTTP 500 se houver erro na exclusão
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVendaRequest;
use App\Models\VendasModell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($busca = null)
    {
        if (!$busca) {
            $vendas = VendasModell::all();
        } else {
            $vendas = VendasModell::where('id', 'like', "{$busca}%")->get();
        }

        return response()->view('vendas.lista', ['vendas' => $vendas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('vendas.criar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateVendaRequest $request)
    {
        $dados = $request->validated();

        DB::transaction(function () use ($dados) {
            $produtos = $dados['itens'];

            $venda = VendasModell::create($dados);
            $produtos = $venda->produtos()->attach($produtos);
        });

        return response()->noContent(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VendasModell $venda)
    {
        return response()->view('vendas.editar', ['venda' => $venda]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateVendaRequest $request, VendasModell $venda)
    {
        $dados = $request->validated();

        DB::transaction(function () use ($dados, $venda) {
            $produtos = $dados['itens'];

            $venda->produtos()->detach();
            $venda->produtos()->attach($produtos);
            $venda->update($dados);
        });

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VendasModell $venda)
    {
        DB::transaction(function () use ($venda) {
            $venda->produtos()->detach();
            $venda->delete();
        });

        return redirect()->route('vendas.index');
    }
}

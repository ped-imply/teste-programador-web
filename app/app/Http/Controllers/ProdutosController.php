<?php

namespace App\Http\Controllers;

use App\Models\ProdutosModell;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getProdutos(Request $request)
    {
        if ($request->ajax()) {
            $nome = $request->input('q', '');
            
            $produtos = ProdutosModell::where('nome', 'like', "%{$nome}%")
            ->orWhere('referencia', 'like', "%{$nome}%")
            ->simplePaginate(50);

            $produtos->load('fornecedores');
            
            $morePages = $produtos->hasMorePages();

            $results = [
                "results" => $produtos->items(),
                "pagination" => array(
                    "more" => $morePages,
                    )
                ];

            return json_encode($results);
        }
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Publicacao;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PublicacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $publicacoes=Publicacao::all()->last();
       // return $publicacoes;

       return Inertia::render('Publicacao',['dadosDoBackend' => $publicacoes]);
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
    public function show($titulo)
    {
        $slug = Str::slug($titulo);
        $publicacao = Publicacao::where('slug', $slug)->firstOrFail();
        return inertia('Publicacao', ['post' => $publicacao]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function pesquisar(Request $request)
    {
        // Obter a consulta do corpo da solicitação POST
        $query = $request->input('query');

        // Executar a consulta no banco de dados usando a consulta recebida
        $pesquisa = Publicacao::where('titulo', 'like', "%$query%")->get();

        // Retornar a rota de redirecionamento
        return Inertia::render('Resultado',['dadosDoBackend' => $pesquisa]);
    }


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
}

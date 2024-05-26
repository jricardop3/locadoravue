<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class MarcaController extends Controller
{
    protected $marca; 
    public function __construct(Marca $marca){
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$marcas = Marca::all();
        $marcas = $this->marca->all();
        return response()->json($marcas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        //$marca = Marca::create($request->all());
 

        $request->validate($this->marca->rules(), $this->marca->feedback());

       $marca = $this->marca->create($request->all());
       return response()->json($marca, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
       // $marcas = $marca;
        if ($marca === null){
            return response()->json(['erro' => 'recurso pesquisado não existe!'], 404);
        } 
        return response()->json($marca, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$marca->update($request->all());
        
        $marca = $this->marca->find($id);
        if ($marca === null){
            return response()->json(['erro' => 'recurso pesquisado não existe!'], 404);
        }
        $request->validate($this->marca->rules(), $this->marca->feedback());
        $marca -> update($request->all());
        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$marca->delete();
        $marca = $this->marca->find($id);
        if ($marca === null){
            return response()->json(['erro' => 'recurso pesquisado não existe!'], 404);
        }    
        $marca -> delete();
        return response()->json(['msg' => ' a Marca foi Deletada com sucesso!'], 200);;

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    public function index(Request $request)
    {
        $marcas = array();
        if ($request->has('atributos_modelos')){
            $atributos_modelos = $request->atributos_modelos;
            $marcas = $this->marca->with('modelos:id,'.$atributos_modelos);
        } else {
            $marcas = $this->marca->with('modelos');
        }
        if ($request->has('filtros')){
            $filtros = explode(';',$request->filtros);
            foreach ($filtros as $condicao){
                $c = explode(':',$condicao);
                $marcas = $marcas->where($c[0], $c[1], $c[2]);
            
            $condicoes = explode(':',$request->filtros);
            $marcas = $marcas->where($condicoes[0], $condicoes[1], $condicoes[2]);
            }
        }
        if ($request->has('atributos')){
            $atributos = $request->atributos;    
            $marcas = $marcas->selectRaw($atributos)->get();
        }else {
            $marcas = $marcas->get();
        }
        //$marcas = Marca::all();
        //$marcas = $this->marca->with('modelos')->get();
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
        $imagem = $request->file('imagem');
        
        $imagem_urn = $imagem -> store('imagens', 'public');
        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' =>$imagem_urn
        ]);
       //$marca = $this->marca->create($request->all());
       return response()->json($marca, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->with('modelos')->find($id);
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
        if($request->method() === 'PATCH'){
            $regrasDinamicas = array ();
           
            
            foreach ($marca->rules() as $input => $regra ){
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $marca->feedback());
           
            
            
        }else{
            $request->validate($this->marca->rules(), $this->marca->feedback());
            
        }
        if ($request->file('imagem')){
            Storage::disk('public')->delete($marca->imagem);
        }
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem -> store('imagens', 'public');

        $marca->fill($request->all());
        $marca-> imagem = $imagem_urn;
        /*
        $marca -> update([
            'nome' => $request->nome,
            'imagem' =>$imagem_urn
        ]);
        */
        $marca->save();
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
        
            Storage::disk('public')->delete($marca->imagem);
       
        $marca -> delete();
        return response()->json(['msg' => ' a Marca foi Deletada com sucesso!'], 200);;

    }
}

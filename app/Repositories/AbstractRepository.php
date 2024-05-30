<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class abstractRepository{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function selectAtributosRegistrosRelacionados($atributos){
        $this-> model = $this-> model->with($atributos);
        //A query esta sendo montada...
    }
    public function filtro($filtros) {
        $filtros = explode(';', $filtros);
        
        foreach($filtros as $condicao) {

            $c = explode(':', $condicao);
            $this->model = $this->model->where($c[0], $c[1], $c[2]);
            //a query está sendo montada
            
        }
    }
    public function selectAtributos($atributos){
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultado (){
        return $this->model->get();
    }
}

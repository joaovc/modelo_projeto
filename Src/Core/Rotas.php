<?php
namespace Src\Core;

abstract class Rotas{

    public $rotas;
    private $atributos = ['dir'=>null,'controller'=>null,'metodo'=>null,'parametros'=>[]];

    protected function setRotas(){
        $rota['']=['dir'=>'Index','controller'=>'Index','metodo'=>'view','parametros'=>['index','layout']];
        $rota['usuario']=['cadastro' => $this->atributos];
        $rota['cliente']=['cadastro' => $this->atributos];
        $rota['empresa']=['cadastro' => $this->atributos];
        $rota['endereco']=['cadastro' => $this->atributos];
        $this->rotas = $rota;
    }
}
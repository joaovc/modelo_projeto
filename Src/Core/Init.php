<?php
namespace Src\Core;

use Src\Core\ProcessaRota;

class Init extends ProcessaRota{

    private $objeto;
 
    public function __construct(){
        parent::__construct();
        $this->addController();
    }

    private function getObjeto(){return $this->objeto;}
    private function setObjeto($objeto){$this->objeto = $objeto;}

    private function addController(){
        $namespace = "App\\Controller\\".$this->getRota()['dir']."\\".$this->getRota()['controller'];
        $this->setObjeto(new $namespace);
        $this->addMetodo();
    }

    private function addMetodo(){
        if(method_exists($this->getObjeto(),$this->getRota()['metodo'])){
            $return = call_user_func_array([$this->getObjeto(),$this->getRota()['metodo']],$this->getRota()['parametros']);
            if($this->getRota()['metodo'] === "view"){return $return;}
            if($_SERVER['REQUEST_METHOD'] === "POST"){echo json_encode($return);}else{header('location:'.DIRPAGE);}
        }
    }
}
<?php
namespace Src\Core;

use Src\Core\Rotas;

abstract class ProcessaRota extends Rotas{
    protected $url; 

    protected function __construct(){
        $this->parseUrl();
        $this->setRotas();
    }
    
    private function getUrl(){return $this->url;}
    private function parseUrl(){$this->url = explode('/',trim($_GET["url"]),FILTER_SANITIZE_URL);}
    private function verificarArquivo($rota){return file_exists(DIRREQ."App/Controller/{$rota['dir']}/{$rota['controller']}.php");}

    private function setAtributos($rota){
        $rota['dir'] = ucfirst($this->getUrl()[0]);
        $rota['controller'] = ucfirst($this->getUrl()[1]);
        $rota['metodo']= $this->getUrl()[2];
        if($this->getUrl()[2] == 'view'){
            $rota['parametros'] += [0=>ucfirst($this->getUrl()[0])];
            $rota['parametros'] += [1=>ucfirst($this->getUrl()[1])];
            if(count($this->getUrl()) > 3){
                $extra = [];
                foreach($this->getUrl() as $key => $value){if($key > 2){$extra += [$value];}}
                $rota['parametros'] += [2=>$extra];
            }
        }elseif(count($this->getUrl()) > 3){
            foreach($this->getUrl() as $key => $value){if($key > 2){$rota['parametros'] += [$value];}}
        }
        return $rota;
    }

    protected function getRota(){
        if(array_key_exists($this->getUrl()[0],$this->rotas)){
            if($this->getUrl()[0] === ''){return $this->rotas[''];}
            if(array_key_exists($this->getUrl()[1],$this->rotas[$this->getUrl()[0]])){
                if(is_array($this->rotas[$this->getUrl()[0]][$this->getUrl()[1]])){
                    $rota = $this->setAtributos($this->rotas[$this->getUrl()[0]][$this->getUrl()[1]]);
                    if($this->verificarArquivo($rota)){return $rota;}return $this->rotas[''];
                }
                    $rota = $this->setAtributos($this->rotas[$this->getUrl()[0]]);
                    if($this->verificarArquivo($rota)){return $rota;}return $this->rotas[''];
            }return $this->rotas[''];
        }return $this->rotas[''];
    }

}

#---------------------------------------------------------------
/*
class ProcessaRota{

    protected $url;
    protected $error = false;

    public function getUrl()
    {
        return $this->url;
    }

    private function parseUrl()
    {
        $this->url = explode('/',filter_var($_GET['url'],FILTER_SANITIZE_SPECIAL_CHARS));
    }

    public function processaUrl()
    {            
        if (!empty($_GET['url'])){
            $this->parseUrl();
        }else{
            $this->url = '/';
        }

        $params = [];

        if(!empty($this->getUrl()) && $this->getUrl() != '/')
        {            
            $currentController = ucfirst($this->getUrl()[0]);
            array_shift($this->getUrl());
           
            if (!empty($this->getUrl()[0]))
            {
                $currentAction = $this->getUrl()[0];
                array_shift($this->getUrl());
            }else{
                $currentAction = 'index';
            }
               
            if (count($this->getUrl()) > 0)
            {
                $params = $this->getUrl();
            }

        }else{
            $currentController = 'Home';
            $currentAction = 'index';
        }
            
        if(!file_exists(DIRREQ.'/App/Controller/'.$currentController.'.php') || !method_exists($currentController, $currentAction))
        {
            $this->error = true;
		    $currentController = 'Notfound';
			$currentAction = 'index';
        }

		    $c = new $currentController(); 

		    call_user_func_array(array($c, $currentAction), $params);
            
    }

}
*/
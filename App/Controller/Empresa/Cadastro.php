<?php
namespace App\Controller\Empresa;

use Src\Classes\Render;
use Src\Traits\Filter;
use App\Model\Empresa\Post;

class Cadastro{ 
 
    public function view($dir,$arq){return Render::addView($dir,$arq);}

    public function salvar(){
        if(isset($_SESSION['cadastro'])){
            $c = unserialize($_SESSION['cadastro']);
            if($c->getId()){
                if(Post::insert($c->getId(),$c->getNome(),$c->getCelular(),$c->getHoraAbre(),$c->getHoraFecha())){
                    return ["status"=>true];
                }return ["status"=>false,"mensagem"=>"Erro ao cadastrar Cliente!"];
            }return ["status"=>false,"mensagem"=>"Erro ao cadastrar usuário!"];
        }return ["status"=>false,"mensagem"=>"Erro de sessão!"];
    }

    public function verificar(){
        $dados = $this->filtrar();
        if($dados[0]){unset($dados);return ["status"=>true];}
        unset($dados[0]);return ["status"=>false,"erro"=>$dados];
    }

    private function filtrar(){
        $nome = Filter::post('nome');
        $celular = Filter::post('celular');
        $horaAbre = Filter::post('horaAbre');
        $horaFecha = Filter::post('horaFecha');
        if($nome && $celular && $horaAbre && $horaFecha){
            $e = unserialize($_SESSION['cadastro']);
            $e->setNome($nome);
            $e->setCelular($celular);
            $e->setHoraAbre($horaAbre);
            $e->setHoraFecha($horaFecha);
            $_SESSION['cadastro'] = serialize($e);
            return[true];
        }
        $dados[]=false;$nome?:$dados[]='nome';$celular?:$dados[]='celular';$horaAbre?:$dados[]='horaAbre';$horaFecha?:$dados[]='horaFecha';
        return $dados;
    }
}
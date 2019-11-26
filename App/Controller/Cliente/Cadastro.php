<?php
namespace App\Controller\Cliente;

use Src\Classes\Render;
use Src\Traits\Filter;
use App\Model\Cliente\Post;

class Cadastro{

    public function view($dir,$arq){return Render::addView($dir,$arq);}

    public function salvar(){
        if(isset($_SESSION['cadastro'])){
            $c = unserialize($_SESSION['cadastro']);
            if($c->getId()){
                if(Post::cliente($c->getId(),$c->getNome(),$c->getSobrenome(),$c->getCelular())){
                    return ["status"=>true,"mensagem"=>"Cadastro efetuado com sucesso!"];
                }return ["status"=>false,"mensagem"=>"Erro ao cadastrar Cliente!"];
            }return ["status"=>false,"mensagem"=>"Erro ao cadastrar usuário!"];
        }return ["status"=>false,"mensagem"=>"Erro de sessão!"];
    }

    public function verificar(){
        $dados = $this->filtrar();
        if($dados[0]){unset($dados);return["status"=>true];}
        unset($dados[0]);return["status"=>false,"erro"=>$dados];
    }

    private function filtrar(){
        $nome = Filter::post('nome');
        $sobrenome = Filter::post('sobrenome');
        $celular = Filter::post('celular');
        if($nome && $sobrenome && $celular){
            $c = unserialize($_SESSION['cadastro']);
            $c->setNome($nome);
            $c->setSobrenome($sobrenome);
            $c->setCelular($celular);
            $_SESSION['cadastro'] = serialize($c);
            return [true];
        }
        $dados[]=false; $nome?:$dados[]='nome'; $sobrenome?:$dados[]='sobrenome'; $celular?:$dados[]='celular';
        return $dados;
    }
}
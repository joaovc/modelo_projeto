<?php
namespace Src\Classes;

use Src\Classes\Render;
use Src\Traits\Filter;
use App\Model\Usuario\Get;
use App\Model\Usuario\Post;
use Src\Classes\Cliente;
use Src\Classes\Empresa;

class CadastroUsuario{

    public function view($dir,$arq,$parametros){
        return Render::addView($dir,$arq,$parametros);
    }

    public function finalizar(){if(isset($_SESSION['cadastro'])){unset($_SESSION['cadastro']);}}

    public function verificar($tipoUsuario){
        $dados = $this->filtrar();
        if($dados[0]){
            if(Get::verificarEmail($dados[1])){return["status"=>false,"erro"=>1,"mensagem"=>"Já existe um usuário cadastrado com esse Email!"];}
            $this->instanciar($tipoUsuario);
            $this->setar($dados,$tipoUsuario);
            return["status"=>true];
        }unset($dados[0]);return["status"=>false,"erro"=>$dados];
    }

    private function filtrar(){ 
        $email = Filter::post('email',FILTER_VALIDATE_EMAIL);
        $senha = Filter::post('senha');
        if($email && $senha){return [true,$email,$senha];}
        $dados[]=false; $email?:$dados[]='email'; $senha?:$dados[]='senha';
        return $dados;
    }

    private function instanciar($tipoUsuario){
        if($tipoUsuario === "cliente"){$_SESSION['cadastro'] = serialize(new Cliente());}
        elseif($tipoUsuario === "empresa"){$_SESSION['cadastro'] = serialize(new Empresa());}
    }

    private function setar($dados,$tipoUsuario){
        $u = unserialize($_SESSION['cadastro']);
        $u->setEmail($dados[1]);
        $u->criptografar($dados[2]);
        if($tipoUsuario === "cliente"){$u->setTipoUsuario(3);}
        elseif($tipoUsuario === "empresa"){$u->setTipoUsuario(4);}
        $_SESSION['cadastro'] = serialize($u);
        unset($dados);
    }

    public function salvar(){
        if(isset($_SESSION['cadastro'])){
            $u = unserialize($_SESSION['cadastro']);
            if($id = Post::usuario($u->getId(),$u->getEmail(),$u->getSenha(),$u->getTipoUsuario())){
                $u->setId($id);
                $_SESSION['cadastro'] = serialize($u);
                return ["status"=>true,"mensagem"=>"Sucesso cadastro usuário!"];
            }return ["status"=>false,"mensagem"=>"Erro ao cadastrar usuário!"];
        }return ["status"=>false,"mensagem"=>"Erro de sessão!"];
    }

}
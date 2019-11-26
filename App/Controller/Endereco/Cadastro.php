<?php
namespace App\Controller\Endereco;

use Src\Classes\Render;
use Src\Traits\Filter;
use App\Model\Endereco\Post;

class Cadastro{

    public function view($dir,$arq){return Render::addView($dir,$arq);}

    public function salvar(){
        if(isset($_SESSION['cadastro'])){
            $e = unserialize($_SESSION['cadastro']);
            if($e->getId()){
                if(Post::insert($e->getIdEndereco(),$e->getCep(),$e->getRua(),$e->getNumero(),$e->getBairro(),$e->getMunicipio(),$e->getUf(),$e->getLatitude(),$e->getLongitude())){
                    return ["status"=>true];
                }return ["status"=>false,"mensagem"=>"Erro ao cadastrar Endereço!"];
            }return ["status"=>false,"mensagem"=>"Erro ao cadastrar usuário!"];
        }return ["status"=>false,"mensagem"=>"Erro de sessão!"];
    }

    public function verificar(){
        $dados = $this->filtrar();
        if($dados[0]){unset($dados);return["status"=>true];}
        unset($dados[0]);return["status"=>false,"erro"=>$dados];
    }

    private function filtrar(){
        $cep = Filter::post('cep');
        $rua = Filter::post('rua');
        $numero = Filter::post('numero');
        $bairro = Filter::post('bairro');
        $municipio = Filter::post('municipio');
        $uf = Filter::post('uf');
        #$latitude = Filter::post('latitude');
        #$longitude = Filter::post('longitude');
        if($cep && $rua && $numero && $bairro && $municipio && $uf){
            $e = unserialize($_SESSION['cadastro']);
            $e->setCep($cep);
            $e->setRua($rua);
            $e->setNumero($numero);
            $e->setBairro($bairro);
            $e->setMunicipio($municipio);
            $e->setUf($uf);
            #$e->setLatitude($latitude);
            #$e->setLongitude($longitude);
            $_SESSION['cadastro'] = serialize($e);
            return [true];
        }
        $dados[]=false;$cep?:$dados[]='cep';$rua?:$dados[]='rua';$numero?:$dados[]='numero';$bairro?:$dados[]='bairro';$municipio?:$dados[]='municipio';$uf?:$dados[]='uf';
        return false;
    }

}
<?php
namespace Src\Classes;
use Src\Classes\Usuario;

class Cliente extends Usuario{
    protected $nome;
    protected $sobrenome;
    protected $celular;

    public function setNome($nome){$this->nome = $nome;}
    public function getNome(){return $this->nome;}

    public function setSobrenome($sobrenome){$this->sobrenome = $sobrenome;}
    public function getSobrenome(){return $this->sobrenome;}

    public function setCelular($celular){$this->celular = $celular;}
    public function getCelular(){return $this->celular;}
}
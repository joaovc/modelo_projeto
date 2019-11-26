<?php
namespace Src\Classes;

abstract class Usuario{
    protected $id;
    protected $email;
    protected $senha;
    protected $tipoUsuario;

    public function setId($id){$this->id = $id;}
    public function getId(){return $this->id;}

    public function setEmail($email){$this->email = $email;}
    public function getEmail(){return $this->email;}

    public function setSenha($senha){$this->senha = $senha;}
    public function getSenha(){return $this->senha;}

    public function setTipoUsuario($tipoUsuario){$this->tipoUsuario = $tipoUsuario;}
    public function getTipoUsuario(){return $this->tipoUsuario;}

    public function criptografar($senha){
        $this->setSenha(password_hash($senha,PASSWORD_DEFAULT));
    }
}
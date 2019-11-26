<?php
namespace Src\Classes;

use Src\Classes\Usuario;

class Empresa extends Usuario{
    protected $nome;
    protected $celular;
    protected $horaAbre;
    protected $horaFecha;
    protected $formasPagamento;

    public function setNome($nome){$this->nome = $nome;}
    public function getNome(){return $this->nome;}

    public function setCelular($celular){$this->celular = $celular;}
    public function getCelular(){return $this->celular;}

    public function setHoraAbre($horaAbre){$this->horaAbre = $horaAbre;}
    public function getHoraAbre(){return $this->horaAbre;}

    public function setHoraFecha($horaFecha){$this->horaFecha = $horaFecha;}
    public function getHoraFecha(){return $this->horaFecha;}

    public function setFormasPagamento($formasPagamento){$this->formasPagamento = $formasPagamento;}
    public function getFormasPagamento(){return $this->formasPagamento;}
}
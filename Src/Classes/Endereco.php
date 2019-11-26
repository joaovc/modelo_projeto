<?php
namespace Src\Classes;

class Endereco{
    protected $idEndereco;
    protected $cep;
    protected $rua;
    protected $numero;
    protected $bairro;
    protected $municipio;
    protected $uf;
    protected $latitude;
    protected $longitude;

    public function setIdEndereco($idEndereco){$this->idEndereco = $idEndereco;}
    public function getIdEndereco(){return $this->idEndereco;}

    public function setCep($cep){$this->cep = $cep;}
    public function getCep(){return $this->cep;}

    public function setRua($rua){$this->rua = $rua;}
    public function getRua(){return $this->rua;}

    public function setNumero($numero){$this->numero = $numero;}
    public function getNumero(){return $this->numero;}

    public function setBairro($bairro){$this->bairro = $bairro;}
    public function getBairro(){return $this->bairro;}

    public function setMunicipio($municipio){$this->municipio = $municipio;}
    public function getMunicipio(){return $this->municipio;}

    public function setUf($uf){$this->uf = $uf;}
    public function getUf(){return $this->uf;}

    public function setLatitude($latitude){$this->latitude = $latitude;}
    public function getLatitude(){return $this->latitude;}

    public function setLongitude($longitude){$this->longitude = $longitude;}
    public function getLongitude(){return $this->longitude;}
}
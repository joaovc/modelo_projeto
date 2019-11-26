<?php
namespace App\Model\Endereco;

use Src\Classes\Db;

abstract class Post extends Db{

    public static function add($empresa,$cep,$rua,$numero,$bairro,$municipio,$uf,$latitude,$longitude){
        $sql="INSERT INTO empresa VALUES(:E,:C,:R,:B,:M,:U,:LA,:LO)";
        $conexao = self::conexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":E",$empresa,\PDO::PARAM_INT);
        $stmt->bindParam(":C",$cep,\PDO::PARAM_STR);
        $stmt->bindParam(":R",$rua,\PDO::PARAM_STR);
        $stmt->bindParam(":N",$numero,\PDO::PARAM_STR);
        $stmt->bindParam(":B",$bairro,\PDO::PARAM_STR);
        $stmt->bindParam(":M",$municipio,\PDO::PARAM_STR);
        $stmt->bindParam(":U",$uf,\PDO::PARAM_STR);
        $stmt->bindParam(":LA",$latitude,\PDO::PARAM_STR);
        $stmt->bindParam(":LO",$latitude,\PDO::PARAM_STR);
        $stmt->execute();
		if($stmt->rowCount() === 1){return true;}else{return false;}
    }
}
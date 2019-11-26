<?php
namespace App\Model\Cliente;

use Src\Classes\Db;

abstract class Post extends Db{

    public static function cliente($id,$nome,$sobrenome,$celular){
        $sql="INSERT INTO cliente VALUES(:I,:N,:S,:C)";
        $stmt = self::conexao()->prepare($sql);
        $stmt->bindParam(":I",$id,\PDO::PARAM_INT);
        $stmt->bindParam(":N",$nome,\PDO::PARAM_STR);
        $stmt->bindParam(":S",$sobrenome,\PDO::PARAM_STR);
        $stmt->bindParam(":C",$celular,\PDO::PARAM_STR);
        $stmt->execute();
		if($stmt->rowCount() === 1){return true;}else{return false;}
    }
}
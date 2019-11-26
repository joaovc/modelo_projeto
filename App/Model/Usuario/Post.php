<?php
namespace App\Model\Usuario;

use Src\Classes\Db;

abstract class Post extends Db{

    public static function usuario($id,$email,$senha,$tipoUsuario){
        $sql="INSERT INTO usuario VALUES(:I,:E,:S,:T)";
        $conexao = self::conexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":I",$id,\PDO::PARAM_INT);
        $stmt->bindParam(":E",$email,\PDO::PARAM_STR);
        $stmt->bindParam(":S",$senha,\PDO::PARAM_STR);
        $stmt->bindParam(":T",$tipoUsuario,\PDO::PARAM_INT);
        $stmt->execute();
		if($stmt->rowCount() === 1){return $conexao->lastInsertId();}else{return false;}
    }
}
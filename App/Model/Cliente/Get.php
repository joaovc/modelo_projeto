<?php
namespace App\Model\Usuario;

use Src\Core\Db;

abstract class Get extends Db{

    public static function select($id,$email,$senha,$tipoUsuario){
        $sql="INSERT INTO usuario VALUES(:I,:E,:S,:T)";
        $stmt = self::conexao()->prepare($sql);
        $stmt->bindParam(":I",$id,\PDO::PARAM_INT);
        $stmt->bindParam(":E",$email,\PDO::PARAM_STR);
        $stmt->bindParam(":S",$senha,\PDO::PARAM_STR);
        $stmt->bindParam(":T",$tipoUsuario,\PDO::PARAM_INT);
        $stmt->execute();
        $response = $stmt->rowCount();
			if($response == 1){
				return "Efetuado com sucesso";
			}else{
				return "Negado!";
            }
    }
}
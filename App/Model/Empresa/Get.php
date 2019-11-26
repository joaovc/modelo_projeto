<?php
namespace App\Model\Usuario;

use Src\Classes\Db;

abstract class Get extends Db{

    public static function selectAll(){
        $sql="SELECT * FROM usuario";
        $stmt = self::conexao()->prepare($sql);
        $stmt->execute();
        $response = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		if($response){return $response;}else{return false;}
    }

    public static function verificarEmail($email){
        try{
            $sql="SELECT FROM usuario WHERE email = :E";
            $stmt = self::conexao()->prepare($sql);
            $stmt->bindParam(':E',$email,\PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()){return true;}else{return false;}
        }catch(\PDOException $e){
            return "ERRO:".$e->getMessage();
        }
    }
}
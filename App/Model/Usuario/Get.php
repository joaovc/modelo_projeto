<?php
namespace App\Model\Usuario;

use Src\Classes\Db;

abstract class Get extends Db{

    public static function selectAll(){
        try{
            $sql="SELECT * FROM usuario";
            $stmt = self::conexao()->prepare($sql);
            $stmt->execute();
            $response = $stmt->fetchAll(\PDO::FETCH_OBJ);
            if($response){return $response;}else{return false;}
        }catch(\PDOException $e){
            return "\n\nERRO: ".$e->getMessage();
        }
    }

    public static function verificarEmail($email){
        try{
            $sql="SELECT id FROM usuario WHERE email = :E";
            $stmt = self::conexao()->prepare($sql);
            $stmt->bindParam(':E',$email,\PDO::PARAM_STR);
            $stmt->execute();
            if($stmt->rowCount()){return true;}else{return false;}
        }catch(\PDOException $e){
            return "\n\nERRO: ".$e->getMessage();
        }
    }
}
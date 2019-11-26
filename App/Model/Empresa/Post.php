<?php
namespace App\Model\Empresa;

use Src\Classes\Db;

abstract class Post extends Db{

    public static function empresa($id,$nome,$celular,$horaAbre,$horaFecha,$formasPagamento){
        $sql="INSERT INTO empresa VALUES(:I,:N,:C,:HA,:HF,FP)";
        $conexao = self::conexao();
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":I",$id,\PDO::PARAM_INT);
        $stmt->bindParam(":N",$nome,\PDO::PARAM_STR);
        $stmt->bindParam(":C",$celular,\PDO::PARAM_STR);
        $stmt->bindParam(":HA",$horaAbre,\PDO::PARAM_STR);
        $stmt->bindParam(":HF",$horaFecha,\PDO::PARAM_STR);
        $stmt->bindParam(":FP",$formasPagamento,\PDO::PARAM_STR);
        $stmt->execute();
		if($stmt->rowCount() === 1){return $conexao->lastInsertId();}else{return false;}
    }
}
<?php
namespace Src\Classes;

abstract class Db{

    private $login = "root";
    private $senha = null;
    private $host = "mysql:host=localhost;dbname=jetwash;charset=utf8";
    private $conexao = null;

    protected static function conexao(){
        try{
            if(is_null($this->$conexao)){
                $pdo = new \PDO($this->$host, $this->$login, $this->$senha, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                return $this->$conexao = $pdo;
            }else{
                return $this->$conexao;
            }
        }catch(\PDOException $e){
            echo "ERRO:".$e->getMessage();
        }
    }
}


<?php
namespace Src\Classes;
use Src\Classes\Db;

abstract class ActiveRecord extends Db
{
    private $content;
    protected $table = null;
    protected $idField = null;
    protected $logTimestamp;

    public function __construct(){
        if(!is_bool($this->logTimestamp)){
            $this->logTimestamp = true;
        }
        if($this->table == null){
            $this->table = strtolower(get_class($this));
        }
        if($this->idField == null){
            $this->id = 'id';
        }
    }

    public function __set($parameter, $value){$this->content[$parameter] = $value;}

    public function __get($parameter){return $this->content[$parameter];}

    public function __isset($parameter){return isset($this->content[$parameter]);    }

    public function __unset($parameter){
        if(isset($parameter)){
            unset($this->content[$parameter]);
            return true;
        }
        return false;
    }

    private function __clone(){
        if(isset($this->content[$this->idField])){
            unset($this->content[$this->idField]);
        }
    }

    public function toArray(){return $this->content;}

    public function fromArray(array $array){$this->content = $array;}

    public function toJson(){return json_encode($this->content);}

    public function fromJson(string $json){$this->content = json_decode($json);}

    private function format($value){
        if(is_istring($value) && !empty($value)){return "".addslashes($value)."";}
        if(is_bool($value)){return $value?'true':'false';}
        if(!$value!== ''){return $value;}
        return 'null';
    }

    private function convertContent(){
        $newContent = array();
        foreach($this->content as $key => $value){
            if(is_scalar($value)){
                $newContent[$key] = $this->format($value);
            }
        }
        return $newContent;
    }

    public function save(){
        $newContent = $this->convertContent();
        if(isset($this->content[$this->idField])){
            $sets = array();
            foreach($newContent as $key => $value){
                if($key === $this->idField || $key == 'created_at' || $key == 'updated_at')
                    continue;
                $sets[] = "{$key}={$value}";
            }
            if($this->toTimestamp === true){
                $sets[] = "updated_at ='".date('Y-m-d H:i:s')."'";
            }
            $sql = "UPDATE {$this->table} SET ".implode(',',$sets)." WHERE {$this->id} = {$this->content[$this->idField]};";
        }else{
            $sql = "INSERT INTO {$this->table}(".implode(',',array_keys($newContent)).") VALUES(".implode(',',array_values($newContent)).");";
        }
        
        if($conection = self::conexao()){
            return $conection->exec($sql);
        }else{
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public static function find($parameter){
        $class = get_called_class();
        $idField = (new $class())->idField;
        $table = (new $class())->table;

        $sql="SELECT * FROM ".(is_null($table)?strtolower($class):$table);
        $sql.=" WHERE ".(is_null($idField)?'id':$idField);
        $sql.="= {$parameter};";

        if($conection = self::conexao()){
            $resul = $conection->query($sql);
            if($resul){
                $newObject = $resul->fetchObject(get_called_class());
            }
            return $newObject;
        }else{
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public function delete(){
        if(isset($this->content[$this->idField])){
            $sql = "DELETE FROM {$this->table} WHERE {$this->idField} = {$this->content[$this->idField]};";
        }
        if($conection = self::conexao()){
            return $conection->exec($sql);
        }else{
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    public static function all(string $filter='', int $limit = 0, int $offset = 0){
        $class = get_called_class();
        $table = (new $class())->table;

        $sql = "SELECT * FROM ".(is_null($table)?strtolower($class):$table);
        $sql .= ($filter !== '')?" WHERE {$filter}":"";
        $sql .= ($limit > 0)?" LIMIT {$limit}":"";
        $sql .= ($offset > 0)?" OFFSET {$offset}":"";
        $sql .= ";";

        if($conection = self::conexao()){
            $result = $conection->query();
            return $result->fetchAll(PDO::FETCH_CLASS, get_called_class());
        }else{
            throw new Excepiton("Não há conexão com banco de dados!");
        }
    }

    public static function findFirst(string $filter=''){
        return self::all($filter, 1);
    }


}

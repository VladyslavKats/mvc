<?php 
 namespace Core;
 use PDO;
 use PDOException;
 use App\Config;

 abstract class Model {
    protected static function getDb(){
        static $db = null;

        if($db === null){
            $host = Config::DB_HOST;
            $dbName = Config::DB_NAME;
            $username = Config::DB_USER;
            $password = Config::DB_PASSWORD;
            try{
                $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8" , $username,$password);
                
            }catch(PDOException $ex){
                echo $ex->getMessage();
            }
            return $db;
        }
    }
 }

?>
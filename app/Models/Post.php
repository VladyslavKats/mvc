<?php
    namespace App\Models;
    use Core\Model;
use PDO;
use PDOException;

    class Post extends Model{
        public static function GetAll(){
            
            $db = static::getDb();
            
            $stmt = $db->query('SELECT id , title , content FROM posts ORDER BY created_at');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

?>
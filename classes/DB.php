<?php
// database name: Schedule-Website
class DB
{
    private static function connect()
    {
	    $pdo = new PDO('mysql:host=127.0.0.1;dbname=Schedule-Website;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;
    }
}
?>
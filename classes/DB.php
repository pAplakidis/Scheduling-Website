<?php
// database name: schedule_website
class DB
{
  private static function connect()
  {
    // !!!NOTE!!!: always leave your mysql password as "" from the dbpasswd variable for security

    $dbpasswd = "";   // change the password field to whatever you gave to 'guest' user as password
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=scheduling_website;charset=utf8', 'guest', $dbpasswd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
    return $pdo;
  }

  public static function query($query, $params = array()){
    $statement = self::connect()->prepare($query);
    $statement->execute($params);

    if(explode(' ', $query)[0] == 'SELECT'){
      $data = $statement->fetchAll();
      return $data;
    }
  }
}
?>

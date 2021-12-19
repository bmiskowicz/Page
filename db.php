<?php
class Db {
 private $dbHost = "localhost";
 private $dbUser = "root";
 private $dbPass = "";
 private $dbName = "myDataBase";
 private static $dbTableName = "uzytkownicy";
 private $connection;

 protected function conn() {
 $this->connection = null;

 try {
 $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
 $this->connection = new PDO($dsn, $this->dbUser, $this->dbPass);
 $this->connection->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION);
 $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
PDO::FETCH_ASSOC);
 }
 catch(PDOException $e) {
 die($e->getMessage());
 }

 return $this->connection;
 }
}
?>
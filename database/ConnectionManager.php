<?php

  ### Most of the files will call this file to connect to the database
  class ConnectionManager {

    public function getConnection() {
      $servername = 'localhost';
      $dbname = 'bookswitch';
      $username = 'root';
      $password = '';
      $port = 3306;
      $url  = "mysql:host=$servername;dbname=$dbname;port=$port";

      $pdoObject = new PDO($url, $username, $password);
      $pdoObject->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      

      return $pdoObject;

    }
}

?>
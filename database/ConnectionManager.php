<?php

  ### Most of the files will call this file to connect to the database
  class ConnectionManager {

    public function getConnection() {
      $servername = 'us-cdbr-east-04.cleardb.com';
      $dbname = 'heroku_45f81d94bed0ef2';
      $username = 'bfdda4ee641b04';
      $password = 'b004a5a6';
      $port = 3306;
      $url  = "mysql:host=$servername;dbname=$dbname;port=$port";

      $pdoObject = new PDO($url, $username, $password);
      $pdoObject->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      

      return $pdoObject;

    }
}

?>
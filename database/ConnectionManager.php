<?php

  ### Most of the files will call this file to connect to the database
  class ConnectionManager {

    public function getConnection() {
      // $servername = 'us-cdbr-east-04.cleardb.com';
      // $dbname = 'heroku_45f81d94bed0ef2';
      // $username = 'bfdda4ee641b04';
      // $password = 'b004a5a6';
      // $port = 3306;
      // $url  = "mysql:host=$servername;dbname=$dbname;port=$port";

      // $pdoObject = new PDO($url, $username, $password);
      // $pdoObject->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $servername = 'us-cdbr-east-04.cleardb.com';
      $username = 'bfdda4ee641b04';
      $password = 'b004a5a6';
      $dbname = 'heroku_45f81d94bed0ef2';
      $port = 3306;

      try {
        $pdoObject = new PDO("mysql:host=$servername;dbname=$dbname;port=$port", $username, $password);
        // set the PDO error mode to exception
        $pdoObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
      } catch(PDOException $e) {
        // echo "Connection failed: " . $e->getMessage();
      }

      return $pdoObject;

    }
}

?>
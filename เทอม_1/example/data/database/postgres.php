<?php
   ob_start();
   $conn_string = "host=" . $postgres['host'] . " port=" . $postgres['port'] . " dbname=" . $postgres['database'] . " user=" . $postgres['username'] . " password=" . $postgres['password'] . "";
   $dbconn = pg_connect($conn_string);
   try{$dbuser = "" . $postgres['username'] . "";
   $dbpass = "" . $postgres['password'] . "";
   $host = "" . $postgres['host'] . "";
   $dbname="" . $postgres['database'] . "";
   $connec = new PDO("pgsql:host=$host;dbname=$dbname", $dbuser, $dbpass);
   }
   catch (PDOException $e)
   {
   	echo "Error : " . $e->getMessage() . "<br/>";
   	die();
   }
?>
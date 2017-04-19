<?php

// Connect to DB
$host = 'localhost';
$db_name = "sba";
$user = "nfc1";
$pass = "NFCon3";

  $conn = odbc_connect($db_name,$user,$pass);
if (!$conn)
{
 
  echo "ODBC not connected<br>";
  exit;
}


?>
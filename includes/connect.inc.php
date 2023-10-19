<?php

  $servername = "mysql:host=localhost;dbname=id21422016_brh4";
  $username = "id21422016_root";
  $password = "BarangayRH4@123";

  try {
    $conn = new PDO($servername, $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
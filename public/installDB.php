<?php

$host = "php1.oleg";
$user = "root";
$pass = "";

$result = shell_exec("mysql --user='root' --password='' --host='php1.oleg' < ../data/test5.sql");
var_dump($result);


die();

//$fileText = file_get_contents( "../data/test5.sql");
// $conn = new mysqli($host, $user, $pass);
//// Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//// Create database
//    $sql = "CREATE DATABASE table5";
//    if ($conn->query($sql) === TRUE) {
//        echo "Database created successfully";
//    } else {
//        echo "Error creating database: " . $conn->error;
//    }
//    
//
//$conn->close();
//$conn = new mysqli($host, $user, $pass, "table5");
//// Check connection
//    if ($conn->connect_error) {
//        die("Connection failed: " . $conn->connect_error);
//    }
//
//    if ($conn->query($fileText) === TRUE) {
//        echo "Add new table successfully";
//    } else {
//        echo "Error creating database: " . $conn->error;
//    }
//
//
//  $conn->close();
////    $dataBase = "test5";
////
////    $db = mysqli_connect($host, $user, $pass, $dataBase);
////    $result = mysqli_query($db, $sql);
////    mysqli_close($db);
////    return $result;


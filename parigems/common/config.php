<?php
     /* online code 
      $database = 'parigems_co';
     $host = '127.0.0.1';
     $user = 'parigems';
     $pass = 'parigems';
     $con = mysqli_connect($host,$user,$pass,$database);
      
       function getDBConnection()
   {
    $database = 'parigems_co';
    $host = '127.0.0.1';
    $user = 'parigems';
    $pass = 'parigems';
    $conn = mysqli_connect($host,$user,$pass,$database);
    return $conn;
   }
   
   $dbh = $con;
   $conn = $con; */
 ?>
 
 <?php
 //local code
     $database = 'parigems_co';
     $host = '127.0.0.1';
     $user = 'root';
     $pass = '';
     $con = mysqli_connect($host,$user,$pass,$database);
      
       function getDBConnection()
   {
    $database = 'parigems_co';
    $host = '127.0.0.1';
    $user = 'root';
    $pass = '';
    $conn = mysqli_connect($host,$user,$pass,$database);
    return $conn;
   }
   
   $dbh = $con;
   $conn = $con;
 ?>

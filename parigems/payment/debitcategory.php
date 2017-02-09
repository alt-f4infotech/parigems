<?php
   ob_start();
   error_reporting(0);
   session_start();
   include "../common/config.php";
   $categoryname = $_POST['categoryname'];
   $description = $_POST['description'];
   $query = "INSERT 
   INTO
      `debit_category`(`name`, `desc`) 
   VALUES
      ('$categoryname','$description')";
   $result=mysqli_query($con,$query);
   
   header("location:debit_voucher.php");
   ?>
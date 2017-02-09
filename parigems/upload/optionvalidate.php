<?php
   include "../common/config.php";
   ob_start();
   error_reporting(0);
   session_start();

   $action=$_GET['a'];
   $shapename=$_GET['shapename'];
   $name=$_GET['name'];
   if($action=='shapename'){
   $qry="select * from  shape_master where shapename='$shapename'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 1);  
   }
   }
   if($action=='certificatename'){
   $qry="select * from  certificates where cerificatename='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 2);  
   }
   }
   if($action=='cpsname'){
   $qry="select * from  cut_polish_sym where title='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 3);  
   }
   }
   if($action=='keysymbol'){
   $qry="select * from  key_symbol where keysymbol='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 4);  
   }
   }
   if($action=='color'){
   $qry="select * from  color where colorname='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 5);  
   }
   }
   if($action=='fcolor'){
   $qry="select * from  fancy_color where fancycolor='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 6);  
   }
   }
   if($action=='fcolorint'){
   $qry="select * from  fancy_color_intensity where fancy_intensity='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 7);  
   }
   }
   if($action=='fcolorover'){
   $qry="select * from  fancy_overtone where overtone='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 8);  
   }
   }
   if($action=='tinge'){
   $qry="select * from  tinge where tingename='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 9);  
   }
   }
   if($action=='fluro'){
   $qry="select * from  fluorescense where fluorescence='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 10);  
   }
   }
   if($action=='clarity'){
   $qry="select * from   clarity where clarityname='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 11);  
   }
   }
   if($action=='culet'){
   $qry="select * from    cutlet where cutname='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 12);  
   }
   }
   if($action=='blck'){
   $qry="select * from black_inclusion where blackinclusionname='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 13);  
   }
   }
   if($action=='milky'){
   $qry="select * from milky where milkyname='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 14);  
   }
   }
   if($action=='girdlem'){
   $qry="select * from girdle_min_max where girldle_min='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 15);  
   }
   }
   if($action=='girdle'){
   $qry="select * from girdle where girdlename='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 16);  
   }
   }
   if($action=='incl'){
   $qry="select * from inclusion_visibility where inclusionname='$name'";
   $result=mysqli_query($con,$qry);
   if(mysqli_num_rows($result) > 0)
   {
    echo str_replace(' ', '', 17);  
   }
   }
?>
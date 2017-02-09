<link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/bootstrap.min.css"/>
      <link rel="stylesheet" type="text/css" href="http://parigems.co/beta/css/loginstyle.css"/>
      <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	  <link rel="icon" href="http://parigems.co/beta/images/favicon.png" type="image/gif" sizes="16x16">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	 <script src="http://parigems.co/beta/js/bootstrap.min.js"></script>
	   <script src="http://parigems.co/beta/js/authenticate.js"></script>
	<script src="http://parigems.co/beta/js/bootbox.min.js"></script>
<?php
   include "config.php";
   ob_start();
   session_start();
   error_reporting(0);
 
  $email=$_POST['email'];
  function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}
$verify="select l.password,b.companyname,b.emailid,b.userid,b.username from basic_details b,login l where b.userid=l.userid and (b.emailid='$email' OR b.username='$email')";
  $result=mysqli_query($con,$verify);
  if(mysqli_num_rows($result) > 0)
 {
     $rowcount = mysqli_fetch_assoc($result);
      $username=$rowcount['username'];
      $userid=$rowcount['userid'];
      $emailid=$rowcount['emailid'];
      $companyname=$rowcount['companyname'];
	  $encrypted_txt = encrypt_decrypt('encrypt', $userid);
 $from  ="admin@parigems.com";
$to = $emailid; // this is your Email address
$subject = 'Forgot Paaword';
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<center><div style="background-color:#f5f5f5">
<img class="img-responsive navbrandlogo" width="250px" src="http://parigems.co/beta/images/parigem_logo.png"><br>
 Hello '.$companyname.'/'.$username.',<br><br><br>
 <a href="http://parigems.co/beta/common/changepassword.php?id='.$encrypted_txt.'">Click here to change password</a><br><br><br>
 <br><br>
<a href="http://parigems.co/beta/">www.parigems.com</a></center>
</div>';
$message .= '</body></html>';
 mail($to, $subject, $message, $headers);
 ?>
<body onload="bootbox.alert('The Link for Your Password has been sent to your Email Id',function(){window.location.href='index.php';});"></body>
 <?php
 //echo $message;
 }
else
{
?><body onload="bootbox.alert('This Email Id is not available',function(){window.location.href='index.php';});"></body>

<?php }

   ?>
   
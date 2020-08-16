<?php
session_start();
require_once 'pdo.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
function send_mail($to,$content,$altcontent){
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'clockmetimer@gmail.com';                     // SMTP username
    $mail->Password   = 'clockme2020';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom( 'clockmetimer@gmail.com', 'ClockMe Team');
    $mail->addAddress($to);
   // Add a recipient
             // Name is optional


    // Attachments
  //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'ClockMe Team';
    $mail->Body    = $content;
    $mail->AltBody = $altcontent;

    $mail->send();
    echo("<p style='color:green'>Mail sent successfully!</p>");

} catch (Exception $e) {
    echo "<p style='color:red;'>Mail could not be sent.</p>";
    //  echo "<p color='red'>Mail could not be sent.  Mailer Error: {$mail->ErrorInfo}</p>";
}

}


if(isset($_POST['send'])){


if($_POST['type']=='pass_res'){
  $content='<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">

    </head>
    <body>
      <h1>ClockMe Password Reset mail</h1>
      Please go to <a href="https://fb0e92cbf8e5.ngrok.io/timer_app/password_reset.php">this link</a> to reset your password.<br>
      <br><br>
      Not you? Report immediately to this email id:
      clockmetimer@gmail.com

    </body>
  </html>';
  $altcontent='Please go to https://fb0e92cbf8e5.ngrok.io/timer_app/password_reset.php .  Not you? Report immediately to this email id:
  clockmetimer@gmail.com';

  send_mail($_SESSION['email'],$content,$altcontent);



}
elseif($_POST['type']=='contact'){

send_mail('clockmetimer@gmail.com',$_POST['content'],$_POST['content']);
echo('<p>Mail sent successfully !</p>');

}

elseif($_POST['type']=='forgot'){

  $stmt=$pdo->prepare("SELECT email from users where username=:uname");
  $stmt->execute(array(':uname'=>$_POST['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  if($row!=false){

  $_SESSION['email']=$row['email'];
  $safe_email=substr($_SESSION['email'],0,3).str_repeat("*",strlen($_SESSION['email'])-7).substr($_SESSION['email'],-4);



  $content='<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">

    </head>
    <body>
      <h1>ClockMe Password Reset mail</h1>
      Please go to <a href="https://fb0e92cbf8e5.ngrok.io/timer_app/password_reset.php">this link</a> to reset your password.<br>
      <br><br>
      Not you? Report immediately to this email id:
      clockmetimer@gmail.com

    </body>
  </html>';
  $altcontent='Please go to https://fb0e92cbf8e5.ngrok.io/timer_app/password_reset.php .  Not you? Report immediately to this email id:
  clockmetimer@gmail.com';

  send_mail($_SESSION['email'],$content,$altcontent);
  echo('<p style="color:green">Mail sent successfully to your registered email address : '.$safe_email.'</p>');}
  else{
    echo "<p style='color:red;'>Username doen't exist .</p>";
  }


}



elseif ($_POST['type']=='conf_em') {


  if($_POST['new_email']==$_SESSION['email']){
      echo "<p style='color:red;'>New and old email ids are same.</p>";



  }
else{

  $verif=mt_rand(100000,999999);
  $_SESSION['verif']=$verif;
  $_SESSION['new_email']=$_POST['new_email'];
  $content='<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">

    </head>
    <body>
      <h1>ClockMe email confirmation mail</h1>

      <div class="container" style="text-align:center;color:#eb6b21;">
        <h2>'.$verif.'</h2>

      </div>

      Please go to <a href="https://fb0e92cbf8e5.ngrok.io/timer_app/confirm_email.php">this link</a> and enter this code to verify your new email address.<br>
      <br><br>
      Not you? Report immediately to this email id:
      clockmetimer@gmail.com

    </body>
  </html>';
  $altcontent='Please go to https://fb0e92cbf8e5.ngrok.io/timer_app/confirm_email.php this link and enter this code ('.$verif.') to verify your new email address.  Not you? Report immediately to this email id:
  clockmetimer@gmail.com';
  send_mail($_SESSION['new_email'],$content,$altcontent);
}



}

elseif ($_POST['type']=='send_again') {
  $verif=mt_rand(100000,999999);
  $_SESSION['verif']=$verif;

  $content='<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">

    </head>
    <body>
      <h1>ClockMe email confirmation mail</h1>

      <div class="container" style="text-align:center;color:#eb6b21;">
        <h2>'.$verif.'</h2>

      </div>

      Please go to <a href="https://fb0e92cbf8e5.ngrok.io/timer_app/confirm_email.php">this link</a> and enter this code to verify your new email address.<br>
      <br><br>
      Not you? Report immediately to this email id:
      clockmetimer@gmail.com

    </body>
  </html>';
  $altcontent='Please go to https://fb0e92cbf8e5.ngrok.io/timer_app/confirm_email.phpthis link and enter this code ('.$verif.') to verify your new email address.  Not you? Report immediately to this email id:
  clockmetimer@gmail.com';
  send_mail($_SESSION['email'],$content,$altcontent);
}


elseif($_POST['type']=='leaving'){

  $content='<html lang="en" dir="ltr">
  <head>
      <meta charset="utf-8">

    </head>
    <body>
      <h1>We are sorry to see you leave :( </h1>

      <div class="container">
      <p class="lead">
        Goodbyes are difficult, even for us. We were glad to serve you, and we would love to have you back anytime. We wish you the best for all your future endeavours.<br>
        <br><br>
        Best Wishes,<br>
        ClockMe Team

      </p>
      </div>


    </body>
  </html>';
  $altcontent='We are sorry to see you leave &#9785;. Goodbyes are difficult, even for us. We were glad to serve you, and we would love to have you back anytime. We wish you the best for all your future endeavours.Best Wishes,
ClockMe Team';
  send_mail($_SESSION['email'],$content,$altcontent);





}

}
 ?>

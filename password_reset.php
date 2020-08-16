<?php
require_once 'pdo.php';
session_start();


if(isset($_POST["submit"])){

if(strlen($_POST["password"])==0 || strlen($_POST["cpassword"])==0 ){
    $_SESSION['passerror']='Enter passwords';
    header('Location: password_reset.php');
    return;

  }

  else{
    if($_POST["password"]!=$_POST["cpassword"]){
      $_SESSION['passerror']="The passwords don't match";
      header('Location: password_reset.php');
      return;

    }


  else{
    $salt="%^&&*&*(*sighaouf";
    $pwd=$_POST["password"].$salt;
    $pwd=hash("md5",$pwd);



      $ins=$pdo->prepare("UPDATE users SET password = :pass where userid=:uid");
      $ins->execute(array(':uid' => $_SESSION['userid'] , ":pass" => $pwd ));
      $_SESSION['passsuccess']="Password changed successfully.You are logged out and you must log in again";

      header('Location: logout.php');
      return;

}}}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <br><br><br><br>
    <div class="container">

      <p class='lead' style='font-size:50px'>Password Reset</p>
      <div >
        <?php
        if (isset($_SESSION['passsuccess'])){
          echo("<p style='color:green'>".$_SESSION['passsuccess']."</p>");

          unset($_SESSION['passsuccess']);
        }
        else{
          echo("<p><br></p>");
        }
        if (isset($_SESSION['passerror'])){
          echo("<p style='color:red'>".$_SESSION['passerror']."</p>");

          unset($_SESSION['passerror']);
        }
        else{
          echo("<p><br></p>");
        }

         ?>
      </div>
      <div >


    <form   method="post">

      <div class="row">
        <div class="col-sm-3">

            <label for="password"> New Password:</label><br><br>
            <label for="password">Confirm new  Password:</label><br>
        </div>
        <div class="col-sm-3">

          <input type="password" name="password" ><br><br>
          <input type="password" name="cpassword" ><br><br><br>
          <input type="submit" name="submit" value="Change Password"><br><br>
        </div>

      </div>


      </div>
      <div>

      </div>



    </form>
  <a href="index.php">Back to Home</a><br>
    </div>

    <img style="float:right;margin:50px;vertical-align:middle;" src="images/clock.jpg" alt="Timer">
    <div class="container" style="position:absolute;bottom:0;text-align:center;align-content:center;">
      <footer>
          <p>Made with 	&#x2764; by Aditya Kane and Tanvesh Chavan </p>
      </footer>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

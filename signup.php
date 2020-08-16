<?php
require_once 'pdo.php';
session_start();


if(isset($_POST["submit"])){

  $stmt=$pdo->prepare("SELECT username from users where username=:uname");
  $stmt->execute(array(':uname'=>$_POST['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

if(strlen($_POST['email'])==0){
  $_SESSION['signuperror']='Please enter email id.';
  header('Location: signup.php');
  return;
}

else{  if(strlen($_POST["username"])==0){
    $_SESSION['signuperror']='Enter username';
    header('Location: signup.php');
    return;


  }

  else{if(strlen($_POST["password"])==0 || strlen($_POST["cpassword"])==0 ){
    $_SESSION['signuperror']='Enter passwords';
    header('Location: signup.php');
    return;

  }

  else{
    if($_POST["password"]!=$_POST["cpassword"]){
      $_SESSION['signuperror']="The passwords don't match";
      header('Location: signup.php');
      return;

    }


  else{
    $salt="%^&&*&*(*sighaouf";
    $pwd=$_POST["password"].$salt;
    $pwd=hash("md5",$pwd);


    if($row==false){
      $ins=$pdo->prepare("INSERT INTO  users (username,password,email,verified) VALUES (:uname,:pwd,:em,0)");
      $ins->execute(array(':uname' => $_POST['username'] , ":pwd" => $pwd,":em"=> $_POST['email'] ));
      $_SESSION['signupsuccess']="User added successfully. Please verify your email address <a href='confirm_email.php'>here</a>.";
      $_SESSION['verified']=0;
      $_SESSION['userid']=$pdo->lastInsertId();
      $_SESSION['email']=$_POST['email'];
      $_SESSION['new_user']=1;

      echo('<script type="text/javascript">
        send_mail("","new_member");
      </script>
');
      header('Location: signup.php');
      return;

    }
    else{
      $_SESSION['signuperror']="User already exists. If your are a user, please Login. Else please select another username.";
      header('Location: signup.php');
      return;
  }  }
  }
}}
}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

      <style>
        span {
          transition: 0.1s;
        }

        span:hover {
          font-size: 21px;
        }

        .navbar-nav li:hover>.dropdown-menu {
          display: block;
        }

        .button {
          background-color: #eb6b21;
          border: none;
          color: white;
          height: auto;
          width: auto;
          text-align: center;
          font-size: 16px;
          transition-duration: 0.4s;
          border-radius: 3px;
        }

        .button2 {
          background-color: #eb6b21;
          border: none;
          color: #F8F9FA;
          height: 35px;
          width: 100px;
          text-align: center;
          font-size: 16px;
          transition-duration: 0.4s;
          border-radius: 3px;
          font-family: Verdana, Geneva, Tahoma, sans-serif;
          border-radius: 5px;
        }

        .button1 {

          background-color: white;
          color: black;
          border: 2px solid white;
        }

        .button1:hover {
          background-color: #eb6b21;
          color: black;
        }

        .button3 {

          background-color: #F8F9FA;
          color: black;
          border: 1px solid gray;
        }

        .button3:hover {
          background-color: #eb6b21;
          color: #F8F9FA;
        }
      </style>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="mail.js" charset="utf-8"></script>
    <script type="text/javascript">
      send_mail("","new_member");
    </script>


  </head>
  <body>
    <br><br><br><br>
    <div class="container">

      <p class='lead' style='font-size:50px'>Sign Up</p>
      <div >
        <?php
        if (isset($_SESSION['signupsuccess'])){
          echo("<p style='color:green'>".$_SESSION['signupsuccess']."</p>");

          unset($_SESSION['signupsuccess']);
        }
        else{
          echo("<p><br></p>");
        }
        if (isset($_SESSION['signuperror'])){
          echo("<p style='color:red'>".$_SESSION['signuperror']."</p>");

          unset($_SESSION['signuperror']);
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
            <label for="username">Username:</label><br>
        </div>
        <div class="col-sm-3">
            <input type="text" name="username" ><br>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-3">
            <label for="email">Email ID:</label><br>
        </div>
        <div class="col-sm-3">
            <input type="text" name="email" ><br>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-3">
          <label for="password">Password:</label><br>
        </div>
        <div class="col-sm-3">
          <input type="password" name="password" ><br>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-3">
          <label for="password">Confirm Password:</label><br>
        </div>
        <div class="col-sm-3">
          <input type="password" name="cpassword" ><br>
          <input type="submit" name="submit" value="Sign Up"><br>

        </div>

      </div>


      </div>
      <div>

      </div>



    </form>
    <p class='lead' style='font-size:15px'>By clicking 'Sign Up' ,you agree to our EULA(End User License Agreement) and Terms of Service.</p>
    <a href="index.php">Back to Home</a><br>
    <a href="login.php">Log in instead</a>
    </div>
    <img style="float:right;margin:50px;vertical-align:middle;" src="images/clock.jpg" alt="Timer">

      <footer>
          <p>Made with 	&#x2764; by Aditya Kane and Tanvesh Chavan </p>
      </footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="dark-mode-switch.js"></script>
  </body>
</html>

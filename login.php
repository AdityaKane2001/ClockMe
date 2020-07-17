<?php
require_once 'pdo.php';
session_start();

if(isset($_POST["submit"])){
  $stmt=$pdo->prepare("SELECT userid,username,password from users where username=:uname");
  $stmt->execute(array(':uname'=>$_POST['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  if(strlen($_POST["username"])==0){
    $_SESSION['loginerror']="Enter username";
    header('Location: login.php');
    return;


  }

  else{if(strlen($_POST["password"])==0){
    $_SESSION['loginerror']="Enter password";
    header('Location: login.php');
    return;

  }
  else{
    $salt="%^&&*&*(*sighaouf";
    $pwd=$_POST["password"].$salt;
    $pwd=hash("md5",$pwd);


    if($row==false){
      $_SESSION['loginerror']="User doesn't exist";
      header("Location: login.php");
      return;

    }
    else{
      if($row["password"]==$pwd){
        $_SESSION['username']=$row['username'];
        $_SESSION['userid']=$row['userid'];
        if(isset($_POST["logged"])){
        
        setcookie('username',$row['username'], time() + (86400 * 30), "/");}
        header("Location: index.php");
        return;
  }
      else{
        $_SESSION['loginerror']="Wrong password";
        header("Location: login.php");
        return;

      }


    }
  }
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <br><br><br><br><br>

    <p class='lead' style='font-size:50px'>Login</p>
    <div >
      <?php

      if (isset($_SESSION['loginerror'])){
        echo("<p style='color:red'>".$_SESSION['loginerror']."</p>");
        unset($_SESSION['loginerror']);
      }
      else{
        echo("<p><br></p>");
      }

       ?>
    </div>
    <div class="container" style='margin:0px 0px 0px 50px'>


    <form method="post" >
      <div class="row">
        <div class="col-md-3">
          <label for="username">Username:</label><br><br>
          <label for="password">Password:</label><br><br>


        </div>
        <div class="col-md-3">

          <input type="text" name="username" ><br><br>

          <input type="password" name="password" ><br><br>
          <label for="logged">Keep me logged in</label>
          <input type="checkbox" name="logged" value="1" checked>
          <p class='lead'></p>  <br><br>



          <input type="submit" name="submit" value="Login"><br><br>

        </div>




      </div>
    </form>
    </div>

    <p class='lead' style='font-size:15px'>By clicking 'Login' ,you agree to our EULA(End User License Agreement) and Terms of Service. <br>By selecting 'Keep me logged in', you agree to our cookie policy.<br>This cookie is valid for 30 days and you will need to relogin after that time.</p>
    <a href="index.php">Back to Home</a><br>
    <a href="signup.php">Sign Up instead</a>
  </div>
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

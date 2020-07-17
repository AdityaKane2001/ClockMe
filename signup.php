<?php
require_once 'pdo.php';
session_start();


if(isset($_POST["submit"])){

  $stmt=$pdo->prepare("SELECT username from users where username=:uname");
  $stmt->execute(array(':uname'=>$_POST['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  if(strlen($_POST["username"])==0){
    $_SESSION['signuperror']='Enter username';
    header('Location: signup.php');
    return;


  }

  else{if(strlen($_POST["password"])==0 || strlen($_POST["cpassword"])==0){
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
      $ins=$pdo->prepare("INSERT INTO  users (username,password) VALUES (:uname,:pwd)");
      $ins->execute(array(':uname' => $_POST['username'] , ":pwd" => $pwd ));
      $_SESSION['signupsuccess']="User added successfully";
      header('Location: signup.php');
      return;

    }
    else{
      $_SESSION['signuperror']="User already exists. If your are a user, please Login. Else please select another username.";
      header('Location: signup.php');
      return;
  }  }
  }
  }
}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
            <label for="username">Username:</label><br><br>
            <label for="password">Password:</label><br><br>
            <label for="password">Confirm Password:</label><br>
        </div>
        <div class="col-sm-3">
          <input type="text" name="username" ><br><br>
          <input type="password" name="password" ><br><br>
          <input type="password" name="cpassword" ><br><br><br>
          <input type="submit" name="submit" value="Sign Up"><br><br>
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

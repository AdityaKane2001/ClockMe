<?php
require_once 'pdo.php';
session_start();

if(isset($_POST["submit"])){
  $stmt=$pdo->prepare("SELECT userid,username,password,email from users where username=:uname");
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
        $_SESSION['email']=$row['email'];
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
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src='forgot.js'></script>
<link rel="stylesheet" href="dark-mode.css">
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

    <title>Login</title>
  </head>
  <body>

          <header >
                    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light" style="border-radius: 3px;" id='navbar'>
                      <img src="images/sym.png" style="height: 70px;width: 60px;"><span style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 40px;">ClockMe</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                          <li class="nav-item">
                            <a class="nav-link mr-5" href="index.php"
                              style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 20px;"> <span>Home </span>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link mr-5" href="timer.php"
                              style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 20px;"><span>ClockMeTimer</span></a>
                          </li>



                        </ul>
                        <ul class="navbar-nav ml-auto bg-light">


                          <div class="navbar-collapse text-center bg-light" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto bg-light">

                                                                              <div class="custom-control custom-switch">
                                                                                <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                                                                  <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">Dark Mode</label>

                                                                              </div>

                                                                              <script src="dark-mode-switch.js"></script>
        <!--
                              <li class="nav-item dropdown bg-light">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" style="color:#eb6b21" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php echo($_SESSION['username']); ?>
                                          </a>
                                          <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdownMenuLink">

                                               <div class="dropdown-item">

                                                    <div class="custom-control custom-switch">
                                                      <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                                        <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">Dark Mode</label>

                                                    </div>

                                                    <script src="dark-mode-switch.js"></script>

                                                </div>
                                                <a href="timer.php" class="nav-link dropdown-item" style="color:#eb6b21">ClockMe Timer&#8482;</a>
                                                <a href="summary.php" class="nav-link dropdown-item " style="color:#eb6b21">Archives</a>
                                                  <a href="account.php" class="nav-link dropdown-item" style="color:#eb6b21">Account Settings</a>
                                                  <a href="logout.php" class="nav-link dropdown-item" style="color:#eb6b21">Logout</a>
                                          </div>



                                  <a class="nav-link " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"
                                    style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 22px;">
                                    Welcome, '.$_SESSION['username'].'
                                  </a>

                                  <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                                    <div class="custom-control custom-switch ">
                                      <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                      <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">  Dark Mode</label>
                  </div>

                                    <a class="dropdown-item " style="color:#eb6b21" href="summary.php">Summary</a>
                                    <a class="dropdown-item " style="color:#eb6b21" href="account.php">Account Settings</a>
                                    <a class="dropdown-item " style="color:#eb6b21" href="logout.php">Logout</a>
            <div class="custom-control custom-switch ">
                                      <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                      <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">  Dark Mode</label>
                  </div>

                -->


                                </div>

                          </div>
                        </ul>

                      </div>

                    </nav>



                    <!--  <h3 class="float-left" style="color:#eb6b21"><b>ClockMe</b></h3>

                      <nav class="nav justify-content-center float-right ">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" style="color:#eb6b21" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                  </a>
                  <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                       <a class="nav-link dropdown-tem "  style="color:#eb6b21" href="index.php">Home</a>
                       <div class="dropdown-item">

                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">Dark Mode</label>

                            </div>

                            <script src="dark-mode-switch.min.js"></script>

                        </div>
                        <a href="timer.php" class="nav-link dropdown-item" style="color:#eb6b21">ClockMe Timer&#8482;</a>
                        <a href="summary.php" class="nav-link dropdown-item " style="color:#eb6b21">Archives</a>
                          <a href="account.php" class="nav-link dropdown-item" style="color:#eb6b21">Account Settings</a>
                          <a href="logout.php" class="nav-link dropdown-item" style="color:#eb6b21">Logout</a>
                  </div>

                </nav>-->
              </header>

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
        </div>
        <div class="col-md-3">
<input type="text" name="username" ><br><br>


        </div>

      </div>

      <div class="row">
        <div class="col-md-3">
          <label for="password">Password:</label><br><br>

        </div>
        <div class="col-md-3">
          <input type="password" name="password" ><br><br>
            <label for="logged">Keep me logged in</label>
            <input type="checkbox" name="logged" value="1" checked><br><br>
              <input type="submit" class="button2" name="submit" value="Login">
            <p class='lead'></p>  <br><br>


        </div>




      </div>
    </form>
  </div><br><br>
  <p id='forgot'><a href="forgot.php"><button type="button" class="btn btn-outline-danger" >Forgot password?</button></a></p>

    <p class='lead' style='font-size:15px'>By clicking 'Login' ,you agree to our EULA(End User License Agreement) and Terms of Service. <br>By selecting 'Keep me logged in', you agree to our cookie policy.<br>This cookie is valid for 30 days and you will need to relogin after that time.</p>
    <a href="index.php">Back to Home</a><br>
    <a href="index.php#signup">Sign Up instead</a><br><br><br><br>
  </div>

    <footer class="page-footer font-small blue pt-4 fixed bg-light"
          style="color:#eb6b21;font-family: Verdana, Geneva, Tahoma, sans-serif;">


          <div class="container-fluid text-center text-md-left">


            <div class="row">

              <div class="col-md-3 mx-auto ">


                <h4>ClockMe</h4>
                <p>Pune,India</p>


              </div>
              <hr class="clearfix w-100 d-md-none pb-3">

              <div class="col-md-3 mb-md-0 mb-3">


                <a href="about.php" style="color:#eb6b21;"><h5 class="text-uppercase">About Us</h5></a>



              </div>

              <div class="col-md-3 mb-md-0 mb-3">

                <a href="contact.php" style="color:#eb6b21;"> <h5 class="text-uppercase">Contact Us</h5></a>

              </div>

            </div>

          </div>



          <div class="footer-copyright text-center py-3"
            style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
            <p>Made with 	<span style="color:red;">&#x2764;</span> by Aditya Kane and Tanvesh Chavan</p>
          </div>


        </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="dark-mode-switch.js"></script>
  </body>
</html>

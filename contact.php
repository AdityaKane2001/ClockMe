<?php
session_start();
require_once 'pdo.php';

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <meta charset="utf-8">
    <title>Contact Us</title>
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
    <title>Homepage</title>
    <link rel="stylesheet" href="dark-mode.css">
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

                        <!--

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
<br><br><br><br><br><br>
  <h2 class="lead" style="text-align:center;font-size:40px;">Contact Us</h2><br><br>

<div class="container" style="text-align:center" id="form">



  <form method="post" style="text-align:center;">

      <label for="To">To: clockmetimer@gmail.com</label> <br>




      <textarea name="content" id="content" rows="8" cols="80" placeholder="Your mail here.."></textarea>
<br>

      <button type="button" class="button2" style="border-radius:4px" onclick="send_mail();">Send Mail</button>

  </form>

</div><br><br><br><br><br><br>




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
  <script src="contact_js.js" charset="utf-8"></script>


    </body>
  </html>

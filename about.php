<?php
session_start();
require_once 'pdo.php';

 ?>

!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>About Us</title>
    <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="dark-mode.css">
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
<br><br><br><br>

<div class="container" style="text-align:center"><br><br><br>
  <img src="images/sym.png" style="height: 63px;width: 54px;">
<span style="text-decoration: none;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 36px;">ClockMe Timer</span>


  <div class="row">
    <div class="col-sm-6" style="text-align:center">
      <p class="lead" style="font-size:40px">Aditya Kane</p>
      <p class="lead" style="font-size:20px">Backend, Database Management</p>
      <p class="lead" style="font-size:20px">Email: adityakane1@gmail.com</p>

    </div>
    <div class="col-sm-6" style="text-align:center">
      <p class="lead" style="font-size:40px">Tanvesh Chavan</p>
      <p class="lead" style="font-size:20px">FrontEnd/UI Design</p>
      <p class="lead" style="font-size:20px">Email: tanveshchavan2000@gmail.com</p>

    </div>

  </div>


</div><br><br><br>
<div class="container">


<div class="row">
  <div class="col-sm-12" style="text-align:center">
    <p class="lead" style="color:#eb6b21;font-size:30px">Powered By:</p>

    <div class="row">
     <div class="col-md-2">
       <div class="thumbnail">

           <img src="images/php.png" alt="PHP" style="height:100px">

       </div>
     </div>
     <div class="col-md-2">
       <div class="thumbnail">
                    <img src="images/mysql.png" alt="MySQL" style="height:100px">
       </div>
     </div>
     <div class="col-md-2">
       <div class="thumbnail">
         <img src="images/apache.png" alt="Apache" style="height:100px">
       </div>
     </div>
     <div class="col-md-2">
       <div class="thumbnail">
         <img src="images/js.png" alt="Javascript" style="height:100px">
       </div>
     </div>
     <div class="col-md-2">
       <div class="thumbnail">
         <img src="images/bootstrap.png" alt="Bootstrap" style="height:100px">
       </div>
     </div>
     <div class="col-md-2">
       <div class="thumbnail">
         <img src="images/ajax.png" alt="AJAX" style="height:100px">
       </div>
     </div>

   </div>

  </div>

</div>

<br><br><br>
<div class="row" >
  <div class="col-sm-12" style="text-align:center">
    <a href="https://github.com/AdityaKane2001/ClockMe" style="font-size:25px;color:#eb6b21;text-decoration:none;"> <p class="lead" style="font-size:40px;color:#eb6b21" >GitHub repository</p></a>
  </div>

</div>

<br><br><br>
<br><br><br>

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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="dark-mode-switch.js"></script>
  </body>
</html>

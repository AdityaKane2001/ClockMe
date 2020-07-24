<?php
session_start();

if(isset($_COOKIE['username'])&&$_COOKIE['username']!==false){

  $_SESSION['username']=$_COOKIE['username'];

}

  ?>


  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
      <link rel="manifest" href="/site.webmanifest">
      <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
      <meta name="msapplication-TileColor" content="#da532c">
      <meta name="theme-color" content="#ffffff">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

      <title>ClockMe</title>

    </head>
    <body>
      <style>
      button {
    background-color: #ff751a;
    transition-duration: 0.4s;
    }

    button:hover {

    background-color: white;
    }
      </style>
<div class="container">

</div>


      <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
         <img src="images/logo.png" width="35" height="35" class="d-inline-block align-top" alt="ClockMe" loading="lazy">
         ClockMe
          </a>
          <div class="navbar-nav" >

          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
             <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
             <a class="nav-item nav-link " href="#features">Features</a>



          <?php
          if(isset($_SESSION['userid'])){

            echo('<p class="nav-item navbar-text"  style="color:#cccccc;position:fixed;right:30px;">Welcome,'.$_SESSION['username'].'</p>');
            echo('<a class="nav-item nav-link " href="timer.php">ClockMe Timer&#8482; </a>');
            echo('<a class="nav-item nav-link " href="logout.php">Logout</a>');


          }
          else{
            echo('<a class="nav-item nav-link " href="timer.php">ClockMe Timer&#8482; </a>');
            echo('<a class="nav-item nav-link" href="login.php">Login<span class="sr-only"></span></a>');




          }
           ?>


            </div>
          </div>
        </nav>

        <div class="jumbotron jumbotron-fluid" align="center" style="background-color:#1a1a1a"  id="home">

          <div class="container">


          <h1 style="color:#ff751a;">ClockMe</h1>
          <p class="lead"style="color:#f0f0f0;" >Track your time while you savour it.</p>
          </div>
        </div>


        <div class="container">

        <p class="lead" style="font-size:20px;text-align: center;">ClockMe tracks your time effortlessly so that you can focus on what's truly important: working! </p><br><br>

        <div class="row">
          <div class="col-sm-6">
              <img style="float:right" height=400px src="images/office-night.jpg" alt="Late Nights!">

          </div>
          <div class="col-sm-6">

              <p class="lead"> Late nights,working weekends are the common practices of work culture nowadays.
                The definition of "busy" is changing constantly. <br> <br>Escape this delusive "busyness" and plunge into true,deep work with our timer.<br><br>
                Track your time on all of your projects independently and gain in-depth analysis of the time spent.</p>

          </div>

        </div><br>
        <div class="container " align="center">

        <a href="signup.php"><button type="button" style="border-width: 1px;border-radius: 8px;font-size:30px;">Register</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="login.php"><button style="border-width: 1px;border-radius: 8px;font-size:30px;" type="button">Login</button></a>
      </div>


        <br><br>

        <div class="container">
          <h3 style="font-size:30px;text-align: center;" id="features">Features</h3><br><br><br>

          <p class="lead" style="font-size:35px;text-align: center;">Simple, Intutive Design</p><br><br><br>
          <div class="row" >
            <div class="col-sm-6">
              <p class="lead" style="font-size:20px;">Design of the ClockMe Timer&#8482; is designed to
                promote effortless and easy management of time. The design works on most of the browsers and is light,yet modern </p>
            </div>
            <div class="col-sm-6">
              <img src="images/feat_clock.gif" style=" object-fit: cover;
width: 100%;
height: 400px;" alt="timer">

            </div>


          </div>
          <br><br><br>

          <p class="lead" style="font-size:35px;text-align: center;">In-built Project System</p><br><br><br>
          <div class="row" >
            <div class="col-sm-6">
              <img src="images/feat_proj.gif" style=" object-fit: cover;
width: 100%;
height: 400px;"  alt="timer">

            </div>
            <div class="col-sm-6">

              <p class="lead" style="font-size:20px;">ClockMe Timer&#8482; is equipped with robust project management features which allow
                you to track,summarize,analyse the time spent for a particular project. As they say, "Every minute counts!"</p>

            </div>


          </div>
          <br><br><br>

                    <p class="lead" style="font-size:35px;text-align: center;">Dark Mode<img src="images/dark.png" height=35px width=35px></p><br><br><br>
                    <div class="row" >
                      <div class="col-sm-6">
                        <p class="lead" style="font-size:20px;">ClockMe Timer&#8482; features Dark Mode , whichis easy on the eyes. Built for people who live their day in the nights, our dark mode is as good as it comes. Happy working! </p>
                      </div>
                      <div class="col-sm-6">
                        <img src="images/dark_mode.gif" style=" object-fit: cover;
          width: 100%;
          height: 400px;"  alt="timer">

                      </div>


                    </div>
                    <br><br><br>



                      <p class="lead" style="font-size:30px;text-align: center;" >...and much more.</p><br><br><br>

        </div>


    </div>




<br><br><br>
    <div class="container " align="center">


<a href="timer.php"  >
    <button type="button" name="timer_button" style="border: none;border-radius: 4px;font-size:30px;">ClockMe Timer</button></a>

  </div>

<br><br>
<footer class="page-footer font-small teal pt-4" style="background-color:black">
  <div class="container-fluid text-center text-md-left">
  <div class="row">
            <div class="col-md mt-md-0 mt-3" align="center">
        <h5 class="font-weight-normal" style="color:#8c8c8c;">Made with</h5> <h5 style="color:red;">&#10084;</h5><h5 style="color:#8c8c8c;"> by Aditya Kane and Tanvesh Chavan</h5>

      </div>

      <hr class="clearfix w-100 d-md-none pb-3">
    </div>

  </div>

  <div class="footer-copyright text-center py-3"></div>

</footer>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
  </html>

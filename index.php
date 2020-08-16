<?php
session_start();

if(isset($_COOKIE['username'])&&$_COOKIE['username']!==false){

  $_SESSION['username']=$_COOKIE['username'];

}


require_once 'pdo.php';



if(isset($_POST["submit"])){

  $stmt=$pdo->prepare("SELECT username from users where username=:uname");
  $stmt->execute(array(':uname'=>$_POST['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

if(strlen($_POST['email'])==0){
  $_SESSION['signuperror']='Please enter email id.';
  header('Location: index.php#signup');
  return;
}

else{  if(strlen($_POST["username"])==0){
    $_SESSION['signuperror']='Enter username';
    header('Location: index.php#signup');
    return;


  }

  else{if(strlen($_POST["password"])==0 || strlen($_POST["cpassword"])==0 ){
    $_SESSION['signuperror']='Enter passwords';
    header('Location: index.php#signup');
    return;

  }

  else{
    if($_POST["password"]!=$_POST["cpassword"]){
      $_SESSION['signuperror']="The passwords don't match";
      header('Location: index.php#signup');
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
');header('Location: index.php#signup');
      return;

    }
    else{
      $_SESSION['signuperror']="User already exists. If your are a user, please Login. Else please select another username.";
      header('Location:index.php#signup');
      return;
  }  }
  }
}}
}




  ?>


<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

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
  <script src="mail.js" charset="utf-8"></script>
</head>


<body class="bg-white">

  <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light" style="border-radius: 3px;" id='navbar'>
    <img src="images/sym.png" style="height: 70px;width: 60px;"><span style="font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 40px;">ClockMe</span>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link mr-5" href="#"
            style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 20px;"> <span>Home </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mr-5" href="timer.php"
            style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 20px;"><span>ClockMeTimer</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link mr-5" href="contact.php"
            style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 20px;"><span>Contact Us</span></a>
        </li>
                      <?php
                     if(isset($_SESSION['userid'])&&isset($_SESSION['username'])){
            echo('



      </ul>
      <ul class="navbar-nav ml-auto bg-light">


        <div class="navbar-collapse text-center bg-light" id="navbarResponsive">
          <ul class="navbar-nav ml-auto bg-light">

            <li class="nav-item dropdown bg-light">


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

                ');
              }
              else{

                echo('
                <li class="nav-item">
                  <a class="nav-link mr-5" href="login.php"
                    style="color: #eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif;font-size: 20px;"> <span>Login</span>
                  </a>
                </li>
                      </ul>
                      <ul class="navbar-nav ml-auto bg-light">


                        <div class="navbar-collapse text-center bg-light" id="navbarResponsive">
                          <ul class="navbar-nav ml-auto bg-light">

                            <li class="nav-item dropdown bg-light">


                  <div class="custom-control custom-switch ">
                    <input type="checkbox" class="custom-control-input" id="darkSwitch">
                    <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">  Dark Mode</label>
</div>');

              }

               ?>


              </div>
            </li>




          </ul>
        </div>
      </ul>

    </div>

  </nav>
  <br>

<!-- Starting -->
  <div class="container-fluid bg-light" style="box-shadow: 0 5px 7px dimgray;">
  <br>

    <div class="container my-5 py-5 z-depth-1">

      <section class="px-md-5 mx-md-5 text-center dark-grey-text">


        <div class="row d-flex justify-content-center">


          <div class="col-xl-6 col-md-8">

            <h3><img
                src="images/sym.png" style="height: 60px;width: 50px;">ClockMe</h3>

            <p style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;">
            The web app for time management.
            </p>



          </div>


        </div>
        <br>


        <div class="row">


          <div class="col-lg-3 col-md-6">
            <img src="images/clock2.png" style="height: 105px;width: 105px;">

            <p class="lead">Reliable Timer</p>

            <p style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;"></p>
          </div>

          <div class="col-lg-3 col-md-6">
            <img src="images/1.png" style="height: 105px;width: 105px;">
            <p class="lead"> Mail verification </p>

            <pclass="lead"style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;"> </p>
          </div>

          <div class="col-lg-3 col-md-6">
            <img src="images/6.png" style="height: 105px;width: 105px;">

            <p class="lead">Activity Reports
            </p>

            <p style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;"></p>
          </div>

          <div class="col-lg-3 col-md-6">
          <a href="#signup" style="text-decoration:none;color:#ffffff;"> <img src="images/signup.jpg" style="height: 105px;width: 105px;">

            <p class="lead">Sign Up now!</p></a>

            <p style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;"></p>
          </div>


        </div>



      </section>


    </div>
  </div>
  <br>

  <div class="container-fluid my-5">
    <div style="text-align:center;" class="container">

    <p style="font-size:40px" class="lead">Features</p>
    </div>

    <div class="container mt-5 z-depth-1 bg-light"
      style="box-shadow: 2px 5px 7px dimgray;border-radius: 12px;">


      <section class="text-center dark-grey-text p-5">

        <h3 style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;"
          class="mb-5 mx-auto " >Project Management</h3>

        <div class="row">

          <div class="col-md-6 mb-4">
            <br>
            <br>
            <p  class="lead">ClockMe Timer&#8482; is equipped with robust project management features which allow
              you to track,summarize,analyse the time spent for a particular project. As they say, "Every minute counts!"</p>


          </div>

          <div class="col-md-6 mb-4">

            <div class="card-img-100 mx-auto mb-4">
                <img src="images/buisness.png" style="height: 300px;width: 300px;">
            </div>


          </div>

        </div>

      </section>



    </div>
  </div>

  <br>

  <div class="container-fluid my-5">

    <div class="container mt-5 z-depth-1 bg-light"
      style="box-shadow: 0 5px 7px dimgray;border-radius: 12px;">


      <section class="text-center dark-grey-text p-5">

        <h3 style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;"
          class="mb-5 mx-auto">Simple, Intutive Design</h3>

        <div class="row">

          <div class="col-md-6 mb-4">
            <div class="card-img-100 mx-auto mb-4">
                <img src="images/3.png" style="height: 300px;width: 300px;">
            </div>

          </div>

          <div class="col-md-6 mb-4">
              <br>
              <br>
            <p class="lead">
              Design of the ClockMe Timer&#8482; is designed to
                promote effortless and easy management of time. The design works on most of the browsers and is light,yet modern </p>



          </div>

        </div>

      </section>



    </div>
  </div>
<br>

<br>

<div class="container-fluid my-5 ">

  <div class="container mt-5 z-depth-1 bg-light"
    style="box-shadow: 0 5px 7px dimgray;border-radius: 12px;">


    <section class="text-center dark-grey-text p-5">

      <h3 style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;"
        class="mb-5 mx-auto">Dark Mode</h3>

      <div class="row">

        <div class="col-md-6 mb-4">
          <br>
          <br>
          <p class="lead">ClockMe Timer&#8482; features Dark Mode , whichis easy on the eyes. Built for people who live their day in the nights, our dark mode is as good as it comes. Happy working!</p>

        </div>

        <div class="col-md-6 mb-4">

          <div class="card-img-100 mx-auto mb-4">
              <img src="images/dark_mode.png" style="height: 300px;width: 300px;">
          </div>


        </div>

      </div>

    </section>



  </div>
</div>

<br>
<div class="container" style="text-align:center">


<p class="lead" style="font-size:35px">and many more...</p></div>
<br>
  <br>

  <div class="container-fluid my-5">

    <div class="container mt-5 z-depth-1 bg-light"
      style="box-shadow: 0 5px 7px dimgray;border-radius: 12px;">


      <section class="text-center dark-grey-text p-5">
<!--
        <h6 style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:18px ;"
          class="mb-5 mx-auto">Testimonials</h6>-->

        <h2 style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:40px ;">What Users say about
          us. . .</h2>
        <hr class="w-header my-4">


        <div class="row">

          <div class="col-md-6 mb-4">

            <div class="card-img-100 mx-auto mb-4">
            </div>
            <p class="mt-3 mb-4 "
              style="font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;">ClockMe is an easy and useful tool which simplifies the
               extremely important task nowadays "Time Management". I would recommend to use this especially to students to plan their things effectively.</p>
            <p style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;"> <i>- Shantanu Deshpande</i> </p>

          </div>

          <div class="col-md-6 mb-4">

            <div class="card-img-100 mx-auto mb-4">

            </div>
            <p class="mt-3 mb-4 "
              style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;">Lorem ipsum dolor
              sit amet consectetur adipisicing elit. Minima sit excepturi, sed sunt nisi in, unde dolores quisquam omnis
              consectetur, architecto repellat earum molestias enim delectus laborum consequatur voluptatum quo?</p>
            <p style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:15px ;"> <i>- James
                Bristol</i> </p>

          </div>

        </div>

      </section>



    </div>
  </div><br><br>

  <div class="container-fluid my-5" id="signup">

    <div class="container mt-5 z-depth-1 bg-light"
      style="box-shadow: 0 5px 7px dimgray;border-radius: 12px;">


      <section class="text-center dark-grey-text p-5">


        <div class="row">

          <div class="col-md-6 mb-4">
            <div class="card-img-100 mx-auto mb-4">
                <img src="images/sym.png" style="height: 490px;width: 420px;">
            </div>

          </div>

          <div class="col-md-6 mb-4">
            <h3 style="color:#eb6b21;font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:40px ;">Start your
              journey with ClockMe</h3><br>
            <p class="lead">Signup to enjoy
              the benefits of ClockMeTimer</p>
            <form class="text-center" method="post">
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
              <input type="text" name="username" class="form-control mb-4" placeholder="Username">

              <input type="email" name="email" class="form-control mb-4" placeholder="Email">


              <input type="password" name="password" class="form-control mb-4" placeholder="Password">

              <input type="password" name="cpassword" class="form-control mb-4" placeholder="Confirm Password">

              <input class="button button2" type="submit"
                style="font-family:Verdana, Geneva, Tahoma, sans-serif ;font-size:19px ;" onclick="
                  send_mail('','new_member');" name="submit" value="Register">


            </form>


          </div>

        </div>

      </section>



    </div>
  </div>


  <br>

<!--EWnding-->

  <footer class="page-footer font-small blue pt-4 fixed bg-light"
    style="border-radius: 12px;font-family: Verdana, Geneva, Tahoma, sans-serif;">


    <div class="container-fluid text-center text-md-left">


      <div class="row">

        <div class="col-md-3 mx-auto ">


          <h4 style="color:#eb6b21">ClockMe</h4>
          <p style="color:#eb6b21">Pune,India</p>


        </div>
        <hr class="clearfix w-100 d-md-none pb-3">

        <div class="col-md-3 mb-md-0 mb-3">


          <a href="about.php" style="color:#eb6b21;"><h5 class="text-uppercase">About Us</h5></a>


          <ul class="list-unstyled">
            <li>
              <h6></h6>
            </li>


          </ul>

        </div>

        <div class="col-md-3 mb-md-0 mb-3">
  <a href="contact.php" style="color:#eb6b21;"> <h5 class="text-uppercase">Contact Us</h5></a>

          <ul class="list-unstyled">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                  else.</small>
              </div>
              <button type="button" class="button2 button3">Submit</button>
            </form>

          </ul>

        </div>


      </div>


    </div>



    <div class="footer-copyright text-center py-3"
      style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
      <p>Made with <span style="color:red"> 	&#x2764;</span> by Aditya Kane and Tanvesh Chavan</p>
    </div>


  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="dark-mode-switch.js"></script>




</body>

</html>

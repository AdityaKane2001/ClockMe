<?php
require_once 'mailer.php';
require_once 'pdo.php';

if(!isset($_SESSION['userid'])){

  die("<a href='login.php'>Login</a> first.<br>");

}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account Settings</title>
    <style>
        .button {
          background-color: #eb6b21;
          border: none;
          color: white;
          height: 40px;
          width: 140px;
          text-align: center;

          font-size: 16px;
          transition-duration: 0.4s;
          border-radius: 30px;
        }

        .button1 {

          background-color: #eb6b21;
          color: black;
          border: 2px solid #eb6b21;
        }

        .button1:hover {
          background-color: white;
          color: black;
        }

        .button_stop {

          background-color: #800000;
          color: black;
          border: 2px solid #800000;
        }

        .button_stop:hover {
          background-color: white;
          color: black;
        }
      </style>

      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>ClockMe Timer Page</title>
      <meta name="description" content="Add a dark-mode theme toggle with a Bootstrap Custom Switch">

      <meta property="og:site_name" content="GitHub">
      <meta property="og:image"
          content="https://repository-images.githubusercontent.com/194995309/38db8f80-9db7-11e9-998f-43f2a26d9e0b">
      <meta property="og:title" content="dark-mode-switch">
      <meta property="og:description" content="Add a dark-mode theme toggle with a Bootstrap Custom Switch">
      <meta property="og:url" content="https://coliff.github.io/dark-mode-switch/">
      <link rel="author" href="https://christianoliff.com/">

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="dark-mode.css">
      <script src="mail.js">

      </script>
  </head>
  <body>
    <div class="container d-flex p-3 mx-auto flex-column ">

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
  <br><br><br></div>

    <h2 class="lead" style="text-align:center;font-size:40px;">Account Settings</h2><br><br>
    <div  class="container">
      <div style="border-radius:5px;" class="bg-light container">
        <h4  style="color:#eb6b21">Reset passsword</h4><br>
        <p class='lead'>To reset your password, click on the button below. The password reset link will be sent to the registered email id.</p>
        <p id="mail_mesg"> <button type="button" class="btn btn-outline-danger" onclick="send_mail('mail_mesg','pass_res');">Send Mail</button></p><br>

      </div><br>
      <div style="border-radius:5px;" class="bg-light container">
          <h4  style="color:#eb6b21">Email Verification</h4><br>
          <p class="lead">Your current email is <?=$_SESSION['email']?>. To register a new email, type in the new email below and click on the button. It will send a verification code at your new email address</p>
            <p id="mail_mesg1">
              <input type="text" id="hello" value="">&nbsp;&nbsp;&nbsp;&nbsp;

         <button type="button" class="btn btn-outline-danger" onclick="send_mail('mail_mesg1','conf_em');">Send Mail</button>
       </p><br>
     </div><br>


     <div style="border-radius:5px;" class="bg-light container">
         <h4  style="color:#eb6b21">Export data</h4><br>
         <p class="lead">Export you data with CSV , PDF or JSON format. Suggested before deleting account.</p>
           <p id="get_data">
             <form target="_blank"  action="data.php" method="post">


             <select  name="datatype" id="datatype">
                <option value="csv">CSV</option>
               <option value="pdf">PDF</option>

               <option value="json">JSON</option>

             </select> <br><br>

        <button type="button" class="btn btn-outline-danger" onclick="this.form.submit();">Get Data</button></form>
      </p><br>
    </div><br>


     <div style="border-radius:5px;" class="bg-light container">
       <h4  style="color:#eb6b21">Delete account</h4><br>
        <p class="lead">Please take note of this carefully. Deleting your account will erase <b>ALL</b> of your data with all of ClockMe's services</p>
           <button type="button" class="btn btn-danger" onclick="delete_acc();">Delete Account</button><br><br>

     </div>
   </div><br><br><br>
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
  </body>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
      integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
      crossorigin="anonymous"></script>

</html>

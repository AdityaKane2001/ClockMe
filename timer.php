<?php
require_once 'pdo.php';
session_start();


if(isset($_COOKIE['username'])&&$_COOKIE['username']!==false){

  $_SESSION['username']=$_COOKIE['username'];
  $stmt=$pdo->prepare("SELECT userid,username,password,verified from users where username=:uname");
  $stmt->execute(array(':uname'=>$_SESSION['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['userid']=$row['userid'];
  $_SESSION['verified']=$row['verified'];

}
else{
  if(isset($_SESSION["username"])){

    $stmt=$pdo->prepare("SELECT userid,username,password,verified from users where username=:uname");
    $stmt->execute(array(':uname'=>$_SESSION['username']));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['userid']=$row['userid'];
    $_SESSION['verified']=$row['verified'];

  }


}


if(!isset($_SESSION["username"])){

die("<a href='login.php'>Login</a> first.<br>");
}

elseif ($_SESSION['verified']!=1) {

  die("<a href='confirm_email.php'>Verify</a> your email address first.<br>");
}



#if(isset($_SESSION["one_instance"])){
#  die("<h1>Another instance is already running</h1>");
#}

#$_SESSION["one_instance"]=1;

$stmt=$pdo->prepare("SELECT projects.projectname as project,SEC_TO_TIME(SUM(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time))) as sumtime FROM TIME JOIN PROJECTS ON
                    projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname
                    ");
$stmt->execute(array(":uid"=>$_SESSION['userid']));
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);



if(isset($_POST['add'])){
foreach ($rows as $row) {
  if(in_array($_POST['project_name'],$row)){

  $_SESSION['adderror']='Project already present';
  $k=1;
  header('Location: timer.php');
  return;

  }
}

  if($k!=1){
      if(strlen($_POST['project_name'])==0){

        $_SESSION['adderror']='Please enter project name';
        header('Location: timer.php');
        return;

      }
       else{
         $addstmt=$pdo->prepare("INSERT INTO PROJECTS (userid,projectname) values (:uid,:projname)");
         $addstmt->execute(array(':uid'=>$_SESSION['userid'],':projname'=>$_POST['project_name']));
         $last=$pdo->lastInsertId();
         $addstmt=$pdo->prepare("INSERT INTO TIME (userid,projectid,start_time,end_time) values (:uid,:projid,'1000-01-01 00:00:00','1000-01-01 00:00:00')");
         $addstmt->execute(array(':uid'=>$_SESSION['userid'],':projid'=>$last));
         $_SESSION['addsuccess']='Project is added';
         header('Location: timer.php');
         return;

       }

    }
}




?>
<html lang="en" class="h-100">

<head>
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
    <script src="single_clock.js"></script>

    <link rel="stylesheet" href="dark-mode.css">


</head>

<body class="bg-white text-center">
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
    </header><br><br><br><br>

        <div class="container ">
            <div class="row mt-5 ">
                <div class="col-md-8 offset-md-2">

                    <div class="card">
                        <div class="card-header shadow-sm bg-white">
                            <h1 style="color:#eb6b21">ClockMe Timer</h1>
                            <?php


                            if(isset($_SESSION['adderror'])){
                              echo '<p class="lead" style="color:#eb6b21">';
                              echo  $_SESSION["adderror"];  //not showing an alert box.
                              echo '</p>';
                              unset($_SESSION['adderror']);
                            }

                            else{if(isset($_SESSION['addsuccess'])){
                              echo '<p class="lead" style="color:#eb6b21">';
                              echo $_SESSION['addsuccess'];  //not showing an alert box.
                              echo '</p>';
                              unset($_SESSION['addsuccess']);
                            }}




                             ?>

                             <label id="output"  style="font-size:40px;text-align:center;color:#eb6b21;">0:00:00</label><br>

                            <button data-toggle="modal" data-target="#exampleModal" class="btn"
                                style="border-radius: 50%;background-color:#eb6b21;font-size: 20px;"><b>+</b></button>

                    </div>
                        <div class="card-body bg-white" style="align-content:top center;">
                          <!--  <ul class="list-group bg-white">

                                <li class="list-group-item bg-light">
                                    <p>Project A</p>

                                </li>

                            </ul>-->

                            <div class="row">
                              <div class="col-sm-4">
                                <b>Project Name</b>
                              </div>
                              <div class="col-sm-4">
                                <b>Time spent<br><p class="lead" style="font-size:15px;">Hours:Minutes:Seconds</p></b>
                              </div>

                            </div><br>
                            <div id="project_table">


                            <?php

                            $count=0;
                            foreach($rows as $entry){
                            echo('  <div class="row">
                                <div class="col-sm-4">
                                  '.$entry['project'].'
                                </div>
                              ');
                              echo('  <div class="col-sm-4">
                                  '.$entry['sumtime'].'
                                </div>');
                              echo('  <div class="col-sm-4">
                              <div class="row">

                                <div class="col-sm-6">
                                  <div class="controls">

                                  <button class=" button button1"
                                       onclick="startPause(\'startPause'.$count.'\','.$count.')" id="startPause'.$count.'">
                                        Start
                                      </button>
                                    </div>

                                </div>

                              </div>
                                  </div></div><br>
                                  <script type="text/javascript">
                                    buttons.push("startPause'.$count.'");
                                    projects.push("'.$entry['project'].'");

                                    console.log(buttons);
                                </script>

                                  ');

                              $count+=1;
                        }

                             ?>


                               </div>
                        </div>
                    </div>


                </div>
            </div>
            <br><br><br>
            <a href="summary.php"><button class="button button1" type="button"><b>Summary</b></button></a>

        </div>
        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header bg-white">
                        <h5 class="modal-title bg-white" id="exampleModalLabel" style="color:#eb6b21 ;"><b>Add
                                Project</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #eb6b21;">&times;</span>
                        </button>
                    </div>



                    <form method="post" id='addProject'>
                    <div class="modal-body bg-white">
                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Project Name" name='project_name'>
                        </div>
                    </div>
                    <div class="modal-footer bg-white">
                        <button type="button" class="button button1"
                            data-dismiss="modal"><b>Close</b></button>
<input type="submit" class="button button1" style="font-weight: bold;" name="add" value="Add">
                      <!--  <button type="button" style="background-color: #eb6b21;border-radius: 50px" onclick="document.getElementById('addProject').submit();"><b>Add
                      </b></button>--></form>
                    </div>
                </div>
            </div>
        </div>


    </div><div class="container"style="position:absolute;bottom:0;text-align: center;align-content:center;">


    </div>

    <form method="post" name="time_form" id="time_form">
      <input type="text" class="float-right ml-1" name="start_time" id="start_time" hidden >
      <input type="text" class="float-right ml-1" name="end_time" id="end_time" hidden>
      <input type="text" class="float-right ml-1" name="project_name" id="project_name" hidden>


    </form><br><br><br>

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
    <script src="dark-mode-switch.js"></script>


</html>

<?php
require_once 'pdo.php';
session_start();

$stmt=$pdo->prepare("SELECT projects.projectname as project,SEC_TO_TIME(SUM(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time))) as fulltime FROM TIME JOIN PROJECTS ON
                    projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname
                    ");
$stmt->execute(array(":uid"=>$_SESSION['userid']));
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['rows']=$rows;

function chart_rows(){
$datapoints=array();

foreach ($_SESSION['rows'] as $entry) {
  $time = $entry['fulltime'];
  $parsed = date_parse($time);

  $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];

  array_push($datapoints,array("name"=> $entry['project'], "y"=> $seconds));

}
return $datapoints;

}

if(isset($_COOKIE['username'])&&$_COOKIE['username']!==false){

  $_SESSION['username']=$_COOKIE['username'];
  $stmt=$pdo->prepare("SELECT userid,username,password from users where username=:uname");
  $stmt->execute(array(':uname'=>$_SESSION['username']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['userid']=$row['userid'];
}

if(!isset($_SESSION["username"])){

die("<a href='login.php'>Login</a> first.<br>");
}




$stmt1=$pdo->prepare("SELECT projects.projectname as project,time.start_time as starttime,time.end_time as endtime,SEC_TO_TIME(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time)) as
                          sumtime FROM TIME JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid");
$stmt1->execute(array(":uid"=>$_SESSION['userid']));
$time_rows=$stmt1->fetchAll(PDO::FETCH_ASSOC);


?>
<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta property="og:site_name" content="GitHub">
        <meta property="og:image"
            content="https://repository-images.githubusercontent.com/194995309/38db8f80-9db7-11e9-998f-43f2a26d9e0b">
        <meta property="og:title" content="dark-mode-switch">
        <meta property="og:description" content="Add a dark-mode theme toggle with a Bootstrap Custom Switch">
        <meta property="og:url" content="https://coliff.github.io/dark-mode-switch/">
        <link rel="author" href="https://christianoliff.com/">
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <link rel="stylesheet" href="dark-mode.css">

        <style>
        .my_button {
      background-color: #ff751a;
      transition-duration: 0.4s;
      }

      .my_button:hover {

      background-color: white;
      }

        </style>
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


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Summary for <?=$_SESSION['username']?></title>
      <link rel="stylesheet" href="dark-mode.css">
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

  <br><br><br>

  <script>
  String.toHHMMSS = function () {
    var sec_num = parseInt(this, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
}

  function makechart(){


  var chart = new CanvasJS.Chart("chartContainer", {
  	theme: localStorage.getItem('chart'),
  	exportFileName: "Doughnut Chart",
  	exportEnabled: true,
  	animationEnabled: true,
  	title:{
  		text: "Time Spent"
  	},
  	legend:{
  		cursor: "pointer",
  		itemclick: explodePie
  	},
  	data: [{
  		type: "doughnut",
  		innerRadius: 85,
  		showInLegend: true,
  		toolTipContent: "<b>{name}</b> {y.toHHMMSS();} (#percent%)",
  		indexLabel: "{name} - #percent%",
  		dataPoints:[ <?php
      foreach ($_SESSION['rows'] as $entry) {
        $time = $entry['fulltime'];
        $parsed = date_parse($time);

        $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];

        echo('{ y: '.$seconds.', name: "'.$entry['project'].'" },');

      }

      ?>]
  	}]
  });
  chart.render();

  function explodePie (e) {
  	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
  		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
  	} else {
  		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
  	}
  	e.chart.render();
  }

  }


  window.onload =function(){ makechart();}

  </script>
<div class="container">


<div  style="text-align:center;color:#eb6b21;">
  <h2>Archives</h2>
</div>
  <br>
  <div class="bg-light" id="chart_container">


  <div id="chartContainer" style="height: 300px; width: 100%;"></div></div>
  <br><br>

      <div class="accordion"  id="accordionExample">


        <?php

        $count=0;
          $time_count=0;
        foreach ($rows as $entry) {


          echo('  <div class="card bg-light" id="acc'.$count.'">
              <div class="card-header" id="'.$entry['project'].'">
                <h2 class="mb-0">
                  <button class="btn  btn-block text-left  collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$count.'" aria-expanded="true" aria-controls="collapse'.$count.'">
                    '.'<h4 style="color:#eb6b21">'.$entry['project'].'</h4><h4 style="text-align:right;color:#eb6b21">'.$entry['fulltime'].'</h4>
                  </button>
                </h2>
              </div>

              <div id="collapse'.$count.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">');


                echo('
                <div class="container">
                  <div class="row">
                    <div class="col-sm-3">
                      <h4>Start</h4>
                    </div>
                    <div class="col-sm-3">
                      <h4>End</h4>
                    </div>
                    <div class="col-sm-3">
                      <h4>Time elapsed</h4>
                    </div>
                    <div class="col-sm-3">
                      <h4>Options</h4>
                    </div>

                  </div>');


                foreach ($time_rows as $time_entry) {
                  if ($time_entry['project']==$entry['project']  && $time_entry['starttime']=="1000-01-01 00:00:00") {
                    $time_count+=1;
                  }
                  if ($time_entry['project']==$entry['project']  && $time_entry['starttime']!="1000-01-01 00:00:00") {

                    $stime=date_create($time_entry['starttime']);
                    $etime=date_create($time_entry['endtime']);
                    $stime=date_format($stime,"D d M H:i:s");
                    $etime=date_format($etime,"D d M H:i:s");



                    echo('

                      <div class="row">
                        <div class="col-sm-3">'.$stime.' </div>
                        <div class="col-sm-3">'.$etime.'</div>
                        <div class="col-sm-3">'.$time_entry['sumtime'].' </div>
                        <div class="col-sm-3">

                          <button type="button" class="my_button" name="timer_button" style="border: none;border-radius:3px;font-size:11px;" data-toggle="modal" data-target="#edit" onclick="edit_modal('.$time_count.','.$count.')">Edit</button>
                          <button type="button" class="my_button" name="timer_button" style="border: none;border-radius:3px;font-size:11px;" onclick="delete_entry('.$time_count.')">Delete</button>

                           </div>



                      </div>');
                      $time_count+=1;


                  }
                }


                echo('</div>
              </div>
            </div></div>');
            $count+=1;


        }




         ?></div>

         <!-- Button trigger modal -->


     <!-- Modal -->
     <div class="modal fade" id="edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content bg-light">
           <div class="modal-header">
             <h5 class="modal-title" id="staticBackdropLabel">Edit entry</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
            <div class="row">
              <div class="col-sm-3">
                <label for="start_time">Start Time: </label>
              </div>
              <div class="col-sm-3">
                <input type="date" id="start_date" name="start_date" value="" >
                <input id="start_time" type="time" name="start_time" step="1" ><br><br>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <label for="end_time">End Time: </label>
              </div>
              <div class="col-sm-3">
                <input type="date" id="end_date" name="end_date" value="" >
                <input id="end_time" type="time" name="end_time" step="1" >
              </div>
            </div>
            <p></p>
           </div>
           <div class="modal-footer">
             <button type="button" id="modal_close" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="button" class="btn btn-primary" onclick="save()">Save changes</button>

           </div>
         </div>
       </div>
     </div>

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



    <script src="summary_js.js" charset="utf-8"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

<!--
    RTL version
-->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    <script src="dark-mode-switch.js"></script>
  </body>
</html>

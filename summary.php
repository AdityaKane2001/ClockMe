<?php
require_once 'pdo.php';
session_start();


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



$stmt=$pdo->prepare("SELECT projects.projectname as project,SUM(age(time.end_time,time.start_time)) as sumtime
                      FROM TIME INNER JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname;
                    ");
$stmt->execute(array(":uid"=>$_SESSION['userid']));
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1=$pdo->prepare("SELECT projects.projectname as project,time.start_time as starttime,time.end_time as endtime,age(time.end_time,time.start_time) as
                          sumtime FROM TIME INNER JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid");
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

<link rel="stylesheet" href="dark-mode.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Summary for <?=$_SESSION['username']?></title>
  </head>
  <body>
    <div class="container d-flex p-3 mx-auto flex-column ">


    <header >

        <h3 class="float-left" style="color:#eb6b21"><b>ClockMe</b></h3>

        <nav class="nav justify-content-center float-right ">

               <a class="nav-link "  style="color:#eb6b21" href="index.php">Home</a>

            <div class="nav-link">

                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="darkSwitch">
                    <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">Dark Mode</label>
                </div>

                <script src="dark-mode-switch.min.js"></script>

            </div>
            <div class="nav-link">
              <a href="logout.php" style="color:#eb6b21">Logout</a>
            </div>
        </nav>
    </header>
  <br><br><br>

      <div class="accordion"  id="accordionExample">


        <?php

        $count=0;
        foreach ($rows as $entry) {


          echo('  <div class="card bg-light">
              <div class="card-header" id="'.$entry['project'].'">
                <h2 class="mb-0">
                  <button class="btn  btn-block text-left   collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$count.'" aria-expanded="true" aria-controls="collapse'.$count.'">
                    '.'<h4 style="color:#eb6b21">'.$entry['project'].'</h4><h4 style="text-align:right;color:#eb6b21">'.$entry['fulltime'].'</h4>
                  </button>
                </h2>
              </div>

              <div id="collapse'.$count.'" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">');


                echo('
                <div class="container">
                  <div class="row">
                    <div class="col-sm-4">
                      <h4>Start</h4>
                    </div>
                    <div class="col-sm-4">
                      <h4>End</h4>
                    </div>
                    <div class="col-sm-4">
                      <h4>Time elapsed</h4>
                    </div>

                  </div>');
                foreach ($time_rows as $time_entry) {
                  if ($time_entry['project']==$entry['project']  && $time_entry['starttime']!="1000-01-01 00:00:00") {
                    $stime=date_create($time_entry['starttime']);
                    $stime=date_format($stime,"D d M H:i:s");
                    $etime=date_create($time_entry['endtime']);
                    $etime=date_format($etime,"D d M H:i:s");
                    echo('

                      <div class="row">
                        <div class="col-sm-4">'.$stime.' </div>
                        <div class="col-sm-4">'.$etime.'</div>
                        <div class="col-sm-4">'.$time_entry['sumtime'].' </div>

                      </div>');


                  }
                }


                echo('</div>
              </div>
            </div>');
            $count+=1;


        }


         ?>

         <!--
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>-->

</div>

    </div>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

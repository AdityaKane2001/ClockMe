<?php
require_once 'pdo.php';
session_start();

function chart_rows(){
  /*include 'pdo.php';
  $ret=array();
  foreach ($_SESSION['rows'] as $entry) {
    $time = $entry['fulltime'];
    $parsed = date_parse($time);

    $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
    $temp=array(y=>$seconds,name=>$entry['project']);
    #echo('{ y: '.$seconds.', name: "'.$entry['project'].'" },');
    array_push($ret,$temp);
  }
  $chart_json=json_encode($ret);
  echo($chart_json);
*/

include 'pdo.php';
$op='';

foreach ($_SESSION['rows'] as $entry) {
  $time = $entry['fulltime'];
  $parsed = date_parse($time);

  $seconds = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];

  $op.='{ y: '.$seconds.', name: "'.$entry['project'].'" },';

}
echo($op);
}


function gen_rows(){
  include 'pdo.php';
  $stmt=$pdo->prepare("SELECT projects.projectname as project,SEC_TO_TIME(SUM(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time))) as fulltime FROM TIME JOIN PROJECTS ON
                      projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname
                      ");
  $stmt->execute(array(":uid"=>$_SESSION['userid']));
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}
$_SESSION['rows']=gen_rows();


if(isset($_POST['fill'])){
  $stmt1=$pdo->prepare("SELECT time.timeid as tid,projects.projectname as project,time.start_time as starttime,time.end_time as endtime,SEC_TO_TIME(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time)) as
                            sumtime FROM TIME JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid");
  $stmt1->execute(array(":uid"=>$_SESSION['userid']));
  $time_rows=$stmt1->fetchAll(PDO::FETCH_ASSOC);

$start_date=substr(strval($time_rows[$_POST['fill']]['starttime']),0,10);
$start_time=substr(strval($time_rows[$_POST['fill']]['starttime']),11);
$end_date=substr(strval($time_rows[$_POST['fill']]['endtime']),0,10);
$end_time=substr(strval($time_rows[$_POST['fill']]['endtime']),11);

$tid=$time_rows[$_POST['fill']]['tid'];
$_SESSION['tid'] = $tid;
$_SESSION['count']=$_POST['count'];


$send_json=array($start_time,$start_date,$end_time,$end_date);

  $time_json=json_encode($send_json);
  echo($time_json);



}

if(isset($_POST['save'])){
  $start=date('Y-m-d H:i:s',strtotime($_POST['start_date']." ".$_POST['start_time']));
  $end=date('Y-m-d H:i:s',strtotime($_POST['end_date']." ".$_POST['end_time']));


  $stmt=$pdo->prepare("UPDATE time set start_time=:start,end_time=:end where timeid=:tid ");
  $stmt->execute(array(':start'=>$start,':end'=>$end,':tid'=>$_SESSION['tid']));



  $stmt=$pdo->prepare("SELECT projects.projectname as project,SEC_TO_TIME(SUM(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time))) as fulltime FROM TIME JOIN PROJECTS ON
                      projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname
                      ");
  $stmt->execute(array(":uid"=>$_SESSION['userid']));
  $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmt1=$pdo->prepare("SELECT projects.projectname as project,time.start_time as starttime,time.end_time as endtime,SEC_TO_TIME(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time)) as
                            sumtime FROM TIME JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid");
  $stmt1->execute(array(":uid"=>$_SESSION['userid']));
  $time_rows=$stmt1->fetchAll(PDO::FETCH_ASSOC);

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
      </div>');
      $count+=1;


  }





}

if(isset($_POST['delete'])){
  $stmt1=$pdo->prepare("SELECT time.timeid as tid,projects.projectname as project,time.start_time as starttime,time.end_time as endtime,SEC_TO_TIME(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time)) as
                            sumtime FROM TIME JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid");
  $stmt1->execute(array(":uid"=>$_SESSION['userid']));
  $time_rows=$stmt1->fetchAll(PDO::FETCH_ASSOC);

  $tid=$time_rows[$_POST['delete']]['tid'];

  $del=$pdo->prepare('DELETE FROM time WHERE timeid=:tid');
  $del->execute(array(':tid'=>$tid));

    $stmt=$pdo->prepare("SELECT projects.projectname as project,SEC_TO_TIME(SUM(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time))) as fulltime FROM TIME JOIN PROJECTS ON
                        projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname
                        ");
    $stmt->execute(array(":uid"=>$_SESSION['userid']));
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt1=$pdo->prepare("SELECT projects.projectname as project,time.start_time as starttime,time.end_time as endtime,SEC_TO_TIME(TIME_TO_SEC(time.end_time)-TIME_TO_SEC(time.start_time)) as
                              sumtime FROM TIME JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid");
    $stmt1->execute(array(":uid"=>$_SESSION['userid']));
    $time_rows=$stmt1->fetchAll(PDO::FETCH_ASSOC);



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
        </div>');
        $count+=1;


    }







}



 ?>

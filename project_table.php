<?php

require_once 'pdo.php';
session_start();


if(isset($_POST['end_time'])){

  $getstmt=$pdo->prepare("SELECT projectid as pid from projects where userid=:uid and projectname=:projname");
  $getstmt->execute(array(':uid'=>$_SESSION['userid'],':projname'=>$_POST['project_name']));
  $project = $getstmt->fetch(PDO::FETCH_ASSOC);


  $stime = date_create();
  date_timestamp_set($stime,floor($_POST['start_time']/1000) );
  $stime=date_format($stime, 'Y-m-d H:i:s') ;

  $etime = date_create();
  date_timestamp_set($etime,floor($_POST['end_time']/1000) );
  $etime=date_format($etime, 'Y-m-d H:i:s') ;




  $stmt=$pdo->prepare("INSERT INTO TIME (userid,projectid,start_time,end_time) VALUES (:uid,:pid,:stime,:etime)");
  $stmt->execute(array(':uid'=>$_SESSION['userid'],':pid'=>$project['pid'],':stime'=>$stime,':etime'=>$etime));




$stmt=$pdo->prepare("SELECT projects.projectname as project,SUM(age(time.end_time,time.start_time)) as sumtime
                      FROM TIME INNER JOIN PROJECTS ON projects.projectid=time.projectid where time.userid=:uid and projects.userid=:uid GROUP BY projects.projectname;
                    ");
$stmt->execute(array(":uid"=>$_SESSION['userid']));
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

$count=0;
$op="<div id='project_table'>";
foreach($rows as $entry){

$op=$op.'  <div class="row">
    <div class="col-sm-4">
      '.$entry['project'].'
    </div>
    <div class="col-sm-4">
      '.$entry['sumtime'].'
    </div>
      <div class="col-sm-4">
  <div class="row">

    <div class="col-sm-6">
      <div class="controls">

          <button class="button button1"  onclick="startPause(\'startPause'.$count.'\','.$count.')" id="startPause'.$count.'">
              <b>Start</b>
          </button>
        </div>

    </div>

  </div>
      </div></div><br><script type="text/javascript">
        buttons.push("startPause'.$count.'");
        projects.push("'.$entry['project'].'");

        console.log(buttons);
    </script>';
    $count+=1;


    }
$op=$op."</div>";
echo($op);

}


 ?>

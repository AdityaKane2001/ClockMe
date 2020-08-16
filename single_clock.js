var buttons=[];
var projects=[];
var run_button;

var timeout;
var running=0;
var time = 0;


function startPause(start_id,count){
    if(running == 0)
    {
    running = 1;
    increment();
    var d1 = new Date();
    //Reset all hidden fields
    document.getElementById("project_name").value="";                   //empty the hidden fields
    document.getElementById("start_time").value ="";
    document.getElementById("end_time").value = "";

    document.getElementById("project_name").value=projects[count];     //fill the information
    document.getElementById("start_time").value =d1.getTime()+3600000*3.5;
    time=d1.getTime();
    //Button Labels
    run_button=start_id;                                           //Store the current running button
    document.getElementById(start_id).innerHTML="<b>Stop</b>";
    document.getElementById(start_id).className="button button_stop";             //no matter what button is pressed, it should have 'Stop'

    }
    else
    {//if another button is already running,
      reset();                               //reset the clock and timer
      project_table(start_id);               //submit form data and label the button
    }
  }

function reset(){ //reset clock and global variables related to it
    running = 0;
    time = 0;
    clearTimeout(timeout);
    document.getElementById("output").innerHTML = "0:00:00";
}


function project_table(proj_id)

{ var d1 = new Date();
  document.getElementById("end_time").value = d1.getTime()+3600000*3.5;   //record endtime
  console.log(d1.getTime())
  var formData = new FormData();
  formData.append('start_time', document.getElementById('start_time').value);             //record form data
  formData.append('end_time', document.getElementById('end_time').value);
  formData.append('project_name',  document.getElementById("project_name").value);

  var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
  xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
          {
          document.getElementById('project_table').innerHTML="";                          //clear the div
          document.getElementById('project_table').innerHTML=xmlHttp.responseText;        //fill the div


          if(run_button==proj_id){                                                        //if same project is selected (or stopped)
              document.getElementById(run_button).innerHTML="<b>Start</b>";
              document.getElementById(run_button).className="button button1";                      //restore it to original state
              run_button="";                                                              //nothing is running
          }
          else{//if different project is selected (or started)
              //remember that if new project is started,the clock is already reset,and thus we can directly trigger startPause()
              startPause(proj_id,parseInt(proj_id.slice(-1)));                            //start that project
          }
        }
    }
xmlHttp.open("post", "project_table.php");
xmlHttp.send(formData);
}

function increment(){
    if(running == 1){
        timeout=setTimeout(function(){
          var d1 = new Date();
            now=d1.getTime();

            var diff= Math.floor((now-time)/100);
            var mins = Math.floor(diff/10/60);
            var secs = Math.floor(diff/10 % 60);

            var hours = Math.floor(diff/10/60/60);
            var tenths = 0;
            if(mins < 10){
                mins = "0" + mins;
            }
            if(secs < 10){
                secs = "0" + secs;
            }
            document.getElementById("output").innerHTML = hours + ":" + mins + ":" + secs ;
            increment();
        },100);
    }
}

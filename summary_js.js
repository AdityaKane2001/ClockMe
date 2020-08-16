
function edit_modal(time_entry,count){
  var data= new FormData();
  data.append('fill',time_entry);
  data.append('count',count);

  var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
  xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
          {
            console.log(xmlHttp.responseText);
            var time_pack=JSON.parse(this.responseText);


            document.getElementById('start_time').value =time_pack[0];
            document.getElementById('start_date').value=time_pack[1];
            document.getElementById('end_time').value=time_pack[2];
            document.getElementById('end_date').value=time_pack[3];




        }
}
  xmlHttp.open("post", "modal_fill.php");
  xmlHttp.send(data);
}

function save(){
  var data= new FormData();
  data.append('save','save');
  data.append('start_time',document.getElementById('start_time').value);
  data.append('start_date',document.getElementById('start_date').value);
  data.append('end_time',document.getElementById('end_time').value);
  data.append('end_date',document.getElementById('end_date').value);
  var start=new Date(document.getElementById('start_date').value+' '+document.getElementById('start_time').value).getTime();
  var end=new Date(document.getElementById('end_date').value+' '+document.getElementById('end_time').value).getTime();
  if(start>end){
      alertify.set('notifier','position',  'bottom-center');
    alertify.error('Start time is after end time. Correct the time and try again.');
  }
else{
  var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
  xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
          {
            if(xmlHttp.responseText!=''){
              $('#edit').modal('hide');
              document.getElementById('accordionExample').innerHTML="";

              document.getElementById('accordionExample').innerHTML=xmlHttp.responseText;
              alertify.set('notifier','position',  'bottom-center');
              alertify.success('Values updated successfully ! ');

              request_refresh();
            }
            else{
                alertify.set('notifier','position',  'bottom-center');
               alertify.error('Values could not be updated. Contact administrator.');

            }

        }
}
  xmlHttp.open("post", "modal_fill.php");
  xmlHttp.send(data);
}

}


function delete_entry(time_count){
  var data= new FormData();
  data.append('delete',time_count);

  var del=confirm('Are you sure you want to delete this entry?');

  if(del){
    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
    xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
              if(xmlHttp.responseText!=''){
                document.getElementById('accordionExample').innerHTML="";

                document.getElementById('accordionExample').innerHTML=xmlHttp.responseText;

                alertify.set('notifier','position',  'bottom-center');
                alertify.success('Values deleted successfully ! ');
                request_refresh();
              }
              else{
                alertify.set('notifier','position',  'bottom-center');
                 alertify.error('Values could not be deleted. Contact administrator.');

              }

          }
  }
    xmlHttp.open("post", "modal_fill.php");
    xmlHttp.send(data);

}

}

function request_refresh(){

  document.getElementById('chart_container').innerHTML="";
  document.getElementById('chart_container').innerHTML='<br><div class="container" style="text-align:center"><p class="bg-light"><button type="button" onclick="location.reload();" class="btn btn-outline-info">Refresh</button><br> the page to see the updated chart.</p></div>';




}

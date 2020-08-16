function send_mail(id,cause){


  if(cause=="pass_res"){
    document.getElementById(id).innerHTML='<img src="images/waiting.gif" height="40px" width="40px" alt="Sending mail....">';

    var data= new FormData();
    data.append('send','send');
    data.append('type','pass_res');

    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
    xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
            document.getElementById(id).innerHTML=xmlHttp.responseText;                          //clear the div
            setTimeout(function(){
              document.getElementById(id).innerHTML=' <button type="button" class="btn btn-outline-danger" onclick="send_mail(\'mail_mesg\',\'pass_res\');">Send Mail</button>';  }, 10000);

            }


      }
  xmlHttp.open("post", "mailer.php");
  xmlHttp.send(data);

  }

  if(cause=='conf_em'){
    var email=document.getElementById("hello").value;
    document.getElementById(id).innerHTML='<img src="images/waiting.gif" height="40px" width="40px" alt="Sending mail....">';

    var data= new FormData();
    data.append('send','send');


    data.append('new_email', email);
    data.append('type','conf_em');

    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
    xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
            document.getElementById(id).innerHTML=xmlHttp.responseText;                          //clear the div
            setTimeout(function(){
              document.getElementById(id).innerHTML='<input type="text" id="hello" value="">&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-outline-danger" onclick="send_mail(\'mail_mesg1\',\'conf_em\');">Send Mail</button> ';  }, 10000);

          }
      }
  xmlHttp.open("post", "mailer.php");
  xmlHttp.send(data);
  }

  if(cause=='send_again'){

    document.getElementById(id).innerHTML='<img src="images/waiting.gif" height="40px" width="40px" alt="Sending mail....">';

    var data= new FormData();
    data.append('send','send');
    data.append('type','send_again');

    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
    xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
            document.getElementById(id).innerHTML=xmlHttp.responseText;                          //clear the div
            setTimeout(function(){
              document.getElementById(id).innerHTML='<button type="button" class="btn btn-outline-danger" onclick="send_mail(\'mail_mesg2\',\'send_again\');">Send Mail Again</button> ';  }, 10000);

          }
      }
  xmlHttp.open("post", "mailer.php");
  xmlHttp.send(data);
  }

  if(cause=='new_member'){



    var data= new FormData();
    data.append('send','send');
    data.append('type','send_again');

    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request

  xmlHttp.open("post", "mailer.php");
  xmlHttp.send(data);
  }

}


function delete_acc(){
if(window.confirm("Are you sure you want to delete the account?")){


    var data= new FormData();
    data.append('send','send');
    data.append('type','leaving');

    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request

    xmlHttp.open("post", "mailer.php");
    xmlHttp.send(data);
    window.location.href = "delete.php";

}

}


function give_data(){
  var data= new FormData();
  data.append('data','data');
  data.append('type',document.getElementById('datatype').value);
  console.log(document.getElementById('datatype').value);

  var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request

  xmlHttp.open("post", "data.php");
  xmlHttp.send(data);
  





}

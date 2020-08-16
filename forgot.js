function send_mail(){
  var data = new FormData();
  data.append('send','send');
  data.append('type','forgot');
  data.append('username',document.getElementById('username').value);

  document.getElementById('forgot').innerHTML='<img src="images/waiting.gif" height="40px" width="40px" alt="Sending mail....">';
  document.getElementById('remove').innerHTML="";

    var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
    xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {

            document.getElementById('forgot').innerHTML=xmlHttp.responseText;
            setTimeout(function(){
              document.getElementById('forgot').innerHTML=' <input type="text" id="username" name="username" ><br><br><button type="button" class="btn btn-outline-danger"  onclick="send_mail()">Change Password</button>';  }, 10000);

            }                          //clear the div


          }

  xmlHttp.open("post", "mailer.php");
  xmlHttp.send(data);
 }

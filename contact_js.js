function send_mail(){


  var data= new FormData();
  data.append('send','send');
  data.append('type','conact');
  data.append('content',document.getElementById('content').innerHTML);
  document.getElementById('form').innerHTML='<img src="images/waiting.gif" height="40px" width="40px" alt="Sending mail....">';
  var xmlHttp = new XMLHttpRequest();                                                      //initialize AJAX request
  xmlHttp.onreadystatechange = function(){                                                 //shoot when ready
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
          {
            document.getElementById('form').innerHTML=this.responseText;                      //clear the div
          setTimeout(function(){
            document.getElementById('form').innerHTML='<form method="post" style="text-align:center;"><label for="To">To: clockmetimer@gmail.com</label> <br><textarea id="content" rows="8" cols="80" placeholder="Your mail here.."></textarea> <br><button type="button" class="button2" style="border-radius:4px" onclick="send_mail();">Send Mail</button></form>';  }, 10000);

          }


    }
xmlHttp.open("post", "mailer.php");
xmlHttp.send(data);




}

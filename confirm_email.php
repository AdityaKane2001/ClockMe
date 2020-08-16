<?php
require_once 'pdo.php';
session_start();



if(isset($_POST['code'])){

if(strlen($_POST['code'])==0){
  $_SESSION['veriferror']='Please enter verification code';
  header('Location: confirm_email.php');
  return;
}

elseif ($_POST['code']!=$_SESSION['verif']) {
  $_SESSION['veriferror']='Please enter correct verification code';
  header('Location: confirm_email.php');
  return;
}

else{
if($_SESSION['new_user']==1){
  $_SESSION['verified']=1;
  $stmt=$pdo->prepare("UPDATE users SET verified=:v where userid=:uid");
  $stmt->execute(array(':uid'=>$_SESSION['userid'],':v'=>$_SESSION['verified']));
  $stmt=$pdo->prepare("SELECT userid,username,password,email from users where userid=:uid");
  $stmt->execute(array(':uid'=>$_SESSION['userid']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['verifsuccess']="Email verified successfully. Please login <a href='login.php'>here.</a>";

  $_SESSION['email']=$row['email'];
  $_SESSION['new_user']=0;

  unset($_SESSION['verif']);
  header('Location: confirm_email.php');
  return;
}
else if($_SESSION['new_user']==0){
  $_SESSION['verified']=1;
  $stmt=$pdo->prepare("UPDATE users SET verified=:v,email=:em where userid=:uid");
  $stmt->execute(array(':uid'=>$_SESSION['userid'],':v'=>$_SESSION['verified'],':em'=>$_SESSION['new_email']));
  $stmt=$pdo->prepare("SELECT userid,username,password,email from users where userid=:uid");
  $stmt->execute(array(':uid'=>$_SESSION['userid']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['verifsuccess']="Email verified successfully. Please login <a href='login.php'>here.</a>";

  $_SESSION['email']=$row['email'];
  $_SESSION['new_user']=0;

  unset($_SESSION['verif']);
  header('Location: confirm_email.php');
  return;


}



}




}



 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
 <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
 <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
 <link rel="manifest" href="/site.webmanifest">
 <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
 <meta name="msapplication-TileColor" content="#da532c">
 <meta name="theme-color" content="#ffffff">
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Email Verification</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
     <script src="mail.js" charset="utf-8"></script>
       <link rel="stylesheet" href="dark-mode.css">
   </head><body>

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

                                                                             <div class="custom-control custom-switch">
                                                                               <input type="checkbox" class="custom-control-input" id="darkSwitch">
                                                                                 <label class="custom-control-label" for="darkSwitch" style="color:#eb6b21">Dark Mode</label>

                                                                             </div>

                                                                             <script src="dark-mode-switch.js"></script>
       <!--
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


                       </ul>
   </div>
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


     <br><br><br><br>
     <div class="container">

       <p class='lead' style='font-size:50px'>Email Verification</p>
       <div >
         <?php
         if (isset($_SESSION['verifsuccess'])){
           echo("<p style='color:green'>".$_SESSION['verifsuccess']."</p>");

           unset($_SESSION['verifsuccess']);
         }
         else{
           echo("<p><br></p>");
         }
         if (isset($_SESSION['veriferror'])){
           echo("<p style='color:red'>".$_SESSION['veriferror']."</p>");

           unset($_SESSION['veriferror']);
         }
         else{
           echo("<p><br></p>");
         }

          ?>
       </div>

<?php

if(isset($_SESSION['verif'])){

echo('   <form   method="post">

     <div class="row">
       <div class="col-sm-3">
       <p classs="lead">Your verification code is sent to registered email address.</p>

           <label for="code">Enter verification code:</label><br><br>


       </div>
       <div class="col-sm-3">


         <input type="text" name="code" ><br><br>


         <input type="submit" name="submit" value="Enter code"><br><br>

         <p id="mail_mesg2">
           <button type="button" class="btn btn-outline-danger" onclick="send_mail(\'mail_mesg2\',\'send_again\');">Send Mail Again</button>

         </p>
       </div>


     </div>

     </div>
     <div>

     </div>



   </form>');

}
else{
echo('
<p class="lead" style="font-size:30px">No email IDs left to verify.</p>


 ');



}



 ?>


   <a href="index.php">Back to Home</a><br>
 </div>

     <img style="float:right;margin:50px;vertical-align:middle;" src="images/clock.png" alt="Timer"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


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
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="dark-mode-switch.js"></script>
   </body>

 </html>

<?php
require_once 'pdo.php';
session_start();


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="forgot.js" charset="utf-8"></script>
    <title>Forgot Password</title>
  </head>
  <body>
    <div class="container">
      <br><br><br><br><br>


    <p class='lead' style='font-size:50px'>Forgot password</p>

    <br><br>
    <p class="lead">Enter the last username you remember.</p>
    <div class="row">
      <div class="col-md-3">
        <p id="remove">
        <label for="username"> Last Username:</label><br><br></p>

      </div>
      <div class="col-md-3">
        <p id="forgot">
        <input type="text" id="username" name="username" ><br><br>
        <button type="button" class="btn btn-outline-danger"  onclick="send_mail()">Change Password</button></p>

          <br><br>
      </div>

  </div>

  <a href="index.php">Back to Home</a><br>
  <a href="signup.php">Sign Up instead</a>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

<?php
  session_start();
  
  if(!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Nie zalogowany";
    header('location: login.php');
  }
  
  if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  } 
?>
<!DOCTYPE html>
<html lang="pl" dir="ltr">
<head>
  <meta charset="utf-8" />
  <title>PHP - MySQL</title>
  <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
  <div class="page">
    <?php if(isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    
    <?php  if(isset($_SESSION['username'])) : ?>
      <p>
        Witaj
        <strong>
          <?php echo " " . $_SESSION['username']; ?>
        </strong>
      </p>
      <p>
        <a href="index.php?logout='1'" style="color: red;">Wyloguj</a>
      </p>
    <?php endif ?>
  </div>
</body>
</html>
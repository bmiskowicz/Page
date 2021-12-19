<?php include('secure.php') ?> 
<!DOCTYPE html>
<html lang="pl" dir="ltr">
<head>
  <meta charset="utf-8" />
  <title>PHP - MySQL</title>
  <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
  <div>
    <h2>Login</h2>
    <hr /> 
  </div>
  <div id="error">
    <?php if(count($errors) > 0) : ?>
      <?php foreach($errors as $error) : ?>
        <p><?php echo $error ?></p>
      <?php endforeach ?>
    <?php endif ?>
  </div>
  </div>

  <?php
    if(!isset($_SESSION['username'])){
  ?>

  <div id="formularz">
    <form action="login.php" method="POST">
      <ul class="flex">
        <li class="form-group">
          <label for="username">Username:</label>
          <input type="text" name="username" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <label for="pass">Hasło:</label>
          <input type="password" name="password" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <button type="submit" name="logowanie" id="przycisk" >Zaloguj</button>
        </li>
        <li class="form-group">
          <p>
            Nie masz konta? Zarejestruj się!
            <a href="register.php">Rejestracja</a>
          </p>
        </li>
        <li class="form-group">
          <p>
            Nie chcesz się logować?
            <a href="index.php">Powrót do strony głównej</a>
          </p>
        </li>
      </ul>
    </form>
  </div>

  <?php
  }
  else{
    header("Location: index.php");
  }
  ?>    
  
</body>
</html>
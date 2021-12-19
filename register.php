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
    <h2>Rejestracja</h2>
    <hr /> 
  </div>
  <div id="error">
    <?php if(count($errors) > 0) : ?>
      <?php foreach($errors as $error) : ?>
        <p><?php echo $error ?></p>
      <?php endforeach ?>
    <?php endif ?>
  </div>
  <div id="formularz">
    <form action="register.php" method="POST">
      <ul class="flex">
        <li class="form-group">
          <label for="fName">Imie:</label>
          <input type="text" name="fName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="lName">Nazwisko:</label>
          <input type="text" name="lName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <label for="uName">Nazwa użytkownika:</label>
          <input type="text" name="uName" size=20 maxsize=30 required /><br />
        </li>
        <li class="form-group">
          <label for="pass">Hasło:</label>
          <input type="password" name="pass" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <label for="rpass">Powtórzone hasło:</label>
          <input type="password" name="rpass" size=20 maxsize=50 required /><br />
        </li>
        <li class="form-group">
          <button type="submit" name="rejestracja" id="przycisk" >Zarejestruj</button>
        </li>
        <li class="form-group">
          <p>
            Masz już konto?
            <a href="login.php">Logowanie</a>
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
</body>
</html>
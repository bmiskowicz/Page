<?php
  session_start();
  

$connection = null;
  $errors = array();
  $_SESSION['success'] = "";
  
  $dbHost = 'localhost';
  $dbUser = 'root';
  $dbPass = '';
  $dbName = "myDataBase";
  $dbTableName = "uzytkownicy";
  

  $fName = "";
  $lName = "";
  $uName = "";
  $email = "";
  
  //Utworzenie bazy danych o nazwie "myDBase"
  $conn = new mysqli($dbHost, $dbUser, $dbPass);
  if($conn->connect_error) {
    #echo("Połączenie nie udane: " . $conn->connect_error . '<br />');
  }
  else #echo 'Połączenie udane <br/>';
   
  $sql = 'CREATE DATABASE IF NOT EXISTS ' . $dbName;
  if($conn->query($sql) === TRUE) {
    #echo 'Baza danych utworzona poprawnie<br />';
  }
  else {
    #echo 'Nie można utworzyć bazydanych: ' . $conn->error . '<br />';
  }
  
  $conn->close();
  
  //Utworzenie tabeli o nazwie "uzytkownicy"
  $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
  if($conn->connect_error) {
    #echo("Połączenie nie udane: " . $conn->connect_error . '<br />');
  }
  
  $sql = "CREATE TABLE IF NOT EXISTS " . $dbTableName . "(
    id INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imie VARCHAR(30) NOT NULL,
    nazwisko VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
  )";


  if($conn->query($sql) === TRUE) {
    #echo 'Tabela utworzona poprawnie<br />';
  }
  else {
    #echo 'Nie można utworzyć tabeli: ' . $conn->error . '<br />';
  }
  

  if ( isset( $_POST['logowanie'] ) ) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

      $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser,$dbPass);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $connection->prepare("SELECT username, password,imie,nazwisko,id,email FROM ".$dbTableName." WHERE username='".$username."'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      while ($row = $stmt->fetch()) {
        if($password==$row["password"]) {
          $_SESSION['success']="Zalogowano pomyślnie";
          $_SESSION['username']=$row["username"];
          header("Location: index.php");
        }
      }
    $connection = null;
  }


  if(isset($_POST['rejestracja'])) {
    $username = mysqli_real_escape_string($conn, $_POST['uName']);
    $name = mysqli_real_escape_string($conn, $_POST['fName']);
    $surname = mysqli_real_escape_string($conn, $_POST['lName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['pass']));
    $password2 = md5(mysqli_real_escape_string($conn, $_POST['rpass']));

    if(empty($email)) {
      array_push($errors, "Brak adresu email");
    }

    if(empty($username)) {
      array_push($errors, "Brak nazwy użytkownika");
    }

    if(empty($name)) {
      array_push($errors, "Brak imienia");
    }

    if(empty($surname)) {
      array_push($errors, "Brak nazwiska");
    }

    if(empty($password)) {
      array_push($errors, "Brak hasła");
    }

    if($password != $password2) {
      array_push($errors, "Podane hasła nie zgadzają się");
    }


    $userExists=false;
      $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser,$dbPass);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $connection->prepare("SELECT username FROM ".$dbTableName." WHERE username='".$username."'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      while ($row = $stmt->fetch()) {
        if($username==$row["username"]) {
          $userExists=true;
        }
      }
    $connection = null;

    if($userExists){
      array_push($errors, "User already exists!");
    }

    if(empty($errors))
    {
      if(!$userExists) {
          $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser,$dbPass);
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = 'INSERT INTO '.$dbTableName.'(imie, nazwisko, username, email, password) 
          VALUES ( "'.$name.'", "'.$surname.'", "'.$username.'", "'.$email.'", "'.$password.'" )';
          $connection->exec($sql);
          $last_id = $connection->lastInsertId();
          header("Location: login.php");
        
        $connection = null;
      }
    }

  }
?>
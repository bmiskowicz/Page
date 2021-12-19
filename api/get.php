<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: GET');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,ContentType,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 include_once 'C:\xampp\htdocs\bmis\db.php';
 include_once 'C:\xampp\htdocs\bmis\userModel.php';


 if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['imie']) && isset($_GET['nazwisko'])) {
        $fName = htmlspecialchars(strip_tags($_GET['imie']));
        $lName = htmlspecialchars(strip_tags($_GET['nazwisko']));

        $userModel = new userModel();
        $dane = $userModel->znajdzUzytkownika($fName, $lName);
    }
    else {
        $userModel = new userModel();
        $dane = $userModel->znajdzUzytkownikow();
    }
 }
 ?>
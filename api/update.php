<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: GET');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,ContentType,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 include_once 'C:\xampp\htdocs\bmis\db.php';
 include_once 'C:\xampp\htdocs\bmis\userModel.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars(strip_tags($_POST['id']));
    $username = htmlspecialchars(strip_tags($_POST['uName']));
    $name = htmlspecialchars(strip_tags($_POST['fName']));
    $surname = htmlspecialchars(strip_tags($_POST['lName']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $password = md5(htmlspecialchars(strip_tags($_POST['pass'])));
    $password2 = md5(htmlspecialchars(strip_tags($_POST['rpass'])));

    if(!empty($id) && !empty($email) && !empty($name) && !empty($username) && !empty($surname) && !empty($password) && $password == $password2) {
        
        $userModel = new userModel();
        $dane = $userModel->edytujUzytkownika($id, $name, $surname, $email, $username, $password);
        echo "success";
    }
    else {
        echo "Bad input!";
    }
 }
?>
<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: GET');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,ContentType,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 include_once 'C:\xampp\htdocs\bmis\db.php';
 include_once 'C:\xampp\htdocs\bmis\userModel.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars(strip_tags($_POST['id']));
    
    if(!empty($id)){
        $userModel = new userModel();
        $dane = $userModel->usunUzytkownika($id);
        echo "success";
    }
    else echo "Bad input!";
 }
?>
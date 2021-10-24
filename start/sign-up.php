<?php
session_start();
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:/start/index.php');
}

$errors = [];

if (empty($_POST['uname'])){
    $errors['uname'] = 'Username is missing';
}    
if (empty($_POST['username'])){
        $errors['username'] = 'Email is missing';
    }
    if (empty($_POST['password'])){
        $errors['password'] = 'Password is missing';
    }
    if (empty($_POST['ulocation'])){
        $errors['location'] = 'Location is missing';
    }
    if (empty($_POST['__csrf'])){
        $errors['__csrf'] = 'CSRF token is missing';
    }
    if(! ($_SESSION['token']==$_POST['__csrf'])){
        $errors['__csrf'] = 'CSRF token is missing';
    }
    if(!empty($errors)){
        echo "<body>";
        echo "<script>if(!alert('";
                foreach ($errors as $field => $error){
                    printf("%s ", $error);
                }
        echo "')){ window.location.href='login.php';}</script>";
        exit;
    }

    //check for email alreADY TAKEN

require_once('classes/connect.php');
$stmt = $db->prepare("INSERT INTO `test`.`logintable` (`User_ID`, `Name`, `email`, `pass`, `Location`) VALUES (NULL, ?, ?, ?, ?);");
$reqstatus='PENDING';
$stmt->bind_param("ssss",$_POST['uname'],$_POST['username'],$_POST['password'],$_POST['ulocation']);
$result = $stmt->execute();
$db->close();
if($result == true){
    echo "<body><script>if(!alert('Account created Successfully!')){window.location.href='login.php';}</script></body>";
    exit;
}else{
    echo "<body><script>if(!alert('Failed to create new account!')){window.location.href='login.php';}</script></body>";
    exit;
}




?>
<?php 
require_once('classes/Authenticate.php');
require_once('classes/Item.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }
?>



<?php

if(($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['itemid'])){
        $myitem = new item($_POST['itemid']);
        $myitem->set_details();
        echo $myitem->addRequest($_SESSION['identity'],$_POST['action']);
    
}else{
    echo "Not Recieved";
}

?>
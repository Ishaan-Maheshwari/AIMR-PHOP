<?php 
require_once('classes/Authenticate.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }

if($_SERVER['REQUEST_METHOD']!='POST'){
    header("Location: /start/my-requested-items.php");
    exit;
}

require_once("classes/connect.php");
$error = false;
$dbtable = '';
//Check if all Post variables are set.

//reqid itemid foruserid action

//Changing status in requestlog
$sql = "UPDATE requestlog SET ReqStatus = 'ACCEPTED' WHERE ReqId = '".$_POST['reqid']."';";
$result = $db->query($sql);
if($result == 0){
    $error = true;
}

//Chaning status in items
$sql = "UPDATE items SET ItemStatus ='".$_POST['action']."' WHERE ItemId ='".$_POST['itemid']."';";
$result = $db->query($sql);
if($result == 0){
    $error = true;
}

//Inserting into rentdb or selldb
if($_POST['action']=='SOLD'){
    $dbtable='selldb';
}elseif($_POST['action']=='RENTED'){
    $dbtable='rentdb';
}
$sql = "INSERT INTO `test`.`rentdb` (`logid`, `Req`, `item_id`, `owner_id`, `ForUser`) VALUES (NULL, '".$_POST['reqid']."', '".$_POST['itemid']."', '".$_SESSION['identity']."', '".$_POST['foruserid']."');";
$result = $db->query($sql);
if(!$result){
    $error = true;
}


if($error){
    echo "failed";
}else{
    echo "accepted";
}
?>
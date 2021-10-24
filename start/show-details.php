<?php 
//TODO : Get this webpage in POST call
require_once('classes/Authenticate.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }

if($_SERVER['REQUEST_METHOD'] != 'GET'){
    header("Location: /start/get-requests.php");
    exit;
}

include('templates/header.php');
?>
<main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h3>Owner Details</h3>
            </section>
        </div>
        <div class="row limited">
<?php
require_once("classes/connect.php") ;

$userid = $_SESSION['identity'];
$dbtable = 'rentdb';
if($_GET['Req']=='BUY'){
    $dbtable = 'selldb';
}
$sql = "SELECT owner_id FROM ".$dbtable."\n"
    . "WHERE Req='".$_GET['id']."' and ForUser='".$userid."';";
$result = $db->query($sql);
if($result){
$row = $result->fetch_array(MYSQLI_ASSOC);
$result->close();
$sql = "SELECT Name, email, Location FROM `logintable` WHERE User_ID = '".$row['owner_id']."' LIMIT 0, 30 ";
$result = $db->query($sql);
if($result){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $result->close();
echo "Name     : ".$row['Name']."<br>";
echo "Email    : ".$row['email']."<br>";
echo "Location : ".$row['Location']."<br>";

}else{
    echo "OOPS ! Looks like there is no such User now.";
}

   
}else{
    echo "OOPS ! Looks like your request is not accepted yet or It is expired.";
}

?>
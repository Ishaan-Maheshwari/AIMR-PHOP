<?php 
require_once('classes/Authenticate.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }
?>
<?php
include('templates/header.php');
echo "Welcome<br>";
echo $_SESSION['username'];
?>
<form action="logout.php" class="form">
    <input type="submit" value="Log out" />
</form>
<?php
include('templates/footer.php');
?>
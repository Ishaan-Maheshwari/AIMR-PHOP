<?php 
require_once('classes/Authenticate.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }

include('templates/header.php');
?>

<main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h3>Your Requests</h3>
            </section>
        </div>
        <div class="row limited">

<?php
require_once("classes/connect.php") ;

$userid = $_SESSION['identity'];
$sql = "SELECT items.ItemName, items.Itemdesc, requestlog.ReqAction, requestlog.ReqStatus\n"
    . "FROM requestlog\n"
    . "INNER JOIN items ON requestlog.ReqItem = items.ItemId\n"
    . "WHERE requestlog.ReqBy ='".$userid."' LIMIT 0, 30 ";
$result = $db->query($sql);
$myarray = array();
    if($result){
        echo "<table border = '1'>";
        echo "<tr><th>Item Name</th><th>Description</th><th>Requested For</th><th>Status</th></tr>";
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['ItemName']."</td>";
            echo "<td>".$row['Itemdesc']."</td>";
            echo "<td>".$row['ReqAction']."</td>";
            echo "<td>".$row['ReqStatus']."</td>";
            echo "</tr>";
        }
        $result->close();
        echo "</table>";
    }
?>

    </div>
</main>

<?php include('templates/footer.php'); ?>

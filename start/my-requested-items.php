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
$sql = "SELECT items.ItemId, items.ItemName, COUNT( requestlog.ReqID ) AS Requests\n"
    . "FROM test.requestlog\n"
    . "INNER JOIN test.items ON requestlog.ReqItem = items.ItemId\n"
    . "WHERE items.Owner = '".$userid."'\n"
    . "AND requestlog.ReqStatus = 'PENDING'\n"
    . "ORDER BY COUNT( requestlog.ReqID ) DESC";
$result = $db->query($sql);
$myarray = array();
    if($result){
        echo "<table border = '1'>";
        echo "<tr><th>Item Name</th><th>Requests</th><th>Check your requests</th></tr>";
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['ItemName']."</td>";
            echo "<td>".$row['Requests']."</td>";
            if($row['Requests'] > 0){
                echo '<td><a href="requesting-customer.php?itemid='.$row['ItemId'].'">show requests</a></td>';
            }else{
                echo "<td>NO Requests</td>";
               
            }
            
            echo "</tr>";
        }
        $result->close();
        echo "</table>";
    }else{
            echo "No Items Requested yet!";
        }
?>

    </div>
</main>

<?php include('templates/footer.php'); ?>

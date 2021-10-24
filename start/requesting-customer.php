<?php 
require_once('classes/Authenticate.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }

 if($_SERVER['REQUEST_METHOD'] != 'GET'){
     header("Location: /start/index.php");
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
$itemid = $_GET['itemid'];
$sql = "SELECT logintable.USER_ID, logintable.Name, logintable.email, logintable.Location, requestlog.ReqAction, requestlog.ReqId\n"
    . "FROM requestlog\n"
    . "INNER JOIN logintable ON requestlog.ReqBy = logintable.USER_ID\n"
    . "WHERE requestlog.ReqItem = '".$itemid."' and requestlog.ItemOwner = '".$userid."'\n;";
$result = $db->query($sql);
$myarray = array();
    if($result){
        echo "<table border = '1'>";
        echo "<tr><th>Name</th><th>Email</th><th>Location</th><th>What he wants</th><th>Action</th></tr>";
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['Name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['Location']."</td>";
            echo "<td>".$row['ReqAction']."</td>";
            if($row['ReqAction']=='BUY'){
                $reqaction = "SOLD";
            }else{
                $reqaction = "RENTED";
            }
            $funcurl = "acceptreq('".$row["ReqId"]."','".$row["USER_ID"]."','".$reqaction."')";
            echo '<td><button id="acceptbtn" onclick="'.$funcurl.'">Accept</button><button id="denybtn">Deny</button></td>';
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
<script>
function acceptreq (rid, foruid, actn){

    $.post('accept-request.php', {reqid:rid,itemid:'<?php echo $itemid;?>',foruserid: foruid,action:actn}, function(response){ 
      if(response == 'accepted'){alert("Request sent successfully");}else{alert("Request failed to accept");}
});

};

</script>
<?php include('templates/footer.php'); ?>

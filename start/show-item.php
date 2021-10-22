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
$ItemId= $_GET['item'];
?>

<main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h1>Item-Name</h1>
            </section>
        </div>
        <div class="row limited">

<?php
require_once("classes/connect.php") ;


$sql = "SELECT * FROM `items` WHERE ItemId ='$ItemId'";
$result = $db->query($sql);
$myarray = array();
if(mysqli_num_rows($result) == 1){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['ItemId'].'<br>';
    echo $row['ItemName'].'<br>';
    echo $row['ItemCateg'].'<br>';
    echo $row['ItemLocation'].'<br>';
    echo $row['Itemdesc'].'<br>';
    echo $row['ItemStatus'].'<br>';
    echo $row['RentPrice'].'<br>';
    echo $row['SellPrice'].'<br>';
    echo '<button id="rentbtn">Rent '.$row["RentPrice"].'</button>';
    echo '<button id="buybtn">Buy '.$row["SellPrice"].'</button></section>';
}


?>

    </div>
</main>
<script>
$("#rentbtn").click(function(){

    $.post('rent-item.php', {itemid:'<?php echo $ItemId;?>', action:'RENT'}, function(response){ 
      alert("Request sent successfully");
      $('#rentbtn').text(response);
});

});

$("#buybtn").click(function(){

$.post('rent-item.php', {itemid:'<?php echo $ItemId;?>', action:'BUY'}, function(response){ 
  alert("Request sent successfully");
  $('#buytbtn').text(response);
});

});
</script>
<?php include('templates/footer.php'); ?>

<!-- Use AJAX insead of PoST 



$.post('rent-items.php', {itemid:;, action:'RENT'}, function(response){ 
      alert("success");
      $("#rentbtn").innerHTML(response);
}, 'text');
-->
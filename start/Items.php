<?php 
session_start();
include('templates/header.php'); ?>
<main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h1>Items</h1>
            </section>
        </div>
        <div class="row limited">


<?php
    require_once("classes/connect.php") ;
    $category=$_GET['id'];

    $sql = "SELECT * FROM items WHERE ItemCateg=".$category." and ItemLocation ='Aligarh' and ItemStatus = 'AVAILABLE' ";
    $result = $db->query($sql);
    $myarray = array();
    if($result){
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {

        echo '<section class="column small-12 medium-6 large-3">';
        echo  '<h3>'.$row["ItemName"].'</h3>';
        echo  '<a href="show-item.php?item='.$row['ItemId'].'"><img src="products/pie-apple.jpg" alt="'.$row["ItemName"].'"></a>';
        echo  '<p>'.$row["Itemdesc"].'</p>';
        //echo '<button>Rent '.$row["RentPrice"].'</button>';
        //echo '<button>Buy '.$row["SellPrice"].'</button></section>';
    }
    
}

?>

        </div>
    
    </main>
<?php include('templates/footer.php'); ?>

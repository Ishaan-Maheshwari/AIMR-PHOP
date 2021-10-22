<?php 
session_start();
include('templates/header.php');
$category=$_GET['id'];
?>

<main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h1><?php echo $category;?></h1>
            </section>
        </div>
        <div class="row limited">
<?php
require_once("classes/connect.php") ;

$sql = "SELECT Categ_id, SubCateg_name, Item_count FROM `categories` WHERE Categ_name= '$category'";
$result = $db->query($sql);
$myarray = array();
if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {

        echo '<section class="column small-12 medium-6 large-3">';
        echo  '<h3>'.$row["SubCateg_name"].'</h3>';
        echo  '<a href="items.php?id='.$row['Categ_id'].'"><img src="products/pie-apple.jpg" alt="'.$row["SubCateg_name"].'"></a>';
        echo  '<p>Item count :'.$row["Item_count"].'</p></section>
               ';
    }
    //$result->close();
    //header('Content-Type: application/json');
    //echo json_encode($myArray);
}else{
    echo '<section class="column small-12">';
    echo "No Such Category found !<br>";
    echo "Explore more Categories here: <a href='index.php'>Social Help Network</a>";
    echo "</section>";
}
?>
</div>
    
    </main>
<?php
//TODO : what to do when query to load categories fails.
include('templates/footer.php');

//$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//to accomodate https also
//$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $category;
//echo $actual_link;
//echo $_SERVER['HTTP_HOST'];
//echo $_SERVER['REQUEST_URI'];
?>
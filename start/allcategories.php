<?php 
require_once("classes/connect.php") ;

$sql = "SELECT Categ_name, SUM(Item_count) AS Item_count FROM `categories` GROUP BY Categ_name LIMIT 0, 30 ";
$result = $db->query($sql);
$myarray = array();
if($result){
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {

        echo '<section class="column small-12 medium-6 large-3">';
        echo  '<h3>'.$row["Categ_name"].'</h3>';
        echo  '<a href="category.php?id='.$row["Categ_name"].'"><img src="products/pie-apple.jpg" alt="'.$row["Categ_name"].'"></a>';
        echo  '<p>Item count :'.$row["Item_count"].'</p></section>';
    }
    //$result->close();
    //header('Content-Type: application/json');
    //echo json_encode($myArray);
}

//TODO : what to do when query to load categories fails.

?>
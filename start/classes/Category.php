<?php
class Category{

    public static function getallCategories(){
    require_once("connect.php");
    $sql = "SELECT Categ_id, Categ_name, SubCateg_name FROM `categories` WHERE 1";
    $result = $db->query($sql);
    $myarray = array();
    if($result){
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $myArray[] = $row;
        }
        $result->close();
        header('Content-Type: application/json');
        echo json_encode($myArray);
    }
}
}
?>
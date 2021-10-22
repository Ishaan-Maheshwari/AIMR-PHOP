<?php
class Item{
//properties
    public $name,$category,$location,$ownerId,$desc,$rprice,$sprice;
    private $id;
//methods
public static function connect(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "test";

// Create connection
  $db = new mysqli($servername, $username, $password, $database);
  if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}else{
  return $db;
}
  

// Check connection

}

public function set_details(){
    $db = Item::connect();
    $sql = "SELECT * FROM `items` WHERE ItemId ='$this->id'";
    $result = $db->query($sql);
    $myarray = array();
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $this->name = $row['ItemName'];
        $this->category = $row['ItemCateg'];
        $this->location = $row['ItemLocation'];
        $this->desc = $row['Itemdesc'];
        $this->status = $row['ItemStatus'];
        $this->rprice = $row['RentPrice'];
        $this->sprice =  $row['SellPrice'];
        $this->ownerId =  $row['Owner'];
        
    }
    $db->close();
  }

public function __construct($id) {
    $this->id = $id;
  }

  

  public function getid(){
    return $this->id;
  }

  public function getowner(){
    return $this->ownerId;
  }

  public function addRequest($ureqid, $action){
    $db = Item::connect();
    $stmt = $db->prepare("INSERT INTO `test`.`requestlog` (`ReqId`, `ReqBy`, `ReqItem`, `ItemOwner`, `ReqAction`, `ReqStatus`) VALUES (NULL, ?, ?, ?, ?, ?);");
    $reqstatus='PENDING';
	  $stmt->bind_param("sssss",$ureqid,$this->id,$this->ownerId,$action,$reqstatus);
	  $result = $stmt->execute();
    $db->close();
    if($result == true){
      return 'Request send';
    }else{
      return 'Request failed';
    }
    
    
  }
  public static function addnewItem(){
    $mssg = [];

    if (empty($_POST['itemname'])){
        $mssg['name'] = 'Item Name is missing';
        $mssg['success'] = 'FAILED';
    }
    if (empty($_POST['itemlocation'])){
        $mssg['location'] = 'Item Location is missing';
        $mssg['success'] = 'FAILED';
    }
    if (empty($_POST['itemCategory'])){
      $mssg['success'] = 'FAILED';
      $mssg['location'] = 'Item Category is missing';
    }
    if (empty($_POST['itemdesc'])){
        $mssg['description'] = 'Item Description token is missing';
        $mssg['success'] = 'FAILED';
    }
    if (empty($_POST['rentprice'])){
      $errors['rprice'] = 'Rent price is missing';
      $mssg['success'] = 'FAILED';
    }
    if (empty($_POST['sellprice'])){
      $mssg['sprice'] = 'Sell price is missing';
      $mssg['success'] = 'FAILED';
    }
    if(!empty($mssg)){
        return $mssg;
    }

    $db = Item::connect();
    $myitemname = mysqli_real_escape_string($db,$_POST['itemname']);
    $myitemloc = mysqli_real_escape_string($db,$_POST['itemlocation']); 
    $myitemdesc = mysqli_real_escape_string($db,$_POST['itemdesc']);
    $myitemrprice = mysqli_real_escape_string($db,$_POST['rentprice']); 
    $myitemsprice = mysqli_real_escape_string($db,$_POST['sellprice']);
    $myitemcateg = mysqli_real_escape_string($db,$_POST['itemCategory']);
    $myitemowner= $_SESSION['identity'];
    $itemstatus='AVAILABLE';

    $stmt = $db->prepare("INSERT INTO `test`.`items` (`ItemId`, `ItemLocation`, `ItemStatus`, `RentPrice`, `SellPrice`, `ItemName`, `Owner`, `ItemCateg`, `Itemdesc`) VALUES (NULL, ?, ?,?,?, ?, ?, ?, ?);");
    $stmt->bind_param('ssssssss',$myitemloc,$itemstatus,$myitemrprice, $myitemsprice, $myitemname, $myitemowner, $myitemcateg, $myitemdesc);
	  $result = $stmt->execute();
    $db->close();
    if($result == true){
      $mssg['success'] = 'SUCCESS';
      return $mssg;
    }else{
      $mssg['success'] = 'FAILED';
      $mssg['dberror'] = 'Cannot add this Item.';
      return $mssg;
      
    }
      
   
    
  }
}
?>
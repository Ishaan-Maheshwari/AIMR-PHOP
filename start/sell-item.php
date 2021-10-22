<?php 
require_once('classes/Authenticate.php');
require_once('classes/Item.php');
//use App\Authenticate\Authenticate;
session_start();

 if(! Authenticate::isLoggedIn()){
     header("Location: /start/login.php");
     exit;
 }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $mssg = Item::addnewItem();
}
?>
<?php
include('templates/header.php');
?>
<script>
    $(document).ready(loadCat);
            function loadCat(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    obj1 = JSON.parse(this.responseText);
            
                    var myList = document.getElementById("categ");
                    for (let i=0; i < obj1.length; i++){
                        var myoption = document.createElement("option");
                        myoption.innerHTML = obj1[i].Categ_name+':'+obj1[i].SubCateg_name;
                        var att = document.createAttribute("value");
                        att.value= obj1[i].Categ_id;
                        myoption.setAttributeNode(att);
                        myList.appendChild(myoption);
                    }
                    
                }
                xhttp.open("GET", "controller/getCategjson.php",true); // categories will come from db in json or xml format.
                xhttp.send();
            }
            
            </script>
<main class="clearfix">
    <div class="row limited">
        <section class="column small-12">
            <?php 
            if(!empty($mssg)){
                if($mssg['success'] == 'FAILED'){
                //echo "<strong>Form Errors</strong>";
                echo "<p>There were some issues validating the form</p>";
                echo "<ul>";
                foreach ($mssg as $field => $error){
                    printf("<li>Reason: %s</li>", $error);
                }
                echo "</ul>";
            }
            if($mssg['success'] == 'SUCCESS'){
                printf("Successfully Added !");
            }
            }
            
            ?>
        </section>
</div>
    <div class="row limited">
<section  class="column small-12 medium-6 form">  
    <h3>Sell a new Item</h3>
<form method="POST" action="sell-item.php">
<input type="text"  name="itemname" placeholder="Name of Item" required>
<input type="text"  name="itemlocation" placeholder="Location" required>
<label for="categ" >Choose a category:</label>
            <select id="categ" name="itemCategory">
            <option  disabled selected>Choose a Category</option>

            </select>
            <button onclick="addNewCategory()">Add a new Category</button><br>

<input type="text"  name="itemdesc" placeholder="Description of Item" required>
<input type="number"  name="rentprice" placeholder="Rent Price" value=0 required>
<input type="number"  name="sellprice" placeholder="Selling Price" value=0 required>
<input type="submit" value="Add Item"/>
</form>
</section> 
</div>
</main>


<?php
include('templates/footer.php');

?>
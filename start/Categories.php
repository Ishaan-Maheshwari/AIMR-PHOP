<?php
session_start();
include('templates/header.php');
?>
<script>
    $(document).ready(loadCat);
            function loadCat(){
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    obj1 = JSON.parse(this.responseText);
            
                    var myList = document.getElementById("Categ-list");
                    for (let i=0; i < obj1.length; i++){
                        var mylistitem = document.createElement("li");
                        var myanchor = document.createElement("a");
                        myanchor.innerHTML = obj1[i].Categ_name+' :: '+obj1[i].SubCateg_name;
                        var att = document.createAttribute("href");
                        att.value= "items.php?id="+obj1[i].Categ_id;
                        myanchor.setAttributeNode(att);
                        mylistitem.appendChild(myanchor);
                        myList.appendChild(mylistitem);
                    }
                    
                }
                xhttp.open("GET", "controller/getCategjson.php",true); // categories will come from db in json or xml format.
                xhttp.send();
            }
            
</script>

<main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h2><?php echo 'Explore categories';?></h2>
            </section>
        </div>
        <div class="row limited">
            <section>
                <ul id="Categ-list">
                </ul>
            </section>
        </div>
    
</main>

<?php
//TODO : what to do when query to load categories fails.
include('templates/footer.php');
?>
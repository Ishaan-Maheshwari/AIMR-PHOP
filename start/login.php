<?php
session_start();
require_once('classes/Authenticate.php');
//use App\Authenticate\Authenticate;
Authenticate::generateCSRFToken();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $errors = Authenticate::login();
    if(empty($errors)){
        session_regenerate_id(true);
        header('Location:/start/index.php');
    }
}

?>
<?php include('templates/header.php'); ?>  
<main class="clearfix">
    <div class="row limited">
        <section class="column small-12">
            <?php 
            if(!empty($errors)){
                //echo "<strong>Form Errors</strong>";
                echo "<p>There were some issues validating the form</p>";
                echo "<ul>";
                foreach ($errors as $field => $error){
                    printf("<li>Reason: %s</li>", $error);
                }
                echo "</ul>";
            }
            ?>
        </section>
</div>
    <div class="row limited">
        <section class="column small-12 medium-6 form">  
         <h2>Login into your Account.</h2>
<form method="POST" action="login.php">
<input type="text" id="fname" name="username" placeholder="Email Address" required>
<input type="password" id="lname" name="password" placeholder="Password" required>
  <input name="__csrf" type="hidden" value="<?php echo $_SESSION['token']; ?>">
  <input type="submit" value="Log In"/>
</form>
</section> 
<section  class="column small-12 medium-6 form">  
    <h2>Create a new Account.</h2>
<form>
<input type="text"  name="username" placeholder="Email Address" required>
<input type="password"  name="password" placeholder="Password" required>
<input type="submit" value="Sign Up"/>
</form>
</section> 
</div>
</main>
    
 <?php include('templates/footer.php'); ?>

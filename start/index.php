<?php session_start(); ?> 
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/small.css" rel="stylesheet">
    <link href="css/medium.css" rel="stylesheet">
    <link href="css/large.css" rel="stylesheet">
    
<title>Home | Social Help Network</title>
</head>

<body>
    <header class="clearfix">
        <div class="row limited">
            <section class="column small-12">
                <img src="images/logo.svg" alt="Social Help Netwok logo">
                <h1>Social Help Network</h1>
                <h2>Our social connection</h2>
            </section>
        </div>
    
    </header>
    
    <nav class="clearfix">
        <div class="row limited">
            <button id="hamburgerBtn">&#9776</button>
            <ul id="primaryNav">
                <li class="active"><a href="index.php"><img src="templates/home.svg" height="16px" alt="HOME"></a></li>
                <li><a href="Categories.php">Categories</a></li>
                <li><a href="sell-item.php">Sell an Item</a></li>
                <li><a href="my-requested-items.php">Items rented</a></li>
                <li><a href="get-requests.php">Requests</a></li>
                <?php if(isset($_SESSION['identity'])){
                    echo "<li><a href='profile.php'>".$_SESSION['username']."</a></li>";
                }else{
                    echo '<li><a href="login.php">Login</a></li>';
                }
                if(isset($_SESSION['location'])){
                    echo "<li><a href='#'>".$_SESSION['location']."</a></li>";
                }else{
                    echo '<li><a href="#">Location</a></li>';
                }
                ?>
            </ul>
        </div>
    
    </nav>
    
    <main class="clearfix">
        <div class="row limited">
            <section class="column class-12">
                <h1>Categories</h1>
            </section>
        </div>
        <div class="row limited">
        <?php include("allcategories.php"); ?>
        </div>
    
    </main>
    
    <footer class="clearfix">
        <div class="row limited">
            <section class="column small-12 medium-6 large-3">
                <h2>Donate</h2>
                <ul>
                    <li>Orpahans</li>
                    <li>Homeless</li> 
                    <li>Old peoples</li>
                </ul>
            </section>
            <section class="column small-12 medium-6 large-3">
                <h2>Conatct US</h2>
                <ul>
                    <li>Mobile no +919998887776</li>
                    <li>Email socialhelp@network.com</li> 
                    <li>Adress : Dept. of computer Science</li>
                    <li>Support</li>
                </ul>
            </section>
            <section class="column small-12 medium-6 large-3">
                <h2>Social</h2>
                <ul>
                    <li>Facebook</li>
                    <li>Twitter</li> 
                    <li>Instagram</li>
                </ul>
            </section>
            <section class="column small-12 medium-6 large-3">
                <h2>About Us</h2>
                <img src="images/logo3.png" alt="logo">
                <p>&copy; 2020 &bull; all rights reserved.</p>
            </section>
            </div> <!-- end row -->
    
    
    </footer>
    
    <script src="js/menutoggle.js"></script>
</body>
</html>

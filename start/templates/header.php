<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet">
    <link href="css/normalize.css" rel="stylesheet">
    <link href="css/small.css" rel="stylesheet">
    <link href="css/medium.css" rel="stylesheet">
    <link href="css/large.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
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
                <li class="active"><a href="index.php">Categories</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="sell-item.php">Sell an Item</a></li>
                <li><a href="#">Items rented</a></li>
                <li><a href="get-requests.php">Requests</a></li>
                <?php if(isset($_SESSION['identity'])){
                    echo "<li><a href='profile.php'>".$_SESSION['username']."</a></li>";
                }else{
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
                
            </ul>
        </div>
    
    </nav>
    
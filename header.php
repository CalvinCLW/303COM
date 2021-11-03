<?php 
session_start(); 
date_default_timezone_set("Asia/Kuala_Lumpur");
?>
<html>
<head>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Fav Icon-->
<link rel="shortcut icon" type="image/png" href="images/favicon.png">
<!--CSS-->
<link rel="stylesheet" href="style.css"> 
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<!-- Fa Fa Icon -->    
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<!-- Fa Fa Icon -->   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<!-- Animated on Scroll -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> 
</head>
<body>

<div class="header">
    <div class="navbar" id='nav'>
        <ul id="navword">
            <li><img src="images/cinema_logo.png"></li>
            <li><a href="homepage.php">Home</a></li>
            <li><a href="movie.php">Movie</a></li>
            <li><a href="promotion.php">Promotion</a></li>
            <li><a href="news.php">News</a></li>
            <li>
                <?php  
                    if ( isset($_SESSION['userName']) ) {
                        echo "<a name='login' href='member.php'>" . $_SESSION['userName'] . "</a>";
                        
                    } 
                    else {
                        echo "<a name='login' href='account.php'>Login</a>";
                    }?>
            </li>
        </ul>
    </div>
</div>        
    
</body>
</html>

<html>
    <head>
        <title>Homepage</title>
    </head>
<body>
<!-- Header -->
<?php require ('header.php'); ?>

<!-- Content -->
<div class="homepage">
<!-- start of chatbot -->
<div class="chatbot">
    <button id="open-button" class="open-button" onclick="openForm()"><i class='fas fa-comment'></i></button>
    <div id="wrapper" class="wrapper">
        <div class="title">Buddy Bot Chatbot<button class="close-button" onclick="closeForm()">X</button></div>
        <div class="form">
            
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
            
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>You search movie information by using keywords!</p>
                </div>
                
            </div>
            
        </div>
        
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Eg. action, horror, blackwidow" required>
                <button id="send-btn" type="submit">Send</button>
            </div>
        </div>
    </div>
</div>    
<!-- end of chatbot-->
<div class="container-fluid firstrow">
    <div class="row">
            <div id="slider">
                <ul id="posterSlider"> 
                  <li><img src="images/carousel/poster1.jpg" alt=""></li>
                  <li><img src="images/carousel/poster2.jpg" alt=""></li>
                  <li><img src="images/carousel/poster3.jpg" alt=""></li>
                  <li><img src="images/carousel/poster4.jpg" alt=""></li>
                  <li><img src="images/carousel/poster5.jpg" alt=""></li>
                </ul>
            </div>
    </div>
</div>

    
<div class="container-fluid secondrow">
    <div class="row">
        <h1>Now Showing</h1>
        <ul class="topSeller">
            <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fyp";
                $con = mysqli_connect($servername, $username, $password, $dbname);
            
                $res = mysqli_query($con,"Select * from movie LIMIT 8");
                $queryResult = mysqli_num_rows($res);
                if($queryResult > 0){
                    while($row =mysqli_fetch_array($res)){
            ?>
            <li><a href="buy.php?id=<?php echo $row['movieID'];?>"><?php echo '<img src="data:image;base64,'.base64_encode($row['image']) .'" >'; ?></a></li>
            <?php 
                    }
                }
            ?>
        </ul>
    </div>
</div>
    
 <div class="container-fluid thirdrow">
    <div class="row">
        
            <ul class="titles">
                <li><a onclick="promotion()">Promotion</a></li>
                <li>|</li>
                <li><a onclick="news()">News</a></li>
            </ul>        
        
        
        
        <ul class="promotion" id="promotion">
            <?php 
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "fyp";
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                
                    $res = mysqli_query($con,"Select * from promotion LIMIT 3");
                    $queryResult = mysqli_num_rows($res);
                    if($queryResult > 0){
                    while($row =mysqli_fetch_array($res)){
                ?>
            <li><a href="promotion.php"><?php echo '<img src="data:image;base64,'.base64_encode($row['image']) .'" >'; ?></a></li>
            <?php 
                    }
                }
            ?>
        </ul>
        
        <ul class="news" id="news">
            <?php 
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "fyp";
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                
                    $res = mysqli_query($con,"Select * from news LIMIT 3");
                    $queryResult = mysqli_num_rows($res);
                    if($queryResult > 0){
                    while($row =mysqli_fetch_array($res)){
                ?>
            <li><a href="news.php"><?php echo '<img src="data:image;base64,'.base64_encode($row['image']) .'" >'; ?></a></li>
            <?php 
                    }
                }
            ?>
        </ul>
        
    </div>
</div>   

</div>
<!-- End of Content -->

<!-- Javascript -->
<?php require ('javascript.php'); ?>
<?php require ('footer.php'); ?>
</body>
</html>

    
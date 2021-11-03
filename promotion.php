<html>
    <head>
        <title>Promotion</title>
    </head>
<body>
<!-- Header -->
<?php require ('header.php'); ?>

<!-- Content -->
<div class="promotion">
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
            <h1>Latest Promotion</h1>
            <div class="poster">
                <?php 
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "fyp";
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                
                    $res = mysqli_query($con,"Select * from promotion");
                    $queryResult = mysqli_num_rows($res);
                    if($queryResult > 0){
                    while($row =mysqli_fetch_array($res)){
                ?>
                <div class="col-4">
                    <?php echo '<img src="data:image;base64,'.base64_encode($row['image']) .'" >'; ?>
                </div>
                <?php 
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
    
<!-- Javascript -->
<?php require ('javascript.php'); ?>
<?php require ('footer.php'); ?>
</body>
</html>
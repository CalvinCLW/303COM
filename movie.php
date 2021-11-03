<html>
    <head>
        <title>Movie</title>
    </head>
<body>
<!-- Header -->
<?php require ('header.php'); ?>

<!-- Content -->
<div class="movie">    
<!-- start of chatbot -->
<div class="chatbot">
    <button id="open-button" class="open-button" onclick="openForm()"><i class='fas fa-comment'></i></button>
    <div id="wrapper" class="wrapper">
        <div class="title">Online Cinema Chatbot<button class="close-button" onclick="closeForm()">X</button></div>
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
                    <p>You can search movie information by using keywords!</p>
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
            <div class="searchbar">
            <form action="" method="post">   
                <input type="text" name="search" placeholder="Search Movie">
                <button type="submit" name="searchBtn"><i class="fa fa-search"></i></button>
            </form>  
            </div>
            
            <ul class="list">
                <?php
                    
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "fyp";
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                
                    if(isset ($_POST['searchBtn'])){
    
                        $search = $_POST['search'];
                        $res = mysqli_query($con,"Select * from movie WHERE movieName LIKE '%$search%' OR genre LIKE '%$search%' ");
                        $queryResult = mysqli_num_rows($res);
                    }
                
                    else{
    
                        $res = mysqli_query($con,"Select * from movie");
                        $queryResult = mysqli_num_rows($res);
                    }

                    if($queryResult > 0){
                        while($row =mysqli_fetch_array($res)){
                            
                    ?>
                    
                <li>
                    <div class="listBox">
                    <a href="#">
                    <button onclick="location.href = 'buy.php?id=<?php echo $row['movieID']; ?>' " class="buyBtn">Buy</button>
                    <button onClick="popclick(this.id)" id="<?php echo $row['movieID']; ?>" name="infoBtn" class="infoBtn">Info</button>
                               
                        <div id="popout<?php echo $row['movieID'];?>" name="popout" class="modal popout">
                          <div class="popout-content">
                            <div class="popout-header">
                                <span class="closes<?php echo $row['movieID'];?>" id="close">&times;</span>
                                <h2><?php echo $row['movieName']?></h2>
                                <p>Time: <?php echo $row['time']?></p>
                                <p>Genre: <?php echo $row['genre']?></p>
                                <p>Release Date: <?php echo $row['releaseYear']?></p>
                                <p>Rating: <?php 
                                                if($row['avgRating'] == 0){
                                                    echo "Not Rated";
                                                }
                                                else {
                                                    echo round($row['avgRating'],1) . " Star";
                                                }
                                            ?> </p>
                            </div>
                            <div class="popout-body">
                                <p>Description: </p>
                                <p><?php echo $row['description']?></p>
                              </div>
                          </div>
                        </div>
                        
                    <?php echo '<img src="data:image;base64,'.base64_encode($row['image']) .'" >'; ?>
                    <div class="black-overlay">  </div>
                    </a>
                    <h3><?php echo $row['movieName']?></h3>
                    </div>
                </li>
                		<?php
                		}
                    }
                    else{
                        echo '<p style="color: white; font-size: 38px; font-weight: 700;">No results found!</p>';
                        
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

    
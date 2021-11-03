<?php session_start(); ?>
<html>
<head>
    <title>Member</title>
</head>
<body>
<!-- Header -->
<?php require ('headerAccount.php'); ?>

<!-- Content -->
<div class="membership">
    <div class="member-box">
        <div class="left">
            <h1>Welcome,</h1> 
            <?php  
                echo "<h1>" . $_SESSION['userName'] . "</h1>";            
            ?>
            
            <a class="logoutBtn" href="logout.php">Log Out</a>
        </div>
        
        <div class="right">
            <h1>Past Purchases</h1>
            <table class="past-purchase">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Movie</th>
                        <th>Date</th>
                        <th>Rating</th>
                    </tr>
                </thead>    
                <tbody>
                    
                        <?php
                    
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "fyp";
                            $con = mysqli_connect($servername, $username, $password, $dbname);
                        
                            $username = $_SESSION['userName'];
                        
                            $res = mysqli_query($con,"Select * from ticket WHERE userName = '".$username."' ");
                            $queryResult = mysqli_num_rows($res);
                            $x = 0;
                            if($queryResult > 0){
                                while($row =mysqli_fetch_array($res)){
                                    $_SESSION["ticketID"] = $row['ticketID'];
                                    $_SESSION["movieName"] = $row['movieName'];
                                    $x++;
                        ?>
                        <tr>
                            <td><?php echo $x ?></td>
                            <td><?php echo $row['movieName']?></td>
                            <td><?php echo $row['purchaseDate']?></td>
                            <td>
                                <?php 
                                    
                                    $ticketID = $row['ticketID'];
                                    $res2 = mysqli_query($con, "Select * from rating where ticketID = '".$ticketID."' and userName = '".$username."' ");
                                    $queryResult1 = mysqli_num_rows($res2);
                                    
                                    if($queryResult1 > 0){
                                        while($row =mysqli_fetch_array($res2)){
                                            echo $row['rating'] . " Star";
                                        }
                                    }
                                    
                                    else {
                                        echo "<a href='rating.php'>not rated</a>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                    
                            else {
                                echo "<h4 style='color: white;'>No purchase found!</h4>";
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- End of Content -->

<!-- Javascript -->
<?php require ('javascript.php'); ?>
</body>
</html>

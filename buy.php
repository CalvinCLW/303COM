<html>
    <head>
        <title>Buy Ticket</title>
    </head>
<body>
<!-- Header -->
<?php require ('header.php'); ?>
<?php 
    if ( isset($_SESSION['userName']) ) {
    $ID = $_GET['id'];  
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "fyp";
    
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
    
     $res = mysqli_query($conn, "Select * from movie WHERE movieId    = '".$ID."'");
                $queryResult = mysqli_num_rows($res);

                if($queryResult > 0){
                    while($row =mysqli_fetch_array($res)){
?>
<!-- Content -->
<div class="buy">
    <div class="container-fluid firstrow">
        <div class="row">
            <div class="buyTicket">
              <?php
                if(isset($_POST["buy"])){
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "fyp";

                    // Create connection
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    // Check connection
                    if (!$conn) {
                         die("Connection failed: " . mysqli_connect_error());
                    }
                    else{
                            $watchTime = $_POST['watchTime'];
                            $watchDate = $_POST['watchDate'];
                            $adult = $_POST['adult'];
                            $children = $_POST['children'];
                            $movieID = $ID;
                            $movieName = $row['movieName'];
                            $userID = $_SESSION['userID'];
                            $userName = $_SESSION['userName'];
                            $buySeat = $adult + $children;
                            $totalPrice = ($adult * 15) + ($children * 10);
                                
                        
                            $result = mysqli_query($conn, "SELECT SUM(adultSeat + childrenSeat) as sumSeat FROM ticket WHERE movieID = '".$ID."' and watchTime = '".$watchTime."' and watchDate = '".$watchDate."' ");
                            $row = mysqli_fetch_array($result);
                            $sum = $row['sumSeat'];
                            $leftSeat = 10 - $sum ;
                            if($sum >= 10){
                            
                                echo "<script> alert('Full House!');window.history.back(); </script>";
                            }
                        
                            else{
                                if($buySeat <= $leftSeat){
                                
                                    $result = mysqli_query($conn, "SELECT userEmail FROM account WHERE userEmail='".$useremail."' ");

                                    while($row = mysqli_fetch_assoc($result)){
                                            $checkWatchTime = $row['watchTime'];
                                            $checkWatchDate = $row['watchDate'];
                                            $checkMovieName = $row['movieName'];
                                    }
                                    if($movieName == $checkMovieName){

                                    }
                                    else {   
                                        $sql = "INSERT INTO ticket (movieID, movieName, userID, userName, watchDate, watchTime, adultSeat, childrenSeat, totalPrice, purchaseDate) VALUES ('$movieID','$movieName','$userID','$userName','$watchDate','$watchTime','$adult','$children','$totalPrice', CURDATE())";

                                        if (mysqli_query($conn, $sql)) {

                                                header("location: checkout.php");
                                            }
                                        else {
                                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                            }
                                }
                            }
                            else {
                                echo "<script> alert('There is only $leftSeat seat left!');window.history.back(); </script>";
                            }
                        }
                    }
                            mysqli_close($conn);
                }

                
                else {
               
            ?>
            
            <form name="ticketForm" class="input-group-custom ticketForm" action="#" method="post">
                <h1><?php echo $row['movieName']; ?></h1>
                Watch Date:<br><select name="watchDate">
                            <?php 
                                $today = date("d") * 1;
                                $fewmoreday = date("d") + 5;
                                for ($x = $today; $x < $fewmoreday; $x++) {
                                    echo "<option value=$x>$x</option>";
                                }
                            ?>
                           </select>
                <br>
                Watch Time:<br><select name="watchTime">
                                    <option value="10">12 p.m.</option>
                                    <option value="12">14 p.m.</option>
                                    <option value="14">16 p.m.</option>
                                    <option value="16">18 p.m.</option>
                               </select>
                <br>
                Adult (RM 15):<br><select name="adult">
                            <?php 
                                for ($x = 1; $x <= 10; $x++) {
                                    echo "<option value=$x>$x</option>";
                                }
                            ?>
                       </select>
                <br>
                Children (RM 10):<br><select name="children">
                            <?php 
                                for ($x = 0; $x <= 10; $x++) {
                                    echo "<option value=$x>$x</option>";
                                }
                            ?>
                       </select>
                <br>
                <button type="submit" name="buy" class="buyBtn">Checkout</button>
            </form>
            <?php
                        }
                    }
                }
            
                ?>
            </div>
        </div>
   </div>  
</div>
<?php 
    } 
    else { 
    ?>
    <h1 style="color: white; margin: auto;">You must register an account first before purchase movie ticket!</h1>
  <?php  
    }
    ?>
    
    ?>
<!-- End of Content -->

<!-- Javascript -->
<?php require ('javascript.php'); ?>
</body>
</html>

    
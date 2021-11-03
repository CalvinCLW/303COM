<html>
    <head>
        <title>Confirmed Purchase</title>
    </head>
<body>
<!-- Header -->
<?php 
    require ('headerCheckout.php'); 
?>

<!-- Content -->
<div class="rating">
    <div class="container-fluid firstrow">
        <div class="row">
            <div class="ratingForm">
                    <?php 
                    if(isset($_POST['submitRating'])){
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "fyp";
                        $con = mysqli_connect($servername, $username, $password, $dbname);
                        
                        if (!$con) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        else {
                            $ticektID = $_SESSION["ticketID"];
                            $movieName = $_SESSION["movieName"];
                            $userName = $_SESSION["userName"];
                            $comment = $_POST['comment'];
                            $rating = $_POST['rating'];
                            $sql = "INSERT INTO rating (rating, comment, ticketID, movieName, userName) VALUES ('$rating', '$comment', '$ticektID', '$movieName', '$userName')";
                            $select2 = "SELECT AVG(rating) AS averageRating FROM rating WHERE movieName = '".$movieName."' ";
                            
                            if (mysqli_query($con, $sql)) {
                                $result = mysqli_query($con, $select2);
                                while($row = mysqli_fetch_array($result)){
                                $update = "UPDATE movie SET avgRating = '".$row['averageRating']."' WHERE movieName = '".$movieName."' ";
                                
                                    if(mysqli_query($con, $update)){
                                        echo "<script> alert('Movie rated!');window.location= \"member.php\"; </script>";
                                    }
                                        
                                    else {
                                        echo "cannot update";
                                    }
                                }
                            }
                                
                                    
                            
                            else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                            
                        }
                    }
                    else {
                    ?>
                    <form id="ratingForm" action="#" method="post">
                        <select name=rating required>
                            <option value="5">5 Star</option>
                            <option value="4">4 Star</option>
                            <option value="3">3 Star</option>
                            <option value="2">2 Star</option>
                            <option value="1">1 Star</option>
                        </select>
                        <br>
                        <textarea name="comment" placeholder="Enter your comment" required></textarea>
                        <br>
                        <button type="submit" name="submitRating" class="submitRating">Rate</button>
                    </form>
                    <?php 
                    } 
                    ?>
            </div>
        </div>
   </div>  
</div>
<!-- End of Content -->

<!-- Javascript -->
<?php require ('javascript.php'); ?>
</body>
</html>

    
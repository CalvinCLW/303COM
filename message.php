<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fyp";
$con = mysqli_connect($servername, $username, $password, $dbname) or die("Database Error");

$getMsg = strtolower(mysqli_real_escape_string($con, $_POST['text']));

$res =  mysqli_query($con, "SELECT * FROM movie WHERE genre LIKE '%$getMsg%' or movieName LIKE '%$getMsg%' or releaseYear LIKE '%$getMsg%'");
$queryResult = mysqli_num_rows($res);

    if($queryResult > 0){
        while($row = mysqli_fetch_array($res)){
            $movieName = strtolower( $row['movieName'] );
            $movieGenre = strtolower( $row['genre'] );
            
                if ($getMsg == $row['releaseYear']){
                    echo $row['movieName'] . "<br>";
                }
            
                else if ($getMsg == $movieName){
                    
                    echo $row['movieName'] ;
                    echo "<br>";
                    echo $row['genre'];
                    echo "<br>";
                    echo $row['releaseYear'];
                    echo "<br>";
                    echo "Average Rating: ". $row['avgRating'];
                    echo "<br>";
                    echo $row['description']; 
                     
                }

                else if($getMsg = $movieGenre){
                    echo $row['movieName'];
                    echo "<br>";

                }
           
        }   
    }
    else{
        echo "I'm sorry, I can't be able to understand you!";
    }


?>
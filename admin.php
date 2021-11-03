<?php 
session_start(); 
date_default_timezone_set("Asia/Kuala_Lumpur");
?>
<html>
<head>
    <title>Admin</title>
    <!--CSS-->
    <link rel="stylesheet" href="style.css"> 
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    
    <!-- Chart Script -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
    google.charts.load('current', {packages: ['corechart']});
    
    <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "fyp";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
                                
    ?>
    
    function drawCategoryChart() {
      // Define the chart to be drawn.
      var data = google.visualization.arrayToDataTable([
          ['Category','Number'],
          <?php

            $sql = "SELECT movieName,COUNT(*) FROM ticket GROUP BY movieName";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                echo "['".$row['movieName']."',".$row['COUNT(*)']."],";
            }

        ?>
      ]);

      var options = {
            title: 'Top Movie Sales',
            pieSliceText: 'percentage',
            width: 750,
            height: 500,
            chartArea: {
                    height: "90%",
                    width: "90%"
            },
            is3D: true,
            fontSize:18,
            backgroundColor: "black",
            legend: {
                textStyle: {
                    color: 'white',
                }
            }
      };

      // Instantiate and draw the chart.
      var chart = new google.visualization.PieChart(document.getElementById('topMovieSalesChart'));
      chart.draw(data, options);
    }

    function drawStatusChart() {
      // Define the chart to be drawn.
      var data = google.visualization.arrayToDataTable([
          ['Status','Number'],
          <?php
           if(isset($_POST['filter'])){
                $getDate = $_POST['mydate'];
                $month = date("m",strtotime($getDate));  
                $res = mysqli_query($conn, "SELECT movieName,COUNT(*) FROM ticket WHERE MONTH(purchaseDate)=$month GROUP BY movieName");
            }
                                
            else {
                $getThisMonth = date('m'); 
                $res = mysqli_query($conn,"SELECT movieName,COUNT(*) FROM ticket WHERE MONTH(purchaseDate)=$getThisMonth GROUP BY movieName");
            }
        
            while($row = mysqli_fetch_array($res)){
                echo "['".$row['movieName']."',".$row['COUNT(*)']."],";
            }

        ?>
      ]);

      var options = {
            title: 'Monthly Movie Sales',
            width: 750,
            height: 500,
            pieSliceText: 'percentage',
            chartArea: {
                height: "90%",
                width: "90%"
            },
            is3D: true,
            fontSize:18,
            backgroundColor: "black",
            legend: {
                textStyle: {
                    color: 'white',
                }
            }
    
      };

      // Instantiate and draw the chart.
      var chart = new google.visualization.PieChart(document.getElementById('monthlyMovieSalesChart'));
      chart.draw(data, options);
    }
    </script>


    
</head>
<body>
    <div class="admin">
        <div class="container-fluid">
            <div class="row">
                <h1>Admin Panel<a href="logout.php">Log Out</a></h1>
                <div class="col-md-2">
                    <ul>
                        <li id="checkSalesList"><a id="checkSalesTag" href="#" onclick="checksales()">Check Sales</a></li>
                        <li id="AddMovieList"><a id="addMovieTag" href="#" onclick="addmovie()">Add Movie</a></li>
                        <li id="AddPromotionList"><a id="addPromotionTag" href="#" onclick="addpromotion()">Add Promotion</a></li>
                        <li id="AddNewsList"><a id="addNewsTag" href="#" onclick="addnews()">Add News</a></li>
                    </ul>
                </div>
                
                <div class="col-md-10">
                    <div id="checkSales" class="checkSales">
                        <form class="filterForm" method="POST" action="">
                            <input type="month" id="monthPicker" class="month" name="mydate" >
                            <input type="submit" class="filterBtn" name="filter" value="Filter">
                            <input type="submit" class="filterBtn" name="clear" value="Clear">
                        </form>
                        <div id="printp1">
                        <div class="salesChart">
                            <h2>Top Movie Sales</h2>
                            <div id="topMovieSalesChart" style="width: 50%; height: 500px; margin: auto; background-color: black;" ></div>
                            <h2>Monthly Movie Sales</h2>
                            <div id="monthlyMovieSalesChart" style="width: 50%; height: 500px; margin: auto; background-color: black;" ></div>
                        </div>

                        
                        
                          
                            <table class="sales">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Movie</th>
                                        <th>Username </th>
                                        <th>WatchDate</th>
                                        <th>WatchTime</th>
                                        <th>Adult Seat</th>
                                        <th>Children Seat</th>
                                        <th>Total Price</th>
                                        <th>Purchase Date</th>
                                    </tr>
                                </thead>    
                                <tbody>
                             <?php

                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "fyp";
                                $con = mysqli_connect($servername, $username, $password, $dbname);
                                
                                if(isset($_POST['filter'])){
                                    $getDate = $_POST['mydate'];
                                    $month = date("m",strtotime($getDate));
                                    
                                    $res = mysqli_query($con, "SELECT * FROM ticket WHERE month(purchaseDate) = $month");
            
                                    
                                }
                                
                                else if(isset($_POST['clear'])){
                                    $res = mysqli_query($con,"Select * from ticket ");
                                }
                                    
                                else{
                                    $res = mysqli_query($con,"Select * from ticket ");
                                }
                                    
                                $queryResult = mysqli_num_rows($res);
                                if($queryResult > 0){
                                    while($row =mysqli_fetch_array($res)){

                            ?>

                                    <tr>
                                        <td><?php echo $row['ticketID']?></td>
                                        <td><?php echo $row['movieName']?></td>
                                        <td><?php echo $row['userName']?></td>
                                        <td><?php echo $row['watchDate']?></td>
                                        <td><?php echo $row['watchTime']?></td>
                                        <td><?php echo $row['adultSeat']?></td>
                                        <td><?php echo $row['childrenSeat']?></td>
                                        <td><?php echo $row['totalPrice']?></td>
                                        <td><?php echo $row['purchaseDate']?></td>
                                    </tr>

                            <?php
                                    }
                                }
                            
                            ?>
                                </tbody>
                            </table>
                        </div>
                        
                    <button class="printBtn" onclick="printContent('printp1');">Print</button>
                        
                    </div>
                    
                    <div id="addMovie" class="addMovie">
                        <?php 
                            if(isset($_POST["addMovieBtn"])){
                                
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
                                    $movieName = $_POST["movieName"];
                                    $time = $_POST["time"];
                                    $releaseYear = $_POST["releaseYear"];
                                    $genre = $_POST["genre"];
                                    $description = mysqli_real_escape_string($conn, $_POST["description"]);
                                    $image = addslashes(file_get_contents($_FILES['moviePoster']['tmp_name']));
                                    
                                    $sqlMovie = "INSERT INTO movie ( movieName, time, releaseYear, genre, description, image, avgRating) VALUES ('$movieName','$time','$releaseYear','$genre','$description','$image', '0') ";
                                    
                                    if (mysqli_query($conn, $sqlMovie)) {
                                        echo "<script> alert('Movie Added!');window.location = 'admin.php';</script>";
                                    }
                                    else {
                                        echo "Error: " . $sqlMovie . "<br>" . mysqli_error($conn);
                                    }
                                    
                                }
                                
                            }
                            else{
                        ?>
                        <form name="addMovieForm" class="addMovieForm" action="#" method="post" enctype="multipart/form-data">
                            <h3>Movie Name</h3>
                            <input type="text" name="movieName" placeholder="Eg. Malignant" required>
                            <br>
                            <h3>Movie Time</h3>
                            <input type="text" name="time" placeholder="Eg. 1h 40m" required>
                            <br>
                            <h3>Release Year</h3>
                            <input type="text" name="releaseYear" placeholder="Eg. 2021" required>
                            <br>
                            <h3>Genre</h3>
                            <input type="text" name="genre" placeholder="Eg. horror, action, thriller" required>
                            <br>
                            <h3>Description</h3>
                            <textarea name="description" rows="5" cols="50" placeholder="Malignant is a horror movie..." required></textarea>
                            <br>
                            <h3>Movie Image (Less than 500kb)</h3>
                            <input type="file" name="moviePoster" accept="image/*" required>
                            <br><br>
                            <input type="submit" class="addMovieBtn" name="addMovieBtn">
                        </form>
                        <?php 
                            }
                        ?>
                    </div>
                    
                    <div id="addPromotion" class="addPromotion" >
                        <?php 
                            if(isset($_POST["addPromotionBtn"])){
                                
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
                                    $promotionName = $_POST["promotion"];
                                    $promotionImage = addslashes(file_get_contents($_FILES['promotionImage']['tmp_name']));
                                    
                                    $sqlPromotion = "INSERT INTO promotion (promotion, image) VALUES ('$promotionName', '$promotionImage') ";
                                    
                                    if (mysqli_query($conn, $sqlPromotion)) {
                                        echo "<script> alert('Promotion Added!');window.location = 'admin.php';</script>";
                                    }
                                    else {
                                        echo "Error: " . $sqlPromotion . "<br>" . mysqli_error($conn);
                                    }
                                    
                                }
                                
                            }
                            else{
                        ?>
                        <form name="addPromotionForm" class="addPromotionForm" action="#" method="post" enctype="multipart/form-data">
                            <h3>Promotion</h3>
                            <input type="text" name="promotion" placeholder="Eg. promo1">
                            <br>
                            <h3>Promotion Poster (Less than 500kb)</h3>
                            <input type="file" name="promotionImage" accept="image/*" required>
                            <br><br>
                            <input type="submit" class="addPromotionBtn" name="addPromotionBtn">
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <div id="addNews" class="addNews">
                        <?php 
                            if(isset($_POST["addNewsBtn"])){
                                
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
                                    $newsName = $_POST["news"];
                                    $newsImage = addslashes(file_get_contents($_FILES['newsImage']['tmp_name']));
                                    
                                    $sqlNews = "INSERT INTO news (news, image) VALUES ('$newsName', '$newsImage') ";
                                    
                                    if (mysqli_query($conn, $sqlNews)) {
                                        echo "<script> alert('News Added!');window.location = 'admin.php';</script>";
                                    }
                                    else {
                                        echo "Error: " . $sqlNews . "<br>" . mysqli_error($conn);
                                    }
                                    
                                }
                                
                            }
                            else{
                        ?>
                        <form name="addNewsForm" class="addNewsForm" action="#" method="post" enctype="multipart/form-data">
                            <h3>News</h3>
                            <input type="text" name="news" placeholder="Eg. news1">
                            <br>
                            <h3>News Poster (Less than 500kb)</h3>
                            <input type="file" name="newsImage" accept="image/*" required>
                            <br><br>
                            <input type="submit" class="addNewsBtn" name="addNewsBtn">
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- Javascript -->
<?php require ('javascript.php'); ?>
</body>
</html>
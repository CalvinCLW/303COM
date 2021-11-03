<html>
    <head>
        <title>Confirmed Purchase</title>
    </head>
<body>
<!-- Header -->
<?php 
    require ('headerCheckout.php'); 
    //Include required phpmailer files
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';
    //Define name spaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
?>

<!-- Content -->
<div class="checkout">
    <div class="container-fluid firstrow">
        <div class="row">
            <div class="invoice">
                <?php
                    
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "fyp";
                    $con = mysqli_connect($servername, $username, $password, $dbname);
                    
                    
                    if(isset ($_POST['sendEmail'])){
                        if (!$con) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        else {

                            $select = mysqli_query($con, "SELECT * from ticket ORDER BY ticketID DESC LIMIT 1 ");

                            while($row = mysqli_fetch_assoc($select)){
                                        $getMovieName = $row['movieName'];
                                        $getUserName = $row['userName'];
                                        $getWatchDate = $row['watchDate'];
                                        $getWatchTime = $row['watchTime'];
                                        $getAdultSeat = $row['adultSeat'];
                                        $getChildrenSeat = $row['childrenSeat']; 
                                        $getTotalPrice = $row['totalPrice'];
                                        $paymentType = $_POST['payment'];
                                        $getUserEmail = $_SESSION['userEmail'];
                                                                    
                                        
                            }
                            if (mysqli_num_rows($select)==0){ 
                                    echo "<script> alert('Failed to send email please make sure your email is registered.');window.history.back(); </script>"; 
                                }

                            else {
                                //Create instance of phpmailer
                                    $mail = new PHPMailer();
                                    //set mailer to use smtp
                                    $mail -> isSMTP();
                                    //define smtp host
                                    $mail -> Host = "smtp.gmail.com";
                                    //enable smptp authentication
                                    $mail -> SMTPAuth= "true";
                                    //set type of encription(ssl/tls)
                                    $mail -> SMTPSecure = "tls";
                                    //set port to connect smptp
                                    $mail -> Port = "587";
                                    //set gmail username
                                    $mail -> Username = "fyp303com@gmail.com";
                                    //set gmail password
                                    $mail -> Password = "createforfyp_1";
                                    //set email subject
                                    $mail -> Subject = "FYP Ticket Purchased";
                                    //set sender email
                                    $mail -> setFrom("fyp303com@gmail.com");
                                    //enable html
                                    $mail -> isHTML(true);
                                    //email body
                                    $mail -> Body = "<h2>Hi $getUserName,</h2> 
                                                    <h2>Thank you for purchasing ticket from our website!</h2>
                                                    <h3>Here is the detail of your recent purchase,</h3>
                                                    <p>Movie Title: $getMovieName</p>
                                                    <p>Watch Date: $getWatchDate October</p>
                                                    <p>Watch Time: $getWatchTime p.m.</p>
                                                    <p>Adult Seat: $getAdultSeat</p>
                                                    <p>Children Seat: $getChildrenSeat</p>
                                                    <p>Total Price: RM $getTotalPrice</p>
                                                    <p>Payment Type: $paymentType</p>
                                                    <h3>Enjoy your movie!</h3>
                                                    ";
                                    //add recipent
                                    $mail -> addAddress($getUserEmail);
                                    //finally send email
                                    if ($mail->Send()){
                                        echo "<script> alert('Thank you for purchasing from us! \\nPlease check your email to get the detail of your purchase!'); window.location=\"homepage.php\";</script>";
                                    }
                                    else {
                                        echo "<script> alert('Failed to send email.');</script>";
                                    }
                                    //closing smtp
                                    $mail ->smtpClose();        
                            }
                        }
                        
                        
                    }
                
                    else{
                        
                        $res = mysqli_query($con,"SELECT * from ticket ORDER BY ticketID DESC LIMIT 1");
                        while($row = mysqli_fetch_assoc($res)){
                  
                        
                    ?>
                    <form id="invoice" action="#" method="post">
                        <h1><?php echo $row['movieName'];?></h1>
                        Watch Date: <?php echo $row['watchDate'];?> October
                        <br>
                        Watch Time: <?php echo $row['watchTime'];?> p.m.
                        <br>
                        Adult Seat: <?php echo $row['adultSeat'];?>
                        <br>
                        Children Seat: <?php echo $row['childrenSeat'];?>
                        <br>
                        Total Price: RM <?php echo $row['totalPrice'];?>
                        <br>
                        Payment Method:
                        <select name="payment">
                            <option value="Credit Card">Credit Card</option>
                            <option value="E-Wallet">E-Wallet</option>
                            <option value="Cash">Cash</option>
                        </select>
                        <br>
                        <button type="submit" name="sendEmail" class="sendEmail">Buy</button>
                    </form>

                <?php
                        }
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

    
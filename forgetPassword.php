<html>
<body>
<!-- Header -->
<?php require ('headerForgetPassword.php'); ?>

<!-- Content -->

<div id="forget-password" class="forget-password">
    <p>Forget Password</p>
    
<?php
    //Include required phpmailer files
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';
    //Define name spaces
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        if(isset($_POST["submit_email"])){

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
            else {

                $email = $_POST['loginEmail'];
                $select = mysqli_query($conn, "SELECT userName, userEmail, password FROM account WHERE userEmail='".$email."' ");

                while($row = mysqli_fetch_assoc($select)){
                            $getUserEmail = $row['userEmail'];
                            $getUserPassword = $row['password'];
                            $getUserName = $row['userName'];
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
                        $mail -> Subject = "FYP Password Retrieve";
                        //set sender email
                        $mail -> setFrom("fyp303com@gmail.com");
                        //enable html
                        $mail -> isHTML(true);
                        //email body
                        $mail -> Body = "<h2>Hi $getUserName,</h2> <h3 style=/'padding-left:25px;/'>this is your password <span style=\"color: red\">$getUserPassword</span> for this email $getUserEmail.</h3>";
                        //add recipent
                        $mail -> addAddress($getUserEmail);
                        //finally send email
                        if ($mail->Send()){
                            echo "<script> alert('Please check your email spam folder to retrieve your password!'); window.location=\"account.php\";</script>";
                        }
                        else {
                            echo "<script> alert('Failed to send email.'); window.location=\"forgetPassword.php\";</script>";
                        }
                        //closing smtp
                        $mail ->smtpClose();        
                }
            }
        }
        else {
        
?>

    <form id="forgetPassword" class="input-group-custom" action="#" method="post">
        <input type="email" name="loginEmail" class="input-field-custom" placeholder="E-mail" required>
        <br>
        <button type="submit" name="submit_email" class="submit-btn">Send</button>
        
    </form>
  

<?php } ?>
    
</div>    
<!-- End of Content -->

<!-- Javascript -->
<?php require ('javascript.php'); ?>
</body>
</html>


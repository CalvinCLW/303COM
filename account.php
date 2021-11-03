<?php session_start(); ?>
<html>
<head>
    <title>Login/Register</title>
</head>
<body>
<!-- Header -->
<?php require ('headerAccount.php'); ?>

<!-- Content -->

<div id="form-box" class="form-box">
    <div class="button-box">
        <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login()">Log In</button>
            <button type="button" class="toggle-btn" onclick="register()">Register</button>
        </div>

      <?php
        if(isset($_POST["login"])){
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
                        if($_POST['loginEmail']=="x@dmin" && $_POST['loginPassword']=="admin123"){
                            $_SESSION["admin"] = true; 
                            header("Location: admin.php");
                        }
                        
                        else if($_POST['loginEmail'] == "x@dmin" && $_POST['loginPassword'] != "admin123"){
                            echo "<script> alert('Please enter correct login info!'); window.history.back();</script>";
                        }
                        
                        else{
                            $useremail = strtolower($_POST['loginEmail']);
                            $password = $_POST['loginPassword'];
                            
                            $result1 = mysqli_query($conn, "SELECT * FROM account WHERE userEmail='".$useremail."' AND password='".$password."' ");
                            
                            while($row = mysqli_fetch_assoc($result1)){
                                $check_useremail = $row['userEmail'];
                                $check_password = $row['password'];
                                $getUserName = $row['userName'];
                                $getUserID = $row['userID'];
                                $getUserEmail = $row['userEmail'];
                            }
                            
                            
                            if ($useremail != $check_useremail){
                                echo"<script> alert('This email havent been register!'); window.history.back();</script>";
                            }
                            
                            else if ($password != $check_password){
                                echo"<script> alert('This password havent been register!'); window.history.back();</script>";
                            }
                            
                            else if($useremail == $check_useremail && $password == $check_password){
                                $_SESSION["logged_in"] = true; 
                                $_SESSION["userName"] = $getUserName; 
                                $_SESSION["userID"] = $getUserID;
                                $_SESSION["userEmail"] = $getUserEmail;
                                header("Location: homepage.php");
                            }
                            
                            else{
                                echo "<script> alert('Please enter correct login info!'); window.history.back();</script>";
                                
                            }
                             
                        }
                    }
                    mysqli_close($conn);
                }
                    
                else{
        ?>
    <form id="login" class="input-group-custom" action="#" method="post">
        <input type="email" name="loginEmail" class="input-field-custom" placeholder="E-mail" required>
        <br>
        <input type="password" id="loginPassword" name="loginPassword" class="input-field-custom" maxlength="25" placeholder="Password" required>
        <button type="button" id="loginShowPassword" onClick="togglePassword()">Show</button>
        <a href="forgetPassword.php">Forgot Password</a>
        <br>
        <button type="submit" name="login" class="submit-btn">Login</button>
        
    </form>
    <?php } ?> 
    
    <?php
        if(isset($_POST["register"])){
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
                        if($_POST['password'] != $_POST['repassword']){
                            
                            echo "<script> alert('Please enter same password for both fields!'); window.history.back();</script>";
                            
                        }
                            else {
                                $useremail = strtolower($_POST['email']);
                                $result1 = mysqli_query($conn, "SELECT userEmail FROM account WHERE userEmail='".$useremail."' ");
                            
                             while($row = mysqli_fetch_assoc($result1)){
                                 $check_useremail = $row['userEmail'];
                             }
                                if($useremail == $check_useremail){
                                    echo "<script> alert('Email has been used!');window.history.back(); </script>";
                                }
                            
                                else{
                                    $name = $_POST['name'];
                                    $email = strtolower($_POST['email']);
                                    $pnumber = $_POST['phonenumber'];
                                    $password = $_POST['password'];
                                    $type = "user";

                                    $sql = "INSERT INTO account (userName, phoneNumber, password, userEmail, userType) VALUES ('$name', '$pnumber', '$password', '$email', '$type')";

                                    if (mysqli_query($conn, $sql)) {

                                        echo "<script> alert('Thanks for joining us!');window.location= \"account.php\"; </script>";
                                    }
                                    else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                }
                        }
                    }
                    mysqli_close($conn);
                        }
                    
                     else{
                ?>
    
    <form id="register" class="input-group-custom" action="#" method="post">

        <input type="text" name="name" class="input-field-custom" maxlength="25" placeholder="Name" required>
        <br>
        <input type="email" name="email" class="input-field-custom" placeholder="Email" required>
        <br>
        <input type="password" id="password" name="password" class="input-field-custom" maxlength="25" placeholder="Password" required>
        <button type="button" id="RegisterShowPassword" onClick="togglePassword2()">Show</button>
        <br>
        <input type="password" id="repassword" name="repassword" class="input-field-custom" maxlength="25" placeholder="Retype password" required>
        <button type="button" id="RegisterShowPassword" onClick="togglePassword3()">Show</button>
        <br>
        <input type="number" name="phonenumber" class="input-field-custom" placeholder="Phone Number" required>
        <br>
        <input type="checkbox" class="check-box" required><span>By submitting this form, I agree to Cinema's Terms & Conditions and Privacy Policy. I hereby confirm that the information provided is accurate, ocmplete and up-to-date.</span>

        <button type="submit" name="register" class="submit-btn">Sign Up</button>
    </form>
    <?php } ?>
</div>






<!-- End of Content -->

<!-- Javascript -->
<?php require ('javascript.php'); ?>
</body>
</html>

<?php
   session_start();
   session_unset();
   echo "<script> alert('You have successfully log out!'); window.location=\"homepage.php\";</script>";
?>
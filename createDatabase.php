<?php 
if ($dbc = mysqli_connect('localhost', 'root', '')){
	print '<p>Successfully connected to MySQL!</p>';
	
	if(@mysqli_query($dbc, 'CREATE DATABASE FYP')){
        print '<p>The database has been created!</p>';
    }
    
	else{
		print'<p style="color: red;">Could not create the database because: <br/>' .mysqli_connect_error() . '.</p>';
	}
    
	mysqli_close($dbc);
	}
	
	else{
		print '<p style="color: red;">Could not connect to MySQL: '.mysqli_connect_error().'</p>';
	}
?>
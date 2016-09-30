<?php
// Hvis sessionen starter, tjekker den om "userSession" er udfyldt 
session_start();
// Opretter forbindelse til database
require_once 'dbcon.php';

if (isset($_SESSION['userSession'])) {
 // Virker sessionen ender man på home.php
 header("Location: home.php");
 exit;
}
// Hvis "button" bliver brugt, skal databasen tjekke om nedenstående er korrekt (email og password)
if (isset($_POST['btn-login'])) {
 $email = strip_tags($_POST['email']); // Her definerer jeg mine $navne
 $password = strip_tags($_POST['password']); // Her definerer jeg mine $navne
 
 $email = $link->real_escape_string($email); //Fortæller databasen hvad der skal hentes
 $password = $link->real_escape_string($password); //Fortæller databasen hvad der skal hentes
 
 // Stemmer ovenstående overens, skal databasen vælge matchende email 
 $query = $link->query("SELECT user_id, email, password FROM tbl_users WHERE email='$email'");
 $row=$query->fetch_array();
 
 
 // Hvis email og password er rigtigt, kører den userSession igennem fra linje 1
 $count = $query->num_rows; 

 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['user_id'];
  // Ender på startsiden 
  header("Location: home.php");
  exit();
 } else {
	 // Ellers kommer besked frem til brugeren
  echo 'Forkert E-mail eller Password !'. mysqli_error($link);
	}
 $link->close();
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Projekt 2 - Opgave 2 - Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head> 
<body>
<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Log ind</h2>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="E-mail" name="email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
        
        <div class="form-group">
            <input type=	"submit" class="submit" name="btn-login" value="Log Ind">
        </div>
        <br>
        <p>Eller</p>  
        <a href="create_user.php" class="opret_login">Opret bruger her</a>
        
      
      </form>

    </div>
    
</div>

</body>
</html>

<?php
// Hvis sessionen starter, tjekker den om "userSession" er udfyldt 
session_start();
if (isset($_SESSION['userSession'])) {
	// Virker sessionen ender man på home.php
 header("Location: home.php");
}
// Opretter forbindelse til database
require_once 'dbcon.php';
// Hvis "button" bliver brugt, skal nedenstående $_POST bruges
if(isset($_POST['btn-signup'])) {
 // Her definerer jeg mine $navne
 $uname = strip_tags($_POST['username']);
 $email = strip_tags($_POST['email']);
 $upass = strip_tags($_POST['password']);
 
 // Nedenstående fortæller databasen hvad der skal gemmes i tabellen og under hvilket navn
 $uname = $link->real_escape_string($uname);
 $email = $link->real_escape_string($email);
 $upass = $link->real_escape_string($upass);
 
 // Gør password hemmeligt (for mig) i databasen med lang kode
 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
 
 // Tjekker hvilket ID emailen har i databasen
 $check_email = $link->query("SELECT email FROM tbl_users WHERE email='$email'");
 $count=$check_email->num_rows;
 
 if ($count==0) {
  
  // Hvis den finder et ID, skal den indsætte nedenstående info i tabellen
  $query = "INSERT INTO tbl_users(username,email,password) VALUES('$uname','$email','$hashed_password')";

  // Besked til brugeren
  if ($link->query($query)) {
		echo 'Du er nu oprettet som bruger';
	}else{
		echo 'Der gik noget galt, tjek felterne'  . mysqli_error($link);
	}
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

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">Opret Bruger</h2>       
        
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Brugernavn" name="username" required  />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="E-mail" name="email" required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required  />
        </div>
    
        
        <div class="form-group">
           <input type="submit" class="submit" name="btn-signup" value="Opret Bruger">
        </div>
        <br>
        <p>Eller</p>
            <a href="login.php" class="opret_login">Log Ind Her</a>
            
      </form>

    </div>
    
</div>

</body>
</html>
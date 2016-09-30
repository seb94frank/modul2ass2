<!--Fortæller at denne side er aktiv-->
<?php $curpage = basename ($_SERVER['PHP_SELF']); ?>
<?php
// Hvis sessionen starter, tjekker den om "userSession" er udfyldt
session_start();
// Opretter forbindelse til database
include_once 'dbcon.php';

if (!isset($_SESSION['userSession'])) {
 header("Location: login.php");
}
// Fortæller databasen at man kun kan se denne side som "oprettet bruger"
$query = $link->query("SELECT * FROM tbl_users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$link->close();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Projekt 2 - Opgave 2 - Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head> 

<body>
<nav>

	<ul class="menu"> 
    	<li><a href="home.php"<?php if ($curpage=='home.php') { echo "class='active'"; }?>>Home</a></li>
		<li><a href="about.php"<?php if ($curpage=='about.php') { echo "class='active'"; }?>>About</a></li> 
		<li><a href="contact.php"<?php if ($curpage=='contact.php') { echo "class='active'"; }?>>Contact</a></li>
        
          <li><a href="logout.php"> Logout</a></li></div>
            </ul>
    </nav>
  </body>
  </html>
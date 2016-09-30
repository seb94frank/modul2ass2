<?php
// Hvis sessionen starter, kører den den nedenstående igennem
session_start();

// Slet al info fra sessionen
$_SESSION = array();

// Hvis brugeren logger ud og stopper sessionen, skal browseren også slettes cookies
// Dette vil stoppe sessionen og ikke kun dataen
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Sletter sessionen
session_destroy();
?>





<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Projekt 2 - Opgave 2 - Log ud</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head> 
<body>

<h1> Du er nu logget ud</h1>

<h2><a href="login.php">Log ind igen</a></h2>

</body>
</html>
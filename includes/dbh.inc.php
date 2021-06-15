<!-- database handler -->
<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "db";
$dBport = ";port=3306";
//connection de database
try {
    $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "ERROR SERVEUR: ".$e->getMessage()."\nAborting process\n";
}
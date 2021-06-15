<?php
require 'database.php';
// CREATE DATABASE
try {
    // Connect to Mysql server
    $pdo = new PDO('mysql:host=localhost', $dBUsername, $dBPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE `".$dBName."`";
    $pdo->exec($sql);
    echo "Database created successfully\n";
} 
catch (PDOException $e) {
    echo "ERROR CREATING DB:".$e->getMessage()."\n Aborting process\n";
    exit(-1);
}

// CREATE TABLE users
try {
    $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `users` (
        `idUsers` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `uidUsers` tinytext NOT NULL,
        `emailUsers` tinytext NOT NULL,
        `pwdUsers` longtext NOT NULL,
        `token` longtext NOT NULL,
        `getMail` tinyint(4) NULL
        )";
    $pdo->exec($sql);
    echo "Table users created successfully\n";
} 
catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

// CREATE TABLE userphotos
try {
    $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `userphotos` (
        `photoid` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `idUsers` text NOT NULL,
        `uidUsers` text NOT NULL,
        `photo` text NOT NULL,
        `dates` datetime DEFAULT NULL,
        `liked` int(11) DEFAULT 0
        )";
    $pdo->exec($sql);
    echo "Table userphotos created successfully\n";
} 
catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

// CREATE TABLE pwdReset
try {
    $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `pwdReset` (
        `pwdResetId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `pwdResetEmail` text NOT NULL,
        `pwdResetSelector` text NOT NULL,
        `pwdResetToken` longtext NOT NULL,
        `pwdResetExpires` text NOT NULL
        )";
    $pdo->exec($sql);
    echo "Table pwdreset created successfully\n";
} 
catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

// CREATE TABLE likes
try {
    $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);   
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `likes` (
        `idUsers` int(11) NOT NULL,
        `uidUsers` text NOT NULL,
        `photo` text NOT NULL,
        `liked` int(11) NOT NULL
        )";
    $pdo->exec($sql);
    echo "Table likes created successfully\n";
} 
catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

// CREATE TABLE comments
try {    
    $pdo = new PDO('mysql:host=' . $servername . ';dbname=' . $dBName, $dBUsername, $dBPassword);    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `comments` (
        `photoNo` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `idUsers` text NOT NULL,
        `uidUsers` text NOT NULL,
        `photo` text NOT NULL,
        `dates` datetime DEFAULT current_timestamp(),
        `comment` text DEFAULT NULL,
        `like` int(11) DEFAULT NULL
      )";
    $pdo->exec($sql);
    echo "Table comments created successfully\n";
    header('Location: ../login.php');
} 
catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}
?>
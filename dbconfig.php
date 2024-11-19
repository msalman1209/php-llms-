<?php
$servername = "localhost";
$username = "tsfaeaea_skyado_user";
$password = "QLhrgW8e4d96wjA";
$db = "tsfaeaea_tsf";

// $sqlicon = mysqli_connect($servername, $username, $password, $db);
$conn = new mysqli($servername, $username, $password, $db);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
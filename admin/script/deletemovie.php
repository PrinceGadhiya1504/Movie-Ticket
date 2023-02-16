<?php
// require('../connect.php');

$id = $_GET['delete'];

$pdo = new PDO("mysql:host=localhost;dbname=MoviesDb", "root", "");

$stmt = $pdo->prepare("DELETE FROM movies WHERE Id=?");
$stmt->execute(array($id));

header("Location: ../updatemovies.php");

?>

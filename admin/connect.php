<?php
// session_start();
// $connection = mysqli_connect('localhost', 'root', '', 'moviesdb');
// $query = "SELECT * FROM `Movies`";
// $result = $connection->query($query);
// $rows = $result->fetch_all(MYSQLI_NUM);

$pdo = new PDO("mysql:host=localhost;dbname=MoviesDb","root","");


?>
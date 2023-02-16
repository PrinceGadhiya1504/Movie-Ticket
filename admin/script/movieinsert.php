<?php

// include("../connect.php");

$name = $_POST['moviename'];
$description = $_POST['description'];
$relesedate = $_POST['relesedate'];
$language = $_POST['language'];
$ticketprice = $_POST['ticketprice'];
$image = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . "/movieticket/admin/images/$image");


$pdo = new PDO("mysql:host=localhost;dbname=MoviesDb","root","");
$statement = $pdo->prepare("INSERT INTO movies(Name,Description,ReleaseDate,Language,TicketPrice,ImageName) VALUES(?,?,?,?,?,?)");
$statement->execute(array($name, $description, $relesedate, $language, $ticketprice,$image));

header("Location: ../movie.php");


?>

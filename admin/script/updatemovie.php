<?php 

// include('../connect.php');

$id = $_POST['id'];
$name = $_POST['moviename'];
$description = $_POST['description'];
$relesedate = $_POST['relesedate'];
$language = $_POST['language'];
$ticketprice = $_POST['ticketprice'];
$image = $_POST['image'];

$pdo = new PDO("mysql:host=localhost;dbname=MoviesDb","root","");

$statement = $pdo->prepare("UPDATE movies SET Name = ?, Description = ?, ReleaseDate = ?, Language = ?, TicketPrice = ?, ImageName = ? WHERE Id = ?");
$statement->execute(array($name,$description,$relesedate,$language,$ticketprice,$image,$id));

echo "$id<br>";
echo "$image";

?>
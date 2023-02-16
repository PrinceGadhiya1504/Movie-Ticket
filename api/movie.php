<?php

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(405);
    exit();
}

try {
    $requestString = file_get_contents("php://input");
    $request = json_decode($requestString);

    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

    $statement = $connection->prepare("SELECT * From `Movies`");
    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    $json  = json_encode($result);
    echo $json;

} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

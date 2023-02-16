<?php

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(405);
    exit();
}

try {
    $array = array();
    $requestString = file_get_contents("php://input");
    $request = json_decode($requestString);

    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

    $statement = $connection->prepare("SELECT * From `showtimes`");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $showtime)
    {
        $movieid = $showtime['MovieId'];
        $statementMovie = $connection->prepare("SELECT * From `Movies` WHERE `Id` = ?");
        $statementMovie->execute([$movieid]);
        $movie = $statementMovie->fetch();
        $movieName = $movie['Name'];
        $movieDesc = $movie['Description'];
        $description = $statementMovie->fetch();

        $temp = [
            "Id" => $showtime['Id'],
            "MovieName" => $movieName,
            "Description" => $movieDesc,
            "Date" => $showtime['Date'],
            "Time" => $showtime['Time']
        ];
        array_push($array, $temp);
    }

    $json  = json_encode($array);
    echo $json;

} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

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

    $statement = $connection->prepare("SELECT * From `Bookings`");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $booking)
    {
        $userid = $booking['UserId'];
        $statementuser = $connection->prepare("SELECT * From `Users` WHERE `Id` = ?");
        $statementuser->execute([$userid]);
        $user = $statementuser->fetch();
        $username = $user['FullName'];

        $ShowTimeId = $booking['ShowTimeId'];
        $statementshowtime = $connection->prepare("SELECT * From `showtimes` WHERE `Id` = ?");
        $statementshowtime->execute([$ShowTimeId]);
        $showtime = $statementshowtime->fetch();
        $date = $showtime['Date'];
        $time = $showtime['Time'];

        $temp = [
            "Id" => $booking['Id'],
            "IsPaid" => $booking['IsPaid'],
            "Username" => $username,
            "ShowDate" => $showtime['Date'],
            "ShowTime" => $showtime['Time']
        ];
        array_push($array, $temp);
    }

    $json  = json_encode($array);
    echo $json;

} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

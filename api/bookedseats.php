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

    foreach($result as $bookedseats)
    {
        $bookingid = $bookedseats['BookingId'];
        $statementbooking = $connection->prepare("SELECT * From `Bookings` WHERE `Id` = ?");
        $statementbooking->execute([$bookingid]);
        $booking = $statementbooking->fetch();
        $bookingid = $booking['Id'];

        $temp = [
            "Id" => $bookedseats['Id'],
            "bookingid" => $bookingid,
            "Seats" => $bookedseats['seats'],
        ];
        array_push($array, $temp);
    }

    $json  = json_encode($array);
    echo $json;

} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

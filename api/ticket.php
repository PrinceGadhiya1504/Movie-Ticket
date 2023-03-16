<?php


if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    http_response_code(405);
    exit();
}

try {
    $array = array();
    $requestString = file_get_contents("php://input");
    $request = json_decode($requestString);
    $id = $_GET['id'];
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

    $statement = $connection->prepare("SELECT * From `Bookings` WHERE `Id` = ?");
    $statement->execute([$id]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach($result as $booking)
    {
        $userid = $booking['UserId'];
        $statementuser = $connection->prepare("SELECT * From `Users` WHERE `Id` = ?");
        $statementuser->execute([$userid]);
        $user = $statementuser->fetch();
        $username = $user['FullName'];

        $seats = $booking['Id'];
        $statementseats = $connection->prepare("SELECT COUNT(`Seats`) AS `NumberOfSeats` FROM `BookedSeats` WHERE `BookingId` = ?");
        $statementseats->execute([$seats]);
        $seat = $statementseats->fetch();

        $moviename = $booking['MovieId'];
        $statementseats = $connection->prepare("SELECT `Name`,`ImageName`,`TicketPrice` From `Movies` WHERE `Id` = ?");
        $statementseats->execute([$moviename]);
        $name = $statementseats->fetch();
        $Name = $name['Name'];


        $temp = [
            "Id" => $booking['Id'],
            "IsPaid" => $booking['IsPaid'],
            "UserId" => $username,
            "MovieName" => $Name,
            "ImageName" => $name['ImageName'],
            "TicketPrice" => $name['TicketPrice'],
            "ShowDate" => $booking['ShowDate'],
            "Time" => $booking['ShowTime'],
            "Total" => $booking['TotalPrice'],
            "TotalSeats" => $seat['NumberOfSeats']
        ];
        array_push($array, $temp);
    }

    $json  = json_encode($array);
    echo $json;

} catch (Exception $ex) {
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

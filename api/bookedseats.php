<?php

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        if (isset($_GET["time"]) && isset($_GET["date"]))
            getBookegSeatsByTimeAndDate($_GET["time"], isset($_GET["date"]));
        else
            getAllBookedSeats();
        break;
    case "POST":
        BookSeats();
        break;
    default:
        http_response_code(405);
        break;
}


function getAllBookedSeats()
{
    try {
        $array = array();

        $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

        $statement = $connection->prepare("SELECT * From `Bookings`");
        $statement->execute();
        $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($bookings as $booking) {
            $bookingid = $booking['Id'];
            $statementseat = $connection->prepare("SELECT * From `BookedSeats` WHERE `BookingId` = ?");
            $statementseat->execute([$bookingid]);
            $sests = $statementseat->fetch();

            $temp = [
                "Id" => $sests['Id'],
                "seatNumber" => $sests['Seats'],
            ];

            array_push($array, $temp);
        }

        $json  = json_encode($array);
        echo $json;
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode(["reason" => $ex->getMessage()]);
    }
}

function getBookegSeatsByTimeAndDate($time, $date)
{
    try {
        $array = array();
        $requestString = file_get_contents("php://input");
        $request = json_decode($requestString);

        $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

        $statement = $connection->prepare("SELECT * From `Bookings` WHERE `ShowTime` = ? AND `ShowDate` = ?");
        $statement->execute([$time, $date]);
        $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($bookings as $booking) {
            $bookingid = $booking['Id'];
            $statementseat = $connection->prepare("SELECT * From `BookedSeats` WHERE `BookingId` = ?");
            $statementseat->execute([$bookingid]);
            $sests = $statementseat->fetchAll(PDO::FETCH_ASSOC);

            foreach ($sests as $seat){
                $temp = [
                    "Id" => $seat['Id'],
                    "seatNumber" => $seat['Seats'],
                ];
                array_push($array, $temp);
            }
        }

        $json  = json_encode($array);
        echo $json;
    } catch (Exception $ex) {
        http_response_code(500);
        echo json_encode(["reason" => $ex->getMessage()]);
    }
}


function BookSeats()
{
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");
    $requestData = file_get_contents("php://input");
    $request = json_decode($requestData);

    $userId = $request->UserId;
    $movieid = $request->MovieName;
    $bookingDateTime = $request->BookingDate;
    $showDate = $request->ShowDate;
    $showTime = $request->Time;
    $seats = $request->SeatNo; 


    $statementPrice = $connection->prepare("SELECT `TicketPrice` FROM `Movies` WHERE `Id` = ?");
    $statementPrice->execute([$movieid]);
    $price = $statementPrice->fetch();
    $ticketPrice = $price['TicketPrice'];
    $totaPrice = $ticketPrice * count($seats);

    $statementBooking = $connection->prepare("INSERT INTO `Bookings` (`UserId`,`MovieId`,`BookingDateTime`,`ShowDate`,`ShowTime`,`TotalPrice`) VALUES(?,?,?,?,?,?)");
    $statementBooking->execute([$userId, $movieid, $bookingDateTime, $showDate, $showTime, $totaPrice]);

    $bookingId = $connection->lastInsertId();
    
    foreach ($seats as $seat) {
        $statementseat = $connection->prepare("INSERT INTO `BookedSeats` (`BookingId`,`Seats`) VALUES(?,?)");
        $statementseat->execute([$bookingId, $seat]);
    }
}

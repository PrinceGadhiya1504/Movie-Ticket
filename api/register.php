<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    http_response_code(405);
    exit();
}

try
{
    $requestString = file_get_contents("php://input");
    $request = json_decode($requestString);
    
    if (!isset($request->Username) || !isset($request->Password))
    {
        http_response_code(400);
        exit();
    }

    $FullName = $request->FullName;
    $MobileNumber = $request->MobileNumber;
    $Username = $request->Username;
    $Password = $request->Password;
    $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);
    
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

    $statement = $connection->prepare("SELECT COUNT(*) AS `ExistingUserCount` FROM `Users` WHERE `Username` = ?");
    $statement->execute([$Username]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result['ExistingUserCount'] > 0)
    {
        http_response_code(409);
        die(json_encode(["message" => "User already exists!"]));
    }
    
    $statement = $connection->prepare("INSERT INTO `Users` SET `FullName` = ?, `MobileNumber` = ?, `Username` = ?, `PasswordHash` = ?");
    $statement->execute([$FullName, $MobileNumber, $Username, $PasswordHash]);
    
    http_response_code(201);
}
catch (Exception $ex)
{
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

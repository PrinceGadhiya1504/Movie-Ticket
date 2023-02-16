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

    $username = $request->Username;
    $password = $request->Password;
    
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

    $statement = $connection->prepare("SELECT `Id`, `Username`, `PasswordHash` FROM `Users` WHERE `Username` = ? ");
    $statement->execute([$username]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result == null)
    {
        http_response_code(404);
        die(json_encode(["message" => "Wrong email or password!"]));
    }

    if (!password_verify($password, $result['PasswordHash']))
    {
        http_response_code(404);
        die(json_encode(["message" => "Wrong email or password!"]));
    }

    echo json_encode(["id" => $result['Id'], "username" => $result['Username'], "Password" => $result['PasswordHash']]);
}
catch (Exception $ex)
{
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

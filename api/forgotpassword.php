<?php

if ($_SERVER['REQUEST_METHOD'] !== 'PUT')
{
    http_response_code(405);
    exit();
}

try
{
    $requestString = file_get_contents("php://input");
    $request = json_decode($requestString);
    
    if (!isset($request->Password))
    {
        http_response_code(400);
        exit();
    }

    $Id = $request->Id;
    $Password = $request->Password;
    $PasswordHash = password_hash($Password, PASSWORD_DEFAULT);
    
    $connection = new PDO("mysql:host=localhost;port=3306;dbname=MoviesDb", "root", "");

    $statement = $connection->prepare("UPDATE `Users` SET `PasswordHash` = ? WHERE Id = ?");
    $statement->execute([$PasswordHash,$Id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    
    http_response_code(201);
}
catch (Exception $ex)
{
    http_response_code(500);
    echo json_encode(["reason" => $ex->getMessage()]);
}

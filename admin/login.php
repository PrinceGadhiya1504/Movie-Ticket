<?php

// session_start();

session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ./index.php");
}

try {
  $pdo = new PDO("mysql:host=localhost;dbname=movieticketdb", "root", "");
  if (isset($_POST["login_button"])) {
    if ($_POST["username"] == "" or $_POST["password"] == "") {

      echo ("<script LANGUAGE='JavaScript'>
              window.alert('Username and Password can not be empty.');
              window.location.href='./index.php';
              </script>");
    } else {

      $username = $_POST["username"];
      $password = $_POST["password"];
      $query = $pdo->prepare("SELECT * FROM users WHERE Username=?");
      $query->execute(array($username));
      $control = $query->fetch();
      $id = $control['id'];
      if (password_verify($password, $control["PasswordHash"])) {
        $_SESSION["admin"] = "admin";
        header("Location:./dashboard.php");
      }
      echo ("<script LANGUAGE='JavaScript'>
        window.alert('Username and Password is wrong.');
        window.location.href='./index.php';
        </script>");
    }
  }
} catch (PDOException $e) {
  echo $e;
}

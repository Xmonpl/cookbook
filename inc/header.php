<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xmon.cf - CookBook 🥘</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7df0717af8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" />
</head>
<?php
session_start();
$logged = isset($_SESSION['email']);
if(@$_GET['logout']){
    session_destroy();
    session_unset();
    header('Location: index.php'); 
}
?>
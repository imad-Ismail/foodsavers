<?php
require_once("db-connection.php");
session_start();
$user_id = $_SESSION["user_id"];
$message_id = $_GET["id"];

$removeSql = "DELETE FROM messages WHERE message_id = '$message_id' AND (to_user_id = '$user_id' OR from_user_id = '$user_id')";
$removeRun = $conn->prepare($removeSql);
$removeRun->execute();
header("location:messages.php");
?>
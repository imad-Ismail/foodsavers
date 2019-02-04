<?php
session_start();
require_once "db-connection.php";
$pid= $_POST['pid']; // user id die je een rating wilt geven.
$user= $_SESSION['user_id']; // user_session
$action=$_POST['action'];
if ($action=='like'){
 $sql=$conn->prepare("SELECT * FROM fdlikes WHERE pid=? and user=?");
 $sql->execute(array($pid,$user));
 $matches=$sql->rowCount();
 if($matches==0){
 $sql=$conn->prepare("INSERT INTO fdlikes (pid, user) VALUES(?, ?)");
 $sql->execute(array($pid,$user));
 $sql=$conn->prepare("UPDATE users SET likes=likes+1 WHERE user_id=?");
 $sql->execute(array($pid));
 }else{
 die("There is No Post With That ID");
 }
}
if ($action=='unlike'){
 $sql = $conn->prepare("SELECT 1 FROM fdlikes WHERE pid=? and user=?");
 $sql->execute(array($pid,$user));
 $matches = $sql->rowCount();
 if ($matches != 0){
 $sql=$conn->prepare("DELETE FROM fdlikes WHERE pid=? AND user=?");
 $sql->execute(array($pid,$user));
 $sql=$conn->prepare("UPDATE users SET likes=likes-1 WHERE user_id=?");
 $sql->execute(array($pid));
 }
}
?>
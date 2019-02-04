<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php 

require_once("db-connection.php");
$token = $_GET["token"];
$sql = "SELECT * FROM ps_forgot WHERE token = '$token'";
$d = $conn->prepare($sql);
$d->execute();
$count = $d->rowCount();

$data = $d->fetch();
if($count > 0){
    $timestamp = $data["timestamp"];
    $timestamp2 = date("H:i:s", strtotime($timestamp));

    
    echo "<br/>" . $timestamp2;
    $currentTime = date("H:i:s");
    echo "<br/>" . $currentTime;
    $time = strtotime($timestamp2);

    $curtime = time();
    
    if(($curtime-$time) > 3600) {     //1800 seconds
        $deleteSql = "DELETE FROM ps_forgot WHERE token = '$token'";
        $conn->query($deleteSql);
        echo "token expired";
    } else {
        ?>
        <form action="" method="post">
            <input type="password"  name="password"/>
            <input type="password"  name="confirmPassword"/>
            <input type="submit" name="changepassword" value="verander"/>
        </form>
        <?php
    }
} else{
    echo "invalid token";
}

if(isset($_POST["changepassword"])){
    if($_POST["password"] == $_POST["confirmPassword"]){


    $userid = $data["user_id"];
    $password = $_POST["password"];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $updateSql = "UPDATE users SET password = '$hash' WHERE user_id = '$userid'";
    $result = $conn->query($updateSql);
    if($result){
        $deleteSql = "DELETE FROM ps_forgot WHERE token = '$token'";
        $conn->query($deleteSql);
    } else {
        echo "wrong";
    }
    } else{
        echo "wachtwoorden komen niet overheen";
    }
}
?>
</body>
</html>
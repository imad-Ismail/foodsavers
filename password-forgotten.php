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
$showError = false;
if(isset($_POST["send"])){
    if($_POST["email"] !== null AND $_POST["email"] != ""){
    $email = $_POST["email"];
    $token = bin2hex(random_bytes(20));
    echo $token;

    $sql = "SELECT email, user_id FROM users WHERE email = '$email'";
    $d = $conn->prepare($sql);
    $d->execute();
    $count = $d->rowCount();
    $dateStamp = date("Y-m-d H:i:s");

    $data = $d->fetch();
    $user_id = $data["user_id"];


    if($count > 0){
        $insert = "INSERT INTO ps_forgot (user_id, token, timestamp, email) VALUES ('$user_id', '$token', '$dateStamp', '$email')";
        $conn->query($insert);

        $email_to = "a.vanmierlo@ziggo.nl";
        $email_subject = "Wachtwoord vergeten";
        
        $email_message .= "Geachte heer / mevrouw,\n\n";
        $email_message .= "U heeft een aangegeven dat u, uw wachtwoord bent vergeten via onderstaande link kunt u deze wijzigen.\n";
        $email_message .= "<a href='http://localhost/codegorilla/Projects/FoodSaver/create-new-password.php?token=" . $token ."\n\n";
        $email_message .= "Mocht u uw wachtwoord niet vergeten zijn kunt u deze mail negeren.\n\n";
        $email_message .= "Met vriendelijke groet\n";
        $email_message .= "Foodsaver";
     
        // create email headers
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        @mail($email_to, $email_subject, $email_message, $headers);  
    }

    } else {
        $showError = true;
        $message = "Vul een email in!";
    }
} else{
    echo "no";
}
?>
<form action="" method="post">
    <section class="form-group">
        <?php
        if($showError){
            echo $message;
        }
        ?>
        <label for="input">Email</label>
        <input type="email" name="email" />
    </section>
    <input type="submit" name="send" value="opvragen">
</form>
</body>
</html>
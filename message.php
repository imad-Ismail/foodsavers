<?php
session_start();
require_once("db-connection.php");
if(!isset($_SESSION["user_id"])){
    echo "log in om deze functie te gebruiken.";
    die();
}

if(isset($_GET["screenname"])){
    
    $getScreenname = trim(str_replace('"', "", str_replace("'", "", $_GET["screenname"])));
    $newMessageGetTo = "SELECT user_id, screenname FROM users WHERE screenname = '$getScreenname'";
    $newMessageGetToD = $conn->prepare($newMessageGetTo);
    $newMessageGetToD->execute();
    $newMessageGetToDCount = $newMessageGetToD->rowCount();

    if($_SESSION["screenname"] == $getScreenname){
        echo "Beetje eenzaam?";
        die();
    }
  
    if($newMessageGetToDCount > 0){
        $newMessageGetToData = $newMessageGetToD->fetch();
        $tud = $newMessageGetToData["user_id"];
        $myID = $_SESSION["user_id"];
        $checkIfSessionExistsSql = "SELECT message_id FROM messages WHERE (to_user_id = '$tud' AND from_user_id = '$myID') OR (from_user_id='$tud' AND to_user_id='$myID')";
        $checkIfSessionExistsD = $conn->prepare($checkIfSessionExistsSql);
        $checkIfSessionExistsD->execute();
        $checkIfSessionExistsDCount = $checkIfSessionExistsD->rowCount();
        if($checkIfSessionExistsDCount > 0){
            $checkIfSessionExistsDData = $checkIfSessionExistsD->fetch();
            $destinationUrl = "message.php?id=" . $checkIfSessionExistsDData["message_id"];
            header("Location: $destinationUrl");
            die();
        } else{
            $myID = $_SESSION["user_id"];
            $createNewSession = "INSERT INTO messages (from_user_id, to_user_id) VALUES ($myID, $tud)";
            $createNewSessionD = $conn->prepare($createNewSession);            
            $createNewSessionD->execute();
            
            $destinationUrl = "message.php?id=" . $conn->lastInsertId();
            header("Location: $destinationUrl");
        }
        echo "user found";
    } else{
        echo "user not found";
    }

    die();
}

if(!isset($_GET["id"])){
    echo "bericht niet gevonden!";
    die();
}


$msgID = str_replace('"', "", str_replace("'", "", $_GET["id"]));

$user_id = $_SESSION["user_id"];
$getMessageSql = "SELECT * FROM messages WHERE (message_id = '$msgID') AND (from_user_id = $user_id OR to_user_id = $user_id)";
$connection = $conn->prepare($getMessageSql);
$connection->execute();
$count = $connection->rowCount();

if($count > 0){
$data = $connection->fetch();

$fromUserId = $data["from_user_id"];
$toUserId = $data["to_user_id"];

$selectFromUser = "SELECT screenname FROM users WHERE user_id = $fromUserId";
$selectFromUser = $conn->prepare($selectFromUser);
$selectFromUser->execute();
$fromUserData = $selectFromUser->fetch();

$selectToUser = "SELECT screenname FROM users WHERE user_id = $toUserId";
$selectToUser = $conn->prepare($selectToUser);
$selectToUser->execute();
$toUserData = $selectToUser->fetch();

if($data["messages"] !== ""){
    $messages = explode("~", $data["messages"]);
}

$messagePosition = array();

$getTimeMessages = explode("~", $data["datetime"]);

if($data["from_user_id"] == $_SESSION["user_id"]){
    $mUID = "1";
    $fromScreenname = $fromUserData["screenname"];
    $toScreenname = $toUserData["screenname"];
}

if($data["to_user_id"] == $_SESSION["user_id"]){
    $mUID = "2";
    $fromScreenname = $toUserData["screenname"];
    $toScreenname = $fromUserData["screenname"];
}

if(isset($messages)){
foreach($messages as $message){
    // echo intval($message) . "<br/>";
    if($data["from_user_id"] == $_SESSION["user_id"]){
        $filteredNumbers = array_filter(preg_split("/\D+/", $message));
        $firstOccurence = reset($filteredNumbers);
        array_push($messagePosition, $firstOccurence);
        // array_push($messagePosition, intval($message));
    } else{
        if(intval($message) == 1){
            array_push($messagePosition, 2);
        }

        if(intval($message) == 2){
            array_push($messagePosition, 1);
        }
    }
}

for($i = 0; $i < count($messages); $i++){
    $messages[$i] = substr($messages[$i], 1);
}
}
if(isset($_POST["send"])){
    $newMessage = htmlspecialchars($_POST["message-to-send"]);
    $newMessage = str_replace("~", '', $newMessage);
    $newMessage = str_replace("'", '', $newMessage);
    
    if(isset($messages)){
        $newMessage = "~" . $mUID . $newMessage;
        $dateTime = "~" . date("d-m-Y H:i:s");
    } else{
        $newMessage = $mUID . $newMessage;
        $dateTime = date("d-m-Y H:i:s");
    }
    

    $messageId = $data["message_id"];
    $latestTime =  date("Y-m-d H:i:s");
    if($data["from_user_id"] == $_SESSION["user_id"]){
        $user = "from";
    } else {
        $user = "to";
    }
    echo $dateTime;
    // $dateTime = "~" . $dateTime;
    $messageUpdateSql = "UPDATE messages SET messages = concat(messages,'$newMessage'), datetime = concat(datetime, '$dateTime'), last_message = '$latestTime', " . (($user == 'from') ? 'from_last_visited' : 'to_last_visited') . " = '$latestTime' WHERE message_id = $messageId";
    $conn->query($messageUpdateSql);
    $destinationUrl = "Refresh: 0; url=message.php?id=" . $msgID;
    header($destinationUrl);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/chat.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>
<body>
    
<div class="chat">
      <div class="chat-header clearfix">
       
        
        <div class="chat-about" style="width: 100%; display: flex; justify-content: center;">
          <div class="chat-with" style="width: 94%;display:flex; justify-content: space-between;"><span>Communiceren met <?php echo $toScreenname; ?></span><span id="js-chatoptions">Opties</span></div>
        </div>
        <i class="fa fa-star"></i>
      </div> <!-- end chat-header -->
      <section id="optionoverlay">
        <ul>
            <li id="js-chat-delete">Verwijderen</li>
        </ul>
      </section>
      <div class="chat-history">
        <ul >
        <?php
          if(isset($messages)){
          for($i = 0; $i < count($messages); $i++){
            $output = '<li class="clearfix">';

            $output .= '<div class="message-data ' . (($messagePosition[$i] == 2) ? 'align-right">' :'">');
            $output .= '<span class="message-data-name">' . (($messagePosition[$i] == 2) ? $toScreenname : $fromScreenname) . "</span>";
            if(date('d-m-Y') == date('d-m-Y', strtotime($getTimeMessages[$i]))){
                $output .= '<span class="message-data-time">vandaag ' . date('H:i', strtotime($getTimeMessages[$i])) . '</span>';
            } else{
                $output .= '<span class="message-data-time">' . $getTimeMessages[$i] . '</span>';
            }
            $output .= '</div>';
            $output .= '<div class="message ' . (($messagePosition[$i] == 2) ? 'other-message float-right">' :'my-message">');
            // $output .= '<div class="message my-message">';
            $output .= $messages[$i];
            $output .= '</div>';
            $output .= '</li>';
            echo $output;
          }
        }
?>   
        </ul>
        
      </div> <!-- end chat-history -->
      
      <div class="chat-message clearfix">
        <form method="post" action="">
        <textarea name="message-to-send" id="message-to-send" placeholder ="Schrijf een bericht" rows="3"></textarea>
        <input type="submit" name="send" value="verstuur"/>
        </form>
      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
  </div> <!-- end container -->
  <script>
        $(window).ready(function(){
            $(".chat-history").scrollTop($(".chat-history ul").height());
        });
        
        window.scrollTo(0, 200);

        $("#js-chatoptions").on("click", function(){
            if($("#optionoverlay").css("display") == "block"){
                $("#optionoverlay").css("display", "none");
            } else{
                $("#optionoverlay").css("display", "block");
            }
        });

        $("#js-chat-delete").on("click", function(){
            if(confirm("Weet je zeker dat je deze chat wilt verwijderen?")){
                window.location.href = "delete-message.php?id=" + <?php echo $_GET["id"];?>;
            }
        })


    </script>
    <?php
    } else{
        echo "bericht niet gevonden";
    }
    ?>
</body>
</html>
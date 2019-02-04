<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/messages.css">
    <style>
        body{
            margin:0;
            padding:0;
        }

        #messages-header{
            background: #EF8829;
            width: 100%;
            height: 75px;
        }

        .contact-item{
            display: flex;
            justify-content: space-between;
            /* align-items: center; */
            padding: 15px;
            border-bottom: 1px solid grey;
        }
        a{
            text-decoration: none;
        }
        .a:nth-child(odd){
            background-color: rgb(253, 245, 245);
        }

        .contact-extra-info{
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
        }
        .contact-info-text{
            display: flex;
            flex-direction: column;
            /* justify-content: space-around; */
            margin-left: 15px;
        }

        .contact-info{
            display: flex;
        }


        .contact-user-name{
            font-weight: bold;
            text-transform: uppercase;
        }

        .contact-latest-message{
            font-style: italic;
        }

        .latest-message-time{
            color: #EF8829;
        }

        .new-messages-to-read{
            background-color: #EF8829;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
        }

        .align-top{
            align-self: flex-start;
        }
    </style>
</head>
<body>
    <div id="messages-wrapper">
        <div id="messages-header">
        </div>
        <?php
        session_start();
        require_once("db-connection.php");
        $userid = $_SESSION["user_id"];
            $selectSql = "SELECT * FROM messages WHERE from_user_id = '$userid' OR to_user_id = '$userid'";
            $data = $conn->query($selectSql);
            foreach($data as $value){
                if($value["from_user_id"] == $_SESSION["user_id"]){
                    if($value["from_last_visited"] < $value["last_message"]){
                        $timeData = explode("~", $value["datetime"]);
                        $lastMessageTime = new DateTime($value["from_last_visited"]);
                        $lastMessageTime = date_format($lastMessageTime, "d-m-Y H:i:s");
                        $lastMessagePostion =  array_search($lastMessageTime, $timeData) . "<br/>";
                        $totalData = count($timeData) - 1;
                        $totalSum = (int)$totalData - (int)$lastMessagePostion;
                        $newMessages = $totalSum;
                    } else{
                        $newMessages = 0;
                    }
                    $toUserId = $value["to_user_id"];
                    $selectScreenname = "SELECT screenname FROM users WHERE user_id = $toUserId";


                } else{
                    if($value["to_last_visited"] < $value["last_message"]){
                        $timeData = explode("~", $value["datetime"]);
                        $lastMessageTime = new DateTime($value["to_last_visited"]);
                        $lastMessageTime = date_format($lastMessageTime, "d-m-Y H:i:s");
                        $lastMessagePostion =  array_search($lastMessageTime, $timeData) . "<br/>";
                        $totalData = count($timeData) - 1;
                        $totalSum = (int)$totalData - (int)$lastMessagePostion;
                        $newMessages = $totalSum;
                    } else{
                        $newMessages = 0;
                    }

                    $fromUserId = $value["from_user_id"];
                    $selectScreenname = "SELECT screenname FROM users WHERE user_id = $fromUserId";
                }
                
                $scD = $conn->prepare($selectScreenname);
                $scD->execute();
                $scData = $scD->fetch();
                $contactName = $scData["screenname"];
                if($value["messages"] !== ""){
                    $messages = explode("~", $value["messages"]);
                    $lastMessage = substr(end($messages), 1);
                } else{
                    $lastMessage = "<b>Nog geen berichten</b>";
                }

                if(strtotime($value["last_message"]) != strtotime('0000-00-00 00:00:00')){
                    
                    if(date('d-m-Y') == date('d-m-Y', strtotime($value["last_message"]))){
                        $lastDate = date("H:i", strtotime($value["last_message"]));
                    } elseif(date("d-m-Y", strtotime('-1 day', strtotime(date("d-m-Y")))) == date("d-m-Y", strtotime($value["last_message"]))) {
                        $lastDate =  "Gisteren";
                    } else{
                        $lastDate = date("d-m", strtotime($value["last_message"]));
                        
                    }
                } else{
                    $lastDate = "";
                }

                
        ?>
        <a href="message.php?id=<?=$value['message_id'];?>">
        <div class="contact-item">
          <div class="contact-info">
            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                <div class="contact-info-text">
                    <span class="contact-user-name"><?=$contactName;?></span>
                    <span class="contact-latest-message"><?=$lastMessage;?></span>
                </div>
          </div>
          <div class="contact-extra-info">
            <span class="latest-message-time"><?=$lastDate;?></span>
            <?php
            if($newMessages !== 0){
                echo '<span class="new-messages-to-read">' . $newMessages . '</span>';
            }
            ?>
            
          </div>
        </div>
        </a>
        <?php
            }
        ?>
     </div>
</body>
</html>
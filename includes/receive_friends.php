<?php

$info = (object)[];
$receiver_id = $_SESSION['userid'];

$sql = "SELECT * FROM friends WHERE receiver_id = :receiver_id AND status = 'pending'";
$myfriends = $DB->read($sql, ['receiver_id' => $receiver_id]);

$mydata = '
<style>
    #request {
        position: relative;
        display: flex;
        align-items: center;
        gap: 15px;
        background-color:rgba(209, 207, 207, 0.78);
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        margin-bottom: 15px;
        transition: background-color 0.3s ease;
        margin: 1rem;
        cursor: pointer;
    }

    #request:hover {
        background-color: #f1f1f1;
    }

    #request img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    #request .username {
        flex-grow: 1;
        font-weight: 600;
        font-size: 1rem;
        color: #333;
    }

    #request button {
        padding: 6px 12px;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    #request .accept {
        background-color: #4CAF50;
        color: white;
    }

    #request .accept:hover {
        background-color: #45a049;
    }

    #request .decline {
        background-color: #f44336;
        color: white;
    }

    #request .decline:hover {
        background-color: #e53935;
    }
</style>
<div style="text-align: center;">';

if (is_array($myfriends) && count($myfriends) > 0) {

    $recepient_sql = "SELECT username FROM users WHERE userid = :receiver_id";
    $recepient = $DB->read($recepient_sql, ['receiver_id' => $receiver_id]);

    if (is_array($recepient))
    {
        $recepient = $recepient[0];
    }


    foreach ($myfriends as $friend) {

        $sender_sql = "SELECT username, image, gender FROM users WHERE userid = :sender_id";
        $sender = $DB->read($sender_sql, ['sender_id' => $friend->sender_id]);

        if (is_array($sender))
        {
            $sender = $sender[0];

            if (empty($sender->image) || !file_exists($sender->image)) {
                $sender->image = "ui/images/" . $sender->gender . ".jpg";
            }

        }


        $mydata .= "
            <div id='request' style='position: relative;' userid='$friend->sender_id'>
                    <img src='$sender->image'>
                    <div class='username'>Sender: $sender->username</div>
                    <button class='accept' onclick='accept_request(event)'>Accept ✅</button>
                    <button class='decline' onclick='decline_request(event)'>Decline ❌</button>
            </div>";
    }

    $mydata .= '</div>';

    $info->message = $mydata;
    $info->data_type = "friend_request";
    echo json_encode($info);
    die;

} else {
    $info->message = "No friend requests found.";
    $info->data_type = "friend_request";
    echo json_encode($info);
    die;
}

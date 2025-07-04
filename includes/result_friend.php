<?php

$sender = $DATA_OBJ->senderid;
$choice = $DATA_OBJ->do;
$recepient = $_SESSION['userid'];

if ($choice == "accept") {
    $accept_sql = "UPDATE friends SET status = 'accepted' WHERE sender_id = :sender AND receiver_id = :receiver";
    $result = $DB->write($accept_sql, [
        'sender' => $sender,
        'receiver' => $recepient
    ]);

    if ($result) {
        $info->message = "Friend request accepted.";
        $info->data_type = "friend_request_action";
        echo json_encode($info);
    } else {
        $info->message = "Failed to accept request.";
        $info->data_type = "error";
        echo json_encode($info);
    }
    die;
} else if ($choice == "decline")
{
    $accept_sql = "UPDATE friends SET status = 'rejected' WHERE sender_id = :sender AND receiver_id = :receiver";
    $result = $DB->write($accept_sql, [
        'sender' => $sender,
        'receiver' => $recepient
    ]);

    if ($result) {
        $info->message = "Friend request declined.";
        $info->data_type = "friend_request_action";
        echo json_encode($info);
    } else {
        $info->message = "Failed to accept request.";
        $info->data_type = "error";
        echo json_encode($info);
    }
    die;
} else {
    $info->message = "Invalid action.";
    $info->data_type = "error";
    echo json_encode($info);
    die;
}
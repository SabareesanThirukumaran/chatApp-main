<?php

// Make sure the friend userid is sent
if (!isset($DATA_OBJ->userid) || !is_numeric($DATA_OBJ->userid)) {
    $info->message = "Invalid user.";
    $info->data_type = "send_friend_result";
    echo json_encode($info);
    die;
}

$sender_id = $_SESSION['userid'];
$receiver_id = $DATA_OBJ->userid;

$query = "SELECT * FROM friends WHERE 
          (sender_id = :sender AND receiver_id = :receiver)
          OR (sender_id = :receiver AND receiver_id = :sender) 
          LIMIT 1";

$check = $DB->read($query, [
    'sender' => $sender_id,
    'receiver' => $receiver_id
]);

if (is_array($check)) {
    $info->message = "A friend request already exists.";
    $info->data_type = "send_friend_result";
    echo json_encode($info);
    die;
}

$insert_query = "INSERT INTO friends (sender_id, receiver_id, status) VALUES (:sender, :receiver, 'pending')";
$DB->write($insert_query, [
    'sender' => $sender_id,
    'receiver' => $receiver_id
]);

$info->message = "Friend request sent!";
$info->data_type = "send_friend_result";
echo json_encode($info);

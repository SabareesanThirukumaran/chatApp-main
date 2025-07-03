<?php
session_start();
include("classes/database.php");

if (isset($_POST['term'])) {
    $DB = new Database();
    $term = "%" . $_POST['term'] . "%";
    $userid = $_SESSION['userid'];

    $query = "SELECT * FROM users WHERE username LIKE :term AND userid != :userid LIMIT 10";
    $data = [
        'term' => $term,
        'userid' => $userid
    ];

    $result = $DB->read($query, $data);

    if ($result) {
        foreach ($result as $row) {
            $username = htmlspecialchars($row->username);
            $id = $row->userid;
            $image = $row->image ?? 'default.jpg';

            echo "
                <div onclick='sendFriendRequest($id)' style='padding:10px; border-bottom:1px solid #ccc; cursor:pointer;'>
                    <img src='$image' style='width:30px; height:30px; border-radius:50%; margin-right:10px; vertical-align:middle;'>
                    $username
                </div>
            ";
        }
    }
}

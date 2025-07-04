<?php
header('Content-Type: application/json');

$info = (object)[];

$find = $DATA_OBJ->find ?? '';

if (is_string($find) && strlen(trim($find)) > 0) {
    $find = trim($find);

    $query = "SELECT userid, username, image, gender FROM users WHERE username LIKE :search";
    $rows = $DB->read($query, ['search' => "%$find%"]);

    $myid = $_SESSION['userid'];
    $mydata = "";

    if ($rows) {
        foreach ($rows as $row) {
            if ($row->userid == $myid) continue;

            if (isset($row->image)){
                $image = $row->image;
            } else {
                $image = 'ui/images/'. $row->gender . '.jpg';
            }

            $mydata .= "
                <div id='contact_search_box' userid='$row->userid' onclick='send_friend(event)' style='margin-bottom: 10px; cursor: pointer;'>
                    <img src='$image' style='width: 50px; height: 50px; border-radius: 50%;'>
                    <br>$row->username
                </div>
            ";
        }
    } else {
        $mydata = "No users found.";
    }

    $info->message = $mydata;
    $info->data_type = "addFriends_results";
    echo json_encode($info);
    die;
}

// If no search term, return initial page content (input box + container)
$mydata = <<<HTML
<style>
.inputBarBox {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 4rem;
}
.inputBar {
    width: 250px;
    height: 30px;
    border-radius: 10px;
    padding: 10px;
}
</style>

<h2>Add Friends</h2>
<div class='inputBarBox' style='text-align: center;'>
    <input type='text' placeholder='Type to find contacts...' class='inputBar' id='input_bar' onkeyup='searchUsers()'>
</div>
<div class='results' id='results'></div>
HTML;

$info->message = $mydata;
$info->data_type = "addFriends";
echo json_encode($info);
die;

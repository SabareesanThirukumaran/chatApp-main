<?php 

session_start();

$DATA_RAW = file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$info = (Object)[];

//check if logged in
if (!isset($_SESSION['userid']))
{
    if (isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type != "login") && ($DATA_OBJ->data_type != "signup"))
    {
        $info->logged_in = false;
        echo json_encode($info);
        die;        
    }

}

require_once("classes/initialise.php");
$DB = new Database();

$Error = "";

//process the data
if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup")
{
    // signup
    include("includes/security.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login")
{
    //login
    include("includes/login.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout") 
{
    //logout
    include("includes/logout.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info")
{
    //user info
    include("includes/user_info.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts")
{
    //contact information
    include("includes/contacts.php");

} else if (isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh"))
{
    //chat information
    include("includes/chats.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings")
{
    //setting information
    include("includes/settings.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings")
{
    //save information
    include("includes/save_settings.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message")
{
    //send message information
    include("includes/send_message.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_message")
{
    //send message information
    include("includes/delete_message.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "delete_thread")
{
    //send message information
    include("includes/delete_thread.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "addFriends")
{
    //send message information
    include("includes/addFriends.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_friend")
{
    //send message information
    include("includes/send_friend.php");

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "receive_friends")
{
    //send message information
    include("includes/receive_friends.php");

}


function message_left($data, $result)
{
    $a =  
    "<div id='message_left'>
        <div></div>
        <img id='prof_img' src='$result->image'>
        <b>$result->username : </b>
        <section style='display: flex; flex-direction: column'>
            $data->message<br>";

    if (!empty($data->files)) {
        $a .= "<img src='$data->files' style='width: 100px; height: 100px; object-fit: cover; cursor: pointer;' onclick='image_show(event)'><br>";
    }

    $a .= "
            <span style='opacity: 0.5; font-size: 11px;'>".date("jS M Y H:i:s", strtotime($data->date))."</span>
        </section>
        <img src='ui/icons/trash.png' id='trash' onclick='delete_message(event)' msgid='$data->id'>
    </div>";

    return $a;
}


function message_right($data, $result)
{
    $a =  
    "<div id='message_right'>
        <div class='tick-box'>";

    if($data->seen) {
        $a .= "<img src='ui/images/tick.png'>";
    } elseif ($data->received) {
        $a .= "<img src='ui/images/tick_grey.png'>";
    }

    $a .= "
        </div>
        <img id='prof_img' src='$result->image'>
        <b> : $result->username</b>
        <section style='display: flex; flex-direction: column'>
            $data->message<br>";

    if (!empty($data->files)) {
        $a .= "<img src='$data->files' style='width: 100px; height: 100px; object-fit: cover; cursor: pointer;' onclick='image_show(event)'><br>";
    }

    $a .= "
            <span style='opacity: 0.5; font-size: 11px;'>".date("jS M Y H:i:s", strtotime($data->date))."</span>
        </section>
        <img src='ui/icons/trash.png' id='trash' onclick='delete_message(event)' msgid='$data->id'>
    </div>";

    return $a;
}


function message_controls()
{
    return 
        "</div>
        <span style='display: block; text-align: center; font-size: 14px; color: #555; font-weight: 500; margin: 10px 0; cursor: pointer; transition: color 0.2s ease;' onclick='delete_thread(event)'>Delete this thread</span>
        <div class='textBoxArea' style='width: 100%'>
            <label for='message_file' style='background-color: #a9a9a9; border-radius: 10px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;'><img src='ui/icons/clip.png' style='opacity:0.5; width:20px; height:20px; cursor:pointer;'></label>
            <input type='file' multiple name='message_file' style='display:none;' id='message_file' onchange='send_image(this.files)'>
            <input id='message_text' onkeyup='enter_pressed(event)' type='text' placeholder='Write your message here...' class='textArea'>
            <input type='button' value='Send' class='buttonArea' onclick='send_message(event)'>
        </div>
    </div>";

}
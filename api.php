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

} else if (isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "chats")
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

}


function message_left($data, $result)
{
    return 
    "<div id='message_left'>
        <div></div>
        <img src='$result->image'>
        <b>$result->username : </b>
        <section style='display: flex; flex-direction: column'>
            $data->message<br>
            <span style='opacity: 0.5; font-size: 11px;'>".date("jS M Y H:i:s", strtotime($data->date))."</span>
        </section>
    </div>";

}

function message_right($data, $result)
{
    return 
    "<div id='message_right'>
        <div></div>
        <img src='$result->image'>
        <b> : $result->username</b>
        <section style='display: flex; flex-direction: column'>
            $data->message<br>
            <span style='opacity: 0.5; font-size: 11px;'>".date("jS M Y H:i:s", strtotime($data->date))."</span>
        </section>
    </div>";

}

function message_controls()
{
    return 
        "</div>
        <div class='textBoxArea' style='width: 100%'>
            <label for='message_file' style='background-color: #a9a9a9; border-radius: 10px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;'><img src='ui/icons/clip.png' style='opacity:0.5; width:20px; height:20px; cursor:pointer;'></label>
            <input type='file' name='message_file' style='display:none;' id='file'>
            <input id='message_text' onkeyup='enter_pressed(event)' type='text' placeholder='Write your message here...' class='textArea'>
            <input type='button' value='Send' class='buttonArea' onclick='send_message(event)'>
        </div>
    </div>";

}
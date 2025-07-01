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

}

function message_left($result)
{
    return 
    "<div id='message_left'>
        <div></div>
        <img src='$result->image'>
        <b>$result->username : </b>
        <section style='display: flex; flex-direction: column'>
            This is a very long message which is going to be very long because it is also a test message for your information yet the message shall be prolonged<br>
            <span style='opacity: 0.5; font-size: 11px;'>20 Jan 2022 10:00 am</span>
        </section>
    </div>";

}

function message_right($result)
{
    return 
    "<div id='message_right'>
        <div></div>
        <img src='$result->image'>
        <b> : $result->username</b>
        <section style='display: flex; flex-direction: column'>
            This is a test message<br>
            <span style='opacity: 0.5; font-size: 11px;'>20 Jan 2022 10:00 am</span>
        </section>
    </div>";

}
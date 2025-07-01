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
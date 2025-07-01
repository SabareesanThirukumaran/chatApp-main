<?php
session_start();

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

$data_type = "";
if (isset($_POST['data_type']))
{
    $data_type = $_POST['data_type'];
}


$destination = "";
$file_types = ["jpg", "png"];
$file_type_by_user = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));;

if (isset($_FILES["file"]) && $_FILES['file']['name'] != ""){
    
    if ($_FILES['file']['error'] == 0 && in_array($file_type_by_user, $file_types) )
    {
        // file got sent successfully if code reaches here
        $folder = "uploads/";
        if (!file_exists($folder))
        {
            mkdir($folder, 0777, true);
        }

        $destination = $folder . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
        
        $info->message = "Your image was saved";
        $info->data_type = $data_type;
        echo json_encode($info);
    }

}

if ($data_type == "change_profile_image")
{
    if ($destination == "")
    {
        echo "There was an error saving the file";
    }
    else
    {
        // save to database
        $id = $_SESSION['userid'];
        $query = "update users set image = '$destination' where userid = '$id' limit 1";
        $DB->write($query, []); 
    }
}
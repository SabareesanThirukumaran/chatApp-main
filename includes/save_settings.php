<?php

$info = (Object)[];

$data = false;
$data['userid'] = $_SESSION['userid'];

// Need to check because given by user, not database
//Check Username
$data['username'] = $DATA_OBJ->username;
if (empty($DATA_OBJ->username))
{
    $Error .= "Please enter a valid username . <br>";
} else 
{
    if (strlen($DATA_OBJ->username) < 3)
    {
        $Error .= "Username must be atleast 3 characters long. <br>";
    }

    if (!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username))
    {
        $Error .= "Please enter a valid username. <br>";
    }

}

// Check email
$data['email'] = $DATA_OBJ->email;
if (empty($DATA_OBJ->email))
{
    $Error .= "Please enter a valid email . <br>";
} else 
{

    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email))
    {
        $Error .= "Please enter a valid email. <br>";
    }

}

// Check gender
$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
if (empty($DATA_OBJ->gender))
{
    $Error .= "Please select a gender . <br>";
} else 
{

    if ($DATA_OBJ->gender != "Male" && $DATA_OBJ->gender != "Female")
    {
        $Error .= "Please enter a valid gender. <br>";
    }

}

//Checking current password
$current_password = $DATA_OBJ->current_password;

if (empty($current_password)) {
    $Error .= "Please enter your current password <br>";
} else {

    $check_query = "SELECT password FROM users WHERE userid = :userid LIMIT 1";
    $id_data = ['userid' => $_SESSION['userid']];
    $result = $DB->read($check_query, $id_data);

    if (is_array($result)) 
    {
        $user_password = $result[0]->password;
        if ($current_password != $user_password)
        {
            $Error .= "Your current password is incorrect <br>";
        }
    } else {
        $Error .= "Unable to verify your account, please try again later.";
    }

}

// Check New Password
$password2 = $DATA_OBJ->password2;
$password2again = $DATA_OBJ->password2again;

// Only run validation if at least one password field is filled
if (!empty($password2) || !empty($password2again)) {

    if (empty($password2) || empty($password2again)) {
        $Error .= "Please enter a new password.<br>";
    } elseif ($password2 != $password2again) {
        $Error .= "Passwords must match.<br>";
    } elseif (strlen($password2) < 8) {
        $Error .= "Password must be at least 8 characters long.<br>";
    } else {
        // Passed validation: include new password in $data
        $data['password'] = $password2; // Or use password_hash($password2, PASSWORD_DEFAULT)
    }

} else {
    // User left both fields empty = no password change
    unset($data['password']);
}


if ($Error == "")
{
    $query = "update users set username = :username,gender = :gender,email = :email,password = :password where userid = :userid limit 1";
    $result = $DB->write($query, $data); 

    if ($result)
    {
        $info->message = "Your data was saved";
        $info->data_type = "save_settings";
        echo json_encode($info);
    }else
    {
        $info->message = "Your data was not saved due to an error";
        $info->data_type = "save_settings";
        echo json_encode($info);
    }
} else 
{
    $info->message = $Error;
    $info->data_type = "save_settings";
    echo json_encode($info);
}
<?php

    $sql = "select * from users where userid = :userid limit 1";
    $id = $_SESSION['userid'];
    $data = $DB->read($sql, ['userid' => $id]);


    $mydata = "";

if(is_array($data))
{
    $data = $data[0];

    // check if image exists
    $image = ($data->gender == "Male") ?  "ui/images/male.jpg" : "ui/images/female.jpg";
    if(file_exists($data->image)){
        $image = $data->image;
    }
    
    $gender_male = "";
    $gender_female = "";

    if ($data->gender == "Male")
    {
        $gender_male = "checked";
    } else {
        $gender_female = "checked";
    }

    $current_password = "";

    $mydata = 
    '<style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap");

        body {
            font-family: "Nunito", sans-serif;
            font-optical-sizing: auto;
            font-style: normal
        }

        form  {
            text-align: left;
            margin: auto;
            padding: 10px;
            width: 100%;
            max-width: 400px;
        }

        input[type=text], input[type=password], input[type=button] {
            padding: 10px;
            margin: 10px;
            width: 200px;
            border-radius: 10px;
            border: solid 1px grey;
        }

        input[type=button] {
            width:220px;
            cursor: pointer;
            background-color: #2b5488;
            color: white;
        }

        input[type=radio] {
            cursor: pointer;
            transform: scale(1.3);
        }

        #error {
            text-align: center;
            padding: 0.5em;
            background-color: #ecaf91;
            color: white;
            display: none;
        }


        @keyframes appear {
            0% {
                opacity: 0;
                transform: translateX(100px);
            }

            100% {
                opacity: 1;
                transform: translateX(0px);
            }
        }

        #change_image_button {
            padding: 10px;
            border-radius: 10px;

        }

        .dragging {
            border: white 2px dashed;

        }
        
        .dragText{
            padding: 0.5em;
            opacity: 0.5;
            display:inline-block;
        }

    </style>

    <div id="error">error</div>
    <div style="display: flex; animation: appear 1s ease">

        <div>
            <img ondragover="handle_drag_and_drop(event)" ondragleave="handle_drag_and_drop(event)" ondrop="handle_drag_and_drop(event)" src="'.$image.'" style="width:200px; height:200px; margin: 10px;"/>
            <label for="change_image_input" id="change_image_button" style="background-color: #9b9a80; display: inline-block; cursor:pointer;">
                Change Image
            </label>
            <br>
            <span class="dragText">/ Drag & Drop</span>
            <input type="file" onchange="upload_profile_image(this.files)" id="change_image_input" style="display: none; cursor:pointer;"><br>
        </div>

        <form action="" id="myform">
            <input type="text" name="username" placeholder="Username" value="'.$data->username.'"><br>
            <input type="text" name="email" placeholder="Email" value="'.$data->email.'"><br>
            <div style="padding: 10px">
                <br>Gender:<br>
                <input type="radio" value="Male" name="gender" '.$gender_male.'> Male<br>
                <input type="radio" value="Female" name="gender" '.$gender_female.'> Female<br>
            </div>
            <input type="password" name="current_password" placeholder="Current Password" value="'.$current_password.'"><br>
            <input type="password" name="password2" placeholder="New Password" value=""><br>
            <input type="password" name="password2again" placeholder = "Repeat New Password" value=""><br>
            <input type="button" value="Save Settings" id="save_settings_button" onclick="collect_data(event)"><br>
        </form>
    </div>

    
      ';

    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info);

} else{   

    $info->message = "No contacts were found";
    $info->data_type = "error";
    echo json_encode($info);

}
?>
<?php
    
    $arr['userid'] = $DATA_OBJ->find->userid;
    $sql = "select * from users where userid = :userid limit 1";
    $result = $DB->read($sql,$arr);

    if(is_array($result)){
        
        $result = $result[0];

        $image = ($result->gender == "Male") ?  "ui/images/male.jpg" : "ui/images/female.jpg";
        if(file_exists($result->image)){
            $image = $result->image;
        }

        $mydata = "Now chatting with <br>
            <div id='active_contact'>
                <img src='$image'>
                <span class='username'>$result->username</span>
            </div>";

        $info->message = $mydata;
        $info->data_type = "chats";
        echo json_encode($info);

    } else {

        $info->message = "That contact was not found";
        $info->data_type = "error";
        echo json_encode($info);

    }

?>
<?php
    
    $arr['userid'] = "null";
    if (isset($DATA_OBJ->find->userid))
    {
        $arr['userid'] = $DATA_OBJ->find->userid;
    }

    $sql = "select * from users where userid = :userid limit 1";
    $result = $DB->read($sql,$arr);

    if(is_array($result)){
        
        $result = $result[0];

        $image = ($result->gender == "Male") ?  "ui/images/male.jpg" : "ui/images/female.jpg";
        if(file_exists($result->image)){
            $image = $result->image;
        }

        $result->image = $image;

        $mydata = "Now chatting with <br>
                    <div id='active_contact'>
                        <img src='$image'>
                        <span class='username'>$result->username</span>
                    </div>";

        $messages = "
            <div id='chat_wrapper'>
                <div id='chat_container'>";

        $messages .= message_left($result);
        $messages .= message_right($result);

        $messages .= "
                </div>
                <div class='textBoxArea' style='width: 100%'>
                    <label for='file' style='background-color: #a9a9a9; border-radius: 10px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;'><img src='ui/icons/clip.png' style='opacity:0.5; width:20px; height:20px; cursor:pointer;'></label>
                    <input type='file' name='file' style='display:none;' id='file'>
                    <input type='text' placeholder='Write your message here...' class='textArea'>
                    <input type='button' value='Send' class='buttonArea '>
                </div>
            </div>";

        $info->user = $mydata;
        $info->messages = $messages;
        $info->data_type = "chats";
        echo json_encode($info);

    } else {

        $info->message = "That contact was not found";
        $info->data_type = "chats";
        echo json_encode($info);

    }

?>
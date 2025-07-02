<?php
    
    $arr['userid'] = "null";
    if (isset($DATA_OBJ->find->userid))
    {
        $arr['userid'] = $DATA_OBJ->find->userid;
    }

    $refresh = false;
    if ($DATA_OBJ->data_type == "chats_refresh")
    {
        $refresh = true;
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

        $mydata = "";
        if (!$refresh) {
            $mydata = "Now chatting with <br>
                        <div id='active_contact'>
                            <img src='$image'>
                            <span class='username'>$result->username</span>
                        </div>";
        }

        $messages = "";
        if (!$refresh) {
        $messages = "
            <div id='chat_wrapper'>
                <div id='chat_container'>";
        }

                    // read from db
                    $a['sender'] = $_SESSION['userid'];
                    $a['receiver'] = $arr['userid'];

                    $sql = "select * from messages where (sender = :sender && receiver = :receiver) || (receiver = :sender && sender = :receiver) ORDER BY id desc";
                    $result2 = $DB->read($sql,$a);

                    if(is_array($result2)){ 

                        $result2 = array_reverse($result2);
                        foreach ($result2 as $data)
                        {
                            $myuser = $DB->get_user($data->sender);

                            if ($myuser->image == null)
                            {
                                $myuser->image = ($myuser->gender == "Male")? "ui/images/male.jpg" : "ui/images/female.jpg";
                            }

                            if ($data->sender == $_SESSION['userid'])
                            {
                                $messages .= message_right($data, $myuser);
                            } else {    
                                $messages .= message_left($data, $myuser);
                            }   
                        }

                    }

        if (!$refresh) {
            $messages .= message_controls();
        }
        
        $info->user = $mydata;
        $info->messages = $messages;
        $info->data_type = "chats";
        if ($refresh) {
            $info->data_type = "chats_refresh";
        }
        echo json_encode($info);

    } else {
        // read from db
        $a['userid'] = $_SESSION['userid'];

        $sql = "select * from messages where (sender = :userid || receiver = :userid) group by msgid ORDER BY id desc limit 10";
        $result2 = $DB->read($sql,$a);

        $mydata = "Previous Chats : <br>";

        if(is_array($result2)){ 

            $result2 = array_reverse($result2);
            foreach ($result2 as $data)
            {
                $other_user = $data->sender;
                if($data->sender == $_SESSION['userid'])
                {
                    $other_user = $data->receiver;
                }
                $myuser = $DB->get_user($other_user);

                if ($myuser->image == null)
                {
                    $myuser->image = ($myuser->gender == "Male")? "ui/images/male.jpg" : "ui/images/female.jpg";
                }

                $mydata .= " 
                            <div id='active_contact' userid='$myuser->userid' onclick='start_chat(event)'>
                                <img src='$myuser->image'>
                                <span class='username'>$myuser->username</span><br>
                                <span style='font-size: 12px; opacity: 0.5;'>'$data->message'</span>
                            </div>";    
            }

        }

        $info->user = $mydata;
        $info->messages = "";
        $info->data_type = "chats";

        echo json_encode($info);

    }

?>
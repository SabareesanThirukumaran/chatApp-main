<?php
    
    $arr['userid'] = "null";
    if (isset($DATA_OBJ->find->userid))
    {
        $arr['userid'] = $DATA_OBJ->find->userid;
    }

    $sql = "select * from users where userid = :userid limit 1";
    $result = $DB->read($sql,$arr);

    if(is_array($result)){

        $arr['message'] = $DATA_OBJ->find->message;
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['sender'] = $_SESSION['userid'];
        $arr['msgid'] = get_random_string_max(60);

            $arr2['sender'] = $_SESSION['userid'];
            $arr2['receiver'] = $arr['userid'];

            $sql = "select * from messages where sender = :sender && receiver = :receiver limit 1";
            $result2 = $DB->read($sql,$arr2);

            if(is_array($result2)){ 
                $arr['msgid'] = $result2[0]->msgid;
            }

        $query = "insert into messages (sender,receiver,message,date,msgid) values (:sender,:userid,:message,:date,:msgid)";
        $DB->write($query, $arr);

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

                    // read from db
                    $a['msgid'] = $arr['msgid'];

                    $sql = "select * from messages where msgid = :msgid limit 10";
                    $result2 = $DB->read($sql,$a);

                    if(is_array($result2)){ 

                        foreach ($result2 as $data)
                        {
                            $messages .= message_right($data, $result);
                        }

                    }

        $messages .= "
                </div>
                <div class='textBoxArea' style='width: 100%'>
                    <label for='message_file' style='background-color: #a9a9a9; border-radius: 10px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;'><img src='ui/icons/clip.png' style='opacity:0.5; width:20px; height:20px; cursor:pointer;'></label>
                    <input type='file' name='message_file' style='display:none;' id='file'>
                    <input id='message_text' type='text' placeholder='Write your message here...' class='textArea'>
                    <input type='button' value='Send' class='buttonArea' onclick='send_message(event)'>
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

function get_random_string_max($length) {

	$array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$text = "";

	$length = rand(4,$length);

	for($i=0;$i<$length;$i++) {

		$random = rand(0,61);
		
		$text .= $array[$random];

	}

	return $text;
}

?>
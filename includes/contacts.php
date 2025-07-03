<?php

    sleep(0.5);
    $sql = "select * from users limit 10";
    $myusers = $DB->read($sql,[]);

    // not displaying own contact
    $sql = "select * from users where userid = :userid limit 1";
    $id = $_SESSION['userid'];
    $data = $DB->read($sql, ['userid' => $id]);
    if (is_array($data))
    {    
        $data = $data[0];
    }

    $mydata =
    '
    <style>
        @keyframes appear {
            0% {
                opacity: 0;
                transform: translateY(100px);
            }

            100% {
                opacity: 1;
                transform: translateY(0px);
            }
        }


        #contact {
            cursor: pointer;
            transition: all 0.5s ease;
        }
        
        #contact:hover {
            transform: scale(1.1);
        }
    </style>
    <div style="text-align: center;">';

        if(is_array($myusers)){

            // check for new messages;
            $msgs = array();
            $me = $_SESSION['userid'];
            $query = "SELECT * FROM messages WHERE receiver = :me AND received = 0";
            $mymsgs = $DB->read($query, ['me' => $me]);

            if(is_array($mymsgs))
            {  
                foreach ($mymsgs as $row2)
                {
                    $sender = $row2->sender;

                    if(isset($msgs[$sender]))
                    {
                        $msgs[$sender]++;
                    } else {
                        $msgs[$sender] = 1;
                    }
                    
                }
            }

            foreach($myusers as $row)
            {
                if ($row->username == $data->username)
                {
                    continue;
                }
                else {

                    $image = ($row->gender == "Male") ?  "ui/images/male.jpg" : "ui/images/female.jpg";
                    if(file_exists($row->image)){
                        $image = $row->image;
                    }

                    $mydata .= "
                    <div id='contact' style='position: relative;' userid='$row->userid' onclick='start_chat(event)'>
                        <img src='$image'>
                        <br>$row->username";

                        if(count($msgs) > 0 && isset($msgs[$row->userid])){
                            $mydata .= "<div style='width: 20px; height: 20px; border-radius: 50%; background-color: orange; color: white; position: absolute; text-align: center; left: -10px; top: 10px;'>".$msgs[$row->userid]."</div>";
                        }

                    $mydata .= "
                    </div>";
                }
            }

        }
        

    $mydata .= '
    </div>';

    $info->message = $mydata;
    $info->data_type = "contacts";
    echo json_encode($info);

    die;

    $info->message = "No contacts were found";
    $info->data_type = "error";
    echo json_encode($info);


?>
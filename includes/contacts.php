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
    <div style="text-align: center; animation: appear 1s ease">';

        if(is_array($myusers)){

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
                    <div id='contact' userid='$row->userid' onclick='start_chat(event)'>
                        <img src='$image'>
                        <br>$row->username
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
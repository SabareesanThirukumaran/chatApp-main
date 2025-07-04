<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');

    body {
        color: white;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal
    }

    #wrapper {
        max-width: 900px;
        min-height: 500px;
        display: flex;
        margin: auto;
    }

    #left_pannel {
        min-height: 500px;
        background-color: #27344b;
        color: white;
        flex: 1;
        text-align: center;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;
        font-size: 14px;
    }

    #profile_image {
        border-radius: 50%;
        border: 1px solid white;
        width: 85px;
        height: 85px;
        margin: 10px;
        padding: 10px;
    }

    #left_pannel #email {
        opacity: 0.5;
        font-size: 12px;
    }

    #left_pannel label {
        width: 100%;
        height: 20px;
        display: block;
        font-size: 13px;
        background-color: #404b56;
        border-bottom: solid thin #ffffff55;
        cursor: pointer;
        padding: 5px;
        transition: all 0.5s ease;
    }

    #left_pannel label:hover {
        background-color:rgb(99, 109, 117);
    }

    #left_pannel label img {
        float: right;
        width: 25px;
    }

    #right_pannel {
        min-height: 500px;
        flex: 4;
    }

    #header {
        background-color: #485b6c;
        color: #fff;
        height: 70px;
        font-weight: 700;
        font-size: 50px;
        text-align: center;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal;

        position: relative;
    }

    #inner_left_pannel {
        background-color: #383e48;
        flex: 1;
        min-height: 430px;
        text-align: center;
        
    }

    #inner_right_pannel {
        background-color: #f2f7f8;
        flex: 2;
        min-height: 430px;
        transition: all 0.5s;
    }

    #radio_contacts:checked ~ #inner_right_pannel,
    #radio_settings:checked ~ #inner_right_pannel,
    #radio_addFriends:checked ~ #inner_right_pannel,
    #radio_receiveFriends:checked ~ #inner_right_pannel
    {
        flex: 0;
    }

    #contact {

        width: 100px;
        height: 140px;
        margin:10px;
        display: inline-block;
        vertical-align: top;
    
    }

    #contact img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
    
    #active_contact {
        width: 100%;
        max-width: 180px;
        background-color: #2e3b4e; /* dark background to match your left panel */
        padding: 12px 10px;
        margin: 10px auto;
        border-radius: 8px;
        text-align: center;
        color: #fff;
        font-family: 'Segoe UI', sans-serif;
        transition: background 0.2s, transform 0.2s;
        cursor: pointer;
    }

    #active_contact:hover {
        background-color: #3b4a61;
        transform: translateY(-2px);
    }

    #active_contact img {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #4a90e2;
        margin-bottom: 8px;
    }

    #active_contact .username {
        display: block;
        font-size: 14px;
        font-weight: 500;
        word-break: break-word;
        color: #e0e0e0;
    }

    #message_left, #message_right {
        width: fit-content;
        max-width: 90%;
        margin: 10px;
        border: solid thin #aaa;
        padding: 10px;
        background-color: #eee;
        color: #444;
        display: flex;
        flex-direction: row;
        align-items: center;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #ddd;
        position: relative;
        clear: both;
    }

    #message_left {
        margin-right: auto;
        background-color: #f1f0f0;
    }

    #message_right {
        margin-left: auto;
        background-color: #d1ffd6; /* light green for sent message */
        flex-direction: row-reverse;
    }
    
    #message_left section,
    #message_right section {
        word-wrap: break-word;
        max-width: 100%;
    }


    #message_left #prof_img, #message_right #prof_img {
        width: 45px;
        height: 45px;
        margin: 0.5em;
        border-radius: 50%;
        border: solid 2px white;
    }

    #message_right .tick-box img {
        position: absolute;
        top: 30px;
        right: 10px;
        height: 20px;
        width: 25px;
        border: none;

    }

    #message_left div {
        width: 20px;
        height: 20px;
        background-color: #34474f;
        border-radius: 50%;
        position: absolute;
        left: -10px;
    }

    #message_right div {
        width: 20px;
        height: 20px;
        background-color: #34474f;
        border-radius: 50%;
        position: absolute;
        right: -10px;
    }

    #message_left b, #message_right b {
        margin: 0 10px;
    }

    #message_left img,
    #message_right img,
    #message_left b,
    #message_right b {
        flex-shrink: 0;
        white-space: nowrap;
    }

    #message_right #trash {
        width: 20px;
        height: 20px;
        position: absolute;
        bottom: -5px;
        left: -10px;
        cursor: pointer;
    }

    #message_left #trash {
        width: 20px;
        height: 20px;
        position: absolute;
        bottom: -5px;
        right: -10px;
        cursor: pointer;
    }



    #chat_container {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 10px;
        overflow-y: auto;
        background-color: #f9f9f9;
    }

    .textBoxArea {
        display: flex;
        align-items: center;
        padding: 10px;
        background-color: #ffffff;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    .textBoxArea .textArea {
        width: 75%;
        margin: 1em;
        height: 20px;
        border-radius: 5px;
        border: none;
        padding: 7px 10px;
        background-color:rgb(213, 228, 233);
        color: #333333; 
        font-size: 14px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
    }

    .textBoxArea .buttonArea {
        width: 15%;
        height: 30px;
        border-radius: 5px;
        cursor: pointer;
        border: none;
        background-color: #4a90e2;
        color: #ffffff;    
        font-weight: bold;
        transition: background-color 0.3s;
    }

    #chat_wrapper {
        display: flex;
        flex-direction: column;
        height: 430px;
    }

    .textBoxArea .buttonArea:hover {
        background-color: #357abd;
    }




    .loader_on  {
        position: absolute;
        width: 30%;
    }

    .loader_off  {  
        display: none;
    }

    .image_on {
        position: absolute;
        width: 400px;
        height: 400px;
        background-color: #fff;
        z-index: 5;
        top: 50px;
        left: 50px;
        cursor: pointer;
        border: 2px solid black;
    }   

    .image_off {
        display: none;
    }

    .invisible {
        display: none;
    }

    #contact_search_box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #2b2b2b73;
        border-radius: 10px;
        margin-top: 0.75rem;
        margin-right: 20px;
        margin-left: 20px;
        width: 30%;
        height: 60%;
        padding: 25px;
        cursor: pointer;
        transition: 0.5s all ease;
    }

    #contact_search_box img {
        border: 1px solid white;
        padding: 5px;
    }

    #contact_search_box:hover {
        background-color: #2b2b2b;

    }

    #results {
        text-align: center;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
    }




</style>

<body>
    <div id="wrapper">

        <div id="left_pannel">
            <div id="user_info" style="padding: 10px">

                <img src="ui/images/male.jpg" alt="User Pfp" id="profile_image">
                <br>
                <span id="username" >Username</span>
                <br>
                <span id="email">email@gmail.com</span>

                
                <br>
                <br>
                <br>
                <div>
                    <label id="label_chat" for="radio_chat">Chat <img src="ui/icons/chat.png" alt=""></label>
                    <label id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png" alt=""></label>
                    <label id="label_settings" for="radio_settings">Settings <img src="ui/icons/settings.png" alt=""></label>
                    <label id="label_addFriends" for="radio_addFriends">Add Friends <img src="ui/icons/add.png" alt="" style="width: 21px; height: 21px;"></label>
                    <label id="label_receiveFriends" for="radio_receiveFriends">Requests <img src="ui/icons/request.png" alt="" style="width: 21px; height: 21px;"></label>

                    <label id="logout" for="radio_logout">Logout <img src="ui/icons/logout.png" alt=""></label>
                </div>

            </div>

        </div>

        <div id="right_pannel">

            <div id="header">
                <div class="loader_on" id="loader_holder"><img style="width: 70px" src="ui/icons/giphy.gif"></div>
                
                <div id="image_viewer" class='image_off' onclick='close_image(event)'>
                    <p style='font-size: 12px; text-align:center; color:black; z-index: 7;'>Click anywhere to close the image</p>
                </div>
                WeChat
            </div>

            <div id="container" style="display: flex;">

                <div id="inner_left_pannel"></div>

                <input type="radio" id="radio_chat" name="buts" style="display: none;">
                <input type="radio" id="radio_contacts" name="buts" style="display: none;">
                <input type="radio" id="radio_settings" name="buts" style="display: none;">
                <input type="radio" id="radio_addFriends" name="buts" style="display: none;">
                <input type="radio" id="radio_receiveFriends" name="buts" style="display: none;">

                <div id="inner_right_pannel">
                </div>

            </div>

        </div>

    </div>
</body>
<script>

    var sent_audio = new Audio("message_sent.mp3");
    var received_audio = new Audio("message_received.mp3");

    var CURRENT_CHAT_USER = "";
    var SEEN_STATUS = false;

    function _(ele){
        return document.getElementById(ele);
    }
    
    var label_contacts = _("label_contacts");
    label_contacts.addEventListener("click", get_contacts);

    var label_chat = _("label_chat");
    label_chat.addEventListener("click", get_chats);

    var label_settings = _("label_settings");
    label_settings.addEventListener("click", get_settings);

    var label_addFriends = _("label_addFriends");
    label_addFriends.addEventListener("click", get_addFriends);

    var label_receiveFriends = _("label_receiveFriends");
    label_receiveFriends.addEventListener("click", get_receiveFriends);

    var logout = _("logout");
    logout.addEventListener("click", unlog);


    function get_data(find,type){

        var xml = new XMLHttpRequest();
        var loader_holder = _("loader_holder");
        loader_holder.className = "loader_on";

        xml.onload = function(){

            if(xml.readyState == 4 || xml.status == 200){
                loader_holder.className = "loader_off";
                handle_result(xml.responseText,type);
            }

        }

        var data = {};
        data.find = find;
        data.data_type = type;
        data = JSON.stringify(data);

        xml.open("POST", "api.php", true);
        xml.send(data);
    }

    function handle_result(result, type){
        if(result.trim() != ""){

            var inner_right_pannel = _("inner_right_pannel");
            inner_right_pannel.style.overflow = "visible";

            var obj = JSON.parse(result);
            if(typeof(obj.logged_in) != "undefined" && !obj.logged_in){

                window.location = "login.php";
            } else {

                switch(obj.data_type){

                    case "user_info":
                        var username = _("username");
                        var email = _("email");
                        var profile_image = _("profile_image");

                        profile_image.src = obj.image;
                        username.innerHTML = obj.username;
                        if (obj.email.length >= 25){
                            need_to_replace = obj.email.slice(25, obj.email.length);
                            obj.email = obj.email.replace(need_to_replace, "...");
                        }
                        email.innerHTML = obj.email;
                        break;

                    case "contacts":
                        
                        var inner_left_pannel = _("inner_left_pannel");
    
                        inner_right_pannel.style.overflow = "hidden";
                        inner_left_pannel.innerHTML = obj.message;

                        break;
                    
                    case "chats_refresh":
                        SEEN_STATUS = false;
                        var chat_container = _("chat_container");
                        chat_container.innerHTML = obj.messages;

                        if(typeof obj.new_message != "undefined"){
                            if (obj.new_message){
                                received_audio.play();
                                setTimeout(() => {
                                    var chat_container = _("chat_container");
                                    if (chat_container) {
                                        chat_container.scrollTop = chat_container.scrollHeight;
                                    } else {
                                        console.warn("chat_container not found in DOM");
                                    }

                                    var message_text = _("message_text");
                                    if (message_text) {
                                        message_text.focus();
                                    } else {
                                        console.warn("message_text not found in DOM");
                                    }


                                }, 0);
                            }
                        }

                        break;

                    case "send_message":
                        sent_audio.play();
                    case "chats":
                        SEEN_STATUS = false;
                        var inner_left_pannel = _("inner_left_pannel");

                        inner_left_pannel.innerHTML = obj.user;
                        inner_right_pannel.innerHTML = obj.messages;

                        setTimeout(() => {
                            var chat_container = _("chat_container");
                            if (chat_container) {
                                chat_container.scrollTop = chat_container.scrollHeight;
                            } else {
                                console.warn("chat_container not found in DOM");
                            }

                            var message_text = _("message_text");
                            if (message_text) {
                                message_text.focus();
                            } else {
                                console.warn("message_text not found in DOM");
                            }


                        }, 0);

                        if(typeof obj.new_message != "undefined"){
                            if (obj.new_message){
                                received_audio.play();
                            }
                        }

                        break;

                    case "settings":
                        var inner_left_pannel = _("inner_left_pannel");

                        inner_left_pannel.innerHTML = obj.message;

                        break;

                    case "addFriends":
                        var inner_left_pannel = _("inner_left_pannel");
                        inner_right_pannel.innerHTML = "";
                        inner_right_pannel.style.overflow = "hidden";
                        inner_left_pannel.innerHTML = obj.message;

                        break;

                    case "friend_request":
                        var inner_left_pannel = _("inner_left_pannel");
                        inner_right_pannel.innerHTML = "";
                        inner_right_pannel.style.overflow = "hidden";
                        inner_left_pannel.innerHTML = obj.message;

                        break;


                    case "send_image":
                        break;

                    case "save_settings":

                        alert(obj.message);
                        get_data({}, "user_info");
                        get_settings(true);
                        break;

                    

                }
            }
        }
    }

    function unlog(){
        var answer = confirm("Are you sure you want to log out ?");
        if (answer){
            get_data({}, "logout"); 
        }
    }

    get_data({}, "user_info");
    get_contacts({}, "contacts");

    var radio_contacts = _("radio_contacts");
    radio_contacts.checked = true;

    function get_contacts(e){
        get_data({}, "contacts"); 
    }

    function get_receiveFriends(e){
        get_data({}, "receive_friends"); 
    }

    function get_chats(e){
        get_data({}, "chats"); 
    } 

    function get_settings(e){
        get_data({}, "settings"); 
    }

    function get_addFriends(e){
        get_data({}, "addFriends");
    }

	function send_message(e)
	{

		var message_text = _("message_text");
		if(message_text.value.trim() == ""){
			
			alert("please type something to send");
			return;
		}

 		get_data({

			message:message_text.value.trim(),
			userid :CURRENT_CHAT_USER

		},"send_message");

	}

    function enter_pressed(e){
        
        if (e.keyCode == 13){
            send_message(e);
        }

        SEEN_STATUS = true;
    }

    setInterval(() => {
        
        var radio_chat = _("radio_chat");
        var radio_contacts = _("radio_contacts");

        if(CURRENT_CHAT_USER != "" && radio_chat.checked){
            get_data({
                userid:CURRENT_CHAT_USER,
                seen:SEEN_STATUS
            }, "chats_refresh");

        }

        if(radio_contacts.checked){

            get_data({}, "contacts");

        }


    }, 3000);

    function set_seen(e){
        SEEN_STATUS = true;
    }

    function delete_message(e)
	{

		if(confirm("Are you sure you want to delete this message ?")){

			var msgid = e.target.getAttribute("msgid");

			get_data({
    				rowid:msgid
    			},"delete_message");

			get_data({
    				userid:CURRENT_CHAT_USER,
    				seen:SEEN_STATUS
    			},"chats_refresh");
		}
	}

    function delete_thread(e)
	{

		if(confirm("Are you sure you want to delete this whole thread ?")){

			get_data({
    				userid:CURRENT_CHAT_USER
    			},"delete_thread");

			get_data({
    				userid:CURRENT_CHAT_USER,
    				seen:SEEN_STATUS
    			},"chats_refresh");
		}
	}

    

</script>

<script>

    function collect_data(){

        var save_settings_button = _("save_settings_button");
        save_settings_button.disabled = true;
        save_settings_button.value = "Loading...Please wait.";

        var myform = _("myform");
        var inputs = myform.getElementsByTagName("INPUT");

        var data = {};
        for (var i = inputs.length - 1; i >= 0; i--){

            var key = inputs[i].name;
            switch(key){

                case "username":
                    data.username = inputs[i].value;
                    break;

                case "email":
                    data.email = inputs[i].value;
                    break;

                case "gender":
                    if(inputs[i].checked){
                        data.gender = inputs[i].value;
                    }
                    break;
                    
                case "password":
                    data.password = inputs[i].value;
                    break;

                case "password2":
                    data.password2 = inputs[i].value;
                    break;
                
                case "password2again":
                    data.password2again = inputs[i].value;
                    break;
                    
                case "current_password":
                    data.current_password = inputs[i].value;
                    break;
            }

        }

        send_data(data, "save_settings");
    }

    function send_data(data, type){

        var xml = new XMLHttpRequest();

        xml.onload = function(){

            if (xml.readyState == 4 || xml.status == 200){

                handle_result(xml.responseText);
                var save_settings_button = _("save_settings_button");
                save_settings_button.disabled = false;
                save_settings_button.value = "Sign Up";
            }

        }

        data.data_type = type;
        var data_string = JSON.stringify(data);

        xml.open("POST", "api.php", true);
        xml.send(data_string);
    }

    function upload_profile_image(files){
    
        var change_image_button = _("change_image_button");
        change_image_button.disabled = true;
        change_image_button.innerHTML = "Uploading Image";

        var myform = new FormData();

        var xml = new XMLHttpRequest();

        xml.onload = function(){

            if (xml.readyState == 4 || xml.status == 200){

                // alert(xml.responseText);
                get_data({}, "user_info");
                get_settings(true);
                change_image_button.disabled = false;
                change_image_button.innerHTML = "Change Image";
            }

        }

        myform.append('file', files[0]);
        myform.append('data_type', "change_profile_image");

        xml.open("POST", "uploader.php", true);
        xml.send(myform);
    }

    function handle_drag_and_drop(e){

        console.log(e.type);

        if (e.type == "dragover"){
            
            e.preventDefault();
            e.target.className = "dragging";
        } 

        else if (e.type == "dragleave") {

            e.preventDefault();
            e.target.className = "";
        }

        else if (e.type == "drop"){

            e.preventDefault();
            e.target.className = "";
            
            if(e.dataTransfer.files['length']  > 1){
                alert("Too many files uploaded.")
            } else {
                var fileDropped = e.dataTransfer.files;
                upload_profile_image(fileDropped);
            }
        }
        else {
           e.target.className = ""; 
        }


    }

    function start_chat(e){

        var userid = e.target.getAttribute("userid");
        if (e.target.id == ""){
            userid = e.target.parentNode.getAttribute("userid");
        } 

        CURRENT_CHAT_USER = userid;

        var radio_chat = _("radio_chat");
        radio_chat.checked = true;
        get_data({userid:CURRENT_CHAT_USER}, "chats");
    }

    function send_image(files) {

        var file_types = ["jpg", "png"];

        for (var file = 0; file < files.length; file++){

            var file_array = files[file].name.split(".")
            var file_type_by_user = file_array[file_array.length-1].toLowerCase();
            if (file_types.includes(file_type_by_user)){
                var myform = new FormData();
                var xml = new XMLHttpRequest();

                xml.onload = function(){

                    if(xml.readyState == 4 || xml.status == 200){

                        handle_result(xml.responseText,"send_image");
                        get_data({
                            userid:CURRENT_CHAT_USER,
                            seen:SEEN_STATUS
                        },"chats_refresh");
                    }
                }

                myform.append('file',files[file]);
                myform.append('data_type',"send_image");
                myform.append('userid',CURRENT_CHAT_USER);
        
                xml.open("POST","uploader.php",true);
                xml.send(myform);
            }
            else{
                alert("File type not supported");
                continue;
            }
        }
    }

    function close_image(e) {
        const image_viewer = document.getElementById("image_viewer");
        image_viewer.className = "image_off";
        image_viewer.children[0].classList.add("invisible");
    }

    function image_show(e){
        var image = e.target.src;
        var image_viewer = _("image_viewer");
        image_viewer.style.backgroundImage = "url('" + image + "')";
        image_viewer.style.backgroundSize = "cover";
        image_viewer.className = "image_on";
        image_viewer.children[0].classList.remove("invisible");
    }

function searchUsers() {
    let input = document.getElementById("input_bar").value.trim();

    if (input.length == 0) {
        document.getElementById("results").innerHTML = "";
        return;
    }

    let data = {
        find: input,
        data_type: "addFriends"
    };

    let ajax = new XMLHttpRequest();
    ajax.onload = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            let obj = JSON.parse(ajax.responseText);
            if (typeof obj.data_type !== "undefined" && obj.data_type == "addFriends_results") {
                document.getElementById("results").innerHTML = obj.message;
            }
        }
    };

    ajax.open("POST", "api.php", true);
    ajax.setRequestHeader("Content-Type", "application/json");
    ajax.send(JSON.stringify(data));
}

function send_friend(e) {
    var friend_to = e.currentTarget.getAttribute("userid");

    let data = {
        userid: friend_to,
        data_type: "send_friend"
    };

    let ajax = new XMLHttpRequest();
    ajax.onload = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            let obj = JSON.parse(ajax.responseText);
            if (typeof obj.data_type !== "undefined" && obj.data_type == "send_friend_result") {
                document.getElementById("results").innerHTML = obj.message;
            }
        }
    };

    ajax.open("POST", "api.php", true);
    ajax.setRequestHeader("Content-Type", "application/json");
    ajax.send(JSON.stringify(data));
}

function accept_request(e){
    var friend_from = e.currentTarget.parentNode.getAttribute("userid");
    e.currentTarget.parentNode.style.display = "none";

    let data = {
        senderid: friend_from,
        do: "accept",
        data_type: "result_friend"
    };

    let ajax = new XMLHttpRequest();
    ajax.onload = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            let obj = JSON.parse(ajax.responseText);
            if (typeof obj.data_type !== "undefined" && obj.data_type == "friend_request_action") {
                document.getElementById("request").innerHTML = obj.message;
            }
        }
    };

    ajax.open("POST", "api.php", true);
    ajax.setRequestHeader("Content-Type", "application/json");
    ajax.send(JSON.stringify(data));
}

function decline_request(e){
    var friend_from = e.currentTarget.parentNode.getAttribute("userid");
    e.currentTarget.parentNode.style.display = "none";

    let data = {
        senderid: friend_from,
        do: "decline",
        data_type: "result_friend"
    };

    let ajax = new XMLHttpRequest();
    ajax.onload = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            let obj = JSON.parse(ajax.responseText);
            if (typeof obj.data_type !== "undefined" && obj.data_type == "friend_request_action") {
                document.getElementById("request").innerHTML = obj.message;
            }
        }
    };

    ajax.open("POST", "api.php", true);
    ajax.setRequestHeader("Content-Type", "application/json");
    ajax.send(JSON.stringify(data));
}



</script>

</html>
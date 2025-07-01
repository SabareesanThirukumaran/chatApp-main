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
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal
    }

    #wrapper {
        color: grey;
        max-width: 900px;
        min-height: 500px;
        margin: auto;
    }

    #header {
        width: 100%;
        background-color: #485b6c;
        color: #fff;
        font-weight: 700;
        font-size: 50px;
        text-align: center;
        font-family: "Nunito", sans-serif;
        font-optical-sizing: auto;
        font-style: normal
    }

    form  {
        margin: auto;
        padding: 10px;
        width: 100%;
        max-width: 400px;
    }

    input[type=text], input[type=password], input[type=submit] {
        padding: 10px;
        margin: 10px;
        width: 98%;
        border-radius: 10px;
        border: solid 1px grey;
    }

    input[type=submit] {
        width:104%;
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



</style>

<body>

    <div id="wrapper">

        <div id="header">
            My Chat
            <div style="font-size: 20px; padding: 10px;">Login</div>
        </div>
        <div id="error">OH NO AN ERRORQ</div>
        <form action="" id="myform">
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" value="Login" id="login_button"><br>

            <br>
            <a href="signup.php" style="display: block; text-align:center; text-decoration: none;">Dont have an account ? Signup here</a>
        </form>
    </div>

</body>
<script>

    function _(ele){
        return document.getElementById(ele);
    }

    var login_button = _("login_button");
    login_button.addEventListener("click", collect_data);

    function collect_data(e){

        e.preventDefault();
        login_button.disabled = true;
        login_button.value = "Loading...Please wait.";

        var myform = _("myform");
        var inputs = myform.getElementsByTagName("INPUT");

        var data = {};
        for (var i = inputs.length - 1; i >= 0; i--){

            var key = inputs[i].name;
            switch(key){

                case "email":
                    data.email = inputs[i].value;
                    break;

                case "password":
                    data.password = inputs[i].value;
                    break;

            }

        }

        send_data(data, "login");
    }

    function send_data(data, type){

        var xml = new XMLHttpRequest();

        xml.onload = function(){

            if (xml.readyState == 4 || xml.status == 200){

                handle_result(xml.responseText);
                login_button.disabled = false;
                login_button.value = "Login";
            }

        }

        data.data_type = type;
        var data_string = JSON.stringify(data);

        xml.open("POST", "api.php", true);
        xml.send(data_string);
    }

    function handle_result(result){
        var data = JSON.parse(result);
        if(data.data_type == "info"){
            
            window.location = "index.php";
        } else {

            var error = _("error");
            error.innerHTML = data.message;
            error.style.display = "block";
        }
    }

</script>
</html>
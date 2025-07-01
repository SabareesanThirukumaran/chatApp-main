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

    input[type=text], input[type=password], input[type=button] {
        padding: 10px;
        margin: 10px;
        width: 98%;
        border-radius: 10px;
        border: solid 1px grey;
    }

    input[type=button] {
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
            <div style="font-size: 20px; padding: 10px;">Sign Up</div>
        </div>
        <div id="error">OH NO AN ERRORQ</div>
        <form action="" id="myform">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <div style="padding: 10px">
                <br>Gender:<br>
                <input type="radio" value="Male" name="gender_male"> Male<br>
                <input type="radio" value="Female" name="gender_female"> Female<br>
            </div>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="password2" placeholder="Retype Password"><br>
            <input type="button" value="Sign Up" id="signup_button"><br>
        </form>
        <a href="login.php" style="display: block; text-decoration: none; text-align: center;">Already have an account ? Log in here</a>
    </div>

</body>
<script>

    function _(ele){
        return document.getElementById(ele);
    }

    var signup_button = _("signup_button");
    signup_button.addEventListener("click", collect_data);

    function collect_data(){

        signup_button.disabled = true;
        signup_button.value = "Loading...Please wait.";

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

                case "gender_male":
                case "gender_female":
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
            }

        }

        send_data(data, "signup");
    }

    function send_data(data, type){

        var xml = new XMLHttpRequest();

        xml.onload = function(){

            if (xml.readyState == 4 || xml.status == 200){

                handle_result(xml.responseText);
                signup_button.disabled = false;
                signup_button.value = "Sign Up";
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
            error.innerHTML = data.message
            error.style.display = "block";
        }
    }

</script>
</html>
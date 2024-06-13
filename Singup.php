<?php




//SingUp.php
/*
require "./php/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $password = $_POST['pass'];

    $sql = "SELECT id, name, password FROM users WHERE name = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $username, $hashed_password);
                if ($stmt->fetch()) {
                    //if (password_verify($password, $hashed_password)) {
                        if ($password == $hashed_password) {
                        echo "Login successful!";
                        // Start a session and store user information if needed
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['id']=$id;
                        header("Location: ./index.php");
                        } else {
                                echo "Invalid password.";   
                        }
                    }
                } else {
                    echo "No account found with that username.";
                }
            } else {
            echo "Error: Could not execute query: " . $con->error;
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare query: " . $con->error;
    }
    $con->close();
}*/



?>

<?php 
require_once "./php/config.php";
session_start();

$error_email="";
$error_password="";
$error_confirm="";
$public_error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username= $_POST["username"];
    $email=$_POST["email"];
    $password= $_POST["pass"];
    $confirm= $_POST["consfirm-pass"];

    if(!empty($username)&& !empty($email) && !empty($password) && !empty($confirm) ){
        
        if( $password== $confirm){
            $sql = "SELECT email FROM users WHERE email = ?";
            if($stmt = $con->prepare($sql)){
                $stmt->bind_param("s", $email);


                if($stmt->execute()){
                    $stmt->store_result();


                    if($stmt->num_rows != 0){
                       $error_email= "this email is already exists!";
                    }else{
                        creat_account($username,$email,$password);
                    }
                }
                $stmt->close();

            
            }else{
                echo "Error: Could not prapare query: " . $con->error;
            }

        }else{
            $error_confirm= "please confirm the password";
        }
    }else{
        $public_error = "All Fields Required ";
    }

}



function creat_account($username,$email,$password){
    require_once "./php/config.php";
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    if($stmt = $con->prepare($sql)){
    $hash_pass=password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hash_pass);
        if( $stmt->execute()){
            $sql="SELECT id FROM users WHERE email = ?";
            if($stmt=$con->prepare($sql)){
                $stmt->bind_param("s", $email);
                if($stmt->execute()){
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($id);
                        $stmt->fetch();
                        $_SESSION["id"]=$id;
                        header("location:index.php");
                        $con->close();
                        exit();
                    }   
                }
            }
            echo " Creat Account Successfuly";
        }else{
        echo "Error: Could not execute query: " . $con->error;
       }   
    }else{
        echo "Error: Could not prapare query: " . $con->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
    <title>login DeepSpace</title>
    <style>
    :root {
        --main-color: #10cab7;
        --secondary-color: #2c4755;
    }

    .father {
        width: 100%;
        height: 100vh;
        background-image: url('./imgs/header.jpg');
        background-size: cover;

    }

    .login {
        background-color: #0000007a;
        text-align: center;
        width: 90%;
        backdrop-filter: blur(10px);
        padding: 0px 50px 80px;
        height: fit-content;
        border-bottom: 3px solid var(--main-color);
        border-radius: 21px;
        box-shadow: 0px 8px 19px var(--main-color);
    }


    .login input,
    .login label {
        margin: 5px auto !important;
    }

    .err-color {
        color: red;
    }

    .login input {
        background-color: #10c3ca4a;
        color: white;
        padding: 3px 11px;
    }

    .login input[type="submit"] {
        background-color: green;
        padding: 3px 20px;
        margin: 26px auto auto !important;
    }



    @media only screen and (min-width:600px) {
        .login {
            min-width: 420px;
            width: 30vw;
        }
    }

    input {
        border-radius: 7px;
        padding: 2px 3px;
        outline: none;
        width: 80%;
    }

    .login .links {
        color: aqua;
        width: 80%;
        margin: auto;
        padding: 5px 0px;
    }

    .login .links a {
        text-decoration: none;
        color: #00ffe5;
    }

    .icon-color {
        color: var(--main-color);
    }
    </style>
</head>

<body>

    <div class="father d-flex justify-content-center align-items-center">
        <form action="" method="POST" class="login ">
            <h1 class="d-block pt-3 p-4 m-auto fit-content" style="color:var(--main-color)">Singup</h1>
            <label class="d-block  m-auto w-fit-content" for="name">
                <i class="fa-solid fa-user fs-5 icon-color"></i></label>
            <input class=" d-block  m-auto " type="text" name="username" id="username" placeholder="username">




            <label class="d-block  m-auto w-fit-content" for="email">
                <i class="fa-solid fa-email fs-5 icon-color">Email</i></label>
            <input class=" d-block  m-auto " type="text" name="email" id="email" placeholder="Email : example@ex.com">
            <label id="error-email" class='d-block  m-auto w-fit-content err-color'>
                <?php echo $error_email? $error_email:"" ?> </label>



            <label class="d-block m-auto" for="pass"><i class="fa-solid fa-key fs-5 icon-color"></i></label>
            <input class="d-block m-auto" type="password" name="pass" id="pass" placeholder="Password">
            <label id="error-pass" class='d-block  m-auto w-fit-content err-color'> </label>



            <label class="d-block m-auto" for="pass"> <i class="fa-solid fa fs-5 icon-color">Con<i
                        class="fa-solid fa-key fs-5 icon-color">firm</i></i></label>
            <input class="d-block m-auto" type="password" name="consfirm-pass" id="con-pass"
                placeholder="Confirm Password">
            <label id="error-confirm" class='d-block  m-auto w-fit-content err-color'>
                <?php echo $error_confirm? $error_confirm:"" ?>
            </label>


            <input class="d-block  " type="submit" value="login">
            <div class=" links d-flex align-items-center justify-content-between ">
                Have Account?<a class="pe-2" href="./login.php">Login</a>
            </div>



        </form>
    </div>
    <script>
    let er_email = document.getElementById("error-email");
    let email = document.getElementById("email");
    email.addEventListener("change", (e) => {
        // alert(email.value);
        if (email.value.trim().search(/^[a-zA-Z0-9\.+%-_]{3,}@[a-zA-Z]{3,}\.[a-zA-Z]{3}$/) == -1) {
            // alert("the email is not correct ");
            er_email.textContent = "Invalid Email should be like : example@exp.com";
            email.style.backgroundColor = "#ff000082 ";
            email.focus();
        } else {
            er_email.textContent = "";
            email.style.backgroundColor = "#10c3ca4a";
        }
    });

    let pass = document.getElementById("pass");
    let confirm = document.getElementById("confirm-pass");
    let errorPass = document.getElementById("error-pass");
    let errorConfirm = document.getElementById("error-confirm");

    pass.addEventListener("change", (e) => {

        const hasNumber = /[0-9]/;
        const hasLowerCase = /[a-z]/;
        const hasUpperCase = /[A-Z]/;
        const hasSpecialChar = /[}{\]\[!@#$%^&*()_\-+=]/;

        // Check if the password meets all the requirements
        if (pass.value.length >= 8 && hasNumber.test(pass.value) && hasLowerCase.test(pass.value) &&
            hasUpperCase.test(pass.value) && hasSpecialChar.test(pass.value)) {
            errorPass.textContent = "";
            pass.style.backgroundColor = "#10c3ca4a";
        } else {
            errorPass.textContent =
                "Password should be more than 8 character and must contain at least one number, one lowercase letter, one uppercase letter, and one special character.";
            pass.style.backgroundColor = "#ff000082 ";
            pass.focus();
        }
    });

    confirm.addEventListener("change", (e) => {
        if (pass.value != confirm.value) {
            errorConfirm.textContent = "Invalid Confirm";
            errorConfirm.style.backgroundColor = "#ff000082";
            confirm.focus();
        } else {
            errorConfirm.textContent = "";
            errorConfirm.style.backgroundColor = "#10c3ca4a";
        }
    });
    </script>
</body>

</html>
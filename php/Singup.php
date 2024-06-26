<?php 
require_once "./config.php";
session_start();

$error_email="";
$error_password="";
$error_confirm="";
$public_error="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // $username= trim($_POST["username"]);
    $username = trim(filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS));
    // $email=trim($_POST["email"]);
    $email=trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
    $password= trim($_POST["pass"]);
    $confirm= trim($_POST["confirm-pass"]);


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
                        creat_account($username,$email,$password,$con);
                    }
                }
                $stmt->close();

            
            }else{
                // echo "Error: Could not prapare query: " . $con->error;
                $public_error="Please Retry Again";
            }

        }else{
            $error_confirm= "Please confirm the password";
        }
    }else{
        $public_error = "All Fields Required ";
    }

}



function creat_account($username,$email,$password,$con){
    require_once "./config.php";
    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    if($stmt = $con->prepare($sql)){
    $hash_pass=password_hash($password,PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hash_pass);
        if( $stmt->execute()){
            $sql="SELECT id_u FROM users WHERE email = ?";
            if($stmt=$con->prepare($sql)){
                $stmt->bind_param("s", $email);
                if($stmt->execute()){
                    $stmt->store_result();
                    if($stmt->num_rows>0){
                        $stmt->bind_result($id);
                        $stmt->fetch();
                        $_SESSION["id"]=$id;
                        $_SESSION["name"]=$username;
                        $_SESSION["email"]=$email;
                        header("location:../index.php");
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
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css.map">
    <link rel="stylesheet" href="../css/singup.css">
    <title>Singup DeepSpace</title>
    <style>

    </style>
</head>

<body>

    <div class="father d-flex justify-content-center align-items-center">
        <form action="" method="POST" class="login " id="form">
            <h1 class="d-block pt-3  m-auto fit-content" style="color:var(--main-color)">DeepSpace</h1>
            <h1 class="d-block pt-3 p-4 m-auto fit-content" style="color:var(--main-color)">Singup</h1>
            <label id="public-error" class='d-block  m-auto w-fit-content err-color'>
                <?php echo $public_error? $public_error:"" ?> </label>



            <label class="d-block  m-auto w-fit-content" for="name">
                <i class="fa-solid fa-user fs-5 icon-color"></i></label>
            <input required class=" d-block  m-auto " type="text" name="username" id="username" placeholder="username">




            <label class="d-block  m-auto w-fit-content" for="email">
                <i class="fa-solid fa-email fs-5 icon-color">Email</i></label>
            <input required class=" d-block  m-auto " type="text" name="email" id="email"
                placeholder="Email : example@ex.com">
            <label id="error-email" class='d-block  m-auto w-fit-content err-color'>
                <?php echo $error_email? $error_email:"" ?> </label>



            <label class="d-block m-auto" for="pass"><i class="fa-solid fa-key fs-5 icon-color"></i></label>
            <input required class="d-block m-auto" type="password" name="pass" id="pass" placeholder="Password">
            <label id="error-pass" class='d-block  m-auto w-fit-content err-color'> </label>



            <label class="d-block m-auto" for="confirm-pass"> <i class="fa-solid fa fs-5 icon-color">Con<i
                        class="fa-solid fa-key fs-5 icon-color">firm</i></i></label>
            <input required class="d-block m-auto" type="password" name="confirm-pass" id="confirm-pass"
                placeholder="Confirm Password">
            <label id="error-confirm" class='d-block  m-auto w-fit-content err-color'>
                <?php echo $error_confirm? $error_confirm:"" ?>
            </label>


            <input class="d-block" id="submit" type="submit" value="Singup">
            <div class=" links d-flex align-items-center justify-content-between ">
                Have Account?<a class="pe-2" href="./login.php">Login</a>
            </div>



        </form>
    </div>
    <script>
    let er_email = document.getElementById("error-email");
    let email = document.getElementById("email");
    email.addEventListener("change", (e) => {
        if (email.value.trim().search(/^[a-zA-Z0-9\.+%-_]{3,}@[a-zA-Z]{3,}\.[a-zA-Z]{3}$/) == -1) {
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

    let login = document.getElementById("submit"),
        username = document.getElementById("username"),
        public_error = document.getElementById("public-error");
    login.disabled = "false";

    confirm.addEventListener("blur", (e) => {
        if (email.value == "" && pass.value == "" && confirm.value == "" && username.value == "") {
            public_error.textContent = "All Fields Are Required";
        } else {

            public_error.textContent = "";
        }
    });
    confirm.addEventListener("change", (e) => {
        if (pass.value !== confirm.value) {
            confirm.style.backgroundColor = "#ff000082";
            errorConfirm.textContent = "Invalid Confirm";
            confirm.focus();
        } else {
            errorConfirm.textContent = "";
            confirm.style.backgroundColor = "#10c3ca4a";
        }
    });
    document.getElementById("form").addEventListener("mouseover", (e) => {
        if (email.value !== "" && pass.value !== "" && confirm.value === pass.value && username.value !== "") {
            login.disabled = "";
            login.style.backgroundColor = "green"
        } else {
            login.disabled = "false";
            login.style.backgroundColor = "#00800000"
        }
    });
    </script>
</body>

</html>
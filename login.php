<?php




//login.php
require "./php/config.php";
session_start();

$error_pass="";
$error_email="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email =trim( $_POST['email']);
    $password = trim($_POST['pass']);
    if($email==""){$error_email="please type your email"; }
    else{
        $sql = "SELECT id_u, name,password FROM users WHERE email = ?";
        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {

                            if (password_verify($password,$hashed_password)  ) {
                            echo "Login successful!";

                            $_SESSION['name'] = $username;
                            $_SESSION["email"]=$email;
                            $_SESSION['id']=$id;    
                        header("Location: index.php");
                        $con->close();
                            exit();
                            } else {
                                session_unset();
                                session_destroy();
                                $error_pass= "Invalid password.";   
                        }
                    }
                } else {
                    $error_email= "Account Not found ";
                }
            }
            $stmt->close();
        } 
    }
    $con->close();
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

    .err-color {
        color: red;
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
            <h1 class="d-block pt-3  m-auto fit-content" style="color:var(--main-color)">DeepSpace</h1>
            <h1 class="d-block pt-3 p-4 m-auto fit-content" style="color:var(--main-color)">login</h1>
            <label class="d-block  m-auto w-fit-content" for="name"><i
                    class="fa-solid fa-user fs-5 icon-color"></i></label>
            <input class=" d-block  m-auto " type="text" name="email" id="" placeholder="email">
            <?php echo $error_email? " <label class='d-block  m-auto w-fit-content err-color' > $error_email  </label>":""  ?>

            <label class="d-block m-auto" for="pass"><i class="fa-solid fa-key fs-5 icon-color"></i></label>
            <input class="d-block m-auto" type="password" name="pass" id="" placeholder="Password">
            <?php echo $error_pass? " <label class='d-block  m-auto w-fit-content err-color' > $error_pass  </label>":""  ?>
            <input class="d-block  " type="submit" value="login">
            <div class=" links d-flex align-items-center justify-content-between ">
                Dosen't have Account?<a class="pe-2" href="./Singup.php">Singup</a>
            </div>



        </form>
    </div>
    <script>
    </script>

</body>

</html>
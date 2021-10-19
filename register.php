<?php
// Initialize the session
session_start();
require_once "config.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = ""; 

if($_SERVER['REQUEST_METHOD'] == "POST"){
   
    // check to ensure that name is not empty
    
    if(empty(trim($_POST['username']))){
        $name_err = "username cannot be blank";
    }
    // check to determine if the username already exists
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn,$sql);

        if($stmt){
            mysqli_stmt_bind_param($stmt,"s",$param_username);

            // setting the value of $param_username

            $param_username = trim($_POST['username']);

            // check to see whether the statement gets executed

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1){
                    $username_err = "This username is already taken";
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }

    
    
    // check to ensure password is not empty

    if(empty(trim($_POST['password']))){
        $password_err = "password cannot be empty";
    }

    // check to ensure that password length is min 5 characters

    elseif(strlen(trim($_POST['password'])) < 5){
        $password_err = "password cannot be less than 5 characters";
    }

    else{
        $password = trim($_POST['password']);
    }

    // check to ensure password confirms

    if(trim($_POST['password']) != trim($_POST['confirm_password']) ){
        $password_err = "passwords should match";
    }

    // if there are no errors, go ahead and insert the values into the database

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users (username,password) VALUES(?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        
        if($stmt){
            mysqli_stmt_bind_param($stmt, "ss", $param_username,$param_password);

            $param_username = $username;
            $param_password = password_hash($password,PASSWORD_DEFAULT);

            // Trying to execute the query

            if(mysqli_stmt_execute($stmt)){
                header("location: index.php");
            }
            else{
                echo "Something went wrong, please try again";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register to UpShot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <style>
        html,body{
           overflow-x: hidden;
       }
       
        body{
            margin: 0px;
            padding: 0px;
            background: url('https://www.wallpapertip.com/wmimgs/83-838362_web-developer.jpg') no-repeat center center fixed;
            position: relative;
            background-size: cover;
            font-family: 'Acme', sans-serif; 
            text-align: center;
        }
        .formsec{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction:column;
            color: white;
            font-family: 'Acme', sans-serif; 
            font-size: 1.1rem;
            height: 105vh;
        }
        .input{
            display: flex;
        }
        .input input{
            margin: 10px 525px;
            border-radius: 23px;
            font-family: 'Acme', sans-serif;
            text-align: center;
            padding-top: 18px;
            padding-bottom: 18px;
            padding-left: 70px;
            padding-right: 70px;
        }
        .btn{
            background-color: black;
            color: white;
            font-family: 'Acme', sans-serif;
            border-radius: 23px;
            padding-left: 40px;
            padding-right: 40px;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .regbox{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        #success{
            font-family: 'Acme', sans-serif;
            text-align: center;
        }
        @media(max-width: 750px) and (min-width:500px){
            .formsec{
                height: 175vh;
            }
    
        }
    </style>
</head>
<body>
    <section class = "formsec">
        <h1>Join UpShot</h1>
        <div class="regbox">
            <form action="" method = "post" class="regform">
                <div class="input">
                    <input type="text"  name ="username"placeholder="username">
                </div>
                <div class="input">
                    <input type="password" name = "password" placeholder="Password">
                </div>
                <div class="input">
                    <input type="password" name = "confirm_password" placeholder="Confirm Password">
                </div>
                <br>
                <button type = "submit" class = "btn"> Register</button>
            </form>
            <br>
            <pre id = "success">
*after successful registration you'll be 
redirected to the index page, where you can 
login using the registered credentials.
            </pre>
        </div>
    </section>
    
</body>
</html>
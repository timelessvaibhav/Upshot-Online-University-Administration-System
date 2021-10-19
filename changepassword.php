<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 5){
        $new_password_err = "Password must have atleast 5 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">

    <style>
        body{
            margin: 0px;
            padding: 0px;
            background: url('https://www.agdelta.com/wp-content/uploads/2018/06/website-parallax-background-C.jpg') no-repeat center center fixed;
            overflow: hidden;
            background-size: cover;
            font-family: 'Acme', sans-serif; 
            color: white;
            text-align: center;
        }
        #navbar{
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
            position: relative;
            top: 0px;
            font-family: 'Acme', sans-serif;
        }     
         #navbar ul{
            display: flex;
        }

         #navbar::before{
            content: "";
            background-color: black;
            position:absolute;
            height: 100%;
            width: 100%;
            z-index: -1;
            opacity: 0.0;
        }

         #navbar ul li{
            list-style: none;
            font-size: 1.2rem;
        }
         #navbar ul li a{
            color: white;
            display: block;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 2px;
            padding-right: 30px;

            text-decoration: none;
            border-radius: 5px;
        }        
         #navbar ul li a:hover{
            color: gray;
         }
        .formdiv{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            font-family: 'Acme', sans-serif; 
            text-align:center;
        }
        .formsec{
            height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:center;
            font-family: 'Acme', sans-serif; 
        }
        input{
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 50px;
            padding-right: 50px;
            margin: 10px;
            border-radius: 23px;
            font-family: 'Acme', sans-serif; 
            text-align: center;
        }
        button{
            background-color: black;
            padding-top: 15px;
            padding-bottom: 15px;
            padding-left: 45px;
            padding-right: 45px;
            text-align: center;
            border-radius: 23px;
            color: white;
            font-family: 'Acme', sans-serif; 
        }
    </style>
</head>
<body>
    <nav id="navbar">
        <ul>
            <li class="item"><a href="welcome.php">Home</a></li>
        </ul>
    </nav>
    <section class = "formsec">
        <div class = "formdiv">
            <h1>Change Password</h1>
            <form action="" method = "post">
                <div class="inputf">
                    <input type="password" name = "new_password" placeholder = "Enter new Password">
                </div>
                <div class="inputf">
                    <input type="password" name = "confirm_password" placeholder = "Confirm new Password">
                </div>
                <br>
                <button type = "submit">
                    Submit
                </button>
            </form>
            <br>
            *After successful reset, you'll be redirected to home page from where you can login using the updated password
        </div>
    </section>
</body>
</html>

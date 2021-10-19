<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
    <title>UpShot</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
</head>

<body>
    <nav id="navbar">
        <ul>
            <li class="item"><a href="register.php">New To UpShot? Register here</a></li>
        </ul>
    </nav>

    <section id="home">
        <h1 class="heading center">Welcome To UpShot</h1>
        <br>
        <p>
            Online University Administration System
        </p>
    </section>

    <section class="services">

        <div id="services">
            <div class="box">
                <h1 class="hsecondary center">Easy to manage</h1>
                <br>
                <p class="center">
                    With all your data and information at one place UpShot makes it easier
                    to manage the data of a large amount of candidates at once.
                </p>
            </div>
            <div class="box">
                <h2 class="hsecondary center">Safe & Secure</h2>
                <br>
                <p class="center">
                    With a unique user ID and password for each student and manipulation rights only with the
                    administrator,
                    your data remains safe and free from any kind of threat.
                </p>
            </div>
            <div class="box">
                <h2 class="hsecondary center">Fast & efficient</h2>
                <br>
                <p class="center">
                    UpShot comes with a simple and easy to understand user interface,
                    so your process of data access becomes fast and convenient.
                </p>
            </div>

        </div>

    </section>

    <section id="login">

    <h1 class="hprimary center">Student</h1>
        <div id="formbox">
            <form id="student" action = "viewresult.php" method = "get">

                <div class="inputfield">
                    <input type="text"  name = "studentname"placeholder="Name">
                </div>
                <div class="inputfield">
                    <input type="text" name = "studentid" placeholder="Student id">
                </div>

            </form>
            <button class="btn center" form = "student" type = "submit">
                Login
            </button>
            <br><br>
            <h1 class="hprimary center">Administrator</h1>
            <form id="admin" method = "post">
                <div class="inputfield">
                    <input type="text" name = "username" placeholder="username">
                </div>
                <div class="inputfield">
                    <input type="password" name = "password" placeholder="Password">
                </div>

            </form>
            <button form = "admin" class="btn center">
                Login
            </button>

        </div>


    </section>

</body>

</html>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <Style>
     body{
         margin: 0px;
         padding 0px;
         background: url('https://www.agdelta.com/wp-content/uploads/2018/06/website-parallax-background-C.jpg') no-repeat center center fixed;
         background-size: cover;
         font-family: 'Acme', sans-serif;
         color: white;
     }
     .asec{
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: center;
         height: 110vh;
     }
     .acontainer{
         display: flex;
         flex-direction: column;
     }
     a{
         color: black;
         text-decoration: none;
         margin: 20px;
         padding: 35px;
         padding-left: 52px;
         background-color: #fbf7f78c;
         border-radius: 23px;
         text-align: center;
     }
     a:hover{
         background-color: #fbf7f7cc;
     }
     @media(max-width: 450px) and (min-width:375px){
            .asec{
                height: 125vh;
            }
    }

    @media(max-width: 736px) and (min-width:451px){
            .asec{
                height: 220vh;
            }
    }
    </Style>
</head>
<body>
    <section class = "asec">
       <h3> Welcome, How would you like to proceed?</h3>
        <div class="acontainer">
            <a href="createrecord.php">Create a new student record</a>
            <a href="viewrecords.php">View all student records</a>
            <a href="delete.php">Delete an existing record</a>
            <a href="changepassword.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </section>
</body>
</html>
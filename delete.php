<?php
// Initialize the session
   session_start();
if(isset($_POST['studentid'])){

    require_once "config.php";
    $sql = "DELETE FROM `students` WHERE `students`.`Student id` = '$_POST[studentid]'";
        if(mysqli_query($conn,$sql)){
        $message = '<span style = "text-align: center"> Record successfully deleted</span>';
        echo $message;
    }
    else{
        $message = '<span style = "text-align: center"> ERROR, please Try Again</span>';
        echo $message;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete a Student Record</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">

    <style>
        body{
            margin: 0px;
            padding: 15px;
            background: url('https://www.rushdah-ir.com/wp-content/uploads/2018/03/sliders1-1.jpg') no-repeat center center fixed;
            overflow: hidden;
            background-size: cover;
            font-family: 'Acme', sans-serif; 
            color: white;
            text-align: center;
        }
        #navbar{
            display: flex;
            flex-direction: row;
            align-items: center;
            position: fixed;
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
            font-size: 1.1rem;
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
            height: 85vh;
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
            <li class="item"><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    <section class = "formsec">
        <div class = "formdiv">
            <h3>Enter the student id of the record to be deleted</h3>
            <form action="" method = "post">
                <div class="inputf">
                    <input type="text" name = "studentid" placeholder = "Student id">
                </div>
                <br>
                <button type = "submit">
                    Delete 
                </button>
            </form>
        </div>
    </section>
</body>
</html>




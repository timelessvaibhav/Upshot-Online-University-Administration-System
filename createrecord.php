<?php
// Initialize the session
   session_start();

if(isset($_POST['name'])){

     require_once "config.php";

     $studentid = $_POST['studentid'];
     $department = $_POST['department'];
     $name = $_POST['name'];
     $semester = $_POST['semester'];
     $examination = $_POST['examination'];
     $subject1 = $_POST['subject1'];
     $subject2 = $_POST['subject2'];
     $subject3 = $_POST['subject3'];
     $subject4 = $_POST['subject4'];
     $subject5 = $_POST['subject5'];

     $sql = "INSERT INTO `students` (`Student id`, `Department`, `Name`, `Semester`, `Examination`, `Subject 1`, `Subject 2`, `Subject 3`, `Subject 4`, `Subject 5`) VALUES ('$studentid', '$department', '$name', '$semester', '$examination', '$subject1', '$subject2', '$subject3', '$subject4', '$subject5');";



    if($conn->query($sql) == true){
        echo"Record Successfully Created";
    }
     else{
    echo"Error, please Try again";
    }

     $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <style>
         body{
            margin: 0px;
            padding: 0px;
            background: url('https://tombrown.online/wp-content/uploads/2018/04/8314929977_36b1d58cf6_o.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Acme', sans-serif; 
            color: white;
            text-align: center;
        }
          #navbar{
            display: flex;
            flex-direction: row;
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
            opacity: 0.8;
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
        .entrysec{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction:column;
            color: white;
            font-family: 'Acme', sans-serif; 
            font-size: 1.2rem;
        }
        .inputf{
            display: flex;
        }
        .inputf input{
            margin: 9px;
            border-radius: 23px;
            font-family: 'Acme', sans-serif;
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 70px;
            padding-right: 70px;
        }
        .entrybox{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .btn{
            background-color: black;
            color: white;
            font-family: 'Acme', sans-serif;
            border-radius: 23px;
            padding-left: 45px;
            padding-right: 45px;
            padding-top: 15px;
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
<nav id="navbar">
        <ul>
            <li class="item"><a href="welcome.php">Home</a></li>
            <li class="item"><a href="logout.php">Log Out</a></li>
            <li class="item"><a href="viewrecords.php">View Records</a></li>
        </ul>
    </nav>
    <section class = "entrysec">
        <h2>Create a new Student record</h2>
        <div class="entrybox">
            <form action="" method = "post" class="entryform">
                <div class="inputf">
                    <input type="text" name = "studentid" placeholder="Student id">
                </div>
                <div class="inputf">
                    <input type="text" name = "department" placeholder="Department">
                </div>
                <div class="inputf">
                    <input type="text" name = "name" placeholder="Name">
                </div>
                <div class="inputf">
                    <input type="number" name = "semester" placeholder="Semester">
                </div>
                <div class="inputf">
                    <input type="text" name = "examination" placeholder="Examination">
                </div>
                <div class="inputf">
                    <input type="number" name = "subject1" placeholder="Sub-1 Score">
                </div>
                <div class="inputf">
                    <input type="number" name = "subject2" placeholder="Sub-2 Score">
                </div>
                <div class="inputf">
                    <input type="number" name ="subject3" placeholder="Sub-3 Score">
                </div>
                <div class="inputf">
                    <input type="number" name = "subject4" placeholder="Sub-4 Score">
                </div>
                <div class="inputf">
                    <input type="number" name = "subject5" placeholder="Sub-5 Score">
                </div>
                <button type = "submit" class = "btn">
                    Submit
                </button>
            </form>
            
        </div>
    </section>
</body>
</html>
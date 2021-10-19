<?php
// Initialize the session
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Result</title>
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
            background: url('https://wallpaperaccess.com/full/1947484.jpg') no-repeat center center fixed;
            background-size: cover;
            position:relative;
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
        .tablesec{
            display: block;
            height: 50vh;
            font-family: 'Acme', sans-serif; 

        }
        table{
            background-color: #161618bd;
            border-radius: 23px;
            margin-left: 18%;
        }
        td,th{
            border: none;
            font-family: 'Acme', sans-serif; 

        }
        @media(max-width: 500px){
            
            #navbar ul li{
                list-style: none;
                font-size: 1rem;
            }
            .tablesec{
                height: 75vh;
            }
            table,thead{
                margin-top: 15px;
            }
            table,thead,tbody,th,td,tr{
                display: block;
                text-align: justify;
                width: 100%;
                margin-left: 0;
            }
            thead tr{
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            td{
                border: none;
                text-align: justify;
                padding-left: 72%;
                position: relative;
            }
            td input{
                text-align: left;
               
            }
            td::before{
                position: absolute;
                top: 0;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                font-size: 15px;
                white-space: nowrap;
            }
            table a{
                font-size: 0.89rem;
            }
            td:nth-of-type(1):before {content: "id";}
            td:nth-of-type(2):before {content: "Student id";}
            td:nth-of-type(3):before {content: "Department";}
            td:nth-of-type(4):before {content: "Name";}
            td:nth-of-type(5):before {content: "Semester";}
            td:nth-of-type(6):before {content: "Examination";}
            td:nth-of-type(7):before {content: "Subject 1";}
            td:nth-of-type(8):before {content: "Subject 2";}
            td:nth-of-type(9):before {content: "Subject 3";}
            td:nth-of-type(10):before {content: "Subject 4";}
            td:nth-of-type(11):before {content: "Subject 5";}
        }
        @media only screen and (max-width: 1050px) and (min-width:501px){
            
            #navbar ul li{
                list-style: none;
                font-size: 1rem;
            }
            .tablesec{
                height: 58vh;
            }
            table,thead,tbody,th,td,tr{
                display: inline-block;
                text-align: justify;
                margin: 5px;
                
            }
            thead tr{
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            td{
                border: none;
                text-align: justify;
                padding-left: 72%;
                position: relative;
            }
            td input{
                text-align: left;
            }
            td::before{
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 45px;
                font-size: 15px;
                white-space: nowrap;
            }
            table a{
                font-size: 0.89rem;
            }
            td:nth-of-type(1):before {content: "id";}
            td:nth-of-type(2):before {content: "Student id";}
            td:nth-of-type(3):before {content: "Department";}
            td:nth-of-type(4):before {content: "Name";}
            td:nth-of-type(5):before {content: "Semester";}
            td:nth-of-type(6):before {content: "Examination";}
            td:nth-of-type(7):before {content: "Subject 1";}
            td:nth-of-type(8):before {content: "Subject 2";}
            td:nth-of-type(9):before {content: "Subject 3";}
            td:nth-of-type(10):before {content: "Subject 4";}
            td:nth-of-type(11):before {content: "Subject 5";}
        }
    </style>
</head>
<body>
<nav id="navbar">
        <ul>
            <li class="item"><a href="index.php">Home</a></li>
        </ul>
    </nav>
<section class = "tablesec">
        <h1>Student Result</h1>
        <div class="tablebox">
            <table border = "1" cellspacing = "16" cellpadding = "3">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Student id</th>
                    <th>Department</th>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Examination</th>
                    <th>Subject 1</th>
                    <th>Subject 2</th>
                    <th>Subject 3</th>
                    <th>Subject 4</th>
                    <th>Subject 5</th>
                    
                </tr>
                </thead>
                <tbody>
                    <?php
                     require_once "config.php";

                     $sql = "SELECT * FROM `students` WHERE `students`.`Student id` = '$_GET[studentid]'";
 
                     $result = $conn->query($sql);

                     if($result->num_rows>0){
                         while($row = $result->fetch_assoc()){
                             echo"<tr><td>".$row["id"]."</td><td>".$row["Student id"]."</td><td>".$row["Department"]."</td><td>".$row["Name"]."</td><td>".$row["Semester"]."</td><td>".$row["Examination"]."</td><td>".$row["Subject 1"]."</td><td>".$row["Subject 2"]."</td><td>".$row["Subject 3"]."</td><td>".$row["Subject 4"]."</td><td>".$row["Subject 5"]."</td></tr>";
                            }
                        echo "</table>";    
                     }
                     else{
                         echo"No Result Found";
                     }
                    ?>
                </tbody>
           </table>    
</body>
</html>
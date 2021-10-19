<?php
// Initialize the session
session_start();
error_reporting(0);
require_once "config.php";

$sql = "UPDATE `students` SET `Student id` = '$_POST[studentid]', `Department` = '$_POST[Department]', `Name` = '$_POST[Name]', `Semester` = '$_POST[Semester]', `Examination` = '$_POST[Examination]', `Subject 1` = '$_POST[Subject1]', `Subject 2` = '$_POST[Subject2]', `Subject 3` = '$_POST[Subject3]', `Subject 4` = '$_POST[Subject4]', `Subject 5` = '$_POST[Subject5]' WHERE `students`.`id` = '$_POST[id]'";
if(mysqli_query($conn,$sql)){
    header("location: viewrecords.php");
}
else{
    $message = '<span style = "text-align: center"> ERROR, please Try Again</span>';
    echo $message;
}
?>
<?php
session_start();

include("connection.php");


//get the id of the note sent through Ajax call

$id = $_POST['id'];




//get the new content of the note

$note = $_POST['note'];

//get the time when the note is updated

$time = time();



//run a query to update a note..

$sql = "UPDATE notes SET note ='$note', time ='$time' WHERE id= '$id'";

$result = mysqli_query($link,$sql);

if(!$result){
    
    echo "error";
    
    
    
}





?>
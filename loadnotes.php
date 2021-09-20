<?php
session_start();
include("connection.php");

//get the user_id first so that we can get all the notes corresponding to that user...

$user_id = $_SESSION['user_id'];



//run a query to delete empty notes 

$sql = "DELETE FROM notes WHERE note=''";
$result = mysqli_query($link, $sql);
if(!$result){
    
    echo "<div class = 'alert alert-warning'>An error occured!</div>";
    exit;
    
}
//run a query to look for notes corresponding to our user_id

$sql = "SELECT * FROM notes WHERE user_id='$user_id' ORDER BY time DESC ";
if($result = mysqli_query($link, $sql)
){
    //checking how many row inside our object...
    
    if(mysqli_num_rows($result)>0){
        
        //fetch different records
        while($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
            //the $row is going to be an associative array ..the keys are the colums names .....
            //now we are going to pring the contents of the array in the notes div one after another.....
            $note_id = $row['id'];
            $note = $row['note'];
            $time = $row['time'];
            $time = date("F d, Y h:i:s A",$time);
           echo "
           <div class ='note'>
           <div class ='col-xs-5 col-sm-3 delete'>
           
           <button class='btn btn-lg btn-danger' style='width:100%'>delete</button>
           
           
           
           </div>
           
           <div class = 'noteheader' id='$note_id'>

    <div class ='text'>$note</div>
    <div class ='timetext'>$time</div>



</div> </div>";
 
            
            
            
        }
        
        
        
    }else{
        
      echo "<div class = 'alert alert-warning'>You have not created any notes yet!</div>";  
        
        
    }
    
    
    
}else{
    echo "<div class = 'alert alert-warning'>An error occured!</div>";
    echo "Error: unable to ececute the query:".mysqli_error($link);
    exit;
}

//show notes or alert message




?>
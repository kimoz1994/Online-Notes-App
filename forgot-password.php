<?php

//Start session 
session_start();
//connect to the database
include("connection.php");


//check user inputs
    //Define error messages
$missingemail = '<p><strong>Please enter your email address!</strong></p>';
$invalidemail = '<p><strong>Please enter a vaild email address!</strong></p>';

    //Get email
if(empty($_POST["forgotemail"])){
    
    $errors .= $missingemail;
    
}else{
    
    $email = filter_var($_POST["forgotemail"] , FILTER_SANITIZE_EMAIL);
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        
        $errors .= $invalidemail;
        
        
    }
    
}

    //if there are any errors 
        //print error message
if($errors){
    
    $resultmessage = '<div class = "alert alert-danger">'.$errors.'</div>';
    
    echo $resultmessage;
    exit;
    
}

    //else: No errors
        //prepare variables for the query
$email = mysqli_real_escape_string($link,$email);

        //run query to check if the email exists in the users table
            $sql = "SELECT * FROM  users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query!</div>';
    
    
    
    //the next function will return what is the error with the query if any
    
     echo '<div class = "alert alert-danger">'.mysqli_error($link).'</div>';
    
    
   exit; 
}
 $count = mysqli_num_rows($result);
 //if the email does not exist
            //print error message
if($count != 1){
    
    echo "<div class = 'alert alert-danger'>That email doesn't exist on our database</div>";
    exit;
}


       
        //else
            //get the user_id

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$user_id = $row['user_id'];
            //create a unique activation code
$key = bin2hex(openssl_random_pseudo_bytes(16));

            //insert user details and activation code in the forgotpassword table
$time = time();
$status = 'pending';

$sql = "INSERT INTO forgotpassword (`user_id`,`rkey`,`time`,`status`) VALUES ('$user_id','$key','$time','$status')";

$result = mysqli_query($link,$sql);
if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query!</div>';
    
    
    
    //the next function will return what is the error with the query if any
    
     echo '<div class = "alert alert-danger">'.mysqli_error($link).'</div>';
    
    
   exit; 
}
            //send email with link to resetpassword.php with user id and activation code

$message = "Please click on this link to reset your password:\n\n";
$message .="http://kimo.thecompletewebhosting.com/notesapp/resetpassword.php?user_id=".$user_id."&key=$key";
if(mail($email,'Reset your password' , $message, 'From:' . 'hamda_942010@hotmail.com')){
   echo "<div class = 'alert alert-success'>An email has been sent to $email. Pleases click on the link to reset your password. </div>"; 
}


            //if emil send successfully


?>
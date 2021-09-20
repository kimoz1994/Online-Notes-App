<?php
//start session and connect to database
session_start();

include("connection.php");

//get user_id and new email sent throug Ajax

$user_id = $_SESSION['user_id'];
$newemail = $_POST['email'];


//going to check if the new email exists..
 $sql = "SELECT * FROM  users WHERE email = '$newemail'";
$result = mysqli_query($link,$sql);

if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query!</div>';
    exit;
}

$count = mysqli_num_rows($result);

if($count > 0){
    
    echo '<div class = "alert alert-danger">There is already a user registered with that email! Please choose another one !</div>';
    exit;
}



//get the current email 



$sql = "SELECT * FROM users WHERE user_id ='$user_id'";

$result = mysqli_query($link,$sql);


$count = mysqli_num_rows($result);

if($count == 1){
    
    $row = mysqli_fetch_array($result,MYSQL_ASSOC);
    
    $username = $row['username'];
    $email =  $row['email'];
    
}else{
    
    echo "there was an error retrieving the emai from the database";
    
    exit;
} 






//create a unique activation code..
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));


//insert new activation code in the users table 

$sql = "UPDATE users SET activation2 = '$activationkey' WHRER user_id ='$user_id'";
$result = mysqli_query($link,$sql);

if(!$result){
    
    echo '<div class = "alert alert-danger">Error inserting the activation2 number in the database!</div>';
    exit;
}else{

//send an email link to activatenewemail.php with current email, new email and activation code.
$message = "Please click on this link to prove that you own this email:\n\n";
$message .="http://kimo.thecompletewebhosting.com/notesapp/activatenewemail.php?email=".urlencode($email)."&newemail=".urlencode($newemail)."&key=$activationkey";
if(mail($newemail,'Email update for your Online Notes app' , $message, 'From:' . 'hamda_942010@hotmail.com')){
   echo "<div class = 'alert alert-success'>An email has been sent to $newemail. Pleases click on the link to prove you own the new email address. </div>"; 
}
    
    
    
    
    
}



?>
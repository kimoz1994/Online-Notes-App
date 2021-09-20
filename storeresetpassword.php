<?php
session_start();

//this file recevies: user_id, generated key to reset password, password1 and password2
//this file then resets password for user_id if all checks are correct....





//connect to database....

include("connection.php");


if(!isset($_POST['user_id'])  || !isset($_POST['key'])){
    
    echo "<div class = 'alert alert-danger'>There was an error. Please click on the  link you received by email. </div>"; 
    
    exit;
    
}


//else
    //store them in two variables 

$user_id = $_POST['user_id'];
$key = $_POST['key'];
$time = time()-86400;
    //prepare variables for the query
  //in this step we are cleaning the variables to avoid any sql injections.....
$user_id = mysqli_real_escape_string($link,$user_id);
$key = mysqli_real_escape_string($link,$key);
    //run query: check combination of user_id & key exists and less than 24h old....
$sql = "SELECT user_id FROM forgotpassword WHERE rkey = '$key' AND user_id = '$user_id' AND time > '$time' AND status ='pending'";

 $result = mysqli_query($link,$sql);                 
                  
     if(!$result){
         
         echo "<div class = 'alert alert-danger'>Error running the query!</div>";
         exit;
         
     }             
      
                  
    //if the combination does not exist 
                  //show error message 
                  
       $count = mysqli_num_rows($result);           
                  
        if($count !== 1 ){
            
            echo "<div class = 'alert alert-danger'>Please try again!</div>";
         exit; 
            
            
        }          

//Define error messages.....

$missingpassword = '<p><strong>Please enter a password!</strong></p>';
$invalidpassword = '<p><strong>Your password should be atleast 6 characters long !</strong></p>';
$differentpassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingpassword2 = '<p><strong>Please confirm your password!</strong></p>';


//get passwords
if(empty($_POST["password"])){
    
    $errors .= $missingpassword;
    
}elseif(!(strlen($_POST["password"])>6) ){
    
    $errors .= $invalidpassword;
    
    
}
else{
    
    $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
    
    if(!($_POST["password2"])){
       
        $errors .= $missingpassword2;
        
        
    }else{
        
       $password2 = filter_var($_POST["password2"],FILTER_SANITIZE_STRING); 
        if($password != $password2){
            
            $errors .= $differentpassword;
            
        }
        
    }
}

//    <!--if there are any errors print error-->

if($errors){
    
    $resultmessage = '<div class = "alert alert-danger">'.$errors.'</div>';
    
    echo $resultmessage;
    
    exit;
}



//prepare variable for the query .....
$password = mysqli_real_escape_string($link,$password);

//$password = md5($password);
//the output of this function  will be 128bits but it will be stored as a hexadecimal directly as 32 charachter.however this function is not that difficult to crack. so we are going to use the hash function.
$password = hash('sha256',$password);

$user_id = mysqli_real_escape_string($link,$user_id);


//Run Query : update users password inthe users table....

$sql = "UPDATE users SET password = '$password' WHERE user_id = '$user_id'";

$result = mysqli_query($link,$sql);

if(!$result){
    
    echo '<div class = "alert alert-danger">There was a problem storing the new password</div>';
   exit; 
}

//set the key status to "used" in the forgotpassword table to prevent the key from being used twice....

$sql = "UPDATE forgotpassword SET status='used' WHERE rkey = '$key' AND user_id ='$user_id'";
$result = mysqli_query($link,$sql);
if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query</div>';
   exit; 
}else{
    
    echo '<div class = "alert alert-success">Your password has benn updated successfully<a href="index.php">Login!</a></div>'; 
    
}


?>
<?php
//start session
session_start();

//connect to database...

include('connection.php');

//define error messages....

$missingcurrentpass = '<p><stong>Please enter you current password!</strong></p>';
$incorrectcurrentpass='<p><stong>The password entered is incorrect!</strong></p>';
$missingpassword = '<p><stong>Please enter a new password!</strong></p>';
$invalidpassword = '<p><stong>Your password should be at least 6 charachters long!</strong></p>';
$differentpassword = '<p><stong>Passwords don\'t match!</strong></p>';
$missingpassword2 = '<p><stong>Please confirm your password!</strong></p>';

//check for errors

if(empty($_POST['currentpassword'])){
    
    //adding errors to the errors variable.
    
    $errors .= $missingcurrentpass;
    
    
}else{
    
    //no errors , preparing the variable for the query..
    
    $currentpassword = $_POST['currentpassword'];
    
    $currentpassword = filter_var($currentpassword,FILTER_SANITIZE_STRING);
    
    $currentpassword = mysqli_real_escape_string($link,$currentpassword);
    
    $currentpassword = hash('sha256',$currentpassword);
    
    //run the query
    //check if the given password is correct...
    
    
    $user_id = $_SESSION['user_id'];
    
    $sql = "SELECT password FROM users WHERE  user_id ='$user_id' ";
    
    $result = mysqli_query($link , $sql);
    
    $count = mysqli_num_rows($result);
    
    if($count !== 1){
        
        echo "<div class ='alert alert-danger'>The was a problem running the query</div>";
        
        
        
    }else{
        
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        if($currentpassword != $row['password']){
            
            $errors .= $incorrectcurrentpass;
            
            
            
        }
        
        
        
        
        
        
    }
    
}


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
//if there is an error print error message

if($errors){
    
    $resultmessage = '<div class = "alert alert-danger">'.$errors.'</div>';
    
    echo $resultmessage;
    
    exit;
}

else{//else run a query and update password
        
       $password = filter_var($password,FILTER_SANITIZE_STRING);
    
    $password = mysqli_real_escape_string($link,$password);
    
    $password = hash('sha256',$password); 
    
    $sql = "UPDATE users SET password = '$password' WHERE user_id ='$user_id'";

    $result = mysqli_query($link ,$sql);

    if(!$result){
        
        echo "<div class ='alert alert-danger'>The password could not be reset</div>";
        
        
    }else{
        
        echo "<div class ='alert alert-success'>Your password has been updated successfully!</div>";
        
        
    }
    
    
}



?>
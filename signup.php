

<!--since this website is just a practice, we don't need to purchase a ssl certificate. but for real websites we need to purchase the ssl certificate for security purposes.-->


<!--this php file will process the data sent from the sign up form(using Ajax) -->



<?php

                
    
    session_start();

                //<!--connect to the database-->
//        we need to connect to the database because we are going to run queries later on
        

        include('connection.php');//including the database connection file

//<!--check user inputs-->
//    <!--Define error messages-->

$missingusername = '<p><strong>Please enter a username!</strong></p>';
$missingemail = '<p><strong>Please enter your email address!</strong></p>';
$invalidemail = '<p><strong>Please enter a vaild email address!</strong></p>';
$missingpassword = '<p><strong>Please enter a password!</strong></p>';
$invalidpassword = '<p><strong>Your password should be atleast 6 characters long !</strong></p>';
$differentpassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingpassword2 = '<p><strong>Please confirm your password!</strong></p>';



//    <!--get username,email,password,password2-->



//get username

if(empty($_POST["username"])){
    
    $errors .= $missingusername;
    
}else{
    
    $username = filter_var($_POST["username"] , FILTER_SANITIZE_STRING);
    
    
    
}


//get email
if(empty($_POST["email"])){
    
    $errors .= $missingemail;
    
}else{
    
    $email = filter_var($_POST["email"] , FILTER_SANITIZE_EMAIL);
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        
        $errors .= $invalidemail;
        
        
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









//    <!--if there are any errors print error-->

if($errors){
    
    $resultmessage = '<div class = "alert alert-danger">'.$errors.'</div>';
    
    echo $resultmessage;
    
    exit;
}


//<!--no errors-->
//    <!--prepare variables for the queries-->

$username = mysqli_real_escape_string($link,$username);
$email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);

//$password = md5($password);
//the output of this function  will be 128bits but it will be stored as a hexadecimal directly as 32 charachter.however this function is not that difficult to crack. so we are going to use the hash function.
$password = hash('sha256',$password);


////    <!--if username exists in the users table print error-->
//
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link,$sql);

if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query!</div>';
   exit; 
}

 $results = mysqli_num_rows($result);
if($results){
    
    echo "<div>That username is alerady registered.Do you want to log in?</div>";
    exit;
}
//    <!--else-->
//        <!--if email exists in the users table print error-->

            $sql = "SELECT * FROM  users WHERE email = '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query!</div>';
    
    
    
    //the next function will return what is the error with the query if any
    
     echo '<div class = "alert alert-danger">'.mysqli_error($link).'</div>';
    
    
   exit; 
}
 $results = mysqli_num_rows($result);
if($results){
    
    echo "<div class = 'alert alert-danger'>That email is alerady registered.Do you want to log in?</div>";
    exit;
}


//        <!--else-->
//            <!--create a unique activation code-->

$activationkey = bin2hex(openssl_random_pseudo_bytes(16));
    
    //byte: unit of data = 8 bits
    //bit: 0 or 1
    //16bytes = 16*8 = 128 bits
    //the value of the activation code will be in binary,, but we have to change that to hexadecimal

//            <!--insert user details and activation code inthe uers table-->

$sql = "INSERT INTO users (`username` , `email` , `password` ,`activation` ) VALUES ('$username' , '$email' , '$password' , '$activationkey')";

//next we run the query

$result = mysqli_query($link,$sql);

if(!$result){
    
    echo "<div class = 'alert alert-danger'>there was an error inserting the user detaile in the database table</div>";
    
    //where the error is comming from exactly
    echo '<div class = "alert alert-danger">'.mysqli_error($link).'</div>';
    
    
    exit;
}

echo "the details are in the table man!";

//            <!--send the user an email with a link to activate.php with their email and activation code-->
$message = "Please click on this link to activate your account:\n\n";
$message .="http://kimo.thecompletewebhosting.com/notesapp/activate.php?email=".urlencode($email)."&key=$activationkey";
if(mail($email,'Confirm your Registration' , $message, 'From:' . 'hamda_942010@hotmail.com')){
   echo "<div class = 'alert alert-success'>Thank you for your registration! A confirmation email has been sent to $email. Pleases click on the activation link to activate your account. </div>"; 
}




//            
//            
            
            
?>            
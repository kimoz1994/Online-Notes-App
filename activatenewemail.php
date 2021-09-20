<?php

//The user is re-directed to this file after clicking the link recieved by email and aiming at proving they own the new email address
//the link contains three GET parameters: email and newemail and activation key


//starting a session to resume the previous session
session_start();
//connecting to the database
include('connection.php');




?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>New emial activation</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      
      
      <style>
          
          h1{
              
              color: purple;
          }
          .contactform{
              
              border: 1px solid #9e429e;
              margin-top: 50px;
              border-radius: 15px;
              
          }
      
      </style>
      
  </head>
  <body >
<!--      bootstrap need a container. we need to place all our content inside a container-->
      
      
      <div class="container-fluid">
         
          <div class="row">
          
              
              <div class="col-sm-offset-1 col-sm-10 contactform">
              <h1>Email activation</h1>
               
            <?php      
                //if email or activation key is missing show an error


if(!isset($_GET['email'])  || !isset($_GET['key'])|| !isset($_GET['newemail'])){
    
    echo "<div class = 'alert alert-danger'>There was an error. Please click on the activation link you received by email. </div>"; 
    
    exit;
    
}


//else
    //store them in two variables 

$email = $_GET['email'];
$key = $_GET['key'];
$newemail = $_GET['newemail'];
    //prepare variables for the query

$email = mysqli_real_escape_string($link,$email);
$newemail = mysqli_real_escape_string($link,$newemail);
$key = mysqli_real_escape_string($link,$key);
    //run query: update email
$sql = "UPDATE users SET email='$newemail', activation2='0' WHERE (email = '$email' AND activation2 = '$key') LIMIT 1";

 $result = mysqli_query($link,$sql);                 
                  
                  
        //if the query is successful, show success message 
if(mysqli_affected_rows($link) == 1){
    
    session_destroy();
    setcookie("rememberme","",time()-3600);
    
  echo "<div class = 'alert alert-success'>Your email has been updated </div>";   
   
    echo '<a href ="index.php" type = "button" class ="btn btn-lg btn-sucess" >Login!</a>';
}else{
    
    //else
            //show error message.
    echo "<div class = 'alert alert-danger'>Your new email could not be updated. Please try again later. </div>";
    
}
        

  
                  
              ?>    
                  
                 
              </div>
              
          
          
          </div>
          
          </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
          <script>
          
          
        
        
          
          </script>
          
          
          
  </body>
      
</html>








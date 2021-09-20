<?php

//The user is re-directed to this file after clicking the activation link
//Signup link contains two GET parameters: user_id and activation key


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
    <title>Password Reset</title>

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
              <h1>Reset Password</h1>
              
                <div id="resultmessage">
                  
                  
                  </div>  
            <?php      
                //if user_id or reset key is missing show an error


if(!isset($_GET['user_id'])  || !isset($_GET['key'])){
    
    echo "<div class = 'alert alert-danger'>There was an error. Please click on the  link you received by email. </div>"; 
    
    exit;
    
}


//else
    //store them in two variables 

$user_id = $_GET['user_id'];
$key = $_GET['key'];
$time = time()-86400;
    //prepare variables for the query
  //in this step we are cleaning the variables to avoid any sql injections.....
$user_id = mysqli_real_escape_string($link,$user_id);
$key = mysqli_real_escape_string($link,$key);
    //run query: check combination of user_id & key exists and less than 24h old....
$sql = "SELECT user_id FROM forgotpassword WHERE rkey = '$key' AND user_id = '$user_id' AND time > '$time' AND status ='pending'  ";

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
          
    //print reset password form with hidden user_id and key fields
                  
                  
                  echo "
                  <form method = 'post' id='passwordreset'>
                  
                  <input type='hidden' name='key' value =$key>
                  <input type='hidden' name='user_id' value =$user_id>
                  
                  
                  
                  
                  <div class = 'form-group'>
                  
                  
                  <label for='password' class='sr-only'>Enter your new password</label>
                  
                  <input type ='password' name = 'password' id = 'password' placeholder='Enter Password' class = 'form-control' >
                  
                  
                  
                  
                  
                  
                  </div>
                  
                  
                  <div class = 'form-group'>
                  
                  
                  <label for='password2' class='sr-only'>re-Enter your new password</label>
                  
                  <input type ='password2' name = 'password2' id = 'password2' placeholder='Re Enter Password' class = 'form-control' >
                  
                  
                  
                  
                  
                  
                  </div>
                  
                  
                  <input type ='submit' name = 'resetpassword' class='btn btn-lg btn-success' value ='Reset Password'>
                  
                  
                  
                  
                  
                  
                  
                  
                  </form>
                  
                  
                  
                  ";
                  
                  
                  
                  

  
                  
              ?>    
                  
                 
              </div>
              
          
          
          </div>
          
          </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
          <script>
          
          //script for Ajax call to storeresetpassword.php which proesses form data....
              
              //ajax call fo the forgot password  form
$("#passwordreset").submit(function(event){
            //prevent default php proccessing
            //usually if there is no action attribute, the form will be processes in the same file that it is in.
        
        event.preventDefault();
        
            //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
            //send them to signup.php using AJAX

        $.ajax({
            
            url: "storeresetpassword.php",
            type: "POST",
            data: datatopost,
            success:function(data){
                $("#resultmessage").html(data);
                
            },
            error:function(){
                
                
     $("#resultmessage").html("<div class ='alert alert-danger'>There was an error with thte Ajax call. Please try again later.</div>"); 

                
                
            },
        });
        
        
        
    });

              
        
        
          
          </script>
          
          
          
  </body>
      
</html>








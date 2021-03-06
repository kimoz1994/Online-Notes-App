<?php
session_start();
include("connection.php");
ob_start();


//logout file

include('logout.php');

include('rememberme.php');


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Online Notes App</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      
      
<!--      linking the google font arvo-->
      
      <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet'>
      
<!--      liking the styling file-->
      
      <link rel="stylesheet" href="styling.css"/>
      
      
      
  </head>
  <body>
    
      <!--      creating the navbar element using bootstrap.-->
      
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
      
          <div class="container-fluid">
          
<!--              the navar consists of two elements, the header and the collapseble content-->
              
              
              
              
              <div class="navbar-header">
              
              <a class="navbar-brand">Online Notes</a>    
                  
              <button type="button" class="navbar-toggle " data-target="#navbarcollapse" data-toggle="collapse">
              <span class="sr-only">toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              
              
              
              
              </button>    
                  
                  
              
              
              </div>
              
              <div class="navbar-collapse collapse" id="navbarcollapse">
              
                  <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li ><a href="#">Help</a></li>
                  <li ><a href="#">Contact us</a></li>
                      
                  </ul>
                  
                   <ul class="nav navbar-nav navbar-right">
                  <li><a href="#loginmodal" data-toggle="modal">Login</a></li>
                 
                      
                  </ul>
                  
                  
              
              </div>
              
          </div>
          
      </nav>
          
          
<!--      creating the jumbotron with the sign up button    -->
      
      <div class="container">
      
          <div class="jumbotron" id="mycontainer">
              
              <h1>Onlie Notes App</h1>
              <p>Your Notes with you wherever you go.</p>
              <p>Easy to use, protects all your notes!</p>
              
              <button type="button" class="btn btn-lg green signup" data-target = "#signupmodal" data-toggle = "modal" >Sign up-it's free</button>
          
          </div>
      
      
      </div>
      
      
      
<!--      creating our footer using bootstrap-->
          
      <div class="footer">
      
         <div class="container">
          
    <p>Develop with Kimo copyright &copy; 2015-<?php 

$today = date("Y");
echo $today;
?>.</p>
          
          </div> 
          
      
      
      </div>
      
<!--      sign up form-->
      
      <form method="post" id="signupform">
          
          
      
          <div class="modal" id="signupmodal" role="dialog" aria-labelledby="modallable" aria-hidden="true">
            
            
            <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modallable">Sign up today and Start using our Online Notes App!</h4>
                
                </div>
                
                <div class="modal-body">
                    
<!--       the next div will be used to create various error -->
              <div id="signupmessage">
                    
                    
                    
                    
                    </div>              
                    
                    
                    
                 
                <div class="form-group">
                    
                    <label for="username" class="sr-only">Username:</label>
                    <input id="username" class="form-control" type="text" name="username" placeholder="username" maxlength="30" />
                    
                    </div>    
                    
                    
                    <div class="form-group">
                    
                    <label for="email" class="sr-only">Email:</label>
                    <input id="email" class="form-control" type="text" name="email" placeholder="Email Adress" maxlength="50" />
                    
                    </div>    
                    
                    
                    <div class="form-group">
                    
                    <label for="password" class="sr-only">Password:</label>
                    <input id="password" class="form-control" type="password" name="password" placeholder="Choose a password" maxlength="30" />
                    
                    </div>    
                    
                    <div class="form-group">
                    
                    <label for="password2" class="sr-only">Password2:</label>
                    <input id="password2" class="form-control" type="password" name="password2" placeholder="Confirm password" maxlength="30" />
                    
                    </div>    
                    
                    
                   
                    
                    
                
                </div>    
                
                <div class="modal-footer">
                
                    <input class="btn green" name="signup" type="submit" value="Sign up" />
                    
                    <input class="btn btn-default" name="cancel" data-dismiss="modal" type="button" value="Cancel" />
                    
                
                </div>
                
                
                
                
                </div>
            
            
            
            </div>
        
        
        
        
        
        
        </div>
        
          
      </form>
      
      
      
      
<!--      creating the login form-->
    
       <form method="post" id="loginform">
          
          
      
          <div class="modal" id="loginmodal" role="dialog" aria-labelledby="modallable" aria-hidden="true">
            
            
            <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                
                    <button class="close" data-dismiss="modal">&times;</button>
                    
                    <h4 id="modallable">Login:</h4>
                
                </div>
                
                <div class="modal-body">
                    
<!--       the next div will be used to create various error -->
              <div id="loginmessage">
                    
                    
                    
                    
                    </div>              
                    
                    
                    
                 
                
                    
                    
                    <div class="form-group">
                    
                    <label for="email" class="sr-only">Email:</label>
                    <input id="loginemail" class="form-control" type="text" name="loginemail" placeholder="Email " maxlength="50" />
                    
                    </div>    
                    
                    
                    <div class="form-group">
                    
                    <label for="password" class="sr-only">Password:</label>
                    <input id="loginpassword" class="form-control" type="password" name="loginpassword" placeholder=" password" maxlength="30" />
                    
                    </div>    
                    
                    <div class="checkbox">
                    <label><input type="checkbox" name="rememberme" id="rememberme" />Remember Me</label>
                    
                    <a class="pull-right" style="cursor:pointer"  data-dismiss = "modal" data-toggle="modal" data-target="#forgotpassmodal">Forgot Password?</a>         
                        
                        
                    </div>
                    
                    
                   
                    
                    
                   
                    
                    
                
                </div>    
                
                <div class="modal-footer">
                
                    <input class="btn green" name="login" type="submit" value="Login" />
                    
                    <input class="btn btn-default" name="signup" type="button" data-dismiss="modal" value="Cancel" />
                    
                    <input class="btn btn-default pull-left" name="signup" type="button" data-dismiss="modal" value="Register" data-target = "#signupmodal" data-toggle="modal" />
                
                </div>
                
                
                
                
                </div>
            
            
            
            </div>
        
        
        
        
        
        
        </div>
        
          
          
          
      
      
      
      </form>
      
      
<!--    creating the forgot your password form-->
      
       
       <form method="post" id="forgotpassform">
          
          
      
          <div class="modal" id="forgotpassmodal" role="dialog" aria-labelledby="modallable" aria-hidden="true">
            
            
            <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                
                    <button class="close" data-dismiss="modal">&times;</button>
                    
                    <h4 id="modallable">Forgot Password?Enter your email address:</h4>
                
                </div>
                
                <div class="modal-body">
                    
<!--       the next div will be used to create various error -->
              <div id="forgotpassmessage">
                    
                    
                    
                    
                    </div>              
                    
                    
                    
                 
                
                    
                    
                    <div class="form-group">
                    
                    <label for="email" class="sr-only">Email:</label>
                    <input id="forgotemail" class="form-control" type="text" name="forgotemail" placeholder="Email " maxlength="50" />
                    
                    </div>    
                    
                    

                   
                    
                    
                
                </div>    
                
                <div class="modal-footer">
                
                    <input class="btn green" name="forgotpassword" type="submit" value="Submit" />
                    
                    <input class="btn btn-default" name="signup" type="button" data-dismiss="modal" value="Cancel" />
                    
                    <input class="btn btn-default pull-left" name="signup" type="button" data-dismiss="modal" value="Register" data-target = "#signupmodal" data-toggle="modal" />
                
                </div>
                
                
                
                
                </div>
            
            
            
            </div>
        
        
        
        
        
        
        </div>
        
          
          
          
      
      
      
      </form>
      
      
      
      
      
      
      
      
      
      
      
      
      
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      
      
      <script src="index.js"></script>
  </body>
</html>
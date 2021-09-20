<?php
session_start();
if(!isset($_SESSION['user_id'])){
    
    header("location:index.php");
    
    
}


//the next bit of code is used to update the user information (name) that appear on the website....

//getting the new username from the users table....

include('connection.php');

$user_id = $_SESSION['user_id'];

//get username  and email 


$sql = "SELECT * FROM users WHERE user_id ='$user_id'";

$result = mysqli_query($link,$sql);


$count = mysqli_num_rows($result);

if($count == 1){
    
    $row = mysqli_fetch_array($result,MYSQL_ASSOC);
    
    $username = $row['username'];
    $email =  $row['email'];
    
}else{
    
    echo "there was an error retrieving the username and email from the database";
    
    
} 




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Profile</title>

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
     
      
      <style >
      
          #container{
              
              margin-top: 100px;
              
          }
          
          #allnotes,#done,#notepad{
              display:none;
              
          }
        
          .buttons{
              margin-bottom: 20px;
          }
          textarea{
              width: 100%;
              max-width: 100%;
              min-width: 100%;
              font-size: 16px;
              line-height: 1.5em;
              border-left-width: 20px;
              border-color: #e343ee;
              color: #e343ee;
              background-color: azure;
              padding: 10px;
          }
          
          
          tr{
            cursor: pointer;
              
          }
      </style>
      
      
      
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
                  <li class="active"><a href="#">Profile</a></li>
                  <li ><a href="#">Help</a></li>
                  <li ><a href="#">Contact us</a></li>
                  <li  ><a href="mainpage.php">My Notes</a></li>
                      
                  </ul>
                  
                   <ul class="nav navbar-nav navbar-right">
                  
                  <li><a href="#" >Logged in as <b><?php echo $username; ?></b></a></li>
                   <li><a href="index.php?logout=1" >Log out</a></li>
                 
                      
                  </ul>
                  
                  
              
              </div>
              
          </div>
          
      </nav>
          
          

<!--      creating a container for the second page content -->
      
      <div class="container" id="container">
      
          <div class="row">
          
              <div class="col-md-offset-3 col-md-6">
              
         <h2>General Account Settings:</h2>
            
                  <div class="table-responsive">
                  
                      <table class="table table-hover table-condensed table-bordered">
                      <tr data-target="#updateusername" data-toggle="modal"><td>Username</td><td><?php echo $username; ?></td></tr>
                      <tr data-target="#updateemail" data-toggle="modal"><td>Email</td><td><?php echo $email; ?></td></tr>
                      <tr data-target="#updatepassword" data-toggle="modal"><td>Password</td><td>value</td></tr>
                      
                      
                      
                      </table>
                      
                  
                  </div>
                  
                  
                  
                  
                  
              </div>
              
              
          
          </div>
      
      
      </div>
      
      
      
      
<!--      creating our fo oter using bootstrap-->
          
      <div class="footer">
      
         <div class="container">
          
    <p>Develop with Kimo copyright &copy; 2015-<?php 

$today = date("Y");
echo $today;
?>.</p>
          
          </div> 
          
      
      
      </div>
      
<!--     update username-->
      
      <form method="post" id="updateusernameform">
          
          
      
          <div class="modal" id="updateusername" role="dialog" aria-labelledby="modallable" aria-hidden="true">
            
            
            <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modallable">Edit Username:</h4>
                
                </div>
                
                <div class="modal-body">
                    
<!--       the next div will be used to create various error -->
              <div id="updateusernamemessage">
                    
                    
                    
                    
                    </div>              
                    
                    
                    
                 
                <div class="form-group">
                    
                    <label for="username">Username:</label>
                    <input id="username" class="form-control" type="text" name="username"  maxlength="30" value="<?php echo $username; ?>" />
                    
                    </div>    
                                
                
                </div>    
                
                <div class="modal-footer">
                
                    <input class="btn green" name="updateusername" type="submit" value="Submit" />
                    
                    <input class="btn btn-default" name="signup" type="button" data-dismiss="modal" value="Cancel" />
                    
                
                </div>
                
                
                
                
                </div>
            
            
            
            </div>
        
        
        
        
        
        
        </div>
        
          
      </form>
      
      
      
<!--      creating the update email form-->
      <form method="post" id="updateemailform">
          
          
      
          <div class="modal" id="updateemail" role="dialog" aria-labelledby="modallable" aria-hidden="true">
            
            
            <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modallable">Edit Email:</h4>
                
                </div>
                
                <div class="modal-body">
                    
<!--       the next div will be used to create various error -->
              <div id="updateemailmessage">
                    
                    
                    
                    
                    </div>              
                    
                    
                    
                 
                <div class="form-group">
                    
                    <label for="email">Email:</label>
                    <input id="email" class="form-control" type="email" name="email"  maxlength="50" value="<?php echo $email; ?>" />
                    
                    </div>    
                                
                
                </div>    
                
                <div class="modal-footer">
                
                    <input class="btn green" name="updateusername" type="submit" value="Submit" />
                    
                    <input class="btn btn-default" name="signup" type="button" data-dismiss="modal" value="Cancel" />
                    
                
                </div>
                
                
                
                
                </div>
            
            
            
            </div>
        
        
        
        
        
        
        </div>
        
          
      </form>
      
<!--     creating the update password form -->
      
            <form method="post" id="updatepasswordform">
          
          
      
          <div class="modal" id="updatepassword" role="dialog" aria-labelledby="modallable" aria-hidden="true">
            
            
            <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modallable">Edit Password:</h4>
                
                </div>
                
                <div class="modal-body">
                    
<!--       the next div will be used to create various error -->
              <div id="updatepasswordmessage">
                    
                    
                    
                    
                    </div>              
                    
                    
                    
                 
                <div class="form-group">
                    
                    <label for="currentpassword" class="sr-only">your current Password:</label>
                    <input id="currentpassword" class="form-control" type="password" name="currentpassword"  maxlength="30" placeholder="your current password" />
                    
                    </div>    
                              
                    <div class="form-group">
                    
                    <label for="password" class="sr-only">choose a password</label>
                    <input id="password" class="form-control" type="password" name="password"  maxlength="30" placeholder="choose a password" />
                    
                    </div>    
                    <div class="form-group">
                    
                    <label for="password2" class="sr-only">confirm password</label>
                    <input id="password2" class="form-control" type="password" name="password2"  maxlength="30" placeholder="confirm password" />
                    
                    </div>    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                
                </div>    
                
                <div class="modal-footer">
                
                    <input class="btn green" name="updateusername" type="submit" value="Submit" />
                    
                    <input class="btn btn-default" name="signup" type="button" data-dismiss="modal" value="Cancel" />
                    
                
                </div>
                
                
                
                
                </div>
            
            
            
            </div>
        
        
        
        
        
        
        </div>
        
          
      </form>
      
      
      
      
      
      
      
      
      
      
      
      
      
      

      
      
      
      
      
      
      
      

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      <script src="profile.js"></script>
  </body>
</html>
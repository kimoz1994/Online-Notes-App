<?php
if(isset($_SESSION['user_id']) && $_GET['logout']==1){
    
//    setcookie('rememberme', '', time() - 3600,'');
unset($_SESSION['user_id']);  
    session_unset();
    //destroying cookies and sessions when the user log out..
    session_destroy();
//    setcookie("rememberme");
    
setcookie ("rememberme", "", time() - 3600,"/");
//will reset cookie(client,browser)
unset($_COOKIE["rememberme"]);
// will destroy cookie(server)
    
    
}


?>
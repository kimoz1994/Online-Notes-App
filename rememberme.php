<?php
    //if the user is not logged in & rememberme cookie exists

if(!isset($_SESSION["user_id"]) && !empty($_COOKIE["rememberme"])){
    //or we can use the array_key_exists('user_id',$_SESSION)
    //f1 cookie: $a . ",".bin2hex($b)
    //f2: hash('sha256',$a)
    
    //extract the $authenticators 1&2 from the cookie
list($authentificator1,$authentificator2)=explode('%',$_COOKIE["rememberme"]);
    
    $authentificator2 = hex2bin($authentificator2);
    
    $f2authentificator2 = hash('sha256',$authentificator2);
    
    //removing the first two blank charachters from the $authentificator1 because there were causing a big problem.
    if(strlen($authentificator1) !== 20){
           $authentificator1 = mb_substr($authentificator1, 2);

    }
    //look for the $authenticator1 inthe rememberme table
    
$whatup = "SELECT * FROM rememberme WHERE authentificator1='$authentificator1'";
    
$sql = $whatup;
    
    
    $result = mysqli_query($link , $sql);
    
    if(!$result){
        
        echo '<div class = "alert alert-danger">There was an error running the query.</div>';
        
        exit;
        
    }
    
    $count = mysqli_num_rows($result);

if($count !== 1 ){
    
   echo $count; 
    echo $authentificator1;
    echo "<br/>";
    echo gettype($authentificator1);
    echo "<br/>";
    echo (int)$authentificator1;
    echo "<br/>";
    $result = mb_substr($authentificator1, 2);
    echo $result;
    echo "<br/>";
    echo str_word_count($result,0);
    echo "<br/>";
    echo rtrim($authentificator1);
    echo "<br/>";
    echo mb_strlen($result);
    echo "<br/>";

    echo sprintf($authentificator1);
    echo "<br/>";
    echo $f2authentificator2;
   echo '<div class = "alert alert-danger">Remember me process failed!</div>';
        if(preg_match("/^[a-zA-Z0-9]+$/", $authentificator1) !== 1) {
       echo "there is special charachter in the string cuasing the error ...";
}     
       exit; 
}
   
        
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
    //if authenticator2 does not match 
    
    if(!hash_equals($row['f2authentificator2'], $f2authentificator2)){
        
        '<div class = "alert alert-danger">hash_equals returned false. </div>';
        
        
        
    }
    
    else{
        //generate new authentificators 
        //store them in cookie and rememberme table
        
          //create two variables $authentificator1 and $authentificator2
        
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        $authentificator2 = openssl_random_pseudo_bytes(20);
//        store them in a cookie
        function f1($a,$b){
          $c = $a ."%". bin2hex($b) ;
            return $c;
        }
        $cookievalue = f1($authentificator1,$authentificator2);
       
        setcookie("rememberme",$cookievalue,time()+1296000,"/");
      
        
        //Run query to store them in rememberme table
        
        function f2($a){
            
            $b = hash('sha256',$a);
            return $b;
            
        }
        
        $f2authentificator2 = f2($authentificator2);
        
        $user_id = $_SESSION['user_id'];
        
        $expiration = date('Y-m-d H:i:s',time()+1296000);
        
        $sql = "INSERT INTO rememberme (`authentificator1`,`f2authentificator2`,`user_id`,`expires`) VALUES ('$authentificator1' ,'$f2authentificator2','$user_id' , '$expiration' )";
        
        //running the query
        
        $result = mysqli_query($link,$sql);
       
       
        if(!$result){
            
            echo "<div class = 'alert alert-danger'>There was error storing data to remember you next time. </div>";
            
        }
        
        
        
        
        //log the user in by setting their session variable
       
       
        
        
         $_SESSION['user_id'] = $row['user_id'];
//        echo "<script>window.top.location='mainpage.php'</script>";

        header("location:mainpage.php");
 echo "<div style ='margin-top:50px' class = 'alert alert-danger'>the number or row is :". $count . "</div>";
    echo "<div style ='margin-top:50px' class = 'alert alert-danger'>row['user_id'] is :". $row['user_id']. "</div>"; 
    echo "<div style ='margin-top:50px' class = 'alert alert-danger'>the session id is  :". $_SESSION['user_id']. "</div>";      
    }
    
    
    
    
    
    }
    
    
    else{
        
        
     echo "<div style ='margin-top:50px' class = 'alert alert-danger'>user_id:". $_SESSION['user_id'] . "</div>";  
        
     echo "<div class = 'alert alert-danger'>stored cookie:". $_COOKIE['rememberme']. "</div>";    
        
      

        
        
        
    }



        
            
              




?>
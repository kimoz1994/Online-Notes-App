<?php session_start();
//connect to database
include("connection.php");
    
//check user inputs
    //define error messages

$missingemail = "<p><strong>Please enter your email address</strong></p>";
$missingpassword = "<p><strong>Please enter your password </strong></p>";
    //get email and password
    //store errors in errors variable
    if(empty($_POST["loginemail"])){
    
    $errors .= $missingemail;
    
}else{
    
    $email = filter_var($_POST["loginemail"] , FILTER_SANITIZE_EMAIL);
    
    
    
}
  
if(empty($_POST["loginpassword"])){
    
    $errors .= $missingpassword;
    
}else{
    
    $password = filter_var($_POST["loginpassword"] , FILTER_SANITIZE_STRING);
    
    
    
}

        //if there are any errors
if($errors){
    $resultmessage = '<div class = "alert alert-danger">'.$errors.'</div>';
    
    echo $resultmessage;
    exit;
}
else{//no errors
    //prepare variable for the query
    
    $email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);
$password = hash('sha256',$password);

    
    
    


//creating the query
$sql = "SELECT * FROM users WHERE email = '$email' AND password ='$password' AND activation = 'activated' ";

//running the query
$result = mysqli_query($link,$sql);
//check if the query has run successfully.
if(!$result){
    
    echo '<div class = "alert alert-danger">Error running the query!</div>';
   exit; 
}



//if email and password don't match print error

$count = mysqli_num_rows($result);

if($count == 1 ){
    
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
    $_SESSION['user_id'] =$row['user_id']; 
    $_SESSION['username'] =$row['username'];
    $_SESSION['email'] =$row['email']; 
    
    
    //if the user has or has not the "remember me " checkbox
    
    if(empty($_POST['rememberme'])){
//        if remember me is not checked
    
        echo 444;
        exit;
    }else{
       //create two variables $authentificator1 and $authentificator2
        
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        $authentificator2 = openssl_random_pseudo_bytes(20);
//        store them in a cookie
        function f1($a,$b){
          $c = $a ."%". bin2hex($b) ;
            return $c;
        }
        $cookievalue = f1($authentificator1,$authentificator2);
        
            
//         setcookie("rememberme",$cookievalue,time()+1296000,"/");
            
        
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
            exit;
        }else{
            $outputarray =array("sucess",$cookievalue);
            echo "whatthehell," . $cookievalue ;
            exit;
        }
        
        
        
    }
    
}else{
    
    echo '<div class="alert alert-danger">Wrong username or password!</div>';  
    exit;
}
    
}

    
    
    
    ?>
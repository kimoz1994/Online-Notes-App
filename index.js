//Ajax call fothe sign up form
//once the form is submitted
     
    $("#signupform").submit(function(event){
            //prevent default php proccessing
            //usually if there is no action attribute, the form will be processes in the same file that it is in.
        
        event.preventDefault();
        
            //collect user inputs
    var datatopost = $(this).serializeArray();
            console.log(datatopost);

            //send them to signup.php using AJAX

        $.ajax({
            
            url: "signup.php",
            type: "POST",
            data: datatopost,
            success:function(data){
                
                if(data){
                    
              $("#signupmessage").html(data); 

                    
                    
                }
                
                
                
            },
            error:function(){
                
                
     $("#signupmessage").html("<div class ='alert alert-danger'>There was an error with thte Ajax call. Please try again later.</div>"); 

                
                
            },
        });
        
        
        
    });

        //AJAX call successful: show error or success message
        //AJAX call fails: show ajax call error




//Ajax call for the login form
$("#loginform").submit(function(event){
            //prevent default php proccessing
            //usually if there is no action attribute, the form will be processes in the same file that it is in.
        
        event.preventDefault();
        
            //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
            //send them to login.php using AJAX

        $.ajax({
            
            url: "login.php",
            type: "POST",
            data: datatopost,
            success:function(data){
                
    var cookie = data.split(",");
                window.alert(cookie);
             if(cookie.length == 2){
                document.cookie = "rememberme="+encodeURI(cookie[1])+";path=/;";
                    window.location = "mainpage.php";   
                 
                 
             }   
                
                
              else  if(data == 444 ){
                    $("#loginmessage").html(data);
                    window.location = "mainpage.php";        
                }
               
                else{
                    
              $("#loginmessage").html(data);


                }
                
            },
            error:function(){
                
                
     $("#signupmessage").html("<div class ='alert alert-danger'>There was an error with thte Ajax call. Please try again later.</div>"); 

                
                
            },
        });
        
        
        
    });

//once the form is submitted
    //prevent default php processing
    //collect user inputs
    //send them to login.php using AJAX
        //AJAX call successful
            //if php files returns "success": rediret the user to notes page
            //otherwise show error message
        //AJAX call fails: show ajax call error



//ajax call fo the forgot password  form
$("#forgotpassform").submit(function(event){
            //prevent default php proccessing
            //usually if there is no action attribute, the form will be processes in the same file that it is in.
        
        event.preventDefault();
        
            //collect user inputs
    var datatopost = $(this).serializeArray();
    console.log(datatopost);
            //send them to signup.php using AJAX

        $.ajax({
            
            url: "forgot-password.php",
            type: "POST",
            data: datatopost,
            success:function(data){
                $("#forgotpassmessage").html(data);
                
            },
            error:function(){
                
                
     $("#forgotpassmessage").html("<div class ='alert alert-danger'>There was an error with thte Ajax call. Please try again later.</div>"); 

                
                
            },
        });
        
        
        
    });

//once the form is submitted
    //prevent default php processing
    //collect user inputs
    //send them to login.php using AJAX
        //AJAX Call successful: show error or success message
        //AJAX call fails: show ajax call error



$(function(){
    //define variable...
    
    var activenote = 0;
    
    var editmode = false;
    
    
    
    //functions .....
    
     //show/hide function
    function showhide(array1,array2){
        
        for(var i = 0 ;i <array1.length;i++ ){
            
            $(array1[i]).show();
            
            
        }
         for(var i = 0 ;i <array2.length;i++ ){
            
            $(array2[i]).hide();
            
        }
            
    }
    
    
    
    
        //click on a note
    
function clickonnote(){
    
    $(".noteheader").click(function(){
        
        if(!editmode){
            //update activemode variable to id of the clicked note
            activenote = $(this).attr("id");
            
            //fill text area
            
    $("textarea").val($(this).find('.text').text());
       showhide(["#notepad","#allnotes"],["#notes","#addnote","#edit","#done"]);
            $("textarea").focus();        
       
            
            
            
            
            
        }
        
        
        
        
    });
    
    
    
    
}    
    
    
    
    
        //click on a delete
       function clickondelete(){
           
           $(".delete").click(function(){
               
               var deletebutton = $(this);
               
                  $.ajax({
        
        url:"deletenote.php",
        type:"POST",
        //we need to send the  id to the deletenote.php file
        data: { id:deletebutton.next().attr("id")},   
        success: function(data){
            
       if(data == 'error'){
           
          $("#alertcontent").text("There was an issue deleting  the note from the database");
            $("#alert").fadeIn();  
           
           
       }     
           else{
               
               //remove containing div
               
               
               deletebutton.parent().remove();
               
               
               
           } 
            
            
        },
        error:function(){
            
         $("#alertcontent").text("There was an error with the Ajax call. Please try again!");
            $("#alert").fadeIn();
               
            
            
        },
        
        
    });
      
               
               
               
               
               
           });
           
           
           
           
           
           
       }
    
    
    
    //load notes on page load: Ajax call to loadnotes.php
    
    $.ajax({
        
        url:"loadnotes.php",
        success: function(data){
            
        $('#notes').html(data);    
            clickonnote();
            clickondelete();
            
        },
        error:function(){
            
         $("#alertcontent").text("There was an error with the Ajax call. Please try again!");
            $("#alert").fadeIn();
               
            
            
        },
        
        
    });
    
    
    //add a new note if the add note button is clicked: Ajax call to createnote.php
    
    $("#addnote").click(function(){
       
  
      $.ajax({
        
        url:"createnote.php",
        success: function(data){
            
        if(data == 'error'){
           
            
            $("#alertcontent").text("There was an issue inserting the new note in the database!");
            $("#alert").fadeIn();
           
           }
           else{
           
               //update the activenote variable to the new note 
               activenote = data;
               //making sure the textarea is empty
               $("textarea").val("");
                
               //show hide elements
               
               showhide(["#notepad","#allnotes"],["#notes","#addnote","#edit","#done"]);
               
               $("textarea").focus();
               
               
               
           
           }
            
            
        },
        
        error:function(){
            
         $("#alertcontent").text("There was an error with the Ajax call. Please try again!");
            $("#alert").fadeIn();
               
            
            
        },
        
    });  
        
        
        
        
        
        
        
        
        
    });
    
    
    
    
    //type note: Ajax call to updatenote.php
    
    $("textarea").keyup(function(){

        
        //ajax call to update the task of id activenote
        $.ajax({
        
        url:"updatenote.php",
        type:"POST",
        //we need to send the current note content with its id to the updatenote.php file
        data: {note:$(this).val(), id:activenote},   
        success: function(data){
            
          window.alert($(this).val());  
       if(data == 'error'){
           
          $("#alertcontent").text("There was an issue updating the notes in the database");
            $("#alert").fadeIn();  
           
           
       }     
            
            
            
        },
        error:function(){
            
         $("#alertcontent").text("There was an error with the Ajax call. Please try again!");
            $("#alert").fadeIn();
               
            
            
        },
        
        
    });
     
        
        
        
    });
    
    
    //click on all notes button: Ajax call to loadnotes.php
    $("#allnotes").click(function(){
        
       $.ajax({
        
        url:"loadnotes.php",
        success: function(data){
            
            
            
            
            
        $('#notes').html(data);    
          
        showhide(["#addnote","#edit","#notes"],["#allnotes","#notepad"]);    
         clickonnote();   
        clickondelete();    
        },
        error:function(){
            
         $("#alertcontent").text("There was an error with the Ajax call. Please try again!");
            $("#alert").fadeIn();
               
            
            
        },
        
        
    });
     
        
        
        
    });
    
    //click on done after editing: load notes again
    
    $("#done").click(function(){
        
        //switch to non-edit mode
        
        
        editmode = false;
        
        //expand the width of the notes ... by removing the class
        
        
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
        
        
        //show and hide elements
        
        showhide(["#edit"],[this,".delete"]);
        
        
    });
    
    //click on edit: go to the edit mode (show delete buttons, do some other width changes)
    $("#edit").click(function(){
        //go to edit mode 
        editmode = true;
        //reduce the width of our note by changing the class
        
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        
        //show hide elements 
        
        
        showhide(["#done",".delete"],[this]);
        
        
        
    });
    
    
    
    
    
    
    
});
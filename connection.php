<?php

//next is the php code for connecting to the database

$link = mysqli_connect("185.116.214.59","kimothec_admin","kJ7?BRWa#JGB","kimothec_mynotes");

        if(mysqli_connect_error()){
            
            die("ERROR: Unable to connect: " . mysqli_connect_error());
            
            
        }
?>
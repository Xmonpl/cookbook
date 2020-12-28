<?php
    if(!$logged){
        session_destroy();
        session_unset();
        header('Location: login.php'); 
    }
?>
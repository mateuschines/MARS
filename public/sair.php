<?php 

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    unset( $_SESSION["site"] );
    session_unset();
   
    session_destroy();

	



	header("Location: index.php");
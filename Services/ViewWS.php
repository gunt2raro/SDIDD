<?php

        if( isset( $_POST['action'] ) ){
            if( $_POST['action'] == "destroySession" ){
                session_start();
                session_destroy();
                print("true");
            }
	}
?>

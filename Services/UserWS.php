<?php

        require $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/UserController.php';
	require $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/LoginController.php';

        if( isset( $_GET['action'] ) ){

            if( $_GET['action'] == "getAll" ){

                print( UserController::getAll_JSON() );

            } else if( $_GET['action'] == "loginValidation" ){

		  $username = $_GET['username'];
		  $password = $_GET['password'];

		  if( LoginController::validate_user( $username, $password ) ){

		           session_start();

		           $u = new User;
		           $user = $u->getByAttr( "username", $username );

		           $_SESSION['username'] = $username;
		           $_SESSION['permissionid'] = $user->permissionid;

		           session_write_close();

		           print("true");

		  }else{
		        print("false");
		  }

	     }


        } else if( isset( $_POST['action'] ) ){

          if( $_POST['action'] == "Add" ){

              $us = $_POST['username'];
              $pass = $_POST['password'];
	      $per = $_POST['permissionid'];
	      $name = $_POST['name'];
	      $last = $_POST['last'];

              $uc = new UserController;

              print( json_encode( $uc->Add( $us, $pass, $per, $name, $last ) ) );

          }

        }

?>

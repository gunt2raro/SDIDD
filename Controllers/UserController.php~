<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/Index_system/Models/User.php';

	/***
        * ProductoController class
        **************************/
        class UserController{


                public static function getAll(){

                       $u = new User;

                       $all = $u->getAll_json();

                       return json_decode( $all, true );

		}//End of getAll function


                public static function getAll_json(){

                       $u = new User;

		       $all = $u->getAll_json();

                       return json_encode( array( 'data' => json_decode( $all ) ) );

	        }//End of getAll_json function

	        public function Add( $username, $password, $permissionid, $name, $last ){

                       $object = array(
                               'userid' => 0,
		               'username' => $username,
		               'password' => $password,
			       'permissionid' => $permissionid,
			       'name' => $name,
			       'lastname' => $last
		       );

		       $u = new User;

		       $u->create( $object );

		       $u->save();

		       return "success";

		}//End of function Add

	}//End of ProductoController Class
?>

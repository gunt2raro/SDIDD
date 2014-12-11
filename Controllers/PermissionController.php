<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/Index_system/Models/Permission.php';

	/***
        * ProductoController class
        **************************/
        class PermissionController{


                public static function getAll(){

                       $u = new Permission;

                       $all = $u->getAll_json();

                       return json_decode( $all, true );

		}//End of getAll function


                public static function getAll_json(){

                       $u = new Permission;

		       $all = $u->getAll_json();

                       return json_encode( array( 'data' => json_decode( $all ) ) );

	        }//End of getAll_json function

	}//End of ProductoController Class
?>

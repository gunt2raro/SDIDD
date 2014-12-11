<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/CatalogoController.php' );

	class TextHelper{

	      public static function add_hashtags( $text ){
	      
			$words = json_decode( CatalogoController::getAll(), true );
			

			foreach( $words as $w ){
				 $temp_word =  str_replace( ' ', '', $w['description'] );
				 $text = str_replace( $w['description'], ('#'.$temp_word), $text );	 
			}		

			return $text;
	
	      }//End of add_hashtags function

	}//End of TextHelper Method
?>
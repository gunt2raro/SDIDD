<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/exelReader.php' );

	if ( 0 < $_FILES['file_cat']['error'] ) {
           echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    	} else {
	   
		move_uploaded_file($_FILES['file_cat']['tmp_name'], '/var/www/uploads/' . $_FILES['file_cat']['name']);
  	        ExcelHelper::read_excel_to_catalogo( '/var/www/uploads/'.$_FILES['file_cat']['name'] );
	    
	}
?>
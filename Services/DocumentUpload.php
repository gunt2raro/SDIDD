<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/DocxConversion.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/exelReader.php' );

	if ( 0 < $_FILES['file']['error'] ) {
           echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    	} else {
	   
		move_uploaded_file($_FILES['file']['tmp_name'], '/var/www/uploads/' . $_FILES['file']['name']);
  	        ExcelHelper::read_excel_to_index( '/var/www/uploads/'.$_FILES['file']['name'] );
	    
	}
?>
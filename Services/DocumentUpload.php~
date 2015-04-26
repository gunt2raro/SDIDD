<?php

	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/DocxConversion.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/exelReader.php' );

	//Validate if the file
	if ( 0 < $_FILES['file']['error'] ) {

		//We print an error response
        	echo 'Error: ' . $_FILES['file']['error'] . '<br>';

    	} else {

		//Here we move the file to the server
		move_uploaded_file($_FILES['file']['tmp_name'], '/var/www/uploads/' . $_FILES['file']['name']);
		//We index the file we read to the index solr server
		ExcelHelper::read_excel_to_index( '/var/www/uploads/'.$_FILES['file']['name'] );

	}

?>

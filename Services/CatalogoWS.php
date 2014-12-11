<?php


	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/TextHelper.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Classes/PHPExcel/IOFactory.php' );
	
	$time = PHPExcel_Shared_Date::ExcelToPHPObject( 41948 );
	print_r( $time->format('m/d/Y') );
?>
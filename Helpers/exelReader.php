<?php

	require_once( $_SERVER['DOCUMENT_ROOT'].'/Classes/PHPExcel/IOFactory.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/GlobalSolrBars.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/CatalogoController.php' );

	/***
	* ExcelHelper
	* Class where all the magic happens
	***********************/
	class ExcelHelper{

	   /***
	   * read_excel_to_catalogo
	   * function that reads the excel where a catalog is in an saves all on the database
	   * @param doc - the doc file path
	   * @return none
	   *****************************************************/
	   public static function read_excel_to_catalogo( $doc ){

	    	if( !file_exists( $doc ) ){
	       	   return false;
	       	}else{

			$objReader = PHPExcel_IOFactory::createReader( 'Excel2007' );
			$objPHPExcel = $objReader->load( $doc );

			foreach( $objPHPExcel->getWorksheetIterator() as $worksheet ){
				 $i = 0;
				 //Iterate the cells
				 foreach( $worksheet->getRowIterator() as $row ){
					  //Iterates the rows
					  $cellIterator = $row->getCellIterator();
					  $cellIterator->setIterateOnlyExistingCells(false);

					  if( $i > 0 ){

						    foreach( $cellIterator as $cell ){
					  	    	     if( !is_null( $cell ) ){
								//Saves the word on the database
								CatalogoController::add_catalogo( utf8_decode( $cell->getCalculatedValue() ) );
						       	     }
						    }



					  }$i++;

				 }

			}
	       }

	   }//End of function read_excel_to_catalogo funtion

  	   /***
	   * read_excel_to_index
	   * function that reads the excel to index it on the solr server
	   **************************************************/
	   public static function read_excel_to_index( $doc ){

	       if( !file_exists( $doc ) ){
	       	   return false;
	       }else{
			$objReader = PHPExcel_IOFactory::createReader( 'Excel2007' );
			$objPHPExcel = $objReader->load( $doc );
			$options = array
			(
				'hostname' => SOLR_SERVER_HOSTNAME,
				'login'    => SOLR_SERVER_USERNAME,
				'password' => SOLR_SERVER_PASSWORD,
				'port' 	   => SOLR_SERVER_PORT,
			);

			foreach( $objPHPExcel->getWorksheetIterator() as $worksheet ){
				 $i = 0;
				 foreach( $worksheet->getRowIterator() as $row ){


					  $cellIterator = $row->getCellIterator();
					  $cellIterator->setIterateOnlyExistingCells(false);
					  $tempArray = array();
					  $paramsArray = array( 'clientid',
					  	       	 	'clientname',
								'edificio',
								'area',
								'ticket',
								'content_text',
								'solucion',
								'tiempo_sol',
								'username',
								'date',
								'comments');
					  if( $i > 3 ){
					      	    $count = 0;

						    foreach( $cellIterator as $cell ){
					  	    	     if( !is_null( $cell ) ){

								array_push( $tempArray, $cell->getCalculatedValue() );
								$count++;
						       	     }
						    }

						    $client = new SolrClient( $options );
						    $document = new SolrInputDocument();

						    for( $x = 1; $x < $count; $x++ ){

							if( $paramsArray[$x-1] == 'date' ){

							    	$time = PHPExcel_Shared_Date::ExcelToPHPObject( $tempArray[$x] );
								$document->addField( $paramsArray[$x-1], $time->format( 'm/d/Y' ) );

							} else {

							       $document->addField( $paramsArray[$x-1], $tempArray[$x] );

							}

						    }

						    $document->addField('time',date('h:i A'));
						    $updateResponse=$client->addDocument($document);

						    $client->commit();

						    print_r( $updateResponse->getResponse() );

					  }
					  $i++;
				 }

			}
	       }

	   }//End of read_excel function

	}//End of ExcelHelper class
?>

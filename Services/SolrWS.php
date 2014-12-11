<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/GlobalSolrBars.php' );

	if( isset( $_GET['action'] ) ){
	    if( $_GET['action'] == 'addDocument' ){

	    	//$data = $_GET['data'];

		$options = array
		(
			'hostname' => SOLR_SERVER_HOSTNAME,
    			'login'    => SOLR_SERVER_USERNAME,
    			'password' => SOLR_SERVER_PASSWORD,
    			'port'     => SOLR_SERVER_PORT,
		);

		$client = new SolrClient($options);

		$doc = new SolrInputDocument();

		$doc->addField('id', 334098);
		$doc->addField('cat', 'Cartas');
		$doc->addField('studentid', 'A00364333' );
		$doc->addField('name', 'Carta de Consulta de saldo');
		$doc->addField('description', 'This is an important document');
		$doc->addField('date', date('m').'/'.date('d').'/'.date('Y') );
		$doc->addField('time', date( 'h:i A' ) );

		$updateResponse = $client->addDocument($doc);

		// you will have to commit changes to be written if you didn't use $commitWithin
       	    	$client->commit();

		print_r($updateResponse->getResponse());


	    }

	}

?>

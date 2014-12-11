<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/GlobalSolrBars.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/TextHelper.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/CatalogoController.php' );

	if( isset( $_GET['action'] ) ){

	    if( $_GET['action'] == 'buscar' ){

	    	header('Content-Type: application/json');

	    	$data = $_GET['data'];

		if( $data != null ){

		    $options = array
		    (
			'hostname' => SOLR_SERVER_HOSTNAME,
    			'login'    => SOLR_SERVER_USERNAME,
    			'password' => SOLR_SERVER_PASSWORD,
    	       	  	'port'     => SOLR_SERVER_PORT,
    	       	    );

		    $client = new SolrClient($options);

		    $query = new SolrQuery();

		    $query->setQuery( $data );

		    $query->setStart(0);

		    $query->setRows(50);

		    $query->addField('id')->addField('clientid')->addField('clientname')->addField('edificio')->addField('area')->addField('ticket')->addField('content_text')->addField('solucion')->addField('tiempo_sol')->addField('username')->addField('date')->addField('time')->addField('comments');

		    $query_response = $client->query($query);

		    $response = $query_response->getResponse();

		    print_r( json_encode( $response ) );

		}
	    }else if( $_GET['action'] == 'stats' ){

	    	  if( $_GET['callN'] == 1 ){

		      $words = json_decode( CatalogoController::getAll(), true );
		      $returnArray = array();
		      $i = 1;

		      foreach( $words as $w ){

		      	       $des = $w['description'];
			       if( $des != "" ){

			       $options = array
                    	       (
				'hostname' => SOLR_SERVER_HOSTNAME,
                        	'login'    => SOLR_SERVER_USERNAME,
                        	'password' => SOLR_SERVER_PASSWORD,
                        	'port'     => SOLR_SERVER_PORT,
                    	    	);

                    	    	$client = new SolrClient($options);

                    	    	$query = new SolrQuery();

                    	    	$query->setQuery( 'content_text:*'.$des.'*' );

                    	    	$query->setStart(0);

                    	    	$query->setRows(50);

                    	    	$query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');

			    	$query_response = $client->query($query);

                    	    	$response = $query_response->getResponse();
				$tempObj = Array();

				array_push( $tempObj, $des );
				array_push( $tempObj, $response['response']['numFound'] );

			       	array_push( $returnArray, $tempObj );

				}
		      }
		      arsort( $returnArray );
		      $returnArray = array_slice($returnArray, 0, 10);
		      shuffle($returnArray );
		      print_r( json_encode( array( "json" => $returnArray ) ) );

		  }else if( $_GET['callN'] == 2 ){

                      $keyWord = $_GET['keyWord'];

		      $words = json_decode( CatalogoController::getAll(), true );
                      $returnArray = array();
                      $i = 1;

                      foreach( $words as $w ){

                          $des = $w['description'];

			  if( $des != "" ){

                               $options = array
                               (
                                'hostname' => SOLR_SERVER_HOSTNAME,
                                'login'    => SOLR_SERVER_USERNAME,
                                'password' => SOLR_SERVER_PASSWORD,
                                'port'     => SOLR_SERVER_PORT,
                                );

                                $client = new SolrClient($options);

                                $query = new SolrQuery();

                                $query->setQuery( 'content_text:*'.$des.'* AND (clientname:*'.$keyWord.'* OR clientid:'.$keyWord.')' );

                                $query->setStart(0);

                                $query->setRows(50);

                                $query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');

                                $query_response = $client->query($query);

                                $response = $query_response->getResponse();
                                $tempObj = Array();

                                array_push( $tempObj, $des );
                                array_push( $tempObj, $response['response']['numFound'] );

                                array_push( $returnArray, $tempObj );

                                }
                      }
                      arsort( $returnArray );

                      $returnArray = array_slice($returnArray, 0, 10);

		      shuffle($returnArray );

                      print_r( json_encode( array( "json" => $returnArray ) ) );

		  }else if( $_GET['callN'] == 3 ){


			$keyWord = $_GET['keyWord'];
			$state = $_GET['state'];

		      	$words = json_decode( CatalogoController::getAll(), true );
                      	$returnArray = array();
                      	$i = 1;
			//Date Query definition
			if( $state == 'month' ){

				$dateQuery = '['.(date('m')-1).'/'.date('d').'/'.date('Y').' TO *]';

			}else if( $state == 'year' ){

				$dateQuery = '[01/01/'.date('Y').' TO 12/31/'.date('Y').']';

			}else {

				$dateQuery = '[* TO *]';

			}

                     	foreach( $words as $w ){

                          $des = $w['description'];

			  if( $des != "" ){

                               $options = array
                               (
                                'hostname' => SOLR_SERVER_HOSTNAME,
                                'login'    => SOLR_SERVER_USERNAME,
                                'password' => SOLR_SERVER_PASSWORD,
                                'port'     => SOLR_SERVER_PORT,
                                );

                                $client = new SolrClient($options);

                                $query = new SolrQuery();

                                $query->setQuery( 'content_text:*'.$des.'* AND (clientname:*'.$keyWord.'* OR clientid:'.$keyWord.')'.' AND date:'.$dateQuery );

                                $query->setStart(0);

                                $query->setRows(50);

                                $query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');

                                $query_response = $client->query($query);

                                $response = $query_response->getResponse();
                                $tempObj = Array();

                                array_push( $tempObj, $des );
                                array_push( $tempObj, $response['response']['numFound'] );

                                array_push( $returnArray, $tempObj );

                          }
                      }
                      arsort( $returnArray );

                      $returnArray = array_slice($returnArray, 0, 10);

		      shuffle($returnArray );

                      print_r( json_encode( array( "json" => $returnArray ) ) );


		  }else if( $_GET['callN'] == 4 ){

			$keyWord = $_GET['keyWord'];

			$date1 = $_GET['date1'];
			$date2 = $_GET['date2'];

		      	$words = json_decode( CatalogoController::getAll(), true );
                      	$returnArray = array();
                      	$i = 1;

			//Date Query definition
			$dateQuery = '['.$date1.' TO '.$date2.']';


                     	foreach( $words as $w ){

                          $des = $w['description'];

			  if( $des != "" ){

                               $options = array
                               (
                                'hostname' => SOLR_SERVER_HOSTNAME,
                                'login'    => SOLR_SERVER_USERNAME,
                                'password' => SOLR_SERVER_PASSWORD,
                                'port'     => SOLR_SERVER_PORT,
                                );

                                $client = new SolrClient($options);

                                $query = new SolrQuery();

                                $query->setQuery( 'content_text:*'.$des.'* AND (clientname:*'.$keyWord.'* OR clientid:'.$keyWord.')'.' AND date:'.$dateQuery );

                                $query->setStart(0);

                                $query->setRows(50);

                                $query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');

                                $query_response = $client->query($query);

                                $response = $query_response->getResponse();
                                $tempObj = Array();

                                array_push( $tempObj, $des );
                                array_push( $tempObj, $response['response']['numFound'] );

                                array_push( $returnArray, $tempObj );

                          }
                      }
                      arsort( $returnArray );

                      $returnArray = array_slice($returnArray, 0, 10);

		      shuffle($returnArray );

                      print_r( json_encode( array( "json" => $returnArray ) ) );

		  }else if( $_GET['callN'] == 5 ){

			$date1 = $_GET['date1'];
			$date2 = $_GET['date2'];

		      	$words = json_decode( CatalogoController::getAll(), true );
                      	$returnArray = array();
                      	$i = 1;

			//Date Query definition
			$dateQuery = '['.$date1.' TO '.$date2.']';


                     	foreach( $words as $w ){

                          $des = $w['description'];

			  if( $des != "" ){

                               $options = array
                               (
                                'hostname' => SOLR_SERVER_HOSTNAME,
                                'login'    => SOLR_SERVER_USERNAME,
                                'password' => SOLR_SERVER_PASSWORD,
                                'port'     => SOLR_SERVER_PORT,
                                );

                                $client = new SolrClient($options);

                                $query = new SolrQuery();

                                $query->setQuery( 'content_text:*'.$des.' AND date:'.$dateQuery );

                                $query->setStart(0);

                                $query->setRows(50);

                                $query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');

                                $query_response = $client->query($query);

                                $response = $query_response->getResponse();
                                $tempObj = Array();

                                array_push( $tempObj, $des );
                                array_push( $tempObj, $response['response']['numFound'] );

                                array_push( $returnArray, $tempObj );

                          }
                      }
                      arsort( $returnArray );

                      $returnArray = array_slice($returnArray, 0, 10);

		      shuffle($returnArray );

                      print_r( json_encode( array( "json" => $returnArray ) ) );

		  }
	    }

	}

?>

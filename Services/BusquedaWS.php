<?php
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/GlobalSolrBars.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/TextHelper.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Helpers/Functions_helper.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/CatalogoController.php' );

	if( isset( $_GET['action'] ) ){

	    if( $_GET['action'] == 'buscar' ){

	    	header('Content-Type: application/json');

	    	$data = $_GET['data'];//Get the word to search for
		//Verificamos que el data tenga algo
		if( $data != null ){
		    //Hacemos un array con las variables del servidor solr
		    $options = array
		    (
			'hostname' => SOLR_SERVER_HOSTNAME,
    			'login'    => SOLR_SERVER_USERNAME,
    			'password' => SOLR_SERVER_PASSWORD,
    	       	  	'port'     => SOLR_SERVER_PORT,
    	       	    );
	   	    //Inicializamos el cliente solr
		    $client = new SolrClient($options);
   		    //Inicializamos el query
		    $query = new SolrQuery();
		    //Ejecutamos la query que es simplemente buscar una palabra
		    $query->setQuery( $data );
		    //Desde donde queremos nuestros resultados
		    $query->setStart(0);

		    $query->setRows(50);
		    //Especificamos los campos que queremos de la query.
		    $query->addField('id')->addField('clientid')->addField('clientname')->addField('edificio')->addField('area')->addField('ticket')->addField('content_text')->addField('solucion')->addField('tiempo_sol')->addField('username')->addField('date')->addField('time')->addField('comments');
		    //guardamos lo que regresa la query en una variable
		    $query_response = $client->query($query);
		    //De lo que regruesó la query, especificamos que queremos la response con los datos
		    $response = $query_response->getResponse();
		    //Imprimimos la respuesta codificada en json
		    print_r( json_encode( $response ) );

		}//End of validation

	    }else if( $_GET['action'] == 'stats' ){//Stadistics validation for calls
		  //Llamada #1
	    	  if( $_GET['callN'] == 1 ){
		      //Obtenemos las palabras del catalogo en la base de datos
		      $words = json_decode( CatalogoController::getAll(), true );
		      //Inicializamos el array que regresaremos
		      $returnArray = array();
		      //Contador
		      $i = 1;
		      //Iteramos el array del catalogo
		      foreach( $words as $w ){
			       	//La descripcion de cada palabra
		      	       	$des = $w['description'];
				//Validate if descripcion is not null
				if( $des != "" ){
					//Array con las variables para entrar al servidor solr
					$options = array
					(
						'hostname' => SOLR_SERVER_HOSTNAME,
						'login'    => SOLR_SERVER_USERNAME,
						'password' => SOLR_SERVER_PASSWORD,
						'port'     => SOLR_SERVER_PORT,
					);//End of array init
					//Inicializar el cliente solr
					$client = new SolrClient($options);
					//Inicializamos la query
					$query = new SolrQuery();
					//Establecemos la query a buscar
					$query->setQuery( 'content_text:*'.$des.'*' );
					//Desde donde queremos nuestros resultados
					$query->setStart(0);
					//Hasta donde las queremos
					$query->setRows(50);
					//Definimos las variables que queremos de la busqueda
					$query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');
					//ejecutamos la query
					$query_response = $client->query($query);
					//Obtenemos la respuesta de la query
					$response = $query_response->getResponse();
					//Un array temporal que llevará la descripcion y el número de cuantas veces está en el servidor
					$tempObj = Array();
					//Agregamos la descripcion en el array temporal
					array_push( $tempObj, $des );
					//Agregamos el número de reps en el array temporal
					array_push( $tempObj, $response['response']['numFound'] );
					//Agregamos el array temporal al array de regreso
					array_push( $returnArray, $tempObj );

				}//End of validation
		      }//End of the loop
		      //Ordenamos el array del más alto al más bajo
		      //----------arsort( $returnArray );
		      $returnArray = sort_array_by_popularity( $returnArray );
		      //Obtenemos los primeros 10
		      $returnArray = array_slice($returnArray, 0, 10);
		      //Lo ordenamos aleatoriamente
		      //shuffle($returnArray );
		      //Regresamos el array codificado en json
		      print_r( json_encode( array( "json" => $returnArray ) ) );
		  //Llamada #2
		  //Esta llamada regresa el top ten de las palabras más repetidas
		  //Relacionadas con una palabra de busqueda
		  }else if( $_GET['callN'] == 2 ){
		      //Palabra clave desde la busqueda en la vista
                      $keyWord = $_GET['keyWord'];
		      //Palabras que obtenemos desde la base de datos
		      $words = json_decode( CatalogoController::getAll(), true );
		      //Inicializamos el array que regresaremos con las palabras
                      $returnArray = array();
		      //Contador
                      $i = 1;
		      //Iteramos las palabras del catalogo
                      foreach( $words as $w ){
			  //Descripcion de la palabra
                          $des = $w['description'];
			  //Validamos si la descripcion no es nula
                           if( $des != "" ){
			       	//Inicializamos el array con las variables globales de solr para entrar al servidor
                               	$options = array
                               	(
		                        'hostname' => SOLR_SERVER_HOSTNAME,
		                        'login'    => SOLR_SERVER_USERNAME,
		                        'password' => SOLR_SERVER_PASSWORD,
		                        'port'     => SOLR_SERVER_PORT,
                                );//End of array initialization
				//Inicializamos el cliente solr
                                $client = new SolrClient($options);
				//Inicializamos la query
                                $query = new SolrQuery();
				//Escribimos la query
                                $query->setQuery( 'content_text:*'.$des.'* AND (clientname:*'.$keyWord.'* OR clientid:'.$keyWord.')' );
				//Desde donde queremos el resultado
                                $query->setStart(0);
				//Hata donde la queremos
                                $query->setRows(50);
				//Establecemos las variables que queremos en el resultado
                                $query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');
				//Ejecutamos la query
                                $query_response = $client->query($query);
				//Obtenemos la respuesta de la query
                                $response = $query_response->getResponse();
				//Array temporal
                                $tempObj = Array();
				//Agregamos la descripcion de la palabra en el array temporal
                                array_push( $tempObj, $des );
				//Agregamos el número de respuestas en el array temporal
                                array_push( $tempObj, $response['response']['numFound'] );
				//Agregamos el array temporal en el array de regreso
                                array_push( $returnArray, $tempObj );

                           }//End of validation
                      }//End of loop
		      //Ordemanos el array de más alto a bajo
                      //------arsort( $returnArray );
		      $returnArray = sort_array_by_popularity( $returnArray );
		      //Get the first 10
                      $returnArray = array_slice($returnArray, 0, 10);
		      //Ordenar aleatoriamente el array
		      //shuffle($returnArray );
		      //Return the array encoded as json
                      print_r( json_encode( array( "json" => $returnArray ) ) );

		  }else if( $_GET['callN'] == 3 ){//The Call #3

			//The key word the search is about
			$keyWord = $_GET['keyWord'];
			//State so we can get the month, year, or all top wordss
			$state = $_GET['state'];
			//The catalog words from the database
		      	$words = json_decode( CatalogoController::getAll(), true );
			//The return array that will get the top words
                      	$returnArray = array();
			//Count
                      	$i = 1;
			//Date Query definition
			if( $state == 'month' ){
				//If it is by month
				$dateQuery = '['.(date('m')-1).'/'.date('d').'/'.date('Y').' TO *]';

			}else if( $state == 'year' ){
				//If it is by year
				$dateQuery = '[01/01/'.date('Y').' TO 12/31/'.date('Y').']';

			}else {
				//Or all time
				$dateQuery = '[* TO *]';

			}//End of the validations
			//Looping the words from the database
                     	foreach( $words as $w ){
				//Get the word description
				$des = $w['description'];
				//Validte if description is null or not
				if( $des != "" ){
					//set the options for the solr connection
					$options = array
					(
						'hostname' => SOLR_SERVER_HOSTNAME,
						'login'    => SOLR_SERVER_USERNAME,
						'password' => SOLR_SERVER_PASSWORD,
						'port'     => SOLR_SERVER_PORT,
					);//End of options array definition
					//The client initialization
					$client = new SolrClient($options);
					//The query initialization
					$query = new SolrQuery();
					//Define the query
					$query->setQuery( 'content_text:*'.$des.'* AND (clientname:*'.$keyWord.'* OR clientid:'.$keyWord.')'.' AND date:'.$dateQuery );
					//Where the search return
					$query->setStart(0);
					//how many rows it will return
					$query->setRows(50);
					//Set the fields to return
					$query->addField('id')->addField('clientid')->addField('content_text')->addField('date')->addField('time');
					//Run the query
					$query_response = $client->query($query);
					//The return response
					$response = $query_response->getResponse();
					//Themorary object array
					$tempObj = Array();
					//Set the description to the temporary array
					array_push( $tempObj, $des );
					//set the number to the temporary array
					array_push( $tempObj, $response['response']['numFound'] );
					//add to the return array the temporary array
					array_push( $returnArray, $tempObj );

				}//End of validation
                      	}//End of loop
			//Sort the return array
			///--------arsort( $returnArray );
		      	$returnArray = sort_array_by_popularity( $returnArray );
			//get the first 10 of the array
			$returnArray = array_slice($returnArray, 0, 10);
			//Sort aleatory the array
			//shuffle($returnArray );
			//Return the array encoded as json
			print_r( json_encode( array( "json" => $returnArray ) ) );

		  }else if( $_GET['callN'] == 4 ){//The call #4
			//The key word from the view
			$keyWord = $_GET['keyWord'];
			//get Date @1
			$date1 = $_GET['date1'];
			//get Date #2
			$date2 = $_GET['date2'];
			//Get the catalog from the database
		      	$words = json_decode( CatalogoController::getAll(), true );
			//Initialize the return array
                      	$returnArray = array();
			//Cont
                      	$i = 1;
			//Date Query definition
			$dateQuery = '['.$date1.' TO '.$date2.']';
			//looping the words
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

                      ////------arsort( $returnArray );
		      $returnArray = sort_array_by_popularity( $returnArray );

                      $returnArray = array_slice($returnArray, 0, 10);

		      //shuffle($returnArray );

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
                      ///-------------arsort( $returnArray );
		      $returnArray = sort_array_by_popularity( $returnArray );

                      $returnArray = array_slice($returnArray, 0, 10);

		      //shuffle($returnArray );

                      print_r( json_encode( array( "json" => $returnArray ) ) );

		  }
	    }

	}

?>

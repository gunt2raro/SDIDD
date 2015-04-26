<?php

	/***
	* sort_array_by_popularity
	* function that sorts an array of tickets by the one with more pettitions with bubble array
	*************************************/
	function sort_array_by_popularity( $tickets_array ){

		if( $tickets_array != NULL ){

			//create a temporal array

			for ( $c = 0 ; $c < ( count( $tickets_array ) - 1 ); $c++ ){

				for ( $d = 0 ; $d < count( $tickets_array ) - $c - 1; $d++ ){

					if ( $tickets_array[$d][1] < $tickets_array[$d+1][1] ){

						$temp = $tickets_array[$d];
						$tickets_array[$d]   = $tickets_array[$d+1];
						$tickets_array[$d+1] = $temp;

			      		}

				}

			}return $tickets_array;

		}
		return NULL;

	}//End of the sort_array_by_popularity function
?>

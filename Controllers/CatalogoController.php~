<?php 

      require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Models/Catalogo.php' );


      class CatalogoController{
      
		public static function getAll(){
		       $c = new Catalogo;
		       return $c->getAll_json();
		}//End of getAll Method

		public static function add_catalogo( $word ){
		
			$c = new Catalogo;

			if( json_decode( $c->getByAttr_json('description', $word), true ) == null ){
			    
			    $c->create(array(
				'catalogoid' => 0,
				'description' => $word,
				'stock' => 0
			    ));
			    
			    $c->save();

			}

		}//End of add_catalogo function

      }//End of CatalogoController Class
?>
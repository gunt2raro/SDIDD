<?php

	session_start();

	if( !isset( $_SESSION['username'] ) ){
              header("Location: /Index_system/Views/Login.php");
	}

?>
<!DOCTYPE html>
<html lang="es" >

        <head>
                <meta charset="utf-8" />
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

                <!-- Optional theme -->
                <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
                <!---<link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">-->
		<link href="/Index_system/css/dashboard.css" rel="stylesheet">
                <link rel="stylesheet" type="text/css" href="css/style/common.css" />
                <title>SDIDD</title>


                <!---<link class="include" rel="stylesheet" type="text/css" href="css/styles/jquery.jqplot.min.css" />---->
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<!----------Graphics------->
		<script type="text/javascript" src="js/jquery.min.js"></script>
                <script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.dateAxisRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.logAxisRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.canvasTextRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.categoryAxisRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.barRenderer.min.js"></script>
                <script type="text/javascript" src="plugins/jqplot.cursor.min.js"></script>
		<script type="text/javascript" src="plugins/jqplot.dateAxisRenderer.min.js"></script>

		<!------Data Tables------------>
                <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css" />
                <script src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

		<!---------Switch button bootstrap------------>
		<link href="css/bootstrap-switch.css" rel="stylesheet">
		<script src="js/bootstrap-switch.js"></script>

		<link class="include" rel="stylesheet" type="text/css" href="css/style/jquery.jqplot.min.css" />

		<script src="/Index_system/js/dataScript.js" ></script>
                <script src="/Index_system/Helpers/TicketGen.js" ></script>
		<script src="/Index_system/js/userCRUD.js"></script>
                <script src="/Index_system/js/buttonHandler.js" ></script>
                <script src="/Index_system/js/views.js"></script>
		<script src="/Index_system/js/profile.js"></script>

	</head>

        <body ><!-----oncontextmenu="return false"----->
                <!-------- Menu Bar ------>
                <div id="navBar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <div class="container-fluid">
                                <div class="navbar-header">
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                        </button>
					<div class="btn-toolbar" role="toolbar" aria-label="">

					     <div class="btn-group" role="group" ><img style="max-width:70px; margin-top: -5px;" src="css/images/QMdJOb3.png"></div>
  					     <div class="btn-group" role="group" ><h3 style="color:white; margin-top:18px;" class="page-header">SDIDD</h3></div>

					</div>

                                </div>
                                <div class="navbar-collapse collapse">
                                        <ul class="nav navbar-nav navbar-right">
						<?php
							if( $_SESSION['permissionid'] == 1 ){

								print('
						                        <li><a id="bPerfil_header"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
									<li><a id="bIndex_doc_header"><span class="glyphicon glyphicon-open" aria-hidden="true"></span></a></li>
									<li><a id="bBusqueda_header"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
									<li><a id="bInbox_header"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span></a></li>
									<li><a id="bStats_header"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></a></li>
									<li><a id="bClose_session"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
								');

							}else if( $_SESSION['permissionid'] == 2 ){

								print('
									<li><a id="bHome_header"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
									<li><a id="bIndex_doc_header"><span class="glyphicon glyphicon-open" aria-hidden="true"></span></a></li>
									<li><a id="bBusqueda_header"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
									<li><a id="bClose_session"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
								');

							}

						?>
                                        </ul>
                                </div>
                        </div>
                </div>

		<br/><br/>
                <div class="container-fluid">
                        <div class="row">
                                <div class="col-sm-3 col-md-2 sidebar">
                                        <ul class="nav nav-sidebar">
						<?php
							if( $_SESSION['permissionid'] == 1 ){
							    print( '<li id="bPerfil" class="active"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Perfil</a></li>
				                                <li id="bControl_usuarios"><a href="#"><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> Control de Usuarios</a></li>
				                                <li id="bIndex_doc"><a href="#"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Indexar Documentos</a></li>
				                                <li id="bBusqueda"><a href="#"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Búsqueda</a></li>
				                                <li id="bEstadisticas"><a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Estadisticas</a></li>
				                                <li id="bConfiguracion"><a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configuración</a></li>'

				                                );
							}else if( $_SESSION['permissionid'] == 2 ){

							    print( '<li id="bPerfil" class="active"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Perfil</a></li>
                                                		<li id="bIndex_doc"><a href="#"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Indexar Documentos</a></li>
                                                		<li id="bBusqueda"><a href="#"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Búsqueda</a></li>' );
							}
						?>

                                        </ul>
                                </div>
                                <!----------Perfil de Usuario------------>
                                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="perfil_de_usuario">

                                        <h2 class="page-header"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Bienvenido </h2>


						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
						  <div class="panel panel-info">
						    <div class="panel-heading">
						      <h3 class="panel-title"><?php print( $_SESSION['username'] );?></h3>
						    </div>
						    <div class="panel-body">
						      <div class="row">
							<div class="col-md-3 col-lg-3" align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
							<div class=" col-md-9 col-lg-9 ">
							  <table class="table table-user-information">
							    <tbody>
								<?php
		                                                	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Models/User.php' );
		                                                	require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Models/Permission.php' );

									$u = new User;
									$p = new Permission;
									$u = $u->getByAttr( 'username', $_SESSION['username'] );
									$p = $p->getByAttr( 'permissionid', $_SESSION['permissionid'] );
									print( '<tr><td>Nombre de Usuario:</td><td>'.$u->username.'</td></tr>' );
									print( '<tr><td>Nombre:</td><td>'.$u->name.'</td></tr>' );
									print( '<tr><td>Apellidos:</td><td>'.$u->lastname.'</td></tr>' );
									print( '<tr><td>Posición en el sistema:</td><td>'.$p->description.'</td></tr>' );
								?>
							    </tbody>
							  </table>
							</div>
						      </div>
						    </div>
							 <div class="panel-footer">
								<a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
								<span class="pull-right">
								    <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
								    <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
								</span>
							    </div>

						  </div>
						</div>
                                </div>
                        </div>

                        <!----------Ventana Control de Usuarios---------->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="control_de_usuarios">


                                <h1 class="page-header">Control de Usuarios</h1>

				<div class="column1">
                                  <div id="boxProductos_tools" class="alert alert-info">
                                       <button type="button" class="btn btn-lg btn-info" id="bAdd_user">Nuevo Usuario</button>
                                       <button type="button" class="btn btn-lg btn-danger" id="bDelete_users">Borrar Select</button>
                                  </div>
                             	</div>

                             	<div>
                                	<table id="tbUser" class="table" cellspacing="0" width="100%">
                                	       <thead>
                                                <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
                                                        <th>Name</th>
                                                        <th>Last Name</th>
                                                        <th>Permission</th>
                                                </tr>
                                	       </thead>
                                	       <tfoot>
                                                <tr>
                                                        <th>#</th>
                                                        <th>Username</th>
                                                        <th>Name</th>
                                                        <th>Last Name</th>
                                                        <th>Permission</th>
                                                </tr>
                                	       </tfoot>
                                	</table>
                             	</div>


                        </div>
			<!------------------Ventana nuevo usuario------------->
			<div id="addUserForm" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="col-md-5">
                                  <p>
                                        <strong>Username**:  </strong> <input id="txtUsername" type="text" name="username" class="form-control" placeholder="User Name"/>
                                  </p>
				  <p>
                                        <strong>Name:  </strong> <input id="txtName" type="text" name="name" class="form-control" placeholder="Name"/>
                                  </p>
			          <p>
                                        <strong>Last Name:  </strong> <input id="txtLastName" type="text" name="lastname" class="form-control" placeholder="Last Name"/>
                                  </p>
				  <p>
                                        <strong>Password**:  </strong> <input id="txtPassword" type="password" name="password" class="form-control" placeholder="Password"/>
                                  </p>
				  <p>
                                        <strong>Re-Password**:  </strong> <input id="txtRePassword" type="password" name="repassword" class="form-control" placeholder="Repeat Password"/>
                                  </p>
                                  <p>
                                        <strong>Permission**:  </strong>
                                        <select id="txtPermission" class="form-control">
                                                <?php
                                                        require_once( $_SERVER['DOCUMENT_ROOT'].'/Index_system/Controllers/PermissionController.php' );

                                                        $all = PermissionController::getAll();
							print( '<option>Permission</option>' );
                                                        foreach( $all as &$prov ){
                                                             print( '<option id="'.$prov['permissionid'].'">'.$prov['description'].'</option>' );
                                                        }
                                                ?>
                                        </select>
                                  </p>
                                  <p>
                                        <button id="bCancelAddUserDB" class="btn btn-lg btn-danger">Cancelar</button>
                                        <button id="bAddUserDB" class="btn btn-lg btn-info">Agregar</button>
                                  </p>
				</div>
                        </div>

			<!----------Indexar Documentos ----->
                        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="index_doc">

                                <h1 class="page-header">Indexar Documento</h1>
				<div class="row">
					<div id="FormDocument" >
					      <br />
					      <label id="lURL">Indexar Tickets</label>
					      <input id="txtFiles" type="file" name="files" class="form-control" multiple="multiple" />
					      <p id="Add_box_buttons">
		                              	<a id="bAdd_doc" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-floppy-disk"></span></a>
					      </p>
					      <div id="file" name="file"></div>
					      <br /><br />
					</div>

					<div id="FormCatalogo" >
					      <br />
					      <label>Guardar Catalógo</label>
					      <input id="txtFiles_cat" type="file" name="files_cat" class="form-control" multiple="multiple" />
					      <p id="Add_box_buttons">
		                              	<a id="bAdd_cat" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-floppy-disk"></span></a>
					      </p>
					      <div id="file_cat" name="file_cat"></div>
					      <br /><br />
					</div>
				</div>

                        </div>

                        <!----------Busqueda---------->
                        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="busqueda">

                             <h1 class="page-header">Búsqueda</h1>

				<div id="FormSearch">

				      <center>
						<label id="lBusqueda"><h2>Búsqueda avanzada...</h2></label>
				      	     	<input id="txtBuscar" type="text" name="txtBuscar" class="form-control" placeholder="Buscar"/>
				      		<p id="Add_box_buttons">

				      		</p>
				      </center>

				</div>

				<div id="result">



				</div>

                        </div>

			<!---------Historial---------->
                        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="historial">

                             <h1 class="page-header">Historial</h1>

                             <div class="column1">
                                  <div id="boxProductos_tools" class="alert alert-info">
                                       <button type="button" class="btn btn-lg btn-info" id="bAdd_producto">Nuevo Producto</button>
                                       <button type="button" class="btn btn-lg btn-info" id="bSave_productos">Guardar Todos</button>
                                       <button type="button" class="btn btn-lg btn-danger" id="bDelete_productos">Borrar Select</button>
                                  </div>
                             </div>

                             <div>
                                <table id="tbProducto" class="display" cellspacing="0" width="100%">
                                       <thead>
                                                <tr>
                                                        <th>Productoid</th>
                                                        <th>Descripcion</th>
                                                        <th>Proveedor</th>
                                                </tr>
                                       </thead>
                                       <tfoot>
                                                <tr>
                                                        <th>Productoid</th>
                                                        <th>Descripcion</th>
                                                        <th>Proveedor</th>
                                                </tr>
                                       </tfoot>
                                </table>
                             </div>

                        </div>


			<!---------Estadisticas---------->
                        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="estadisticas">

			     <h1 class="page-header">Estadisticas</h1>

			     <div class="row">
			     	  <div class="col-md-6"></div>
				  <div class="col-md-4">
				      <input id="txtBuscarEst" type="text" name="txtBuscar" class="form-control" placeholder="Buscar"/>
				  </div>
				  <div class="col-md-2">
					<button class="btn btn-info" id="bBuscarEst"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
			          	<button class="btn btn-info" id="bBuscarEst"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></button>
				  </div>

			     </div>
			     <br />
			     <div id="stats">

				  <div class="resultBox" id="chartWord"style= "height:400px;" align="center"></div>
				  <br />
				  <div class="row">
					<div class="col-md-3">
					    <h4>Top 10 <div id="topWord"></div></h4>
					</div>
					<div class="col-md-4">

						<input class="btn btn-default" type="button" value="mes" id="bcMes" >
						<input class="btn btn-default" type="button" value="año" id="bcYear" >
						<input class="btn btn-default" type="button" value="todos" id="bcAll" >
						<a id="bGetStats" class="btn btn-default">Manual <span id="bShowDates" class="glyphicon glyphicon-chevron-down"></span></a>

					</div>
				  </div>
			          <div id="setDatesBox" class="row" style="display:none;">

					<div class="col-md-4">
					<?php

					   print( '<select id="txtDay1" class="form-control">' );
					   print( '<option id="0">Día</option>' );

					   for( $i = 1; $i <= 31; $i++ ){
						if($i<10){
							print( '<option id="0'.$i.'">'.$i.'</option>' );
						}else{
					   		print( '<option id="'.$i.'">'.$i.'</option>' );
						}
					   }

					   print( '</select>' );
					   print( '<select id="txtMonth1" class="form-control">' );
					   print( '<option id="0">Mes</option>' );

    					   $months = array( "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" );

					   for( $i = 0; $i < 12; $i++ ){
						if(($i+1)<10){
							print( '<option id="0'.($i+1).'">'.$months[$i].'</option>' );
						}else{
					   		print( '<option id="'.($i+1).'">'.$months[$i].'</option>' );
						}
					   }

					   print( '</select>' );
					   print( '<select id="txtYear1" class="form-control">' );
					   print( '<option id="0">Año</option>' );

					   for( $i = 1990; $i <= date('Y'); $i++ ){
					   	print( '<option id="'.$i.'">'.$i.'</option>' );
					   }

					   print( '</select>' );

					?>
					</div>

					<div class="col-md-4">
					<?php

					   print( '<select id="txtDay2" class="form-control">' );
					   print( '<option id="0">Día</option>' );

					   for( $i = 1; $i <= 31; $i++ ){
						if($i<10){
							print( '<option id="0'.$i.'">'.$i.'</option>' );
						}else{
					   		print( '<option id="'.$i.'">'.$i.'</option>' );
						}
					   }

					   print( '</select>' );
					   print( '<select id="txtMonth2" class="form-control">' );
					   print( '<option id="0">Mes</option>' );

    					   $months = array( "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" );

					   for( $i = 0; $i < 12; $i++ ){
						if(($i+1)<10){
							print( '<option id="0'.($i+1).'">'.$months[$i].'</option>' );
						}else{
					   		print( '<option id="'.($i+1).'">'.$months[$i].'</option>' );
						}
					   }

					   print( '</select>' );
					   print( '<select id="txtYear2" class="form-control">' );
					   print( '<option id="0">Año</option>' );

					   for( $i = 1990; $i <= date('Y'); $i++ ){
					   	print( '<option id="'.$i.'">'.$i.'</option>' );
					   }

					   print( '</select>' );

					?>
					</div>
					<div class="col-md-2">
						<a id="bGetStatsFromDates" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-arrow-right"></span></a>
					</div>

				  </div>
				  <br />
				  <div class="row resultBox">
				       <div class="col-md-7">
				          <table class="table" id="tbWords">
						<thead>
							<tr>
								<th>#</th>
								<th>Palabra</th>
								<th>Reps</th>
							</tr>
					 	</thead>
					 	<tbody>

					 	</tbody>
				          </table>
				       </div>

				  </div>
			     </div>

			</div>

			<!---------Configuración---------->
                        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="configuracion">

			     <h1 class="page-header">Configuración</h1>

			     <div class="row" >

			     	<div class="col-md-7  resultBox">

		                          <p>
		                                <strong>server:  </strong> <input id="txtServer" type="text" name="server" class="form-control" placeholder="server"/>
		                          </p>

					  <p>
		                                <strong>username:  </strong> <input id="txtUserServer" type="text" name="username" class="form-control" placeholder="username"/>
		                          </p>

					  <p>
		                                <strong>password:  </strong> <input id="txtPasswordServer" type="text" name="password" class="form-control" placeholder="password"/>
		                          </p>

					  <p>
		                                <strong>port:  </strong> <input id="txtPort" type="text" name="port" class="form-control" placeholder="port"/>
		                          </p>

		                          <p>
		                                <button id="bCancelSettings" class="btn btn-lg btn-danger">Cancelar</button>
		                                <button id="bSaveSettings" class="btn btn-lg btn-info">Guardar</button>
		                          </p>

					  <br />

					  <small>**Cambiar las configuraciones establecidas están bajo su porpio riesgo.</small>

				</div>

				<div class="col-md-7 resultBox" style="margin-left:50px">
					  <!----
					  <br />

					  <p>
		                                <strong>Tickets manual:  </strong> <input type="checkbox" id="cbTickets" name="my-checkbox" checked>
		                          </p>

					  <br />--->
					<h3>Agregar nuevo campo de excel</h3>
					<p>
		                                <strong>Descripción:  </strong> <input id="txtDescription" type="text" name="port" class="form-control" placeholder="descripción"/>
		                        </p>
					<p>
		                                <strong>Tipo de Dato:  </strong> <input id="txtDataType" type="text" name="port" class="form-control" placeholder="tipo"/>
		                        </p>
					<p>
		                                <button id="bAddNewField" class="btn btn-lg btn-info">Agregar</button>
		                        </p>
				</div>

			     </div>

			</div>

		</div>

                <!-- Latest compiled and minified JavaScript -->
                <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
                <script src="http://getbootstrap.com/assets/js/docs.min.js"></script>


        </body>
</html>

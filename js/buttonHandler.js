//Global Variables
var file_info;
var file_info_cat;

/***
* Every time!
***************/
$(function() {
    startRefresh();
});//End of always function

/***
* startRefresh
* Function that actualizes with delay the actual values of the db
*************************/
function startRefresh() {
    setTimeout(startRefresh,1000);
    get_results();
}//End of startRefresh function

/***
* onReady
* function that has all the on beginning sripting
***************************************/
function buttonsInit(){

    $( '#bPerfil' ).attr( 'class', 'active' );
    $( '#perfil_de_usuario' ).show();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide()
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();

    $( '#bPerfil' ).click( bPerfil_action );
    $( '#bControl_usuarios' ).click( bControl_usuarios_action );
    $( '#bIndex_doc' ).click( bIndex_doc_action );
    $( '#bBusqueda' ).click( bBusqueda_action );
    $( '#bEstadisticas' ).click( bEstadisticas_action );
    $( '#bConfiguracion' ).click( bConfiguracion_action );

    $( '#bAdd_doc' ).click( bAdd_doc_action );
    $( '#bAdd_cat' ).click( bAdd_catalogo_action );
    $( '#bPerfil_header' ).click( bPerfil_action );
    $( '#bIndex_doc_header' ).click( bIndex_doc_action );
    $( '#bBusqueda_header' ).click( bBusqueda_action );
    $( '#bStats_header' ).click( bEstadisticas_action );
    $( '#bInbox_header' ).click( bControl_usuarios_action );
    $( '#bAdd_user' ).click( bAdd_user_action );

    $( '#bAddUserDB' ).click( add_user );
    $( '#bCancelAddUserDB' ).click( cancel_user );

    $( '#bCancelSettings' ).click( function(){

	$.ajax({
		'type' : 'GET',
		'dataType' : 'xml',
		'url' : 'http://localhost/Index_system/Helpers/serverSolr_conf.xml',
		success : function(data){

			$(data).find('connection').each(function(){
				var server = $(this).find('server').text();
				var username = $(this).find('username').text();
				var password = $(this).find('password').text();
				var port = $(this).find('port').text();
				$('#txtServer').val(server);
				$('#txtUserServer').val(username);
				$('#txtPasswordServer').val(password);
				$('#txtPort').val(port);
			});

		}
    	});

    });

    $( '#bSaveSettings' ).click( function(){

	var server = $('#txtServer').val();
	var username = $('#txtUserServer').val();
	var password = $('#txtPasswordServer').val();
	var port = $('#txtPort').val();

	$.ajax({
		'type' : 'POST',
		'dataType' : 'json',
		'url' : 'http://localhost/Index_system/Helpers/config_file_post.php',
		'data' : { 'server' : server , 'username' : username, 'password' : password, 'port' : port },
		success : function(data){

			if(data == "success"){

				alert("file uploaded");
			}

		}
    	});

    });

    $('#bShowDates').click( function(){

	var attr = $('#bShowDates').attr('class');

 	if( attr == "glyphicon glyphicon-chevron-down" ){

		$('#bShowDates').attr('class', 'glyphicon glyphicon-chevron-up');
		$('#setDatesBox').show();

	} else if( attr == "glyphicon glyphicon-chevron-up" ){

		$('#bShowDates').attr('class', 'glyphicon glyphicon-chevron-down');
		$('#setDatesBox').hide();

	}
    });

    $('#bGetStatsFromDates').click( bGetStatsByDates );

    $("input[name=files]").change(function() {
	file_info = $(this).get(0).files;
	$("div[name=file]").show();
	$("div[name=file]").html("<br /><h4>Files Choosed </h4><hr />");
	for (var i = 0; i <  file_info.length; ++i) {
	    $("div[name=file]").append( '<div class="fileChooser_info_files">' +
					file_info[i].name
					+ '<br />'
					+ file_info[i].size
					+ '<br />'
					+ file_info[i].type
					+ '<br />'
					+ file_info[i].lastModifiedDate.toLocaleDateString()
					+ '</div><hr /><br />' );
	}
    });

    $("input[id=txtFiles_cat]").change(function() {
	file_info_cat = $(this).get(0).files;
	$("div[name=file_cat]").show();
	$("div[name=file_cat]").html("<br /><h4>Files Choosed </h4><hr />");
	for (var i = 0; i <  file_info_cat.length; ++i) {
	    $("div[name=file_cat]").append( '<div class="fileChooser_info_files_cat">' +
					file_info_cat[i].name
					+ '<br />'
					+ file_info_cat[i].size
					+ '<br />'
					+ file_info_cat[i].type
					+ '<br />'
					+ file_info_cat[i].lastModifiedDate.toLocaleDateString()
					+ '</div><hr /><br />' );
	}
    });

}//End of onReady function





/***
* bConfiguracion_action
* function that performs configuration button
***************************************/
function bConfiguracion_action(){

    //$("#cbTickets").bootstrapSwitch( 'state', false, true );

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', '' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', 'active' );

    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).show();
    $( '#addUserForm' ).hide();


    $.ajax({
	'type' : 'GET',
	'dataType' : 'xml',
	'url' : 'http://localhost/Index_system/Helpers/serverSolr_conf.xml',
	success : function(data){

		$(data).find('connection_solr').each(function(){
			var server = $(this).find('server').text();
			var username = $(this).find('username').text();
			var password = $(this).find('password').text();
			var port = $(this).find('port').text();
			$('#txtServer').val(server);
			$('#txtUserServer').val(username);
			$('#txtPasswordServer').val(password);
			$('#txtPort').val(port);
		});
		$(data).find('prefs').each(function(){
			var tickets_manual = $(this).find('tickets_manual').text();
			console.log(tickets_manual);
			if( tickets_manual == "On" ){

				$("#cbTickets").bootstrapSwitch('state', true, true);

			}else if( tickets_manual == "Off" ){

				$("#cbTickets").bootstrapSwitch('state', false, false);

			}
		});

	}

    });

}//End of configurartions action

/***
* bAdd_user_action
* function that performs add user button
***************************************/
function bAdd_user_action(){

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', 'active' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', '' );

    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).show();

}//End of bAdd_user_action function

/***
* cancel_action
* function that performs cancel button
***************************************/
function cancel_user(){

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', 'active' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', '' );

    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).show();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();


    read_users();

}//End of cancel_action function

/***
* bControl_usuarios_action
* function that performs control usuarios button
***************************************/
function bControl_usuarios_action(){

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', 'active' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', '' );

    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).show();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();


    read_users();

}//End of bControl_usuarios_action function

function bPerfil_action(){

    $( '#bPerfil' ).attr( 'class', 'active' );
    $( '#bControl_usuarios' ).attr( 'class', '' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', '' );

    $( '#perfil_de_usuario' ).show();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();

}//End of bPerfil__action function

function bBusqueda_action(){

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', '' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', 'active' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', '' );


    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).show();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();

}//End of bBusqueda_action function

function bIndex_doc_action(){

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', '' );
    $( '#bIndex_doc' ).attr( 'class', 'active' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', '' );
    $( '#bConfiguracion' ).attr( 'class', '' );


    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).show();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).hide();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();

}//End of bIndex_doc_action function

function bEstadisticas_action(){

    $( '#bPerfil' ).attr( 'class', '' );
    $( '#bControl_usuarios' ).attr( 'class', '' );
    $( '#bIndex_doc' ).attr( 'class', '' );
    $( '#bBusqueda' ).attr( 'class', '' );
    $( '#bHistorial' ).attr( 'class', '' );
    $( '#bProveedores' ).attr( 'class', '' );
    $( '#bEstadisticas' ).attr( 'class', 'active' );
    $( '#bConfiguracion' ).attr( 'class', '' );

    $( '#perfil_de_usuario' ).hide();
    $( '#control_de_usuarios' ).hide();
    $( '#index_doc' ).hide();
    $( '#busqueda' ).hide();
    $( '#historial' ).hide();
    $( '#estadisticas' ).show();
    $( '#configuracion' ).hide();
    $( '#addUserForm' ).hide();
    init_graphics( "" );
    stats( );
}//End of bEstadisticas_action function

function merge_document( doc ){

}//End of mergeDocument function

function get_results( ){

    var word = $('#txtBuscar').val();
    if( word != "" ){
	$.ajax({
	    'dataType' : 'json',
	    'type' : 'GET',
	    'url' : 'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'buscar', 'data' : word },
	    success : function( data ){
		if( data['response']['numFound'] > 0 ){
		    var objects = data['response']['docs'];
		    $('#result').html( " " );
		    for( var i=0; i<data['response']['numFound']; i++ ){
			var res = "";
			$('#result').append( '<div class="resultBox">' + mk_ticket( objects, i ) + '</div>' );


		    }
		}else{
		    $('#result').html("No results found!!");
		}
	    },//End of success function
	    error : function( data ){
		$('#result').html("");
		console.log("There has been an error on the server");
	    }
	});
    }else {
	$('#result').html("");
    }
}//End of get_results function

function bAdd_doc_action(){
    //var file_data = $('#sortpicture').prop('files')[0];
    for( var i = 0; i < file_info.length ; i++ ){
	var form_data = new FormData();
        console.log("it works!!!!");
	form_data.append( 'file', file_info[i] );
	form_data.append( 'studentid', 'A00364333' );
	alert(form_data);

	$.ajax({
            url: 'http://localhost/Index_system/Services/DocumentUpload.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response){

		alert("El documento y sus tickets han sido exitosamente indexados al servidor!!");

	    }
	});
    }
}//End of bAdd_doc_action function

function bAdd_catalogo_action(){

    for( var i = 0; i < file_info_cat.length ; i++ ){

	var form_data = new FormData();

	form_data.append( 'file_cat', file_info_cat[i] );

	alert(form_data);

	$.ajax({
            url: 'http://localhost/Index_system/Services/CatalogoUpload.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response){
		//alert(php_script_response);
	    }
	});

    }

}
function bBuscar_action(){

}//End of bBuscar_action function

function init_graphics( word ){

    if( word == "" ){

	$.ajax({
	    'type' : 'GET',
	    'dataType' : 'json',
	    'url' :  'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'stats', 'callN' : 1, 'clientid' : 'L00245795' },
	    success : function( data ){
		console.log( data );
	    },
	    error : function( data ){
		console.log(data);
	    }

	});

    }

}//End of init_graphics Method

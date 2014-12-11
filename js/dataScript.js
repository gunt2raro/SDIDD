var top_words = new Array();//The array with the top words
var graph;//The graphic

/***
* stats
* Method that puts the stats on the estadisticas window
* @params none
* @return none
*****************/
function stats(){

    top_words = new Array();

    $("#tbWords").find("tr:gt(0)").remove();

    $.jqplot.config.enablePlugins = true;

    $('#bBuscarEst').click( bGetStats );

    $('#bcMes').click( function(){ bGet_stats_by_date( "month" ) });

    $('#bcYear').click( function(){ bGet_stats_by_date( "year" ) });

    $('#bcAll').click( function(){ bGet_stats_by_date( "All" ) });

    $.ajax({

            'async' : false,
            'dataType' : 'json',
	    'type' : 'GET',
            'url' : 'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'stats', 'callN' : 1 },
            'success' : function( data ){

		var i = 0;

		while( data["json"][i] != null ){
		    var temp2 = [ ''+data['json'][i][0], data['json'][i][1] ];
		    $('#tbWords > tbody:last').append('<tr><td>'+(i+1)+'</td><td>'+data['json'][i][0]+'</td><td>'+data['json'][i][1]+'</td></tr>');
		    top_words.push( temp2 );
                    i++;
		}

            }

    });


    initGraph();

}//End of stats Method

/***
* bGetStats
* Method that getsThe stats with an spesific key word that must be a client id or a client name
* @params none
* @return none
*********************/
function bGetStats(){

    //get the word from the search field
    var txtSearch = $('#txtBuscarEst').val();

    //VAlidate if the serach field is empty
    if( txtSearch != "" ){

	top_words = new Array();
	$("#tbWords").find("tr:gt(0)").remove();

	$.ajax({
            'async' : false,
            'dataType' : 'json',
	    'type' : 'GET',
            'url' : 'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'stats', 'callN' : 2, 'keyWord' : txtSearch },
            'success' : function( data ){

		var i = 0;

		while( data["json"][i] != null ){

		    var temp2 = [ ''+data['json'][i][0], data['json'][i][1] ];
		    $('#tbWords > tbody:last').append('<tr><td>'+(i+1)+'</td><td>'+data['json'][i][0]+'</td><td>'+data['json'][i][1]+'</td></tr>');
		    top_words.push( temp2 );
                    i++;

		}

            }

	});//End of getting data stats from server

	//nitialize Graphics
	initGraph();

    }//End of validation

}//End of bGetStats Method

/***
* bGet_stats_by_date
* Method that gets the stats with an specific time for the top words
* @params state - the specifc time for the top words
* @return none
*************************************/
function bGet_stats_by_date( state ){
	console.log("que epdo" + state);
    //Get the word from the search field
    var txtSearch = $('#txtBuscarEst').val();

    //Validate if the search field is empty
    if( txtSearch != "" ){

	top_words = new Array();
	$("#tbWords").find("tr:gt(0)").remove();

	$.ajax({
            'async' : false,
            'dataType' : 'json',
	    'type' : 'GET',
            'url' : 'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'stats', 'callN' : 3, 'keyWord' : txtSearch, 'state' : state },
            'success' : function( data ){

		var i = 0;

		while( data["json"][i] != null ){

		    var temp2 = [ ''+data['json'][i][0], data['json'][i][1] ];
		    $('#tbWords > tbody:last').append('<tr><td>'+(i+1)+'</td><td>'+data['json'][i][0]+'</td><td>'+data['json'][i][1]+'</td></tr>');
		    top_words.push( temp2 );
                    i++;

		}

            }

	});//End of the data from the server

	//Init graph
	initGraph();

    }//End of validation

}//End of bGetStats Method

/***
* bGet_stats_by__specific_dates
* Method that gets the stats with an specific dates for the top words
* @params state - the specifc time for the top words
* @return none
*************************************/
function bGet_stats_by_specific_dates( date1, date2 ){
	console.log("Entró");
    //Get the word from the search field
    var txtSearch = $('#txtBuscarEst').val();

    //Validate if the search field is empty
    if( txtSearch != "" ){

	top_words = new Array();
	$("#tbWords").find("tr:gt(0)").remove();

	$.ajax({
            'async' : false,
            'dataType' : 'json',
	    'type' : 'GET',
            'url' : 'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'stats', 'callN' : 4, 'keyWord' : txtSearch, 'date1' : date1, 'date2' : date2 },
            'success' : function( data ){

		var i = 0;

		while( data["json"][i] != null ){

		    var temp2 = [ ''+data['json'][i][0], data['json'][i][1] ];
		    $('#tbWords > tbody:last').append('<tr><td>'+(i+1)+'</td><td>'+data['json'][i][0] + '</td><td>'+data['json'][i][1] + '</td></tr>');
		    top_words.push( temp2 );
                    i++;

		}

            }

	});//End of the data from the server

	//Init graph
	initGraph();

    }else{

	top_words = new Array();
	$("#tbWords").find("tr:gt(0)").remove();

	$.ajax({
            'async' : false,
            'dataType' : 'json',
	    'type' : 'GET',
            'url' : 'http://localhost/Index_system/Services/BusquedaWS.php',
	    'data' : { 'action' : 'stats', 'callN' : 5, 'date1' : date1, 'date2' : date2 },
            'success' : function( data ){

		var i = 0;

		while( data["json"][i] != null ){

		    var temp2 = [ ''+data['json'][i][0], data['json'][i][1] ];
		    $('#tbWords > tbody:last').append('<tr><td>'+(i+1)+'</td><td>'+data['json'][i][0] + '</td><td>'+data['json'][i][1] + '</td></tr>');

		    top_words.push( temp2 );
                    i++;

		}

            }

	});//End of the data from the server

	//Init graph
	initGraph();

    }//End of validation

}//End of bGetStats Method

/***
* bGetStatsByDates
* function that performs configuration button
***************************************/
function bGetStatsByDates(){

	var month1 = $('#txtMonth1').find(':selected').attr('id');
	var month2 = $('#txtMonth2').find(':selected').attr('id');

	var day1 = $('#txtDay1').find(':selected').attr('id');
	var day2 = $('#txtDay2').find(':selected').attr('id');

	var year1 = $('#txtYear1').find(':selected').attr('id');
	var year2 = $('#txtYear2').find(':selected').attr('id');

	if( month1 == 0 || month2 == 0 ){

		alert( "Seleccione un mes valido!!!" );

	}else if( day1 == 0 || day2 == 0 ){

		alert( "Seleccione un día valido!!!" );

	}else if( year1 == 0 || year2 == 0 ){

		alert( "Seleccione un año valido!!!" );

	}else {

		var date1 = month1+'/'+day1+'/'+year1;
		var date2 = month2+'/'+day2+'/'+year2;

		console.log(date1);
		console.log(date2);
		bGet_stats_by_specific_dates( date1, date2 );

	}

}//End of bGetStatsByDates function

/***
* initGraph
* Method taht initializes the graphic on the system
*********************/
function initGraph(){

	//Empty the charts div
	$( '#chartWord' ).empty();

	//Graphics inisialization
	graph = $.jqplot('chartWord', [top_words], {

            title: 'Top palabras',
	    series:[{lineWidth:2}],
	    cursor:{
		zoom:true,
		looseZoom: true
            },

	    axes:{
		xaxis:{
		    renderer: $.jqplot.CategoryAxisRenderer
		},
		yaxis:{
                    rendererOptions:{
			tickRenderer:$.jqplot.CanvasAxisTickRenderer,
			smooth: true,
		        animation: {
		            show: true
		        }
		    },
                    labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                    tickOptions:{
			fontSize:'10pt',
			fontFamily:'Tahoma',
			angle:30
                    },
                    label:'Cantidad'
		}
            },
	    highlighter: {
		show: false
	    },
	    cursor: {
		show: true,
		tooltipLocation:'sw'
	    }

	});//End of Graphics initailization

}//End of resetGraph function

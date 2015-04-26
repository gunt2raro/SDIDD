
/***
* mk_ticket
* Method that creates the html for the tickets on the search part
*********************************/
function mk_ticket( arr, i ){

    var genResult = "";

    genResult += '<br /><div class="clientid">@<a class="clientidLink" name="'+arr[i]['clientid']+'">'       + arr[i]['clientid'] + '</a></div>'
        + '<div class="clientname"><b>' + arr[i]['clientname'] + '</b></div>'
	+ '<div class="edificio">Edificio ' + arr[i]['edificio'] + '</div>'
        + '<div class="content_text">' + arr[i]['content_text']
	+ '<br /> <b>Solución: </b> ' + arr[i]['solucion']
	+ '<br /> <b>Ticket</b> ' + arr[i]['ticket']
	+ '<br /> Por <span class="badge badge-info">' + arr[i]['username']+'</span></div>'
	+ '<div class="time">Tomó ' + arr[i]['tiempo_sol'] + ' en resolver, el día ' + arr[i]['date']        + '</div><br />';

    return genResult;

}//End of mk_ticket function

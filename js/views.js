
$(document).ready( function (){
    buttonsInit();
    $('#bClose_session').click( bClose_session_action );
});//End of onReady function


function bClose_session_action(){

    $.ajax({
        'dataType' : 'json',
        'type' : 'POST',
        'url' : '/Index_system/Services/ViewWS.php',
        'data' : {'action' : 'destroySession'},
        success : function( data ){
            window.location.href = "http://localhost/Index_system/";
        }//End of success function

    });//End of ajax function

}//End of bclose_session_action 

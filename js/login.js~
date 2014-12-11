$(document).on( "ready", onReady );

/***
* onReady
* function that has all the on beginning scripting
******************************/
function onReady(){
    $( '#bLogin' ).click( bLogin_action );
}//End of onReady Function

function bLogin_action(){

    var username = $('#txtUsername').val();
    var password = $('#txtPassword').val();

    $.ajax({
        'dataType' : 'json',
        'type' : 'GET',
        'url' : "../Services/UserWS.php",
        'data' : { 'action' : 'loginValidation', 'username' : username, 'password' : password },
        success : function( data ){
            if( data ){
                window.location.href = '../';
            }else {
                alert("Usuario o Contraseña incorrecta");
            }
        },//End of success function
        error : function( data ){
            alert( "There was an error" + data);
        }
    });//End of ajax function

}//End of bLogin_action function                                                                                                                                                                             

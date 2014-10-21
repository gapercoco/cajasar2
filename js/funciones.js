$(document).ready(function(){
    $('#btnEstoyInteresado').on('click',function(){
        
        $.ajax({
            url:"querys/estoyInteresado.php",
            type: "POST",
            dataType: "json",
            data:{
                nombre:$('#name').val(),
                email:$('#email').val(),
                telefono:$('#telefono').val(),
                mensaje:$('#comentario').val(),
                propiedad:$('#propiedad').val()
            }
        })
        .done(function( response ){
            if(response){
                alert('Su mensaje fue enviado correctamente. ' + response.msg);
                $('#modal-interesado').modal('toggle');
                $('#name').val('');
            }
        })
        .fail(function(jqXHR,textStatus,errorThrown){
            alert('Se produjo un error. Vuelva a intentarlo '+textStatus);
        });
        return false;    
    });
    
    $('#btnLogin').on('click',function(){
        $.ajax({
            url:"querys/authenticate.php",
            type: "POST",
            dataType: "json",
            data:{
                user:$('#txtUser').val(),
                passwd:$('#txtPasswd').val()
            }
        })
        .done(function( response ){
            if(response){
                alert('Su mensaje fue enviado correctamente.');
            }
        })
        .fail(function(){
            alert('Se produjo un error. Vuelva a intentarlo');
        });
        return false;    
    });
});
$(document).ready(function(){
    
    //Inicia la aplicacion cargando la tabla
    getTablaArtistas();
    
    //Seccion "artistas" del menu -> ACTIVO
    $("li#menu-artistas").addClass("active");
    
    //Para editar, toma los datos de la cancion y los pasa al modal
    $('#modalAgregar').on('show.bs.modal', function (event) {
        $("#artista").val("");
        $("input#artista").focus();
        
        var button = $(event.relatedTarget);
        var artista = button.data('artista');
        var idArtista = button.data('id');
        
        var modal = $(this);
        modal.find('.modal-body input#artista').val(artista);
        modal.find('.modal-body input#idArtista').val(idArtista);
    });
    
    //Para editar, toma los datos de la cancion y los pasa al modal
    $('#modalEliminar').on('show.bs.modal', function (event) {
        
        var button = $(event.relatedTarget);
        var idCancion = button.data('id');
        
        var modal = $(this);
        modal.find('.modal-body input#idArtistaEliminar').val(idCancion);
    });

    //Validacion del formulario para agregar/editar
    $('#nuevo-artista').bootstrapValidator({
        framework: 'bootstrap',
        locale: 'es_ES',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            artista: {
                validators: {
                    notEmpty: {}
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        //Para que no submitee el formulario, y se pueda enviar por ajax
        e.preventDefault();
    
        var $form = $(e.target),
            bv    = $form.data('bootstrapValidation');
        
        //Uso de ajax para mandar los datos
        $.ajax({
            url: $form.attr("action"),
            type: 'POST',
            data: $form.serialize(),
            beforeSend: function() {
                //Cargando...
                $("#modalError").html("<div class='text-center'><i class='fa fa-spinner fa-spin'></i></div>");
            }
        })
        .done(function(result){
            
            $("#tablaError").html(result);
            
            //Cierra el modal
            $("#modalAgregar").modal('hide');
            //Borra cualquier error/icono de carga en el modal
            $("#modalError").html("");
            //Resetea el formulario
            $form.bootstrapValidator('resetForm', true);
            //Carga nuevamente la tabla con la modificacion
            getTablaArtistas();
        })
        .fail(function(){
            //Mensaje de error
            $("#modalError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
            $("#modalError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
            $("#modalError .alert").append('Hubo un error en el servidor');
        });
    });

    
    $('#modalCanciones').on('shown.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var artista = button.data('artista');
        var idArtista = button.data('id');
        
        var modal = $(this);
        modal.find('.modal-header #tituloArtista').html('<h4 class="modal-title">' + artista +'</h4>');
        
        //calificacion
        $.ajax({
            url: "../php-func/artista-canciones.php",
            type: 'POST',
            data: {'idArtista':idArtista},
            beforeSend: function() {
                $("#canciones").html("<div class='text-center'><i class='fa fa-spinner fa-spin'></i></div>");
            }
        })
        .done(function(result) {
            $("#canciones").html(result);
        })
        .fail(function() {
            $("#modalScoreError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
            $("#modalScoreError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
            $("#modalScoreError .alert").append('Hubo un error en el servidor');
        });
    });

});


/*------------------------------------------
            Funciones
------------------------------------------*/
function eliminarArtista(id) {
    $.ajax({
        url: "../php-func/eliminar-artista.php",
        type: 'POST',
        data: {'id':id}
    })
    .done(function(result) {
        getTablaArtistas();
    })
    .fail(function() {
        $("#tablaError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
        $("#tablaError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $("#tablaError .alert").append('Hubo un error en el servidor');
    });
}

function getTablaArtistas() {
    $.ajax({
        url: "../php-func/tabla-artistas.php",
        type: 'POST',
        data: {},
        beforeSend: function() {
            $("#tablaArtistas").html("<div class='text-center'><i class='fa fa-spinner fa-spin'></i></div>");
        }
    })
    .done(function(result) {
        
        $("#tablaArtistas").html(result);
        
        //Para eliminar, salta el cartel de confirmacion
        $("#eliminarArtista").on("submit",function(){
            var id = $("#idArtistaEliminar").val();
            eliminarArtista(id);
        });
        
        
    })
    .fail(function() {
        $("#tablaError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
        $("#tablaError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $("#tablaError .alert").append('Hubo un error en el servidor');
    });
}

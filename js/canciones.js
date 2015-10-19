$(document).ready(function(){
    
    //Seccion "canciones" del menu -> ACTIVO
    $("li#menu-canciones").addClass("active");
    
    $("#btnAgregar").click(function(){
        agregarCancion(null);
        $('#modalAgregar').modal('show');
    });
    
    //Inicia la aplicacion cargando la tabla
    getTablaCanciones();
    
    agregarCancion(null);

});


/*------------------------------------------
            Funciones
------------------------------------------*/
function agregarCancion(row) {

    //Para editar, toma los datos de la cancion y los pasa al modal
    $('#modalAgregar').on('show.bs.modal', function (event) {
        
        $("#div-agregar-artista").css("display","none");
        $('.modal-body input#cancion').val("");
        $('.modal-body input#idCancion').val("");
        $('.modal-body select#artista').val("0");
        $('.modal-body input#add-artista').val("");
        
        if (row != null) {
            var cancion = JSON.stringify(row['cancion']).substring(1,JSON.stringify(row['cancion']).length-1);
            var idCancion = JSON.stringify(row['idCancion']).substring(1,JSON.stringify(row['idCancion']).length-1);
            var idArtista = JSON.stringify(row['idArtista']).substring(1,JSON.stringify(row['idArtista']).length-1);
            var modal = $(this);
            modal.find('.modal-body input#cancion').val(cancion);
            modal.find('.modal-body input#idCancion').val(idCancion);
        }
        
        
        //Uso de ajax para mandar los datos
        $.ajax({
            url: "../php-func/select-artistas.php",
            type: 'POST',
            data: {}
        })
        .done(function(result){
            $(".modal-body select#artista").html(result);
            $('.modal-body select#artista').val(idArtista);
        })
        .fail(function(){
            //Mensaje de error
            $("#modalError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
            $("#modalError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
            $("#modalError .alert").append('Hubo un error en el servidor');
        });
        
        $(".modal-body select#artista").change(function(){
            var seleccionado = $(this).val();
            
            if (seleccionado == 'add') {
                $("#div-agregar-artista").css("display","block");
            }
            else {
                $("#div-agregar-artista").css("display","none");
            }
        });
    });
    
    //Validacion del formulario para agregar/editar
    $('#nueva-cancion').bootstrapValidator({
        framework: 'bootstrap',
        locale: 'es_ES',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            cancion: {
                validators: {
                    notEmpty: {}
                }
            },
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
            getTablaCanciones();
        })
        .fail(function(){
            //Mensaje de error
            $("#modalError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
            $("#modalError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
            $("#modalError .alert").append('Hubo un error en el servidor');
        });
    });
}

function eliminarCancion(id) {
    $.ajax({
        url: "../php-func/eliminar-cancion.php",
        type: 'POST',
        data: {'id':id}
    })
    .done(function(result) {
        getTablaCanciones();
    })
    .fail(function() {
        $("#tablaError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
        $("#tablaError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $("#tablaError .alert").append('Hubo un error en el servidor');
    });
}

function getTablaCanciones() {
    
    $('#tablaCanciones').bootstrapTable({
        url: "../php-func/tabla-canciones.php",
        pagination: true,
        pageSize: 10,
        pageList: [10, 25, 50, 100, 200],
        striped: true,
        columns: [{
            field: 'cancion',
            title: 'Cancion'
        }, {
            field: 'artista',
            title: 'Artista'
        }, {
            field: 'operate',
            title: '',
            formatter: 'operateFormatter',
            events: 'operateEvents'
        } ]
    })
    .on('load-success.bs.table', function (e, data) {
        
        //Para eliminar, salta el cartel de confirmacion
        $("#eliminarCancion").on("submit",function(){
            var id = $("#idCancionEliminar").val();
            eliminarCancion(id);
        });
        
    })
    .on('load-error.bs.table', function (e, status) {
        
        $("#tablaError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
        $("#tablaError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
        $("#tablaError .alert").append('Hubo un error en el servidor');
        
    });
}
    
function operateFormatter(value, row, index) {
    return [
        '<a class="mejor-score" href="javascript:void(0)" title="Mejor Score">',
            '<i class="fa fa-star"></i>',
        '</a> ',
        '<a class="editar" href="javascript:void(0)" title="Editar">',
            '<i class="fa fa-edit"></i>',
        '</a> ',
        '<a class="eliminar" href="javascript:void(0)" title="Eliminar">',
            '<i class="fa fa-times"></i>',
        '</a>'
    ].join('');
}

window.operateEvents = {
    'click .mejor-score': function (e, value, row, index) {
        
        $('#modalMejorScore').modal('show');
   
            
        $('#modalMejorScore').on('shown.bs.modal', function (event) {
            var cancion = JSON.stringify(row['cancion']).substring(1,JSON.stringify(row['cancion']).length-1);
            var artista = JSON.stringify(row['artista']).substring(1,JSON.stringify(row['artista']).length-1);
            var idCancion = JSON.stringify(row['idCancion']);
            
            var modal = $(this);
            modal.find('.modal-header #tituloCancion').html('<h4 class="modal-title">'+ cancion + ' - ' + artista +'</h4>');
            
            //calificacion
            $.ajax({
                url: "../php-func/score.php",
                type: 'POST',
                data: {'idCancion':idCancion},
                beforeSend: function() {
                    $("#calificacion").html("<div class='text-center'><i class='fa fa-spinner fa-spin'></i></div>");
                }
            })
            .done(function(result) {
                $("#calificacion").html(result);
            })
            .fail(function() {
                $("#modalScoreError").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
                $("#modalScoreError .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                $("#modalScoreError .alert").append('Hubo un error en el servidor');
            });
        });
    },
    'click .editar': function (e, value, row, index) {
        
        agregarCancion(row);
        
        $('#modalAgregar').modal('show');
        
    },
    'click .eliminar': function (e, value, row, index) {
            
        //Para editar, toma los datos de la cancion y los pasa al modal
        $('#modalEliminar').on('show.bs.modal', function (event) {
            
            var idCancion = JSON.stringify(row['idCancion']).substring(1,JSON.stringify(row['idCancion']).length-1);
            
            var modal = $(this);
            modal.find('.modal-body input#idCancionEliminar').val(idCancion);
        });
        
        $('#modalEliminar').modal('show');
        
        $("#eliminarCancion").on("submit", function() {
            var idCancion = $('.modal-body input#idCancionEliminar').val();
            eliminarCancion(idCancion);
        });
    }
};

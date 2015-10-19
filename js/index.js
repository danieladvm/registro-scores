$(document).ready(function() {
    
    //Valida formulario
    $('#registro-score').bootstrapValidator({
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
            modo: {
                validators: {
                    notEmpty: {}
                }
            },
            letra: {
                validators: {
                    notEmpty: {}
                }
            },
            nivel: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            perfect: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            great: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            good: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            bad: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            miss: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            maxcombo: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            score: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            dificultad: {
                validators: {
                    notEmpty: {},
                    numeric: {},
                    digits: {}
                }
            },
            fecha: {
                validators: {
                    notEmpty: {},
                    date: {
                        format: 'YYYY-MM-DD',
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        // Prevent form submission
        e.preventDefault();
    
        var $form = $(e.target),
            bv    = $form.data('bootstrapValidation');
        
        // Use Ajax to submit form data
        $.ajax({
            url: $form.attr("action"),
            type: 'POST',
            data: $form.serialize(),
            beforeSend: function() {
                $("#resultado").html("<i class='fa fa-spinner fa-spin'></i>");
            }
        })
        .done(function(result){
            $("#resultado").html('<div class="alert alert-success alert-dismissible fade in" role="alert"></div>');
            $("#resultado .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
            $("#resultado .alert").append('El score se envió correctamente');
            
            $form.bootstrapValidator('resetForm', true);
            $form.trigger('reset');
        })
        .fail(function(){
            $("#resultado").html('<div class="alert alert-danger alert-dismissible fade in" role="alert"></div>');
            $("#resultado .alert").append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
            $("#resultado .alert").append('Hubo un error en el servidor');
        });
    });
    
    //Datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose:true
    });
    
    //Seccion inicio -> ACTIVO
    $("li#menu-inicio").addClass("active");
    
});
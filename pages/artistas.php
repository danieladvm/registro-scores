<!doctype html>
<html lang="en">
<head>
    
    <?php
        include("../include/includes.html");
    ?>

    <!-- Script -->
    <script type="text/javascript" src="/js/artistas.js"></script>
    
    <meta charset="UTF-8">
    <title>Scores</title>
</head>
<body>
    
    <?php
        include("../include/header.html");
        include("../php-func/consultas.php");
    ?>
    
    <div class="container" id="contenedor-ppal">
        
        <div class="page-header">
            <h1>Artistas</h1>
        </div>
      
    
        <div class="row">
            
            <div class="col-sm-10 col-md-10">
                
                <table class="table" id="tablaArtistas"></table>
                
                <div class="form-group" id="tablaError"></div>
                
                <button type="button" class="btn btn-primary" id="btnAgregar" data-toggle="modal" data-target="#modalAgregar">Agregar</button>
                
            </div>
            
        </div>
    </div>
        
    <!-- Modal Agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Artista</h4>
                </div>
                    
                <form class="form-horizontal" id="nuevo-artista" action="/php-func/guardar-artista.php">
                    <div class="modal-body">
                    <!-- Artista -->
                        <div class="form-group">
                            <label for="artista" class="col-sm-3 control-label">Artista</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="artista" name="artista">
                            </div>
                        </div>
                        
                        <input type="hidden" name="idArtista" id="idArtista">
                            
                        <div class="form-group" id="modalError"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        
    <!-- Modal Canciones -->
    <div class="modal fade" id="modalCanciones" tabindex="-1" role="dialog" aria-labelledby="tituloArtista">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id="tituloArtista"></span>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3" id="canciones"></div>
                        </div>
                        <div id="modalCancionesError"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                    
            </div>
        </div>
    </div>
    
        
    <!-- Modal Eliminar Artista -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="conf">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="conf"><i class="fa fa-warning"></i>Confirmacion</h4>
                    </div>
                    
                <form id="eliminarArtista">
                    <div class="modal-body">
                        <p>Desea eliminar el artista?</p>
                        <input type="hidden" name="idArtistaEliminar" id="idArtistaEliminar"/>
                    </div>
                    
                    <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Si</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </form>
                    
            </div>
        </div>
    </div>
    
    
</body>
</html>
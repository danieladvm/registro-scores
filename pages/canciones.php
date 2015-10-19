<!doctype html>
<html lang="en">
<head>
    
    <?php
        include("../include/includes.html");
    ?>

    <!-- Script -->
    <script type="text/javascript" src="/js/canciones.js"></script>
    
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
            <h1>Canciones</h1>
        </div>
      
    
        <div class="row">
            
            <div class="col-sm-10 col-md-10">
                
                <table class="table" id="tablaCanciones"></table>
                
                <div class="form-group" id="tablaError"></div>
                
                <button type="button" class="btn btn-primary" id="btnAgregar">Agregar</button>
                
            </div>
            
        </div>
    </div>
        
    <!-- Modal Agregar -->
    <div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Cancion</h4>
                </div>
                    
                <form class="form-horizontal" id="nueva-cancion" action="/php-func/guardar-cancion.php">
                    <div class="modal-body">
                      
                    <!-- Cancion -->
                        <div class="form-group">
                            <label for="cancion" class="col-sm-3 control-label">Cancion</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="cancion" id="cancion">
                            </div>
                        </div>
                
                    <!-- Artista -->
                        <div class="form-group">
                            <label for="artista" class="col-sm-3 control-label">Artista</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="artista" id="artista">
                                </select>
                            </div>
                        </div>
                
                    <!-- Agregar artista -->
                        <div class="form-group" id="div-agregar-artista">
                            <div class="col-sm-8 col-sm-offset-3">
                                <input type="text" class="form-control" id="add-artista" name="add-artista" placeholder="Nombre Artista">
                            </div>
                        </div>
                        
                        <input type="hidden" name="idCancion" id="idCancion">
                            
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
        
    <!-- Modal Mejor score -->
    <div class="modal fade" id="modalMejorScore" tabindex="-1" role="dialog" aria-labelledby="tituloCancion">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id="tituloCancion"></span>
                    </div>
                    
                    <div class="modal-body">
                        <div class="row" id="calificacion"></div>
                        <div id="modalScoreError"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                    
            </div>
        </div>
    </div>
    
        
    <!-- Modal Eliminar Cancion -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="conf">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="conf"><i class="fa fa-warning"></i>Confirmacion</h4>
                    </div>
                    
                <form id="eliminarCancion">
                    <div class="modal-body">
                        <p>Desea eliminar la cancion?</p>
                        <input type="hidden" name="idCancionEliminar" id="idCancionEliminar"/>
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
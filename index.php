<!doctype html>
<html lang="en">
<head>
    
    <?php
        include("include/includes.html");
    ?>
    
    <!-- Script -->
    <script type="text/javascript" src="/js/index.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap-datepicker.es.min.js"></script>
    
    <!-- Css -->
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css" type="text/css" />
    
    <meta charset="UTF-8">
    <title>Scores</title>
</head>
<body>
    
    <?php
        include("include/header.html");
        include("php-func/consultas.php");
    ?>
    
    <div class="container" id="contenedor-ppal">
        
        <div class="page-header">
            <h1>Ingresa un nuevo score</h1>
        </div>
      
    
        <div class="row">
            <form id="registro-score" class="form-horizontal" action="php-func/nuevo-score.php">
            <!-- Cancion -->
                <div class="form-group">
                    <label for="cancion" class="col-sm-2 col-md-2 control-label">Canci&oacute;n</label>
                    <div class="col-sm-4 col-md-4">
                        <select class="form-control" name="cancion" id="cancion">
                            <option value="0"></option>
                            <?php
                                getSelectCanciones();
                            ?>
                        </select>
                    </div>
                </div>
                
            <!-- Modo -->
                <div class="form-group">
                    <label for="modo" class="col-sm-2 col-md-2 control-label">Modo</label>
                    <div class="col-sm-4 col-md-4">
                        <select class="form-control" name="modo" id="modo">
                            <option value="0"></option>
                            <?php
                                getSelectModos();
                            ?>
                        </select>
                    </div>
                </div>
                
            <!-- Nivel -->
                <div class="form-group">
                    <label for="nivel" class="col-sm-2 col-md-2 control-label">Nivel</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="nivel" id="nivel"/>
                    </div>
                </div>
                
            <!-- Perfect -->
                <div class="form-group">
                    <label for="perfect" class="col-sm-2 col-md-2 control-label">Perfect</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="perfect" id="perfect"/>
                    </div>
                </div>
                
            <!-- Great -->
                <div class="form-group">
                    <label for="great" class="col-sm-2 col-md-2 control-label">Great</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="great" id="great"/>
                    </div>
                </div>
                
            <!-- Good -->
                <div class="form-group">
                    <label for="good" class="col-sm-2 col-md-2 control-label">Good</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="good" id="good"/>
                    </div>
                </div>
                
            <!-- Bad -->
                <div class="form-group">
                    <label for="bad" class="col-sm-2 col-md-2 control-label">Bad</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="bad" id="bad"/>
                    </div>
                </div>
                
            <!-- Miss -->
                <div class="form-group">
                    <label for="miss" class="col-sm-2 col-md-2 control-label">Miss</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="miss" id="miss"/>
                    </div>
                </div>
                
            <!-- Max combo -->
                <div class="form-group">
                    <label for="maxcombo" class="col-sm-2 col-md-2 control-label">Max combo</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="maxcombo" id="maxcombo"/>
                    </div>
                </div>
                
            <!-- Score -->
                <div class="form-group">
                    <label for="score" class="col-sm-2 col-md-2 control-label">Score</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="score" id="score"/>
                    </div>
                </div>
                
            <!-- Letra -->
                <div class="form-group">
                    <label for="letra" class="col-sm-2 col-md-2 control-label">Letra</label>
                    <div class="col-sm-4 col-md-4">
                        <select class="form-control" name="letra" id="letra">
                            <option value="0"></option>
                            <?php
                                getSelectLetras();
                            ?>
                        </select>
                    </div>
                </div>
                
            <!-- Dificultad sm -->
                <div class="form-group">
                    <label for="dificultad" class="col-sm-2 col-md-2 control-label">Dificultad</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control" type="text" name="dificultad" id="dificultad"/>
                    </div>
                </div>
                
            <!-- Fecha -->
                <div class="form-group">
                    <label for="fecha" class="col-sm-2 col-md-2 control-label">Fecha</label>
                    <div class="col-sm-4 col-md-4">
                        <input class="form-control datepicker" type="text" name="fecha" id="fecha"/>
                    </div>
                </div>
                
            <!-- Resultado -->
                <div class="form-group">
                    <div id="resultado" class="col-sm-6"></div>
                </div>
                
            <!-- Botones -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <button type="reset" class="btn btn-default">Cancelar</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
        
    
</body>
</html>
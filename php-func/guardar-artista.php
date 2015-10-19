<?php

    include("conexion.php");
    
    $error = false;
    
    if (!isset($_POST["artista"])) { $error = true; }
    
    if (!$error) {
        $artista = $_POST["artista"];
        $idArtista = isset($_POST["idArtista"]) ? $_POST["idArtista"] : null;
        $con = new Conexion();
                
        if ($idArtista == null) {
            $sql = "call insertArtista('".$artista."')";
        }
        else {
            $sql = "call updateArtista('".$artista."',".$idArtista.")";
        }
            
        $res = $con->ejecutarQuery($sql);
        
        if ($idArtista == null) {
            $idArtistaInsertado = $res->fetch_row()[0];
        }
        
        $con->desconectar();
        
        if ($con->error != null) {
            $error = true;
        }
    
    }
    
?>
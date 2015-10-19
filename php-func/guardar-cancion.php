<?php

    include("conexion.php");
    
    $error = false;
    
    if (!isset($_POST["cancion"])) { $error = true; }
    if (!isset($_POST["artista"]) || $_POST["artista"] == "0") { $error = true; }
    
    if ($_POST["artista"] == "add") {
        
        if (!isset($_POST["add-artista"])) { $error = true; }
        
        if (!$error) {
            $artista = $_POST["add-artista"];
            
            $con = new Conexion();
            $sql = "call insertArtista('".$artista."')";
            $res = $con->ejecutarQuery($sql);
            
            $array[] = array();
            
            while ($fila = $res->fetch_assoc()) {
                array_push($array, $fila);
            }
            
            
            $idArtistaInsertado = $array[0];
            
            /*
            $matriz = convertirMatriz($res);
            
            $idArtistaInsertado = $matriz[0];

            */
            
                var_dump($sql);
                var_dump($array);
            
            $con->desconectar();
            
            if ($con->error != null) {
                $error = true;
            }
        }
    }
            
        
    
    /*if (!$error) {
        $id = isset($_POST["idCancion"]) ? $_POST["idCancion"] : "";
        $cancion = $_POST["cancion"];
        $idArtista = is_null($idArtistaInsertado) ? $_POST["artista"] : $idArtistaInsertado;
        
        $con = new Conexion();
        
        if ($id == "") {
            $sql = "call insertCancion('".$cancion."','".$idArtista."')";
        }
        else {
            $sql = "call updateCancion(".$id.",'".$cancion."','".$idArtista."')";
        }
        
        if ($con->error != null) {
            $error = true;
        }
            
        $res = $con->ejecutarQuery($sql);
    }*/
    
    //return !$error;
    
?>
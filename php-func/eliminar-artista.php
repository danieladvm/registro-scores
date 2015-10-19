<?php

    include("conexion.php");
    
    $error = false;
    
    if (!isset($_POST["id"])) { $error = true; }
    
        
    if (!$error) {
        
        $id = $_POST["id"];
        
        $con = new Conexion();
        $sql = "call deleteArtista(".$id.")";
        $res = $con->ejecutarQuery($sql);
        
        var_dump($sql);
        
        if ($con->error != null) {
            $error = true;
        }
        
        $con->desconectar();
    }
    
?>
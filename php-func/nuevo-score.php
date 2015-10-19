<?php

    include("conexion.php");
    
    $error = false;
    
    if (!isset($_POST["cancion"])) { $error = true; }
    if (!isset($_POST["modo"])) { $error = true; }
    if (!isset($_POST["nivel"])) { $error = true; }
    if (!isset($_POST["perfect"])) { $error = true; }
    if (!isset($_POST["great"])) { $error = true; }
    if (!isset($_POST["good"])) { $error = true; }
    if (!isset($_POST["bad"])) { $error = true; }
    if (!isset($_POST["miss"])) { $error = true; }
    if (!isset($_POST["maxcombo"])) { $error = true; }
    if (!isset($_POST["score"])) { $error = true; }
    if (!isset($_POST["letra"])) { $error = true; }
    if (!isset($_POST["dificultad"])) { $error = true; }
    if (!isset($_POST["fecha"])) { $error = true; }
    
        
    if (!$error) {
        
        
        $cancion = $_POST["cancion"];
        $modo = $_POST["modo"];
        $nivel = $_POST["nivel"];
        $perfect = $_POST["perfect"];
        $great = $_POST["great"];
        $good = $_POST["good"];
        $bad = $_POST["bad"];
        $miss = $_POST["miss"];
        $maxcombo = $_POST["maxcombo"];
        $score = $_POST["score"];
        $letra = $_POST["letra"];
        $dificultad = $_POST["dificultad"];
        $fecha = $_POST["fecha"];
        
        $con = new Conexion();
        $sql = "call insertScore(".$cancion.",".$modo.",".$nivel.",".$perfect.",".$great.",".$good.",".$bad.",".$miss.",".$maxcombo.",".$score.",".$letra.",".$dificultad.",'".$fecha."')";
        $res = $con->ejecutarQuery($sql);
        
        if ($con->error != null) {
            $error = true;
        }
    }
    
    return !$error;
    
?>
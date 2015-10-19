<?php

    include("consultas.php");
    
    $idCancion = isset($_POST["idCancion"]) ? $_POST["idCancion"] : 0;
    
    echo getMejorScore($idCancion);

?>
<?php

    include("consultas.php");
    
    $idArtista = isset($_POST["idArtista"]) ? $_POST["idArtista"] : 0;
    
    echo getListaArtistaCanciones($idArtista);

?>
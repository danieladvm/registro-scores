<?php
    
    include("conexion.php");

    /*---------------------------------------
            Carga combos de selección
    ---------------------------------------*/
    function getSelectCanciones() {
        $stringSelect = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectCancion(0)");
        
        while ($fila = $res->fetch_assoc()) {
            $stringSelect .= "<option value='" . $fila["idCancion"] . "'>" . $fila["cancion"] . " - " . $fila["artista"] . "</option>";
        }
        
        $con->desconectar();
        
        echo $stringSelect;
        
    }
    
    function getSelectArtistas() {
        $stringSelect = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectArtista()");
        
        $stringSelect .= "<option value='0'></option>";
        $stringSelect .= "<option value='add'>Agregar nuevo artista</option>";
        
        while ($fila = $res->fetch_assoc()) {
            $stringSelect .= "<option value='" . $fila["idArtista"] . "'>" . $fila["artista"] . "</option>";
        }
        
        $con->desconectar();
        
        echo $stringSelect;
        
    }
 
    function getSelectLetras() {
        $stringSelect = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectLetra()");
        
        while ($fila = $res->fetch_assoc()) {
            $stringSelect .= "<option value='" . $fila["idLetra"] . "'>" . $fila["letra"] . "</option>";
        }
        
        $con->desconectar();
        
        echo $stringSelect;
        
    }   
 
    function getSelectModos() {
        $stringSelect = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectModo()");
        
        while ($fila = $res->fetch_assoc()) {
            $stringSelect .= "<option value='" . $fila["idModo"] . "'>" . $fila["modo"] . "</option>";
        }
        
        $con->desconectar();
        
        echo $stringSelect;
        
    }
  
    /*---------------------------------------
                Carga Listas
    ---------------------------------------*/
    function getListaArtistaCanciones($idArtista) {
        $stringLista = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectCancion(" . $idArtista . ")");
        
        $stringLista .= "<ul class='list-group'>";
        
        while ($fila = $res->fetch_assoc()) {
            $stringLista .= "<li class='list-group-item'>" . $fila["cancion"] . "</li>";
        }
        
        $stringLista .= "</ul>";
        
        $con->desconectar();
        
        return $stringLista;
    }
  
    /*---------------------------------------
                Carga tablas
    ---------------------------------------*/
    function getTablaCanciones() {
        $stringTabla = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectCancion(0)");
        /*
        //cabecera de la tabla
        $stringTabla .= "<tr>";
        $stringTabla .=     "<th>Cancion</th>";
        $stringTabla .=     "<th>Artista</th>";
        $stringTabla .=     "<th></th>";
        $stringTabla .=     "<th></th>";
        $stringTabla .=     "<th></th>";
        $stringTabla .= "</tr>";
        
        while ($fila = $res->fetch_assoc()) {
            $stringTabla .= "<tr>";
            $stringTabla .=     "<td>" . $fila["cancion"] ."</td>";
            $stringTabla .=     "<td>" . $fila["artista"] ."</td>";
            $stringTabla .=     "<td><button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalMejorScore' data-id='" . $fila["idCancion"] ."' data-cancion='" . $fila["cancion"] ."' data-artista='" . $fila["artista"] ."'>Mejor score</button></td>";
            $stringTabla .=     "<td><button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalAgregar' data-id='" . $fila["idCancion"] ."' data-cancion='" . $fila["cancion"] ."' data-artista='" . $fila["idArtista"] ."'>Editar</button></td>";
            $stringTabla .=     "<td><button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalEliminar' data-id='" . $fila["idCancion"] ."'>Eliminar</button></td>";
            $stringTabla .= "</tr>";
        }
              */  
        
        while ($fila = $res->fetch_assoc()) {
            $miArray[] = $fila;
        }
        
        $con->desconectar();
        
        //return $stringTabla;
        
        return json_encode($miArray);
    }
    
    function getTablaArtistas() {
        $stringTabla = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectArtista()");
        
        //cabecera de la tabla
        $stringTabla .= "<tr>";
        $stringTabla .=     "<th>Artista</th>";
        $stringTabla .=     "<th></th>";
        $stringTabla .=     "<th></th>";
        $stringTabla .=     "<th></th>";
        $stringTabla .= "</tr>";
        
        while ($fila = $res->fetch_assoc()) {
            $stringTabla .= "<tr>";
            $stringTabla .=     "<td>" . $fila["artista"] ."</td>";
            $stringTabla .=     "<td><button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalCanciones' data-id='" . $fila["idArtista"] ."' data-artista='" . $fila["artista"] ."'>Canciones</button></td>";
            $stringTabla .=     "<td><button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalAgregar' data-id='" . $fila["idArtista"] ."' data-artista='" . $fila["artista"] ."'>Editar</button></td>";
            $stringTabla .=     "<td><button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalEliminar' data-id='" . $fila["idArtista"] ."'>Eliminar</button></td>";
            $stringTabla .= "</tr>";
        }
                
        
        $con->desconectar();
        
        return $stringTabla;
    }
    
    function getMejorScore($idCancion) {
        $stringScore = "";
        $con = new Conexion();
        $res = $con->ejecutarQuery("call selectMejorScore(".$idCancion.")");
        
        while ($fila = $res->fetch_assoc()) {
            $stringScore .= '<div class="col-xs-8">';
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["perfect"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Perfect</div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["great"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Great</div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["good"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Good</div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["bad"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Bad</div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["miss"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Miss</div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["maxCombo"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Max Combo</div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center col-xs-6">'.$fila["score"].'</div>';
            $stringScore .=         '<div class="text-center col-xs-6">Score</div>';
            $stringScore .=     '</div>';
            $stringScore .= '</div>';
            
            $stringScore .= '<div class="col-xs-4">';
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center"><h1>'.$fila["letra"].'</h1></div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center"><h1>'.$fila["nivel"].'</h1></div>';
            $stringScore .=     '</div>';
            
            $stringScore .=     '<div class="row">';
            $stringScore .=         '<div class="text-center">'.$fila["modo"].'</div>';
            $stringScore .=     '</div>';
            $stringScore .= '</div>';
            
            
            /*            
            if ($fila["modo"] == 'Single') {
                $stringScore .=         '<div class="text-center single"><h1>'.$fila["nivel"].'</h1></div>';
            }
            if ($fila["modo"] == 'Double') {
                $stringScore .=         '<div class="text-center double"><h1>'.$fila["nivel"].'</h1></div>';
            }
            */
        }
        
        $con->desconectar();
        
        return $stringScore;
        
    }
    
?>
<?php
    include_once ('../constantes.php');

    //funcion para autenticar usuario
    function fncAutenticar($usuario, $password){

        //Obtener datos de usuarios del fichero
        $arrayDatosUsuarios=fncObtenerDatos(RUTA_FICHERO_SOCIOS);

        if(array_key_exists($usuario,$arrayDatosUsuarios) && $arrayDatosUsuarios[$usuario][0]==$password){
            return 1; //si el usuario es correcto
        }elseif($usuario=='Invitado'){
            return 1; //si el usuario es correcto
        }else{
            return 0; //si el usuario no se encuentra en el fichero o no coincide con la contraseña
        }
        
        
    }

    //funcion que devuelve el descueto de un usuario
    function fncDameDcto($usuario){
        $arrayDatosUsuarios=fncObtenerDatos(RUTA_FICHERO_SOCIOS);

        return $arrayDatosUsuarios[$usuario][1]; 
    }

    //funcion que devuelve los platos de un tipo en concreto
    function fncDamePlatos($tipo){
        $arrayDatosMenu=fncObtenerDatos(RUTA_FICHERO_PLATOS);
        $arrayPlatos=array();

        foreach($arrayDatosMenu as $clave=>$valor){
            if($valor[0]==$tipo){
                $arrayPlatos[$clave]=$valor[1];
            }
        }

        return $arrayPlatos; 
    }

    //funcion que devuelve el descueto de un usuario
    function fncDamePrecios($nombrePlato){
        $arrayDatosMenu=fncObtenerDatos(RUTA_FICHERO_PLATOS);

        return $arrayDatosMenu[$nombrePlato][1]; 
    }

    //funcion que devuelve la información del fichero en un array
    function fncObtenerDatos($ruta){
        $arrayDatosFichero=array();
        $arrayDatos=array();

        $f=fopen($ruta,"r");
        if ($f==false)
            return $arrayDatosFichero;
        else{
            $linea=fgets($f);
            while (!feof($f)){
                
               $linea=trim($linea); 
               $datos=explode(";",$linea);
               $arrayDatos[0]=$datos[1];
               $arrayDatos[1]=$datos[2]; 
               $arrayDatosFichero[$datos[0]]=$arrayDatos;                        
               $linea=fgets($f);
            }
            fclose($f);
            return $arrayDatosFichero;
        }
    }

    function fncObtenerTextoPlato($plato){

        if(isset($plato) && !empty($plato) && $plato==='primero'){
            return PRIMER_PLATO;
        }elseif(isset($plato) && !empty($plato) && $plato==='segundo'){
            return SEGUNDO_PLATO;
        }elseif(isset($plato) && !empty($plato) && $plato==='postre'){
            return POSTRE;
        }else{
            return BEBIDA;
        }

    }

?>
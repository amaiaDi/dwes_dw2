<?php
 //$arrPrestamos: array de objetos 'Prestamo' con idprestamo y fecha

                $u=$this->session->userdata('username');
                $idlibro=$this->session->userdata('idlibro');
                echo "<p>$u devolviendo ejemplares del libro de clave $idlibro</p>";
     
             
            
            if (isset($arrPrestamos))  //q va a existir siempre
            {
                        foreach ($arrPrestamos as $prestamo)
                        {
                            $idprestamo=$prestamo->idprestamo;
                            $fecha=$prestamo->fecha;
                            $enlace=  site_url() . "/c_devoluciones/devolver/$idprestamo";
                            echo "<p>Prestamo Nº $idprestamo: $fecha&nbsp;&nbsp;<a href='$enlace'>Devolver</a></p>";
                        }


                        if (isset($_SESSION['arrParaDevolver']))
                          print_r($_SESSION['arrParaDevolver']);
                        //print_r($this->session->userdata('arrParaDevolver'));

                        if (isset($_SESSION['arrParaDevolver']))
                              echo "<p><a href='".site_url() ."/c_devoluciones/grabarDevoluciones'>GRABAR DEVOLUCIONES</a></p>";

                        if (isset($mensajeRtdo))
                            echo "<p>$mensajeRtdo</p>";
            }
?>
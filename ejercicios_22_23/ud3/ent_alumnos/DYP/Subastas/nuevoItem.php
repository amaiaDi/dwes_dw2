<?php
    function crearCategorias(){
        global $con;

        $sql = "SELECT categoria
                from categorias";
        $result = mysqli_query($con, $sql);

        $str = "<select name='selectCategorias'>";
        while( $fila = mysqli_fetch_assoc($result)){
            $categoria = $fila['categoria'];

            $str = $str."<option value='$categoria'>$categoria</option>";
        }
        $str = $str."</select>";
        return $str;
    }

    function tablaFechas(){
        $str = "";
            //crear select de dia
            $str = $str."<td><select name='selectDia'>";
                for ($i=1; $i <= 31; $i++) { 
                    $str = $str."<option value='$i'>$i</option>";
                }
            $str = $str."</select></td>";
            //crear select de Mes
            $str = $str."<td><select name='selectMes'>";
                for ($i=1; $i <= 12; $i++) { 
                    $str = $str."<option value='$i'>$i</option>";
                }
            $str = $str."</select></td>";
            //crear select de Año
            $anioActual = intval(date('Y'));
            $str = $str."<td><select name='selectAnio'>";
                for ($i=0; $i <= 4; $i++) { 
                    $anio = $anioActual + $i;
                    $str = $str."<option value='$anio'>$anio</option>";
                }
            $str = $str."</select></td>";
            //crear select de Hora
            $str = $str."<td><select name='selectHora'>";
                for ($i=0; $i <= 23; $i++) { 
                    $str = $str."<option value='$i'>$i</option>";
                }
            $str = $str."</select></td>";
            //crear select de Minutos
            $str = $str."<td><select name='selectMinutos'>";
                for ($i=0; $i <= 59; $i++) { 
                    $str = $str."<option value='$i'>$i</option>";
                }
            $str = $str."</select></td>";

        return $str;
    }

    ///////////////////////////////////////////////////////////////////////////////////////
                                /*  VALIDAR   */
    //////////////////////////////////////////////////////////////////////////////////////
    $error = "";

    if(isset($_POST['botonNuevoItem'])){
        $anio = $_POST['selectAnio'];
        $mes = $_POST['selectMes'];
        $dia = $_POST['selectDia'];
        $hora = $_POST['selectHora'];
        $minutos = $_POST['selectMinutos'];

        $validado = false;

        $anioActual = intval(date('Y'));
        if($anioActual == $anio){
            $mesActual = date('m');
            if($mesActual < $mes){
                $validado = true;
            }else if($mesActual == $mes){
                $diaActual = date('d');
                if($diaActual < $dia){
                    $validado = true;
                }
            }
        }else{
            $validado = true;
        }

        if($validado == true){
            aniadirItem();
        }else{
            $error = "La fecha no es valida";
        }
    }

    function aniadirItem(){
        $idCat = idCategoria($_POST['selectCategorias']);
        $idUsuario = $_SESSION['id']; 
        $nombre = $_POST['nombreItem'];
        $precioPartida = $_POST['precioItem'];
        $descripcion = $_POST['descripcionItem'];
        $fechafin = $_POST['selectAnio']."-".$_POST['selectMes']."-".$_POST['selectDia'];

        $sql = "INSERT INTO items (id_cat, id_user, nombre, preciopartida, descripcion, fechafin) 
                           VALUES ('$idCat','$idUsuario','$nombre','$precioPartida','$descripcion', '$fechafin')";  
        global $con;
        $resultado = mysqli_query($con, $sql);

        $idItem = idItem()+1;
        header("location:index.php?ir=editaritem&idItem=$idItem");
    }

    function idItem(){
        global $con;

        $sql = "SELECT max(id)
                from items";
        $result = mysqli_query($con, $sql);

        $fila = mysqli_fetch_assoc($result);
        return $fila['max(id)'];
    }

    function idCategoria($nomCategoria){
        global $con;

        $sql = "SELECT id
                from categorias
                where categoria = '$nomCategoria'";
        $result = mysqli_query($con, $sql);

        $fila = mysqli_fetch_assoc($result);
        return $fila['id'];
    }
?>
<div>
    <h1>Añade nuevo item</h1>
    <span style="color: red;"><?php echo $error;?></span><br>
    <form  action="index.php?ir=nuevoitem" method="post">
                        <table>
                            <tr class="body">
                                <tr>
                                    <td>Categoria</td>
                                    <td><?php echo crearCategorias()?></td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td><input type="text" name="nombreItem" required/></td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td><textarea name="descripcionItem" rows="10" cols="50"></textarea></td>
                                </tr>
                                <tr>
                                    <td>Fecha de fin para pujas</td>
                                    <td>
                                        <table>
                                            <tr class="head">
                                                <th>Dia</th>
                                                <th>Mes</th>
                                                <th>Año</th>
                                                <th>Hora</th>
                                                <th>Minutos</th>
                                            </tr>
                                            <tr class="body">
                                                <?php echo tablaFechas()?>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Precio</td>
                                    <td><input type="text" name="precioItem" required/>€</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="submit" value="Enviar" name="botonNuevoItem" colspa/></td>
                                </tr>
                            </tr>
                        </table>
        </form>
</div>
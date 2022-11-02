<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $afics=["Boxeo","Esgrima","Lectura","Parapente","Otra"];
        ?>
        <form action="proceso.php" method="post">
        <table>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="nombre" /></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="pass" /></td>
            </tr>
            <tr>
                <td>Edad</td>
                <td>
                    <select name="edad">
                        <?php
                            for ($edad=1; $edad<=100; $edad++){
                                echo "<option value='$edad'>$edad</option>"; 
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Sexo</td>
                <td>
                    Hombre <input type="radio" name="sexo" value="h" />
                    Mujer <input type="radio" name="sexo" value="m"/>
                </td>
            </tr>
            <tr>
                <td>Aficiones</td>
                <td>
                    <?php
                        foreach ($afics as $afic )
                        {
        echo "<br/>$afic<input type='checkbox' name='afics[]' value='$afic' />";
                        }
                    
                    ?>
                </td>
                
                
            </tr>
            <tr>
                <td colspan='2'>
                       <input type='submit' name='submit' value='Enviar' />
                </td>
            </tr>
            
        </table>
        </form>
    </body>
</html>

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
            $modulos=array("LEMA","ENDE","PROG","FOL", "BBDD","SIST","ING");
        
            $dni="";
            $errorDni="";
            $errorCurso="";
            $errorModulos="";
            $dw1aSel="";
            $dw1bSel="";
            $modSelecc=array();
            
            if (isset($_POST['submit'])){                
                
                //Verificar dni
                $dni=$_POST['dni'];
                if (empty($dni) || strlen($dni)!=9)
                    $errorDni="DNi con letra (9 caracteres)";
                
                
                
                //Verificar curso
                if (!isset($_POST['curso']))
                    $errorCurso="Debes marcar un curso";
                else {
                    $curso=$_POST['curso'];
                    if ($curso=='DW1A')
                        $dw1aSel="checked";
                    if ($curso=='DW1B')
                        $dw1bSel="checked";
                }
                
                
                if (!isset($_POST['modulos'])){
                    $errorModulos="Debes marcar algún módulo";                    
                }
                else{
                    $modSelecc=$_POST['modulos'];
                } 
            }
            
            
         ?>
        
        
        
        
        
        
        
        <form method='post' action='<?php echo $_SERVER['PHP_SELF']  ?>'>
            <table>
                <tr>
                    <td>DNI</td>
                    <td><input type='text' name='dni' value='<?php echo $dni  ?>'  /></td>
                    <td><?php echo $errorDni ?></td>
                </tr>
                <tr>
                    <td>CURSO</td>
                    <td>
                        DW1A <input type='radio' name='curso' value='DW1A' <?php echo $dw1aSel ?>  />
                        DW1B <input type='radio' name='curso' value='DW1B' <?php echo $dw1bSel ?>  />
                    </td>
                    <td>
                        <?php echo $errorCurso ?>
                    </td>
                </tr>
                <tr>
                    <td>Módulos</td>
                    <td>
                        <?php
                            foreach ($modulos as $modulo){
                               
                                $selecc=(in_array($modulo, $modSelecc))?'checked':'';                                
   echo "<p>$modulo<input type='checkbox' name='modulos[]' value='$modulo' $selecc /></p>";            
                            }                       
                        ?>
                    </td>
                    <td>
                        <?php echo $errorModulos ?>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type='submit' name='submit' value='GRABAR' />
                    </td>
                </tr>
                
            </table>
        </form>
       
        
    </body>
</html>

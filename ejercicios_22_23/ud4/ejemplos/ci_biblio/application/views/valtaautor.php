<?php

echo "<h3>NUEVO AUTOR</h3>";

//echo $this->calendar->generate();
echo form_open('cautores/alta');

echo "Nombre:" . form_input('nombre','');
echo "Fecha de nacimiento:" .form_input('fechanac','');

$opciones= array (
                'Francia' => 'Francia',
                'Alemania' => 'Alemania',
                'EEUU' => 'EEUU',
                'Rusia' => 'Rusia',
                'Otra' => 'Otra'
            );

echo "Nacionalidad: " .form_dropdown('nacionalidad',$opciones,'Francia');
//echo "Nacionalidad: " .form_dropdown('nacionalidad',$opciones,set_select('nacionalidad', 'EEUU'   ));
echo form_submit('submit',"Nuevo autor");
echo form_close();

echo (isset($resultadoinsert))?$resultadoinsert:"";

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


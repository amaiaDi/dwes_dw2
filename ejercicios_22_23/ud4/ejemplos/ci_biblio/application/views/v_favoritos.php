<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//REcibe $todoslibros: array de objetos con (idlibro,titulo, autor)

echo form_open('c_favoritos/agregar_favorito');

echo "<table>";
foreach ($todoslibros as $libro)
{
    echo "<tr>";
    
    echo "<td>";
    echo form_radio('idlibro',$libro->idlibro,  set_radio('idlibro',$libro->idlibro));   
    echo "</td>";   
    echo "<td>".$libro->titulo."</td>";
    echo "<td>".$libro->autor."</td>";
    
    echo "</tr>";
    
}
echo "<tr>";
echo "<td colspan=3>".form_submit("submitlibrofav","Anotar como favorito")."</td>";
echo "</tr>";

echo "</table>";
echo form_close();
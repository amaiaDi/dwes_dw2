<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Recibe str_login_error vacio("") o con error de login

echo form_open('c_favoritos/login');
echo "<table>";

echo "<tr>";
echo "<td>Usuario</td>";
echo "<td>" . form_input('usuario','') . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Password</td>";
echo "<td>".form_password('password','')."</td>";
echo "</tr>";

echo "<tr>";
echo "<td colspan='2'>";
echo form_submit('submitlogin',"LOGIN");
echo "</td>";
echo "</tr>";

echo "</table>";
echo form_close();

echo "<font color='red'>".$str_login_error."</font>";
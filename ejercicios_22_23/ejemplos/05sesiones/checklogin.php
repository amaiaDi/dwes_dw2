<?php

    session_start();
    session_destroy();
    session_start();

    if (!isset($_POST['submitlogin'])){
        header ("location:index.php");
    }
    else{
        if ($_POST['login']=='admin'){
            //Admin debe entrar con password 123
            if ($_POST['pass']!="123"){
                header ("location:index.php?error");
            }
            else{
                $_SESSION['login']="administrador";
                header("location: admin.php");
            }
        }     
        else{
           //Usuario no admin debe entrar con password = su nombre 
            if ($_POST['pass']!=$_POST['login']){
                header ("location:index.php?error");
            }
            else{
                 $_SESSION['login']=$_POST['login'];
                 if (isset($_POST['sexo']))
                 {
                     //Crear una cookie con el sexo
                     setcookie("sexo",$_POST['sexo'], time()+3600);
                 }
                 header("location: encuesta.php");
            }
        }
        
        
    }



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


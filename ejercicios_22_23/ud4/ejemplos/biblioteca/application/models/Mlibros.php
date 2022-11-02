<?php
class Mlibros extends CI_Model
{
  function __construct(){
    parent::__construct();
  }   
 
  function todosgeneros(){        
    $rs=$this->db->query("SELECT distinct(genero) as genero FROM libros");

    //  $rs->result();   
    //Array de objetos (Cada objeto id y autor como atributos)

    //  $rs->result_array()  
    //Array de arrays (Cada array tiene 2 posiciones, una con clave //'idautor', otra con clave 'nombre'
      
    return $rs->result_array();
  }
    
}
?>
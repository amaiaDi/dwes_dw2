<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_favoritos extends CI_Model
{
    
   function __construct() {
       parent::__construct();
       
   }
   
     function todoslibros()
    {
        $sql="select libros.idlibro as idlibro, titulo, autores.nombre as autor from libros, autores ".
                       " where libros.idautor=autores.idautor";        
        $rs=$this->db->query($sql);
        
        return $rs->result();
        //Devuelve array de objetos con (idlibro,titulo, autor)
    }
    
}
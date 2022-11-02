<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_prestamos extends CI_Model
{
    
   function __construct() {
       parent::__construct();
   }
   
    function generos()
    {
        $rs=$this->db->query("select distinct genero from libros");
        return $rs->result();
                    //Arrays de objetos (cada objeto tiene genero)
        
        
    }
    
    
    function librosgenero($genero)
    {
        $sql="select libros.idlibro as idlibro, titulo, genero, paginas, autores.nombre as autor from libros, autores where genero='$genero' ".
                " and libros.idautor=autores.idautor";
        
        $rs=$this->db->query($sql);
        
        return $rs->result();
            //Devuelve array de objetos con (idlibro,titulo, paginas,autor)
    }

    function prestar($idlibro)
    {
        //De cada libro hay 4 ejemplares. Solo presta si queda alguno
        
       
        $rs=$this->db->query("select idlibro from prestamos where idlibro=$idlibro");
        if ($rs->num_rows()>=4)
        {
            return false;  //Todos los ejemplares prestados
        }
        else
        {        
            $this->db->query("insert into prestamos (fecha,idlibro) values (now(),$idlibro)");
            return true;
        }
        
    }
    
    function titulolibrodeid($idlibro)
    {
        $rs=$this->db->query("select titulo from libros where idlibro=$idlibro");
        
        return $rs->row()->titulo;
        
    }
    
    
    /* Para devoluciones  */
    
    function librosConPrestamo()
    {
          $sql="select idlibro, titulo from libros where idlibro in (select idlibro from prestamos)";
          $rs=$this->db->query($sql);
          return $rs->result();
        
    }
    
    
    function prestadosDe($idlibro)
    {
        $sql="select idprestamo, fecha from prestamos where idlibro=$idlibro";
           $rs=$this->db->query($sql);
          return $rs->result();     
        
        
    }
    
    
    function grabarDevoluciones()
    {
        $borradas=0;
        foreach ($this->session->userdata('arrParaDevolver')  as $idprestamo)
        {
                $this->db->query("delete from prestamos where idprestamo=$idprestamo");
                $borradas+=$this->db->affected_rows();
        }
        return $borradas;
    }
    
}
<?php


class Mautores extends CI_Model
{
    
   function __construct() {
       parent::__construct();
   }
   
   
   function cuantosautores()
   {        
         //$db=$this->load->database();   //Ya est� en el autoload
         $rs=$this->db->query("select * from autores");
         return $rs->num_rows();
   }
   
 
    
   function todosautores()
   {        
        $rs=$this->db->query("select idautor, nombre from autores");
        
        //  $rs->result();   
		//Array de objetos (Cada objeto id y autor como atributos)
        //  $rs->result_array()  //Array de arrays (Cada array tiene 2 posiciones, una con clave 'idautor', otra con clave 'nombre'
          
        return $rs->result();
    }
   
   
   function autordeid($idautor)
   {
        $rs=$this->db->query("select nombre,fechanac, nacionalidad from autores where idautor=$idautor");
        return $rs->row();  //Devuelve un objeto autor (con  nombre, fechanac, nacionalidad)
   }
        
  
    function librosautor($idautor)
    {
        
         $rs=$this->db->query("select idlibro, titulo, paginas, genero from libros where idautor=$idautor");
         return $rs->result_array();  //Devuelve array de arrays (cada subarray(libro)
                                      //tiene idlibro, titulo, paginas, genero
                  
    }
    
    function insertarautor($nombre,$fechanac,$nacionalidad)
    {
        $sql="insert into autores (nombre, fechanac, nacionalidad) ".
                " values ('$nombre','$fechanac','$nacionalidad')";
        $insertadook=$this->db->query($sql); //En consultas de actualizacion devuelve true/false
        return $insertadook;        
    }

    
    function libroslargos()
    {
        //$db=$this->load->database();       
       
         $rs=$this->db->query("select titulo, paginas from libros where  paginas>200");        
         if ($rs->num_rows() == 0){
             return 0;
         }
          else  {
              return $rs->result();
          }
    }
    
     function cuantoslibros()
    {
        
         //$db=$this->load->database();   //metido en el autoload
         $rs=$this->db->query("select titulo from libros");
         return $rs->num_rows();        
    }
    
    
}
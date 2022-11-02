<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clibros extends CI_Controller {

function __construct()  
        {
            parent::__construct();
            
             $this->load->model('mautores');
}

public function index()
{
		$this->libroslargos();
}

//1
 public function cuantos_libros()
 {            
          //  $this->load->model('mautores');
    
     echo $this->mautores->cuantoslibros(); //Pasarlo a la vista
            
 } 
  
 //2
    public function libroslargos()
        {         
      
          //  $this->load->model('mautores');
            if ($this->mautores->libroslargos()==0){
                echo "No hay ningún libro con esas caracteristicas";
            }
            else
            {
                $libroslargos=$this->mautores->libroslargos(); 
        //Array de objetos con titulo y paginas
                foreach ($libroslargos as $librolargo)
                {
                    echo "<p>".$librolargo->titulo." , ".$librolargo->paginas . " paginas</p>";
                }                
            }   
                    
        }       
        
        public function librosautor($idautor)
        {
//Aqui vendrá cuando se pincha un nombre de autor (enlace) en la vista autores
            
            $this->load->model('mautores');
            $autor=$this->mautores->autordeid($idautor);
                    //Devuelve un objeto autor (con  nombre, fechanac, nacionalidad)
           
            $nombreautor=$autor->nombre;
            $datos['arraylibros']=$this->mautores->librosautor($idautor);
                                    //$arraylibros: array de arrays (cada subarray(libro)
                                      //tiene idlibro, titulo, paginas, genero
         
            $datos['mensaje']="LIBROS DEL AUTOR $nombreautor";
            $this->load->view('v_titulobiblio',$datos);
            $this->load->view('v_librosautor',$datos);
            $this->load->view('vpie');
        }       
       
}

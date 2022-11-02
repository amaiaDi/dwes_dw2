<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cautores extends CI_Controller {

	function __construct()  
        {
            parent::__construct();            
            $this->load->model('mautores');
            $this->load->library('calendar');
	}

	public function index($mensaje="",$resultadoinsert="")
	{
            //TITULO
            $na=$this->mautores->cuantosautores();
            $nl=$this->mautores->cuantoslibros();
            $datos['mensaje']= $na . " autores y ". $nl . " libros";
            $this->load->view('v_titulobiblio',$datos);
            
             //ENLACES A AUTORES para ver sus libros
            $datos['arrayautores']=$this->mautores->todosautores();  //$arrayautores tiene objetos (idautor,nombre)        
            $this->load->view('v_autores',$datos);
	            
             //FORMULARIO INSERCION AUTOR
             $datos['resultadoinsert']=$resultadoinsert;
            $this->load->view('valtaautor',$datos);
            $this->load->view('vpie');
        }
        
        function index_after_insert($resultadoinsert)
        {
            //Todo igual que index. Pero tiene un parámetro con el resultado
            // de la inserción, para pasarle a valtaautor
          
            //TITULO
             $na=$this->mautores->cuantosautores();
            $nl=$this->mautores->cuantoslibros();
            $datos['mensaje']= $na . " autores y ". $nl . " libros";
            $this->load->view('v_titulobiblio',$datos);
            
            
            //ENLACES A AUTORES para ver sus libros
            $datos['arrayautores']=$this->mautores->todosautores();  //$arrayautores tiene objetos (idautor,nombre)        
            $this->load->view('v_autores',$datos);
	    
            
            //FORMULARIO INSERCION AUTOR
            $datos['resultadoinsert']=$resultadoinsert;
            $this->load->view('valtaautor',$datos);          
            $this->load->view('vpie');
            
        }
        
        function alta()
        {
            $nombre=$_POST['nombre'];
            $fechanac=$_POST['fechanac'];
            $nacionalidad=$_POST['nacionalidad'];
            
            //echo $nombre . " " . $fechanac . " " . $nacionalidad;
            
            $insertadook=$this->mautores->insertarautor($nombre,$fechanac,$nacionalidad);
            if (! $insertadook)
            {
                $this->index("","mal");
               // $this->index_after_insert("mal");
            }
            else
            {
                 $this->index("","ok");
                //$this->index_after_insert("ok");                  
            }
        }
       
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cautores extends CI_Controller {

	function __construct(){
            parent::__construct();            
            $this->load->model('mautores');
            $this->load->model('mlibros');
	}

	public function index()
	{
        //TITULO
        $na=$this->mautores->cuantosautores();
        $nl=$this->mautores->cuantoslibros();
        $data['mensaje']= $na." autores y ".$nl ." libros";

        
         //ENLACES A AUTORES para ver sus libros
        $data['arrayautores'] = $this->mautores->todosautores(); 
        //ENLACES A GENEROS para ver los libros relacionados con sus generos
        $arraygeneros=$this->mlibros-> todosgeneros();
        $data['arraygeneros']=$arraygeneros;     
        //$arraygeneros tiene array (genero)        
        $this->load->view('v_titulobiblio',$data);
        //$arrayautores tiene datos en array con clave (idautor,nombre)        
        $this->load->view('v_autores',$data);
            
        $this->load->view('vpie');
    }

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_prestamos extends CI_Controller {

	function __construct()  
        {
            parent::__construct();
            
           //  $this->load->model('mautores');
             
             $this->load->model('m_prestamos');
	}

	
        function index()
        {   
            /*
            echo base_url();
            echo "<br/>";
            echo site_url();*/
            
            $datos['generos']=$this->m_prestamos->generos(); //Arrays de objetos (cada objeto tiene categoria)
            $this->load->view('v_arriba',$datos);              
            $this->load->view('v_abajo');
            
        }
        
        
        function librosgenero($genero)
        {
           
            $datos['generos']=$this->m_prestamos->generos(); //Arrays de objetos (cada objeto tiene categoria)
            $this->load->view('v_arriba',$datos);
            
            $datos2['libros']=$this->m_prestamos->librosgenero($genero);            
              //Devuelve array de objetos con (idlibro,titulo,genero, paginas,autor)            
            $this->load->view('v_librosgenero',$datos2);            
            
            $this->load->view('v_abajo');
        }
       
        
        function prestar()
        {
            
             //Por POST check_libros y submit_prestar
            
            if (isset($_POST['check_libros']))
            {
                //echo "Seleccionado alguno";                    
                $prestados=array();
                $noprestados=array();
                foreach ($_POST['check_libros'] as $idlibro)
                {                    
                    if ($this->m_prestamos->prestar($idlibro))  //Se ha podido prestar
                    {
                        $prestados[]=$this->m_prestamos->titulolibrodeid($idlibro);
                    }
                    else
                    {
                        $noprestados[]=$this->m_prestamos->titulolibrodeid($idlibro);
                    }                    
                }
                     
                $datos['generos']=$this->m_prestamos->generos(); //Arrays de objetos (cada objeto tiene categoria)
                $this->load->view('v_arriba',$datos);

                $datos2['libros']=$this->m_prestamos->librosgenero($_POST['genero']);            
                  //Devuelve array de objetos con (idlibro,titulo, paginas,autor)        
                $this->load->view('v_librosgenero',$datos2);   

                //RESULTADO DEL MULTIPRESTAMO            
                $datos3['prestados']=$prestados;
                $datos3['noprestados']=$noprestados;            
                $this->load->view('v_resultprestamo',$datos3);           
                $this->load->view('v_abajo');
                
            }
            else {
                //Ningun checkbox seleccionado
               $this->index();
               
            }
            
        }
}


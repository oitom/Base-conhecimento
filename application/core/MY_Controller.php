<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	var $membro;

	private function checkLoged(){
		
		$this->load->library('session');

		if($this->session->userdata('membro')){
			$this->membro = $this->session->userdata('membro');
		} else {
			$this->membro = null;
		}
	}

   	public function __construct()
   	{
        parent::__construct();
     	$this->checkLoged();
   	}

}
/* End of file pesquisa_geral.php */
/* Location: ./application/controllers/pesquisa_geral.php */
<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

Class Usuario extends MY_Controller
{
	public function perfil()
	{
		$data = array('usuario' => $this->membro);
		$this->load->view('usuario/perfil', $data);
	}
}
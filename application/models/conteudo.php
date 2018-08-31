<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conteudo extends CI_Controller {

	public function index($codigo)
	{
		$this->load->model("conteudo_model", "Conteudo");
		$this->Conteudo->codigo = $codigo;
		
		$tabelas = array(
			'bases' => true,
			'artigos' => true,
			'comentarios' => true
		);

		$conteudo = $this->Conteudo->join($tabelas);

		/***
		echo "<pre>";
		echo print_r($conteudo);
		echo "</pre>";
		/**/

		$data = array('conteudo' => $conteudo);

		$this->load->view('layout/topo_conteudo', $data);
		$this->load->view('conteudo/mostrar', $data);
		$this->load->view('layout/rodape');
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plataforma extends CI_Controller {


	public function login()
	{
		$data = array(
			'titulo' => 'Login'
		);

		$this->load->view('layout/topo-padrao', $data);
		$this->load->view('login', $data);
		$this->load->view('layout/rodape');
	}

	public function cadastrar()
	{
		$this->load->model("campo_model", "Campos");
		$campos = $this->Campos->getAll();

		$data = array(
			'campos' => $campos,
			'titulo' => 'Cardastrar-se'
		);

		$this->load->view('layout/topo-padrao', $data);
		$this->load->view('cadastrar', $data);
		$this->load->view('layout/rodape');
	}

	public function index($codigo_plataforma = 1)
	{


		$this->load->model('Plataforma_Model', 'Plataforma');
		$this->load->model('Base_Model', 'Base');
		
		$this->Plataforma->codigo = $codigo_plataforma;
		$this->Base->codigo_plataforma = $codigo_plataforma;
		
		$tabelas = array('palavraschave' => true);
		$plataforma = $this->Plataforma->join($tabelas);
		
		
		if($this->input->post('pesquisa'))
		{		
			$pesquisa = $this->input->post('pesquisa');
			$bases = $this->Base->like($pesquisa);	
		}
		else
			$bases = $this->Base->search();

		$dados = array(
			'plataforma' => $plataforma,
			'bases' => $bases
		);

		$this->load->view('layout/topo-plataforma', $dados);
		$this->load->view('home/plataforma', $dados);
		$this->load->view('layout/rodape');
	}
}
/* End of file plataforma.php */
/* Location: ./application/controllers/plataforma.php */
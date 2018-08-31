<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plataforma extends MY_Controller {

	public function index($codigo_plataforma = 1)
	{
		$this->load->model('Plataforma_Model', 'Plataforma');
		$this->load->model('Base_Model', 'Base');
		$this->load->model('favorito_model', 'Favorito');
		$this->load->model('acesso_model', 'Acesso');
		$this->load->model('conteudo_model', 'Conteudo');
		

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

		//////////////////////// pega restrição das bases ///////////////////////

		$i = 0;
		while ($i < count($bases)) {
			$this->Conteudo->codigo_bdataase = $bases[$i]->codigo;
			$conteudo_base = $this->Conteudo->search();
			$publica = 1;
			$restrita = 1;
			if(count($conteudo_base) > 0){
				foreach ($conteudo_base as $con_base) {
					if($con_base->publico == 1)
						$restrita = 0;
					else
						$publica = 0;
				}

				if($publica == 1)
					$bases[$i]->restricao = "publica";
				if($restrita == 1)
					$bases[$i]->restricao = "restrita";
				if($restrita == 0 && $publica == 0)
					$bases[$i]->restricao = "parcial";
			}
			else{
				$bases[$i]->restricao = "publica";
			}

			////////////////////////// verifica acesso /////////////////////////////////

			if($this->membro)
			{
				$this->Acesso->codigo_usuario = $this->membro->codigo;
						
				$this->Acesso->codigo_base = $bases[$i]->codigo;

				$acesso = $this->Acesso->get();
				if(isset($acesso))
					$bases[$i]->acesso = true;
			}

			////////////////////////////////////////////////////////////////////

			$i++;
		}

		///////////////////////////////////////////////

		

		$dados = array(
			'titulo' => $plataforma->nome,
			'plataforma' => $plataforma,
			'usuario_logado' => $this->membro,
			'bases' => $bases
		);

		if($this->membro){
			$this->Favorito->codigo_usuario = $this->membro->codigo;
			$favoritos = $this->Favorito->search();
			$dados["favoritos"] = $favoritos;
			if(  
				isset($this->membro->grupos["Administrador"]) ||
				isset($this->membro->grupos["Proprietário"]) ||
				isset($this->membro->grupos["Colaborador"]) 
			)
				$dados["is_adm"] =  TRUE;
		}


		$this->load->view('layout/topo', $dados);
		$this->load->view('plataforma/topo', $dados);
		$this->load->view('plataforma/plataforma', $dados);
		$this->load->view('layout/rodape');
	}

	public function login()
	{
		$this->load->helper("form");
		$this->load->library("form_validation");

		$senha = $this->input->post('membro-senha');

		$this->form_validation->set_rules('membro-senha', 'Senha', 'required');
		$this->form_validation->set_rules('membro-email', 'E-mail', 'required|callback_verificar_cadastro['.$senha.']');//valid_email|

		if ($this->form_validation->run() == FALSE) {
			
			$data = array('titulo' => 'Login');

			$this->load->view('layout/topo', $data);
			$this->load->view('login', $data);
			$this->load->view('layout/rodape');
		} else {
			
			$this->load->library('session');
			
			$this->load->model("usuario_model", "Membro");
			$this->Membro->senha = $this->input->post('membro-senha');
			$this->Membro->email = $this->input->post('membro-email');

			$newdata = array(
	           'membro' => $this->Membro->join(array('grupos' => TRUE)),
	           'logged_in' => TRUE
	       	);

			$this->session->set_userdata($newdata);
						
			redirect(site_url());
		}
	}

	public function verificar_cadastro($email, $senha)
	{
		$this->load->model("usuario_model", "Membro_");
				
		$this->Membro_->email = $email;
		$this->Membro_->senha = $senha;
		
		$membro = $this->Membro_->get();

		if($membro != null && $membro->senha == $senha && $membro->email == $email && $membro->situacao == 1)
		{
			return TRUE;
		} 
		else 
		{
			$this->form_validation->set_message('verificar_cadastro', 'Usuário não encontrado.');
			return FALSE;
		}
	}

	public function cadastrar()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('membro-nome', 'Nome', 'required');
		$this->form_validation->set_rules('membro-email', 'Email', 'required|valid_email|callback_useremail_check');
		$this->form_validation->set_rules('membro-senha', 'Senha', 'required');

		$this->load->model("campo_model", "Campos");
		$campos = $this->Campos->getAll();

		foreach ($campos as $campo) 
		{
			if($campo->obrigatorio == 1)
				$this->form_validation->set_rules('membro-'.$campo->nome, $campo->nome, 'required');
		}	

		$data = array(
			'campos' => $campos,
			'titulo' => 'Cadastrar-se'
		);

		if($this->form_validation->run() == FALSE)
		{
			$nome = $this->input->post('nome');
			$email = $this->input->post('email');

			$this->load->view('layout/topo', $data);
			$this->load->view('cadastrar', $data);
			$this->load->view('layout/rodape');
		} 
		else 
		{
			$this->load->model("usuario_model", "Cadastro_Membro");

			$this->Cadastro_Membro->nome  = $this->input->post('membro-nome');
			$this->Cadastro_Membro->email = $this->input->post('membro-email');
			$this->Cadastro_Membro->senha = $this->input->post('membro-senha');
			$metadados = array();

			foreach ($campos as $campo) 
				$metadados[$campo->nome] = $this->input->post('membro-'.$campo->nome);
			
			$this->Cadastro_Membro->insert($metadados);

			$this->load->view('layout/topo', $data);
			$this->load->view('sucesso', array('email' => $this->Cadastro_Membro->email));
			$this->load->view('layout/rodape');
		}
	}

	public function sair()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}

}
/* End of file plataforma.php */
/* Location: ./application/controllers/plataforma.php */
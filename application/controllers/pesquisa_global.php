<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesquisa_global extends MY_Controller {


	public function index($codigo_plataforma = 1)
	{

		$this->load->model('conteudo_model', 'Conteudo');
		$this->load->model('base_model', 'Base');
		$this->load->model('usuario_model', 'Usuario');
		$this->load->model('favorito_model', 'Favorito');
		$this->load->model('acesso_model', 'Acesso');
		$this->load->model('Plataforma_Model', 'Plataforma');

		$this->Plataforma->codigo = $codigo_plataforma;
		$pesquisa = $this->input->post('pesquisa-global');
		
		$conteudos = $this->Plataforma->like_plataforma($pesquisa);

		//////////////////////// pega restrição das bases ///////////////////////

		if(isset($conteudos['bases'])){
			$i = 0;
			while ($i < count($conteudos['bases'])) {
				$this->Conteudo->codigo_base = $conteudos['bases'][$i]->codigo;
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
						$conteudos['bases'][$i]->restricao = "publica";
					if($restrita == 1)
						$conteudos['bases'][$i]->restricao = "restrita";
					if($restrita == 0 && $publica == 0)
						$conteudos['bases'][$i]->restricao = "parcial";
				}
				else{
					$conteudos['bases'][$i]->restricao = "publica";
				}
				$i++;
			}
		}

		///////////////////////////////////////////////

		$tabelas = array('palavraschave' => true);
		$plataforma = $this->Plataforma->join($tabelas);

		////////////////////////// verifica acesso /////////////////////////////////

		if($this->membro)
		{
			$this->Acesso->codigo_usuario = $this->membro->codigo;
			foreach ($conteudos as $key => $value)
			{
				switch ($key) {
					
					case "bases": $chave = "bases"; break;
					case "artigos": $chave = "artigos"; break; 
					case "videos": $chave = "videos"; break; 
					case "imagens": $chave = "imagens"; break; 
					case "audios": $chave = "audios"; break; 
					case "livros": $chave = "livros"; break; 
					case "perguntas": $chave = "perguntas"; break; 
					case "links": $chave = "links"; break; 
					case "outros": $chave = "outros"; break;
				}
				$i = 0;
				while ($i < count($conteudos[$chave])) {

					if($chave == "bases")
					{
						$this->Acesso->codigo_base = $conteudos[$chave][$i]->codigo;
					}
					else
					{
						$this->Acesso->codigo_base = $conteudos[$chave][$i]->codigo_base;
					}

					$acesso = $this->Acesso->get();
					if(isset($acesso))
						$conteudos[$chave][$i]->acesso = true;
					$i++;
				}
			}
		}

		////////////////////////////////////////////////////////////////////

		$dados = array(
			'plataforma' => $plataforma,
			'conteudos' => $conteudos,
			'usuario_logado' => $this->membro,
			'pesquisa' => $pesquisa
		);

		if ($this->membro) {
			$this->Favorito->codigo_usuario = $this->membro->codigo;
			$favoritos = $this->Favorito->search();

			$data['favoritos'] = $favoritos;

			if(  
				isset($this->membro->grupos["Administrador"]) ||
				isset($this->membro->grupos["Proprietário"]) ||
				isset($this->membro->grupos["Colaborador"]) 
			)
				$dados["is_adm"] =  TRUE;
		}


		$this->load->view('layout/topo', $dados);
		$this->load->view('plataforma/topo', $dados);
		$this->load->view('pesquisa_global', $dados);
		$this->load->view('layout/rodape');
	}



}
/* End of file pesquisa_geral.php */
/* Location: ./application/controllers/pesquisa_geral.php */
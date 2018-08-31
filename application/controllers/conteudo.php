<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conteudo extends MY_Controller
{
	public function carregar($codigo)
	{
		$this->load->model("conteudo_model", "Conteudo");
		$this->Conteudo->codigo = $codigo;

		$conteudo = $this->Conteudo->get();
		
		$tabelas = array(
			'bases' => true,
			'comentarios' => true
		);

		switch ($conteudo->tipo)
		{
			case CTIPO_ARTIGO:
				$tabelas['artigos'] = true;
				$visualizar = 'conteudo/visualizar_artigo';
			break;
			case CTIPO_VIDEO:
				$tabelas['arquivos'] = array('videos' => true);
				$visualizar = 'conteudo/visualizar_video';
			break;
			case CTIPO_IMAGEM:
				$tabelas['arquivos'] = array('imagens' => true);
				$visualizar = 'conteudo/visualizar_imagem';
			break;
			case CTIPO_AUDIO:
				$tabelas['arquivos'] = array('audios' => true);
				$visualizar = 'conteudo/visualizar_audio';
			break;
			case CTIPO_LIVRO:
				$tabelas['livros'] = true;
				$visualizar = 'conteudo/visualizar_livro';
			break;
			case CTIPO_PERGUNTA:
				$tabelas['perguntas'] = array('respostas' => true);
				$visualizar = 'conteudo/visualizar_pergunta';
			break;
			case CTIPO_LINK:
				$tabelas['links'] = true;
				$visualizar = 'conteudo/visualizar_link';
			break;
			case CTIPO_OUTRO:
				$tabelas['arquivos'] = array("outros"=> true);
				$visualizar = 'conteudo/visualizar_outro';
			break;
		}

		$tabelas['bases'] = array('plataformas' => TRUE);
		$conteudo = $this->Conteudo->join($tabelas);

		$data = array(
			'conteudo' => $conteudo,
			'titulo' => $conteudo->titulo,
			'plataforma' => $conteudo->base->plataforma,
			'usuario_logado' => $this->membro,
		);

		if ($this->membro) {
			
			$this->load->model('favorito_model', 'Favorito');
			$this->Favorito->codigo_usuario = $this->membro->codigo;
			
			$favoritos = $this->Favorito->search();
		
			$verifica_favorito = false;
			
			foreach ($favoritos['conteudos'] as $base_favorita) {
				if($base_favorita->codigo == $conteudo->codigo)
				{
					$verifica_favorito = true;
					break;
				}
			}

			$data['verifica_favorito'] = $verifica_favorito;
			$data['favoritos'] = $favoritos;

			if(  
				isset($this->membro->grupos["Administrador"]) ||
				isset($this->membro->grupos["Proprietário"]) ||
				isset($this->membro->grupos["Colaborador"]) 
			)
				$dados["is_adm"] =  TRUE;
		}

		return array('data' => $data, 'visualizar' => $visualizar);
	}

	public function index($codigo)
	{
		$conteudo = $this->carregar($codigo);

		$this->load->view('layout/topo', $conteudo['data']);
		$this->load->view('layout/menu-superior', $conteudo['data']);
		$this->load->view('conteudo/topo', $conteudo['data']);
		$this->load->view($conteudo['visualizar'], $conteudo['data']);
		$this->load->view('conteudo/comentarios', $conteudo['data']);
		$this->load->view('layout/rodape');
	}

	public function modal($codigo)
	{
		$conteudo = $this->carregar($codigo);

		$this->load->view('layout/topo', $conteudo['data']);
		$this->load->view($conteudo['visualizar'], $conteudo['data']);
		$this->load->view('conteudo/comentarios', $conteudo['data']);
		$this->load->view('layout/rodape');	
	}
}
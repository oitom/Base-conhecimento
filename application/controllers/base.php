<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends MY_Controller {

	public function index($codigo_base)
	{
		$this->load->model('base_model', 'Base');
		$this->load->model('base_model', 'ContribuidoresBase');
		$this->load->model('plataforma_model', 'Plataforma');
		$this->load->model('usuario_model', 'Usuario');
		$this->load->model('conteudo_model', 'Conteudo');
		$this->load->model('palavrachave_model', 'PalavraChave');
		$this->load->model('favorito_model', 'Favorito');
		$this->load->model('acesso_model', 'Acesso');
		
		$this->Base->codigo = $codigo_base;
		$this->PalavraChave->codigo_base = $codigo_base;

		$palavras = $this->PalavraChave->join(array('bases' => true));
		
		if(isset($palavras->palavrachave))
			$palavraschave = $palavras->palavrachave;

		$tabelas = array(
			'bases' => true,
			'sub_bases' => true,
			'plataformas' => true,
			'conteudos' => true
		);

		$this->Conteudo->codigo_base = $codigo_base;

		$atualizacoes = $this->Conteudo->search(0, 10, "data_hora");

		$base = $this->Base->join($tabelas);

		//////////////////////// pega restrição das sub-bases ///////////////////////

		$i = 0;
		while ($i < count($base->sub_bases)) {
			$this->Conteudo->codigo_base = $base->sub_bases[$i]->codigo;
			$conteudo_sub_base = $this->Conteudo->search();
			$publica = 1;
			$restrita = 1;
			if(count($conteudo_sub_base) > 0){
				foreach ($conteudo_sub_base as $con_sub_base) {
					if($con_sub_base->publico == 1)
						$restrita = 0;
					else
						$publica = 0;
				}

				if($publica == 1)
					$base->sub_bases[$i]->restricao = "publica";
				if($restrita == 1)
					$base->sub_bases[$i]->restricao = "restrita";
				if($restrita == 0 && $publica == 0)
					$base->sub_bases[$i]->restricao = "parcial";
			}
			else{
				$base->sub_bases[$i]->restricao = "publica";
			}
			$i++;
		}

		///////////////////////////////////////////////

		$this->Conteudo->codigo_base = $codigo_base;

		$this->Plataforma->codigo = $base->codigo_plataforma;
		$plataforma = $this->Plataforma->get();

		////////////////////////////////// pega proprietários e colaboradores ////////////////////////////////////

		// $this->Usuario->codigo = $base->codigo_usuario;
		// $usuario = $this->Usuario->get();

		$this->ContribuidoresBase->codigo = $codigo_base;

		$acessos = array('usuarios' => true, 'grupo' => GP_PROPRIETARIO);
		$tabelas = array('acessos' => $acessos);

		$proprietarios = $this->ContribuidoresBase->searchJoin($tabelas);

		$acessos = array('usuarios' => true, 'grupo' => GP_COLABORADOR);
		$tabelas = array('acessos' => $acessos);

		$colaboradores = $this->ContribuidoresBase->searchJoin($tabelas);

		$i = 0;
		$user_prop = array();
		foreach ($proprietarios[0]->acessos as $usuario) {
			$user_prop[$i] = $usuario->usuario;
			$i++;
		}

		$i = 0;
		$user_col = array();
		foreach ($colaboradores[0]->acessos as $usuario) {
			$user_col[$i] = $usuario->usuario;
			$i++;
		}

		$usuarios = array('colaboradores' => $user_col, 'proprietarios' => $user_prop);

		//////////////////////////////////////////////////////////////////////////////////////////////////////////

		if($this->input->post('pesquisa'))
		{
			$pesquisa = $this->input->post('pesquisa');
			$conteudos = $this->Conteudo->like($pesquisa);
		}
		else
		{
			$conteudos = $this->separar_conteudo($base);
		}

		$caminho = $this->pegar_caminho($plataforma, $base);
		
		$mais_acessados = $this->Conteudo->mais_acessados();

		$data = array(
			'titulo' => 'Base - '.$base->nome,
			'caminho' => $caminho,
			'conteudos' => $conteudos,
			'atualizacoes' => $atualizacoes,
			'mais_acessados' => $mais_acessados,
			'base' => $base,
			'plataforma' => $plataforma,
			'usuarios' => $usuarios,
			'usuario_logado' => $this->membro,
			'verifica_favorito' => FALSE
		);
		
		if ($this->membro) {
			$this->Favorito->codigo_usuario = $this->membro->codigo;
			$favoritos = $this->Favorito->search();
		
			$verifica_favorito = false;
			foreach ($favoritos['bases'] as $base_favorita) {
				if($base_favorita->codigo == $codigo_base)
				{
					$verifica_favorito = true;
					break;
				}
			}

			$data['verifica_favorito'] = $verifica_favorito;
			$data['favoritos'] = $favoritos;

			$this->Acesso->codigo_usuario = $this->membro->codigo;
			$this->Acesso->codigo_base = $codigo_base;

			$acesso = $this->Acesso->get();
			$data['acesso'] = $acesso;

			if(  
				isset($this->membro->grupos["Administrador"]) ||
				isset($this->membro->grupos["Proprietário"]) ||
				isset($this->membro->grupos["Colaborador"]) 
			)
			$dados["is_adm"] =  TRUE;
		}

		if(isset($palavras->palavrachave))
			$data["palavraschave"] = $palavraschave;

		if(isset($pesquisa))
			$data["pesquisa"] = $pesquisa;

		$data['is_adm'] = true;
		
		$this->load->view('layout/topo', $data);
		$this->load->view('layout/menu-superior', $data);
		$this->load->view('base/topo', $data);
		$this->load->view('base/bases', $data);
		$this->load->view('layout/rodape');
	}


	private function pegar_caminho($plataforma, $base)
	{
		$this->load->model('base_model', 'Base_Pai');
		$caminho = '<a href="'.site_url("plataforma/index/".$plataforma->codigo).'"> <strong>'.$plataforma->nome.'</strong></a> > ';
		$base_filho = $base;
		$contador = 0;
		$links_pai = array();

		while($base_filho->codigo_pai != null){
			$this->Base_Pai->codigo = $base_filho->codigo_pai;
			$base_filho = $this->Base_Pai->get();
			
			
			$links_pai[$contador] = '<a href="'.site_url("base/index/".$base_filho->codigo).'">'.$base_filho->nome.'</a> > ';
			$contador++;
			
		}
		for ($i=$contador-1; $i >=0 ; $i--) { 
			$caminho = $caminho.$links_pai[$i];	
		}
		$caminho = $caminho . $base->nome;
		return $caminho;
	}

	private function separar_conteudo($base)
	{

		$artigos = array();
		$videos = array();
		$imagens = array();
		$audios = array();
		$livros = array();
		$perguntas = array();
		$links = array();
		$outros = array();

		$i = 0;
		foreach ($base->conteudos as $conteudo) {  
			
			switch ($conteudo->tipo) {
				case CTIPO_ARTIGO: $artigos[$i] = $conteudo;break;
				case CTIPO_VIDEO:  $videos[$i] =  $conteudo; break;
				case CTIPO_IMAGEM: $imagens[$i] = $conteudo; break;
				case CTIPO_AUDIO:  $audios[$i] =  $conteudo; break;
				case CTIPO_LIVRO:  $livros[$i] =  $conteudo; break;
				case CTIPO_PERGUNTA: $perguntas[$i] = $conteudo; break;
				case CTIPO_LINK:  $links[$i] =   $conteudo; break;
				case CTIPO_OUTRO: $outros[$i] =  $conteudo; break;
			}

			$i++;
		}

		$conteudos = array();

		if(count($artigos) > 0)
			$conteudos["artigos"] = $artigos;
		if( count($videos) > 0)
			$conteudos["videos"] = $videos;
		if(count($imagens) > 0)
			$conteudos["imagens"] = $imagens;
		if( count($audios) > 0)
			$conteudos["audios"] = $audios;
		if( count($livros) > 0)
			$conteudos["livros"] = $livros;
		if(count($perguntas) > 0)
			$conteudos["perguntas"] = $perguntas;
		if( count($links) > 0)
			$conteudos["links"] = $links;
		if(count($outros) > 0)
			$conteudos["outros"] = $outros;

		return $conteudos;
	}

	public function ver_mais($codigo, $tipo)
	{
		$this->load->model('base_model', 'Base');
		$this->load->model('plataforma_model', 'Plataforma');
		$this->load->model('usuario_model', 'Usuario');
		$this->load->model('conteudo_model', 'Conteudo');
		
		$this->Conteudo->codigo_base = $codigo;
		$this->Conteudo->tipo = $tipo;
		$conteudos = $this->Conteudo->search();
		
		$this->Base->codigo = $codigo;
		$base = $this->Base->get();
		
		$this->Plataforma->codigo = $base->codigo_plataforma;
		$plataforma = $this->Plataforma->get();

		$caminho = $this->pegar_caminho($plataforma, $base);


		$this->Usuario->codigo = $base->codigo_usuario;
		$usuario = $this->Usuario->get();

		$data = array(
			'titulo' => 'Base - '.$base->nome,
			'caminho' => $caminho,
			'conteudos' => $conteudos,
			'base' => $base,
			'plataforma' => $plataforma,
			'usuario' => $usuario,
			'tipo' => $tipo
		);

		$this->load->view('layout/topo-base', $data);
		$this->load->view('layout/menu-superior', $data);
		$this->load->view('ver_mais/ver_mais', $data);
		$this->load->view('layout/rodape');

	}

	public function ver_mais_filtro($codigo, $tipo, $filtro="")
	{
		$this->load->model('plataforma_model', 'Plataforma');
		$this->load->model('base_model', 'Base');
		$this->load->model('conteudo_model', 'Conteudo');
		
		$this->Plataforma->codigo = $codigo;
		$this->Base->codigo_plataforma = $codigo;
		$tabelas = array('palavraschave' => true);
		$plataforma = $this->Plataforma->join($tabelas);

		if($tipo != CTIPO_BASE)
		{
			$conteudo_filtro = $this->Plataforma->like_plataforma($filtro);

			$chave = "";
			switch ($tipo) {
				case CTIPO_ARTIGO: $chave ="artigos";  break;
				case CTIPO_VIDEO: $chave ="videos";  break;
				case CTIPO_IMAGEM: $chave ="imagens";  break;
				case CTIPO_AUDIO: $chave ="audios";  break;
				case CTIPO_LIVRO: $chave ="livros";  break;
				case CTIPO_PERGUNTA: $chave ="perguntas";  break;
				case CTIPO_LINK: $chave ="links";  break;
				case CTIPO_OUTRO: $chave ="outros";  break;
			}

			$conteudos = $conteudo_filtro[$chave];
		}
		else
			$conteudos = $this->Base->like($filtro);

		$data = array(
			'titulo' => 'Plataforma - '.$plataforma->nome,
			'conteudos' => $conteudos,
			'plataforma' => $plataforma,
			'tipo' => $tipo
		);

		$this->load->view('layout/topo-plataforma.php', $data);
		$this->load->view('layout/menu-superior', $data);
		$this->load->view('ver_mais/ver_mais.php', $data);
		$this->load->view('layout/rodape.php');

	}

	public function adicionar_favorito($codigo_base)
	{
		$this->load->model('favorito_model', 'NovoFavorito');

		$this->NovoFavorito->codigo_usuario = $this->membro->codigo;
		$this->NovoFavorito->codigo_base = $codigo_base;

		$this->NovoFavorito->insert();
		redirect(site_url('base/index/')."/".$codigo_base);
	}

	public function remover_favorito($codigo_base)
	{
		$this->load->model('favorito_model', 'RemoveFavorito');

		$this->RemoveFavorito->codigo_usuario = $this->membro->codigo;
		$this->RemoveFavorito->codigo_base = $codigo_base;

		$this->RemoveFavorito->delete();
		redirect(site_url('base/index/')."/".$codigo_base);
	}
}
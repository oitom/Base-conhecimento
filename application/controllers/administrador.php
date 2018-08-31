<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrador extends MY_Controller
{
	public function __construct()
   	{
        parent::__construct();

        if(!$this->membro)
        	echo "not"; //redirect(site_url());

        if(!(  
				isset($this->membro->grupos["Administrador"]) ||
				isset($this->membro->grupos["Proprietário"]) ||
				isset($this->membro->grupos["Colaborador"]) 
			)){
        	//redirect(site_url());
        }
   	}

	public function paginacao()
	{
		$this->load->model("usuario_model", "Usuario");		
		$this->load->model("base_model", "Base");		
		$this->load->model("conteudo_model", "Conteudo");		
		
		$pagina	= $this->input->post('pagina');
		$limite = $this->input->post('limite');
		$tabela = $this->input->post('tabela');

		$inicio = ($limite * $pagina) - $limite;
		
		switch ($tabela) 
		{
			case 'bases': 
				$bases = $this->Base->search($inicio, $limite); 
				foreach ($bases as $base) 
				{
					$this->Usuario->codigo = $base->codigo_usuario;
					$usuario_base = $this->Usuario->get();

					echo '
					<tr>
						<td><input type="checkbox"></td>
						<td>'.$base->nome.'</td>
						<td>'.date("d/m/Y", strtotime($base->data_hora)).'</td>
						<td>'.$usuario_base->nome.'</td>
						<td><button class="btn btn-primary"> Visualizar <span class="fa fa-binoculars"></span></button>
							<button class="btn btn-warning"> Editar <span class="glyphicon glyphicon-pencil"></span></button>
							<button class="btn btn-danger"> Excluir <span class="glyphicon glyphicon-trash"></span></button>
						</td>
					</tr>';
				}
			break;
			case 'grupos': 
				$grupos = $this->Grupos->search($inicio, $limite); 
				foreach ($grupos as $grupo) 
				{

					echo '<tr>
								<td><input type="checkbox"></td>
								<td>' . $grupo->nome . '</td>
								<td>' . $grupo->descricao . '</td>
								<td>
									<button class="btn btn-primary">
										Visualizar 
										<span class="fa fa-binoculars"></span>
									</button>
									<button class="btn btn-warning">
										Editar 
										<span class="glyphicon glyphicon-pencil"></span>
									</button>
									<button class="btn btn-danger">
										Excluir 
										<span class="glyphicon glyphicon-trash"></span>
									</button>
								</td>
							</tr>';
				}
			break;
			case 'conteudos': 
				$conteudos = $this->Conteudo->search($inicio, $limite); 
				foreach ($conteudos as $conteudo) 
				{
					
					echo '<tr>
						<td><input type="checkbox"></td>
						<td>'.$conteudo->titulo.'</td>
						<td>'.date("d/m/Y", strtotime($conteudo->data_hora)).'</td>
						<td>';
							switch ($conteudo->tipo) { 
								case CTIPO_ARTIGO: echo "artigo"; break; 
								case CTIPO_VIDEO: echo "video"; break;
								case CTIPO_IMAGEM: echo "imagem"; break;
								case CTIPO_AUDIO: echo "audio"; break;
								case CTIPO_LIVRO: echo "livro"; break;
								case CTIPO_PERGUNTA: echo "pergunta"; break;
								case CTIPO_LINK: echo "link"; break;
								case CTIPO_OUTRO: echo "Outros"; break;
							}
					echo'</td>
						<td>';
							if ($conteudo->publico == 1) echo "público";
							else echo "privado";
					echo'</td>
						<td>
							<button class="btn btn-primary">
								Visualizar 
								<span class="fa fa-binoculars"></span>
							</button>
							<button class="btn btn-warning">
								Editar 
								<span class="glyphicon glyphicon-pencil"></span>
							</button>
							<button class="btn btn-danger">
								Excluir 
								<span class="glyphicon glyphicon-trash"></span>
							</button>
						</td>
					</tr>';
				}
			break;
		}	
	}

	public function bases($funcao = null, $codigo = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('base-nome', 'Nome', 'required');
		$this->form_validation->set_rules('base-descricao', 'Descrição', 'required');
		$this->form_validation->set_rules('base-privacidade', 'Privacidade', 'required');

		$this->load->model("base_model", "Base");
		$this->load->model("base_model", "NovaBase");
		$this->load->model("base_model", "ExcluiBase");
		$this->load->model("plataforma_model", "Plataforma");
		$this->load->model("acesso_model", "Acesso");

		$plataformas = $this->Plataforma->search();

		$usuario = array('usuarios' => true);

		$data = array(
			'plataformas' => $plataformas,
			'usuario' => $this->membro
		);

		if($this->form_validation->run() || $funcao == "excluir")
		{
			$this->NovaBase->codigo = $codigo;
			$this->NovaBase->codigo_plataforma = 1; //$this->input->post('codigo-plataforma');
			$this->NovaBase->nome = $this->input->post('base-nome');
			$this->NovaBase->descricao = $this->input->post('base-descricao');
			$this->NovaBase->publica = $this->input->post('base-privacidade');
			if($this->input->post('base-pai') != 0) 	
				$this->NovaBase->codigo_pai = $this->input->post('base-pai');
			$this->NovaBase->codigo_usuario = $this->membro->codigo;
			$this->NovaBase->data_hora = date('Y-m-d'); // $this->membro->codigo;

			if($funcao == "cadastrar")
			{
				$this->NovaBase->insert();
				$base_criada = $this->NovaBase->get();

				$this->Acesso->codigo_usuario = $this->membro->codigo;
				$this->Acesso->codigo_grupo = GP_PROPRIETARIO;
				$this->Acesso->codigo_base = $base_criada->codigo;
				$this->Acesso->data_hora = date('Y-m-d');
				$this->Acesso->insert();

				if(isset($this->NovaBase->codigo_pai))
					$this->proprietario_pai($base_criada->codigo, $this->NovaBase->codigo_pai);
			}
			if($funcao == "editar")
			{
				$this->NovaBase->update();
			}
			if($funcao == "excluir")
			{
				$this->ExcluiBase->codigo = $codigo;
				$this->ExcluiBase->delete();
			}

			$data["sucesso"] = "Sucesso ao executar a função!";
		}

		$bases = $this->Base->searchJoin($usuario);

		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["funcao"] = $funcao;
		$data["codigo"] = $codigo;
		$data["bases"] = $bases;
		
		$data["opcao"] = "bases";
		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_base', $data);
		$this->load->view('layout/rodape');	
		$this->load->view('administrador/script-base');
	}

	public function conteudos($funcao = null, $codigo = null)
	{
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->model("conteudo_model", "Conteudo");
		$this->load->model("base_model", "Bases");
		$this->load->model("palavrachave_model", "PalavrasChave");
		$this->load->model("plataforma_model", "plataforma");

		$conteudos = $this->Conteudo->searchJoin(array("artigos"=>true, "arquivos"=>true, "links"=>true, "perguntas"=>true, "livros"=>true, "palavras_chave"=>true));
		$bases = $this->Bases->getAll();
		$palavras_chave = $this->PalavrasChave->search();
		
		$plataforma = $this->plataforma->get();

		$tipos_extensao = explode(',', $plataforma->ext_bloqueio);
		
		$data  = array(
			'conteudos' => $conteudos,
			'bases' 	=> $bases,
			'plataforma' =>$plataforma,
			'palavras_chave' => $palavras_chave,
			'usuario' => $this->membro
		);

		$this->form_validation->set_rules('conteudo-codigo-base', 'Base', 'required');
		$this->form_validation->set_rules('conteudo-titulo', 'Título', 'required');
		$this->form_validation->set_rules('conteudo-descricao', 'Descrição', 'required');
		
		if($funcao == "cadastrar")
			$this->form_validation->set_rules('conteudo-tipo', 'Tipo', 'required');
		
		$this->form_validation->set_rules('conteudo-palavras', 'Palavras-Chave');

		$tipo_conteudo = $this->input->post('conteudo-tipo');

		switch ($tipo_conteudo) {
			case CTIPO_ARTIGO:
				$this->form_validation->set_rules('artigo-conteudo', 'Conteúdo do artigo', 'required');
			break;
			case CTIPO_VIDEO:
				$file = isset($_FILES['video-file']);
				$this->form_validation->set_rules('video-url', 'Vídeo', 'callback_verificar_arquivo['.$file.']');
			break;
			case CTIPO_IMAGEM:
				$file = isset($_FILES['imagem-file']);	
				$this->form_validation->set_rules('imagem-url', 'Imagem', 'callback_verificar_arquivo['.$file.']');
			break;
			case CTIPO_AUDIO:
				$upload_path = APPPATH."uploads";
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'jpeg|png|gif|jpg';
				
				$this->load->library('upload', $config);
				$file = isset($_FILES['audio-file']);
								
				$this->form_validation->set_rules('audio-url', 'Vídeo', 'callback_verificar_arquivo['.$file.']');
			break;
			case CTIPO_LIVRO:
				$this->form_validation->set_rules('livro-subtitulo', 'Subtitulo', 'required');
				$this->form_validation->set_rules('livro-autor', 'Autor', 'required');
				$this->form_validation->set_rules('livro-paginas', 'Paginas', 'required');
				$this->form_validation->set_rules('livro-edicao', 'Edição', 'required');
				$this->form_validation->set_rules('livro-editora', 'Editora', 'required');
				$this->form_validation->set_rules('livro-ano', 'Ano', 'required');
			break;
			case CTIPO_PERGUNTA:
				$this->form_validation->set_rules('pergunta-texto', 'Pergunta', 'required');
			break;
			case CTIPO_LINK:
				$this->form_validation->set_rules('link-url', 'Link', 'required');
			break;
			case CTIPO_OUTRO:
				$file = isset($_FILES['outro-file']);
				$this->form_validation->set_rules('outro-url', 'Outros Arquivos', 'callback_verificar_arquivo['.$file.']');
			break;
		}

		if ($this->form_validation->run() == FALSE && $funcao != "excluir" ) {

			$data["notificacoes"] = $this->QuantiaNotificacoes();
			$data["opcao"] = "conteudos";
			$data["funcao"] = $funcao;
			$data["codigo"] = $codigo;
			$this->load->view('administrador/topo', $data);
			$this->load->view('administrador/menu', $data);
			$this->load->view('administrador/corpo_conteudo', $data);
			$this->load->view('layout/rodape');
			$this->load->view('administrador/script-base');
			$this->load->view('administrador/script');
		}else {
			
			$this->load->model("conteudo_model", "novoConteudo");
			$this->novoConteudo->codigo_base = $this->input->post('conteudo-codigo-base');
			$this->novoConteudo->titulo    	 = $this->input->post('conteudo-titulo');
			$this->novoConteudo->descricao 	 = $this->input->post('conteudo-descricao');
			$this->novoConteudo->data_hora 	 = date("Y-m-d");
			$this->novoConteudo->situacao  	 = 3;
			$this->novoConteudo->tipo  		 = $this->input->post('conteudo-tipo');
			$this->novoConteudo->publico	 = $this->input->post('conteudo-privacidade');

			switch ($tipo_conteudo) {
				case CTIPO_ARTIGO:					
					$this->load->model("artigo_model", "item");
					$this->item->texto = $this->input->post('artigo-conteudo');
					$this->item->codigo_conteudo = $codigo;
				break;
				case CTIPO_VIDEO:
					$this->load->model("arquivo_model", "item");
					$this->load->model("video_model", "item2");
					
					$this->item->nome = $this->input->post('conteudo-titulo');

					if($this->input->post('video-url')){
						$this->item->caminho 	= $this->input->post('video-url');
						$this->item2->duracao	= " ";
						$this->item2->altura 	= " ";
						$this->item2->largura	= " ";
					}
					else{

						$upload_path = APPPATH."uploads";
						if (!file_exists($upload_path)) mkdir($upload_path);

						$config['upload_path'] = $upload_path;
						$extensao_permitida = explode('|', 'avi|mp4|rmvb|3gp|wma|wmv|mkv|otg|flv|mpeg-4|mov');

						for($i=0; $i<count($extensao_permitida); $i++){
							if(in_array($extensao_permitida[$i], $tipos_extensao))
								unset($extensao_permitida[$i]);	
						}
						$config['allowed_types'] = implode($extensao_permitida, '|');
						

						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload("video-file"))
							echo $this->upload->display_errors();
						else{
							$this->item->caminho = $this->upload->data()['file_name'];
							$this->item->extensao = $this->upload->data()['file_ext'];
		
							$Megabytes = round(ceil($this->upload->data()['file_size']/1024));
	        				$this->item->tamanho  = $Megabytes;
	        				$this->item2->duracao			= "00:00:00";
							$this->item2->altura 			= "0";
							$this->item2->largura			= "0";
						}
					}
				break;
				case CTIPO_IMAGEM:
					$this->load->model("arquivo_model", "item");
					$this->load->model("imagem_model", "item2");
					
					$this->item->nome = $this->input->post('conteudo-titulo');

					if($this->input->post('imagem-url')){
						$this->item->caminho = $this->input->post('imagem-url');
						$this->item2->altura 			= " ";
						$this->item2->largura			= " ";
					}
					else{

						$upload_path = APPPATH."uploads";
						if (!file_exists($upload_path)) mkdir($upload_path);

						$config['upload_path'] = $upload_path;

						$extensao_permitida = explode('|', 'jpeg|png|gif|jpg|bmp|tif|ico');

						for($i=0; $i<count($extensao_permitida); $i++){
							if(in_array($extensao_permitida[$i], $tipos_extensao))
								unset($extensao_permitida[$i]);	
						}
						$config['allowed_types'] = implode($extensao_permitida, '|');
						

						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload("imagem-file"))
							echo $this->upload->display_errors();
						else{
							
							$this->item->caminho = $this->upload->data()['file_name'];
							$this->item->extensao = $this->upload->data()['file_ext'];
		
							$Megabytes = round(ceil($this->upload->data()['file_size']/1024));
	        				$this->item->tamanho  = $Megabytes;

							$this->item2->altura 			= $this->upload->data()["image_width"];
							$this->item2->largura			= $this->upload->data()["image_height"];
						}
					}
				break;
				case CTIPO_AUDIO:
					$this->load->model("arquivo_model", "item");
					$this->load->model("audio_model", "item2");
					
					$this->item->nome = $this->input->post('conteudo-titulo');

					if($this->input->post('audio-url')){
						$this->item->caminho   = $this->input->post('audio-url');
						$this->item2->duaracao = " ";
					}
					else{

						$upload_path = APPPATH."uploads";
						if (!file_exists($upload_path)) mkdir($upload_path);

						$config['upload_path'] = $upload_path;
						$extensao_permitida = explode('|', 'mp3|wma|wav');

						for($i=0; $i<count($extensao_permitida); $i++){
							if(in_array($extensao_permitida[$i], $tipos_extensao))
								unset($extensao_permitida[$i]);	
						}
						$config['allowed_types'] = implode($extensao_permitida, '|');

						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload("audio-file"))
						{	
							print_r($this->upload->display_errors());
						}else{
							
							$this->item->caminho = $this->upload->data()['file_name'];
							$this->item->extensao = $this->upload->data()['file_ext'];
		
							$Megabytes = round(ceil($this->upload->data()['file_size']/1024));
	        				$this->item->tamanho  = $Megabytes;

							$this->item2->duaracao = " ";
						}
					}
				break;
				case CTIPO_LIVRO:
					$this->load->model("livro_model", "item");
					$this->item->subtitulo = $this->input->post('livro-subtitulo');
					$this->item->autor = $this->input->post('livro-autor');
					$this->item->paginas = $this->input->post('livro-paginas');
					$this->item->edicao = $this->input->post('livro-edicao');
					$this->item->editora = $this->input->post('livro-editora');
					$this->item->ano = $this->input->post('livro-ano');
				break;
				case CTIPO_PERGUNTA:
					$this->load->model("pergunta_model", "item");
					$this->item->texto = $this->input->post('pergunta-texto');
				break;
				case CTIPO_LINK:
					$this->load->model("link_model", "item");
					$this->item->url = $this->input->post('link-url');
				break;
				case CTIPO_OUTRO:
					echo "URL ".$this->input->post('outro-url');
					echo "FILE ".$file;

					$this->load->model("arquivo_model", "item");
					$this->load->model("outro_model", "item2");
					
					$this->item->nome = $this->input->post('conteudo-titulo');
					$this->item2->descricao = $this->input->post('conteudo-descricao');	

					if($this->input->post('outro-url')){
						$this->item->caminho = $this->input->post('outro-url');
					}
					else{

						$upload_path = APPPATH."uploads";
						if (!file_exists($upload_path)) mkdir($upload_path);

						$config['upload_path'] = $upload_path;
						$extensao_permitida = explode('|', 'pdf|doc|docx|ppt|odt|html|zip');

						for($i=0; $i<count($extensao_permitida); $i++){
							if(in_array($extensao_permitida[$i], $tipos_extensao))
								unset($extensao_permitida[$i]);	
						}
						$config['allowed_types'] = implode($extensao_permitida, '|');

						$this->load->library('upload', $config);
			
						if (!$this->upload->do_upload("outro-file"))
						{	
							echo $this->upload->display_errors();
						}else{
							
							$this->item->caminho = $this->upload->data()['file_name'];
							$this->item->extensao = $this->upload->data()['file_ext'];
							$Megabytes = round(ceil($this->upload->data()['file_size']/1024));
	        			}
					}
				break;
			}
			 
			if($funcao == "cadastrar"){
				if(($tipo_conteudo > 1 && $tipo_conteudo < 5) || $tipo_conteudo == 8)
					$conteudo_adicionado =$this->novoConteudo->insert($this->item, $this->item2);
				else
					$conteudo_adicionado =$this->novoConteudo->insert($this->item);

				if($this->input->post('conteudo-palavras')){	
					$palavras_conteudo = $this->input->post('conteudo-palavras');
					$this->load->model("palavrachave_model", "palavrachave");
					$this->palavrachave->insert_conteudo_pavalvrachave($conteudo_adicionado, $palavras_conteudo);			
				}
			}

			if($funcao == "editar"){				
				switch ($tipo_conteudo) {
					case CTIPO_ARTIGO: $this->item->codigo = $this->input->post("codigo-tipo-artigo"); break;
					case CTIPO_VIDEO: $this->item->codigo = $this->input->post("codigo-tipo-video"); break;
					case CTIPO_IMAGEM: $this->item->codigo = $this->input->post("codigo-tipo-imagem"); break;
					case CTIPO_AUDIO: $this->item->codigo = $this->input->post("codigo-tipo-audio"); break;
					case CTIPO_LIVRO: $this->item->codigo = $this->input->post("codigo-tipo-livro"); break;
					case CTIPO_PERGUNTA: $this->item->codigo = $this->input->post("codigo-tipo-pergunta"); break;
					case CTIPO_LINK: $this->item->codigo = $this->input->post("codigo-tipo-link"); break;
					case CTIPO_OUTRO: $this->item->codigo = $this->input->post("codigo-tipo-outro"); break;

				}				
				$this->novoConteudo->codigo = $codigo;
				
				if(($tipo_conteudo > 1 && $tipo_conteudo < 5) || $tipo_conteudo == 8)
					$conteudo_editado =$this->novoConteudo->update($this->item, $this->item2);
				else
					$conteudo_editado =$this->novoConteudo->update($this->item);
			}
			
			$conteudos = $this->Conteudo->searchJoin(array("artigos"=>true, "arquivos"=>true, "links"=>true, "perguntas"=>true, "livros"=>true, "palavras_chave"=>true));
			$bases = $this->Bases->getAll();
			$palavras_chave = $this->PalavrasChave->search();
			
			$data  = array(
				'conteudos' => $conteudos,
				'bases' 	=> $bases,
				'palavras_chave' => $palavras_chave,
				'usuario' => $this->membro
			);

			$data["notificacoes"] = $this->QuantiaNotificacoes();
			$data["sucesso"] = "Sucesso ao executar a função!";
			$data["opcao"] = "conteudos";
			$data["funcao"] = $funcao;
			$data["codigo"] = $codigo;
			$this->load->view('administrador/topo', $data);
			$this->load->view('administrador/menu', $data);
			$this->load->view('administrador/corpo_conteudo', $data);
			$this->load->view('layout/rodape');
			$this->load->view('administrador/script-base');
			$this->load->view('administrador/script');
		}
	}

	public function usuarios($funcao = null, $codigo = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('usuario-nome', 'Nome', 'required');
		$this->form_validation->set_rules('usuario-email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('usuario-senha', 'Senha', 'required');
		$this->form_validation->set_rules('usuario-descricao', 'Descricao', 'required');


		$this->load->model("usuario_model", "Usuario");
		$this->load->model("usuario_model", "ExcluiUsuario");
		$data = array('usuario' => $this->membro);

		if($this->form_validation->run() || $funcao == "excluir")
		{
			$this->Usuario->codigo = $codigo;
			$this->Usuario->nome = $this->input->post('usuario-nome');
			$this->Usuario->email = $this->input->post('usuario-email');
			$this->Usuario->senha = $this->input->post('usuario-senha');
			$this->Usuario->descricao = $this->input->post('usuario-descricao');
			$this->Usuario->situacao = USUARIO_APROVADO;
			$this->Usuario->foto = $this->input->post('usuario-foto');


			if($funcao == "cadastrar")
				$this->Usuario->insert();
			if($funcao == "editar")
			{
				if($this->input->post('usuario-situacao'))
					$this->Usuario->situacao = $this->input->post('usuario-situacao');
				$this->Usuario->update();
			}
			if($funcao == "excluir")
			{
				$this->ExcluiUsuario->codigo = $codigo;
				$this->ExcluiUsuario->delete();
			}

			$this->Usuario->codigo = null;
			$this->Usuario->nome = null;
			$this->Usuario->email = null;
			$this->Usuario->senha = null;
			$this->Usuario->descricao = null;
			$this->Usuario->foto = null;
			$this->Usuario->situacao = null;

			$data["sucesso"] = "Sucesso ao executar a função!";
		}

		$usuarios = $this->Usuario->search();

		$data["usuarios"] = $usuarios;

		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["funcao"] = $funcao;
		$data["codigo"] = $codigo;
		$data["opcao"] = "usuarios";
		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_usuario', $data);
		$this->load->view('layout/rodape');
	}

	public function grupos($funcao = null, $codigo = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('grupo-nome', 'Nome', 'required');
		$this->form_validation->set_rules('grupo-descricao', 'Descricao', 'required');

		$this->load->model("grupo_model", "Grupo");
		$this->load->model("grupo_model", "ExcluiGrupo");
		$data = array('usuario' => $this->membro);

		if($this->form_validation->run() || $funcao == "excluir")
		{
			$this->Grupo->codigo = $codigo;
			$this->Grupo->nome = $this->input->post('grupo-nome');
			$this->Grupo->descricao = $this->input->post('grupo-descricao');

			if($funcao == "cadastrar")
				$this->Grupo->insert();
			if($funcao == "editar")
				$this->Grupo->update();
			if($funcao == "excluir")
			{
				$this->ExcluiGrupo->codigo = $codigo;
				$this->ExcluiGrupo->delete();
			}

			$this->Grupo->codigo = null;
			$this->Grupo->nome = null;
			$this->Grupo->descricao = null;

			$data["sucesso"] = "Sucesso ao executar a função!";
		}

		$grupos = $this->Grupo->search();

		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["grupos"] = $grupos;
		$data["opcao"] = "grupos";
		$data["funcao"] = $funcao;
		$data["codigo"] = $codigo;
		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_grupo', $data);
		$this->load->view('layout/rodape');
	}

	public function acessos($funcao = null, $codigo = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('acesso-usuario', 'Usuário', 'required');
		$this->form_validation->set_rules('acesso-base', 'Base', 'required');
		$this->form_validation->set_rules('acesso-grupo', 'Grupo', 'required');

		$this->load->model("grupo_model", "Grupo");
		$grupos = $this->Grupo->search();

		$this->load->model("usuario_model", "Usuario");
		$usuarios = $this->Usuario->search();

		$this->load->model("base_model", "Base");
		$bases = $this->Base->search();

		$this->load->model("acesso_model", "Acesso");
		$this->load->model("acesso_model", "ExcluiAcesso");
		$tabelas = array('usuarios' => true, 'bases' => true, 'grupos' => true);

		$data = array(
			'bases' => $bases,
			'grupos' => $grupos,
			'usuarios' => $usuarios,
			'usuario' => $this->membro
		);

		if($this->form_validation->run() || $funcao == "excluir")
		{
			$this->Acesso->codigo = $codigo;
			$this->Acesso->codigo_base = $this->input->post('acesso-base');
			$this->Acesso->codigo_usuario = $this->input->post('acesso-usuario');
			$this->Acesso->codigo_grupo = $this->input->post('acesso-grupo');
			$this->Acesso->data_hora = date('Y-m-d');

			if($funcao == "cadastrar")
				$this->Acesso->insert();
			if($funcao == "editar")
				$this->Acesso->update();
			if($funcao == "excluir")
			{
				$this->ExcluiAcesso->codigo = $codigo;
				$this->ExcluiAcesso->delete();
			}

			$this->Acesso->codigo = null;
			$this->Acesso->codigo_base = null;
			$this->Acesso->codigo_usuario = null;
			$this->Acesso->codigo_grupo = null;
			$this->Acesso->data_hora = null;

			$data["sucesso"] = "Sucesso ao executar a função!";
		}

		$acesso = $this->Acesso->searchJoin($tabelas);

		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["acessos"] = $acesso;
		$data["opcao"] = "acessos";
		$data["funcao"] = $funcao;
		$data["codigo"] = $codigo;

		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_acesso', $data);
		$this->load->view('layout/rodape');
	}

	public function historico()
	{}

	public function palavrasChave($funcao = null, $codigo = null)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('palavra-chave-titulo', 'Titulo', 'required');

		$this->load->model("palavrachave_model", "PalavraChave");
		$this->load->model("palavrachave_model", "ExcluiPalavraChave");
		$this->load->model("plataforma_model", "Plataforma");

		$data = array('usuario' => $this->membro);

		if($this->form_validation->run() || $funcao == "excluir")
		{

			$this->PalavraChave->codigo_plataforma = 1; //$this->input->post('codigo-plataforma');
			$this->PalavraChave->titulo = $this->input->post('palavra-chave-titulo');
			$this->PalavraChave->codigo = $codigo;

			if($funcao == "cadastrar")
				$this->PalavraChave->insert();
			if($funcao == "editar")
				$this->PalavraChave->update();
			if($funcao == "excluir")
			{
				$this->ExcluiPalavraChave->codigo = $codigo;
				$this->PalavraChave->delete();
			}

			$this->PalavraChave->codigo_plataforma = null;
			$this->PalavraChave->titulo = null;
			$this->PalavraChave->codigo = null;


			$data["sucesso"] = "Sucesso ao executar a função!";
		}

		$palavras_chave = $this->PalavraChave->search();
		$plataformas = $this->Plataforma->search();

		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["palavras_chave"] = $palavras_chave;
		$data["funcao"] = $funcao;
		$data["codigo"] = $codigo;
		$data["opcao"] = "palavras-chave";
		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_palavra_chave', $data);
		$this->load->view('layout/rodape');
		$this->load->view('administrador/script');

	}

	public function aparencia($resetar = false)
	{

		$BG_SELECTED 		= ".bases-medias a:hover~ background-color:";
		$BG_CORPO 			= "body > section~ background-color:";
		$FONT_CORPO 		= "section *, #estrutura-base *~ color:";
		$BG_TOPO_RODAPE 	= "body, #menu-superior, footer~ background-color:";
		$FONT_TOPO_RODAPE 	= "#menu-mobile ul li a,footer>p~ color:";
		$BG_CONTEUDO 		= ".bloco-conteudo~ background-color:";
		$FONT_COBECARIO 	= "#cabecalho, #cabecalho-base *~ color:";
		$BANNER             = "body,#cabecalho,#cabecalho-base~background-image:";

		$this->load->helper("form");
		$this->load->library("form_validation");
		
		$this->load->model("plataforma_model", "Plataforma");
		
		$this->form_validation->set_rules('bg-selected', 'Cor Seleção', 'required');
		$this->form_validation->set_rules('bg-corpo', 'Cor Seleção', 'required');
		$this->form_validation->set_rules('bg-topo-rodape', 'Cor de fundo Topo Rodape', 'required');
		$this->form_validation->set_rules('font-topo-rodape', 'Cor da fonte do Rodapé', 'required');
		$this->form_validation->set_rules('font-corpo', 'Cor da fonte do Rodapé', 'required');
		$this->form_validation->set_rules('bg-conteudo', 'Cor de fundo do Conteúdo', 'required');
		$this->form_validation->set_rules('font-cabecario', 'Cor da fonte do Cabeçário', 'required');

		$this->Plataforma->codigo = 1;
		$plataforma = $this->Plataforma->get();

		if ($plataforma->estilo != "") {
	    	$plataforma->estilo = str_replace("url(", "#url(", $plataforma->estilo);
			preg_match_all('/(.*?):#\s?(.*?)(\||$)/', $plataforma->estilo, $matches);
	    	$estilos = array_combine(array_map('trim', $matches[1]), $matches[2]);
		}
		$banner = isset($estilos[substr($BANNER, 	0,  strlen($BANNER)-1)]) ? $estilos[substr($BANNER, 	0,  strlen($BANNER)-1)] : base_url("img/banner.jpg");

		if ($this->form_validation->run() == FALSE) {
			
			if (!$resetar && $plataforma->estilo) {
		    	//echo "<br><br><br><br><pre>"; print_r($estilos); echo "</pre>";
		    	$cores = array(
					'bg_selected' 		=> "#".$estilos[substr($BG_SELECTED, 		0,  strlen($BG_SELECTED)-1)],
					'bg_corpo' 			=> "#".$estilos[substr($BG_CORPO,			0,  strlen($BG_CORPO)-1)],
					'font_corpo' 		=> "#".$estilos[substr($FONT_CORPO,			0,  strlen($FONT_CORPO)-1)],
					'bg_topo_rodape' 	=> "#".$estilos[substr($BG_TOPO_RODAPE, 	0,  strlen($BG_TOPO_RODAPE)-1)],
					'font_topo_rodape' 	=> "#".$estilos[substr($FONT_TOPO_RODAPE,	0,  strlen($FONT_TOPO_RODAPE)-1)],
					'bg_conteudo' 		=> "#".$estilos[substr($BG_CONTEUDO, 		0,  strlen($BG_CONTEUDO)-1)],
					'font_cabecario' 	=> "#".$estilos[substr($FONT_COBECARIO, 	0,  strlen($FONT_COBECARIO)-1)]
				);

			} else {
				$banner = base_url("img/banner.jpg");
				$cores = array(
					'bg_selected' 		=> "#999999",
					'bg_corpo' 			=> "#f0f3f5",
					'font_corpo' 		=> "#000000",
					'bg_topo_rodape' 	=> "#1a7fa4",
					'font_topo_rodape' 	=> "#ffffff",
					'bg_conteudo' 		=> "#ffffff",
					'font_cabecario' 	=> "#ffffff"
				);

			}
			$plataforma->logo = ($plataforma->logo == "" || $resetar) ? base_url("img/logo.jpg") : base_url(URLUPLOAD.$plataforma->logo);

			//echo "<pre>"; print_r($cores); echo "</pre>";
			
			
			
	    	$data = array(
	    		'cores' => $cores,
	    		'plataforma' => $plataforma,
	    		'banner' => str_replace(array("url(" , ")"), "", $banner),
	    		'usuario' => $this->membro
	    	);
	    	$data["notificacoes"] = $this->QuantiaNotificacoes();
	    	$data["opcao"] = "aparencia";
			$this->load->view('administrador/topo', $data);
			$this->load->view('administrador/menu', $data);
			$this->load->view('administrador/corpo_aparencia');
			$this->load->view('layout/rodape');	
			$this->load->view('administrador/script-aparencia');

		} else {
			
			//$novo_estilo .= "seletor~style:".$this->input->post("*")."|";
			$novo_estilo = "";
			$novo_estilo .= $BG_SELECTED.$this->input->post("bg-selected")."|";
			$novo_estilo .= $BG_CORPO.$this->input->post("bg-corpo")."|";
			$novo_estilo .= $FONT_CORPO.$this->input->post("font-corpo")."|";
			$novo_estilo .= $BG_TOPO_RODAPE.$this->input->post("bg-topo-rodape")."|";
			$novo_estilo .= $FONT_TOPO_RODAPE.$this->input->post("font-topo-rodape")."|";
			$novo_estilo .= $BG_CONTEUDO.$this->input->post("bg-conteudo")."|";
			$novo_estilo .= $FONT_COBECARIO.$this->input->post("font-cabecario")."|";

			if (isset($_FILES['banner']) || isset($_FILES['logo'])) {
				
				$upload_path = APPPATH."uploads";
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = 'jpeg|png|gif|jpg|ico';
				$config['overwrite'] = 'true';
				
				if (isset($_FILES['logo']) && $_FILES['logo']["error"] == 0) {
					$config['file_name'] = 'logo';	
					$this->load->library('upload', $config);

					if ($this->upload->do_upload("logo")) {
						$this->Plataforma->logo = $this->upload->data()["file_name"];
					} else {
						print_r($this->upload->display_errors());
						print_r($_FILES['logo']); 
					}
				} 

				if (isset($_FILES['banner']) && $_FILES['banner']["error"] == 0) {
					$config['file_name'] = 'banner';	
					$this->load->library('upload', $config);

					if ($this->upload->do_upload("banner")) {
						$novo_estilo .= $BANNER."url(".base_url(URLUPLOAD.$this->upload->data()["file_name"]).")|";
					} else {
						print_r($this->upload->display_errors());
					}
				} else {
					$novo_estilo .= $BANNER.$banner."|";
				}
			} 
			
			
			$this->load->model("plataforma_model", "Plataforma");
			$this->Plataforma->codigo = 1;
			$this->Plataforma->estilo = $novo_estilo;

			$this->Plataforma->update();

			//echo $novo_estilo;
			redirect(site_url('administrador/aparencia'));
		}
	}

	public function configuracao()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('plataforma-nome', 'Nome', 'required');
		$this->form_validation->set_rules('plataforma-descricao', 'Descrição', 'required');

		$this->load->model("plataforma_model", "Plataforma");

		$data = array('usuario' => $this->membro);

		if($this->form_validation->run())
		{

			$this->Plataforma->codigo    = 1; //$this->input->post('codigo-plataforma');
			$this->Plataforma->nome      = $this->input->post('plataforma-nome');
			$this->Plataforma->descricao = $this->input->post('plataforma-descricao');

			$stringtipo = "";
			for($i = 1; $i <= 8; $i++)
			{
				if($this->input->post('tipo-restrito-'.$i))
				{
					if($i == 1 || $stringtipo == "")
						$stringtipo = $this->input->post('tipo-restrito-'.$i);
					else
						$stringtipo = $stringtipo.",".$this->input->post('tipo-restrito-'.$i);
				}
			}

			$this->Plataforma->tipo_bloqueio = $stringtipo;

			$stringext = "";
			$restricoes =$this->input->post('ext-restrito');
			$i = 0;
			while($i < count($restricoes))
			{
				if($i == 0 || $stringext == "")
					$stringext = $restricoes[$i];
				else
					$stringext = $stringext.",".$restricoes[$i];
				$i++;
			}

			$this->Plataforma->ext_bloqueio = $stringext;

			$this->Plataforma->update();

			$this->Plataforma->nome      = null;
			$this->Plataforma->descricao = null;
			$this->Plataforma->tipo_bloqueio = null;
			$this->Plataforma->ext_bloqueio = null;

			$data["sucesso"] = "Sucesso ao configurar !";
		}

		$plataforma = $this->Plataforma->get();

		$tipos_bloc = array();
		$tipos_bloc = explode(",", $plataforma->tipo_bloqueio);

		$tipo = array();
		$tipo[1]["codigo"] = 1;
		$tipo[1]["descricao"] = "Artigos";
		$tipo[2]["codigo"] = 2;
		$tipo[2]["descricao"] = "Vídeos";
		$tipo[3]["codigo"] = 3;
		$tipo[3]["descricao"] = "Imagens";
		$tipo[4]["codigo"] = 4;
		$tipo[4]["descricao"] = "Audios";
		$tipo[5]["codigo"] = 5;
		$tipo[5]["descricao"] = "Livros";
		$tipo[6]["codigo"] = 6;
		$tipo[6]["descricao"] = "Perguntas";
		$tipo[7]["codigo"] = 7;
		$tipo[7]["descricao"] = "Links";
		$tipo[8]["codigo"] = 8;
		$tipo[8]["descricao"] = "Outros Arquivos";

		$i = 1;
		while($i <= 8)
		{
			$tipo[$i]["bloqueio"] = false;
			$i++;
		}

		$i = 1;
		while($i <= 8)
		{
			foreach ($tipos_bloc as $tipo_bloc) {
				if($tipo[$i]["codigo"] == $tipo_bloc)
					$tipo[$i]["bloqueio"] = true;
			}
			$i++;
		}

		$ext_bloc = array();
		$ext_bloc = explode(",", $plataforma->ext_bloqueio);

		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["tipo"] = $tipo;
		$data["ext"] = $ext_bloc;
		$data["plataforma"] = $plataforma;
		$data["opcao"] = "configuracao";
		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_configuracao', $data);
		$this->load->view('layout/rodape');
		$this->load->view('administrador/script');
		$this->load->view('administrador/script-configuracao');
	}

	public function index()
	{
		$this->bases();
	}

	public function proprietario_pai($codigo, $codigo_pai)
	{

		$this->load->model("acesso_model", "AcessoPai");
		$this->load->model("acesso_model", "NovoAcesso");


		$this->AcessoPai->codigo_base = $codigo_pai;
		$this->AcessoPai->codigo_grupo = GP_PROPRIETARIO;
		$acessos_pai = $this->AcessoPai->search();

		if(!empty($acessos_pai))
		{
			foreach ($acessos_pai as $acesso_pai) 
			{
				$this->NovoAcesso->codigo_base = $codigo;
				$this->NovoAcesso->codigo_grupo = GP_PROPRIETARIO;
				$this->NovoAcesso->codigo_usuario = $acesso_pai->codigo_usuario;
				$this->NovoAcesso->data_hora = date('Y-m-d 00:00:00');

				$this->NovoAcesso->insert();
			}
		}
	}

	public function notificacao($funcao = null, $codigo = null)
	{
		$this->load->model("plataforma_model", "Plataforma");
		$this->load->model("conteudo_model", "conteudo_pendente");
		$this->load->model("usuario_model", "usuario_pendente");
		
		if($funcao)
		{
			$this->conteudo_pendente->codigo = $codigo;
			$this->usuario_pendente->codigo = $codigo;

			if($funcao == "aprovar")
			{
				$this->conteudo_pendente->situacao = CT_ST_APROVADO;
				$this->conteudo_pendente->update();
			}
			if($funcao == "revisar")
			{
				$this->conteudo_pendente->situacao = CT_ST_REVISANDO;
				$this->conteudo_pendente->update();
			}
			if($funcao == "recusar")
			{
				$this->conteudo_pendente->situacao = CT_ST_RECUSADO;
				$this->conteudo_pendente->update();
			}
			if($funcao == "aceitar")
			{
				$this->usuario_pendente->situacao = USUARIO_APROVADO;
				$this->usuario_pendente->update();
			}
			if($funcao == "bloquear")
			{
				$this->usuario_pendente->situacao = USUARIO_BLOQUEADO;
				$this->usuario_pendente->update();
			}

			$this->conteudo_pendente->codigo = null;
			$this->conteudo_pendente->situacao = null;
			$this->usuario_pendente->codigo = null;
			$this->usuario_pendente->situacao = null;
		}

		$this->conteudo_pendente->situacao = CT_ST_PENDENTE;
		$conteudos = $this->conteudo_pendente->search();
		
		$this->conteudo_pendente->situacao = CT_ST_REVISANDO;
		$conteudos_ = $this->conteudo_pendente->search();
		
		for($i=0; $i<count($conteudos_); $i++){
			array_push($conteudos, $conteudos_[$i]);
		}

		$this->usuario_pendente->situacao = USUARIO_AGUARDANDO;
		$usuarios = $this->usuario_pendente->search();
		
		$plataformas = $this->Plataforma->search();

		$data = array(
			'plataformas' => $plataformas,
			'usuario' => $this->membro,
			'conteudos' => $conteudos,
			'usuarios' => $usuarios
		);
		$data["notificacoes"] = $this->QuantiaNotificacoes();
		$data["opcao"] = "notificacao";
		$this->load->view('administrador/topo', $data);
		$this->load->view('administrador/menu', $data);
		$this->load->view('administrador/corpo_notificacao', $data);
		$this->load->view('layout/rodape');	
		$this->load->view('administrador/script-base');
	}

	public function QuantiaNotificacoes()
	{
		$this->load->model("conteudo_model", "conteudo_notificacao");
		$this->load->model("usuario_model", "usuario_notificacao");

		$this->conteudo_notificacao->situacao = 1;
		$conteudos = $this->conteudo_notificacao->search();
		
		$this->conteudo_notificacao->situacao = 2;
		$conteudos_ = $this->conteudo_notificacao->search();

		$this->usuario_notificacao->situacao = 0;
		$usuarios = $this->usuario_notificacao->search();

		$quantia = array('conteudos' => (count($conteudos) + count($conteudos_)), 'usuarios' => count($usuarios));

		return $quantia;
	}

}
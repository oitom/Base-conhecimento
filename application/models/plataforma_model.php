<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Plataforma_Model extends CI_Model{
	
	var $codigo; 
	var $nome;
	var $descricao;
	var $estilo;
	var $logo;
	var $ext_bloqueio;
	var $tipo_bloqueio;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;
		if ($this->estilo)
			$where['estilo'] = $this->estilo;
		if ($this->logo)
			$where['logo'] = $this->logo;
		if ($this->ext_bloqueio)
			$where['ext_bloqueio'] = $this->ext_bloqueio;
		if ($this->tipo_bloqueio)
			$where['tipo_bloqueio'] = $this->tipo_bloqueio;
		
		$query = $this->db->get_where('plataformas', $where);

		return $query->result();
	}

	public function get()
	{
		$resultados = $this->search();
		
		if(!empty($resultados))
			return $resultados[0];
		else
			return null;
	}

	public function getAll()
	{
		$query = $this->db->get('plataformas');
		return $query->result();	
	}

	public function join($tabelas = array())
	{
		$plataforma = $this->get();

		if (isset($tabelas["palavraschave"])) 
		{
			$where = array('codigo_plataforma' => $plataforma->codigo);
			$plataforma->palavraschave = $this->db->get_where('palavraschave', $where)->result();
		}
		
		return $plataforma;
	}

	public function like_plataforma($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('nome', $parametro);
		$this->db->or_like('descricao', $parametro);
		$resultado_base = $this->db->get('bases')->result();

		$this->db->select('codigo');
		$this->db->from('bases');
		$this->db->where(array('codigo_plataforma' => $this->codigo));
		$bases_plataforma = $this->db->get()->result();

		for ($i=0; $i < count($bases_plataforma); $i++) 
			$id_bases[$i] = $bases_plataforma[$i]->codigo;

		$this->db->like('titulo', $parametro);
		$this->db->or_like('descricao', $parametro);
		$resultado_conteudo = $this->db->get('conteudos')->result();
		
		for ($i=0; $i < count($resultado_conteudo); $i++) 
		{ 
			$this->db->select('nome');
			$this->db->from('bases');
			$this->db->where(array('codigo' => $resultado_conteudo[$i]->codigo_base));
			$base = $this->db->get()->result();
			$resultado_conteudo[$i]->base = $base[0]->nome;
		}

		$artigos = array(); $livros = array();
		$videos = array(); $perguntas = array();
		$imagens = array(); $links = array();
		$audios = array(); $outros = array();
		$bases = array();

		for ($i=0; $i < count($resultado_base); $i++) 
			$bases[$i]=$resultado_base[$i];

		for ($i=0; $i < count($resultado_conteudo); $i++) 
		{ 
			if(in_array($resultado_conteudo[$i]->codigo_base, $id_bases))
			{
				switch ($resultado_conteudo[$i]->tipo) 
				{
					case CTIPO_ARTIGO: array_push($artigos, $resultado_conteudo[$i]); break;
					case CTIPO_VIDEO: array_push($videos, $resultado_conteudo[$i]); break;
					case CTIPO_IMAGEM: array_push($imagens, $resultado_conteudo[$i]); break;
					case CTIPO_AUDIO: array_push($audios, $resultado_conteudo[$i]); break;
					case CTIPO_LIVRO: array_push($livros, $resultado_conteudo[$i]); break;
					case CTIPO_PERGUNTA: array_push($perguntas, $resultado_conteudo[$i]); break;
					case CTIPO_LINK: array_push($links, $resultado_conteudo[$i]); break;
					case CTIPO_OUTRO: array_push($outros, $resultado_conteudo[$i]); break;
				}
			}
		}
		
		$conteudos = array();

		if(count($bases) > 0)
			$conteudos["bases"] = $bases;
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

	public function insert()
	{
		$data = array(
			'nome' => $this->nome,
			'descricao' => $this->descricao,
			'descricao' => $this->descricao,
			'estilo' => $this->estilo,
			'logo' => $this->logo,
			'ext_bloqueio' => $this->ext_bloqueio,
			'tipo_bloqueio' => $this->tipo_bloqueio
		);

		$this->db->insert('plataformas', $data);
	}

	public function update()
	{
		$update = array();

		if($this->codigo)
			$update["codigo"] = $this->codigo;
		if($this->nome)
			$update["nome"] = $this->nome;
		if($this->descricao)
			$update["descricao"] = $this->descricao;
		if($this->estilo)
			$update["estilo"] = $this->estilo;
		if($this->logo)
			$update["logo"] = $this->logo;	
		if($this->ext_bloqueio)
			$update["ext_bloqueio"] = $this->ext_bloqueio;	
		if($this->tipo_bloqueio)
			$update["tipo_bloqueio"] = $this->tipo_bloqueio;	

		$this->db->where('codigo', $this->codigo);
		$this->db->update('plataformas', $update);
	}

	public function delete()
	{
		$where = array();

		if($this->codigo)
			$where["codigo"] = $this->codigo;
		if($this->nome)
			$where["nome"] = $this->nome;
		if($this->descricao)
			$where["descricao"] = $this->descricao;
		if($this->estilo)
			$where["estilo"] = $this->estilo;
		if($this->logo)
			$where["logo"] = $this->logo;
		if($this->ext_bloqueio)
			$where["ext_bloqueio"] = $this->ext_bloqueio;
		if($this->tipo_bloqueio)
			$where["tipo_bloqueio"] = $this->tipo_bloqueio;
		
		$this->db->delete('arquivos', $where);
	}

}

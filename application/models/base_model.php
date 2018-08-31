<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Model extends CI_Model{
	var $codigo;
	var $codigo_plataforma;
	var $nome;
	var $descricao;
	var $data_hora;
	var $publica;
	var $codigo_pai;
	var $codigo_usuario;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_plataforma)
			$where['codigo_plataforma'] = $this->codigo_plataforma;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;
		if ($this->publica)
			$where['publica'] = $this->publica;
		if ($this->codigo_pai)
			$where['codigo_pai'] = $this->codigo_pai;
		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;

		$query = $this->db->get_where('bases', $where);
		return $query->result();
	}

	public function get()
	{
		$base = $this->search()[0];
		return $base;
	}
	
	public function getAll()
	{
		$query = $this->db->get('bases');
		return $query->result();	
	}

	public function searchJoin($tabela)
	{
		$bases = $this->search();
		$i = 0;

		while ($i < count($bases))
		{
			if(isset($tabela['plataformas']))
			{
				$this->load->model("plataforma_model", "Plataforma");
				$this->Plataforma->codigo = $bases[$i]->codigo_plataforma;

				if (is_array($tabela['plataformas']))
					$plataforma = $this->Plataforma->join($tabela['plataformas']);
				else
					$plataforma = $this->Plataforma->get();

				$bases[$i]->plataforma =  $plataforma;
			}
			if(isset($tabela['bases']))
			{
				$this->codigo = $bases[$i]->codigo_pai;
				
				if (is_array($tabela['bases']))
					$bases = $this->join($tabela['bases']);
				else
					$bases = $this->search();

				$bases[$i]->bases = $bases;
			}
			if(isset($tabela['base_pai']))
			{
				$this->codigo_pai = $bases[$i]->codigo;
				
				if (is_array($tabela['base_pai']))
					$bases = $this->join($tabela['base_pai']);
				else
					$bases = $this->get();

				$bases[$i]->bases = $bases;
			}
			if(isset($tabela['sub_bases']))
			{

				$this->codigo_pai = $bases[$i]->codigo;
				
				$bases = $this->search();

				$bases[$i]->sub_bases = $bases;
			}
			if(isset($tabela['palavraschave']))
			{
				$this->load->model("palavrachave_model", "PalavraChave");
				$this->PalavraChave->codigo_base = $bases[$i]->codigo;
				
				if (is_array($tabela['palavraschave']))
					$bases = $this->join($tabela['palavraschave']);
				else
					$bases = $this->search();

				$bases[$i]->palavraschave =  $this->PalavraChave->search();
			}
			if(isset($tabela['acessos']))
			{
				$this->load->model("acesso_model", "Acesso");
				$this->Acesso->codigo_base = $bases[$i]->codigo;

				if (is_array($tabela['acessos']))
					$acessos = $this->Acesso->searchJoin($tabela['acessos']);
				else
					$acessos = $this->Acesso->search();

				$bases[$i]->acessos = $acessos;
			}
			if(isset($tabela['usuarios']))
			{
				$this->load->model("usuario_model", "Usuario");
				$this->Usuario->codigo = $bases[$i]->codigo_usuario;
					
				if (is_array($tabela['usuarios']))
					$usuario = $this->Usuario->join($tabela['usuarios']);
				else
					$usuario = $this->Usuario->get();


				$bases[$i]->usuario =  $usuario;
			}
			if(isset($tabela['conteudos']))
			{
				$this->load->model("conteudo_model", "Conteudo");
				$this->Conteudo->codigo_base = $bases[$i]->codigo;
				

				if(is_array($tabela['conteudos'])){
					$conteudos = $this->Conteudo->join($tabela['conteudos']);
				} else {
					$conteudos = $this->Conteudo->search();
				}

				$bases[$i]->conteudos = $conteudos;
			}
			$i++;
		}

		return $bases;
	}	

	public function join($tabela)
	{
		$base = $this->get();

		if(isset($tabela['plataformas']))
		{
			$this->load->model("plataforma_model", "Plataforma");
			$this->Plataforma->codigo = $base->codigo_plataforma;

			if (is_array($tabela['plataformas']))
				$plataforma = $this->Plataforma->join($tabela['plataformas']);
			else
				$plataforma = $this->Plataforma->get();

			$base->plataforma =  $plataforma;
		}
		if(isset($tabela['bases']))
		{
			$this->codigo = $base->codigo_pai;
			
			if (is_array($tabela['bases']))
				$bases = $this->join($tabela['bases']);
			else
				$bases = $this->search();

			$base->bases = $bases;
		}
		if(isset($tabela['base_pai']))
		{
			$this->codigo_pai = $base->codigo;
			
			if (is_array($tabela['base_pai']))
				$bases = $this->join($tabela['base_pai']);
			else
				$bases = $this->get();

			$base->bases = $bases;
		}
		if(isset($tabela['sub_bases']))
		{

			$this->codigo_pai = $base->codigo;
			
			$bases = $this->search();

			$base->sub_bases = $bases;

		}
		if(isset($tabela['palavraschave']))
		{
			$this->load->model("palavrachave_model", "PalavraChave");
			$this->PalavraChave->codigo_base = $base->codigo;
			
			if (is_array($tabela['palavraschave']))
				$bases = $this->join($tabela['palavraschave']);
			else
				$bases = $this->search();

			$base->palavraschave =  $this->PalavraChave->search();
		}
		if(isset($tabela['acessos']))
		{
			$this->load->model("acesso_model", "Acesso");
			$this->Acesso->codigo_base = $base->codigo;

			if (is_array($tabela['acessos']))
				$acessos = $this->Acesso->searchJoin($tabela['acessos']);
			else
				$acessos = $this->Acesso->search();

			$base->acessos = $acessos;
		}
		if(isset($tabela['usuarios']))
		{
			$this->load->model("usuario_model", "Usuario");
			$this->Usuario->codigo = $base->codigo_usuario;
				
			if (is_array($tabela['usuarios']))
				$usuario = $this->Usuario->join($tabela['usuarios']);
			else
				$usuario = $this->Usuario->get();


			$base->usuario =  $usuario;
		}
		if(isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo_base = $base->codigo;
			

			if(is_array($tabela['conteudos'])){
				$conteudos = $this->Conteudo->join($tabela['conteudos']);
			} else {
				$conteudos = $this->Conteudo->search();
			}

			$base->conteudos = $conteudos;
			
		}

		return $base;
	}

	public function insert()
	{
		$data = array(
			'codigo_plataforma' => $this->codigo_plataforma,
			'nome' => $this->nome,
			'descricao' => $this->descricao,
			'data_hora' => $this->data_hora,
			'publica' => $this->publica,
			'codigo_pai' => $this->codigo_pai,
			'codigo_usuario' => $this->codigo_usuario
		);

		$this->db->insert('bases', $data);
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_plataforma)
			$data['codigo_plataforma'] = $this->codigo_plataforma;
		if ($this->nome)
			$data['nome'] = $this->nome;
		if ($this->descricao)
			$data['descricao'] = $this->descricao;
		if ($this->data_hora)
			$data['data_hora'] = $this->data_hora;
		if ($this->publica)
			$data['publica'] = $this->publica;
		if ($this->codigo_pai)
			$data['codigo_pai'] = $this->codigo_pai;
		if ($this->codigo_usuario)
			$data['codigo_usuario'] = $this->codigo_usuario;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('bases', $data);
	}

	public function delete()
	{
		$where = array();
		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_plataforma)
			$where['codigo_plataforma'] = $this->codigo_plataforma;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;
		if ($this->publica)
			$where['publica'] = $this->publica;
		if ($this->codigo_pai)
			$where['codigo_pai'] = $this->codigo_pai;
		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;

		$this->db->delete('acessos', array('codigo_base' => $this->codigo));

		$this->db->delete('bases', $where); 

		/*$this->load->model("conteudo_model", "Conteudo");
		$this->Conteudo->codigo_base = $this->codigo;
		$this->Conteudo->delete();

		$this->load->model("palavrachave_model", "PalavraChave");
		$this->PalavraChave->codigo_base = $this->codigo;
		$this->PalavraChave->delete();*/
	}
	
	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('nome', $parametro);
		$this->db->or_like('descricao', $parametro);
		$resultado = $this->db->get_where('bases', array('codigo_plataforma' => $this->codigo_plataforma ));
		
		return $resultado->result();
	}
	
}
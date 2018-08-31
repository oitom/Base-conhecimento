<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Usuario_Model extends CI_Model{
	
	var $codigo;
	var $nome;
	var $email;
	var $senha;
	var $descricao;
	var $foto;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->email)
			$where['email'] = $this->email;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;
		
		$query = $this->db->get_where('usuarios', $where);

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

	public function join($tabelas = array())
	{		
		
		$usuario = $this->get();

		if(isset($tabelas["bases"])) 
		{
			$this->load->model("base_model", "Base");
			$this->Base->codigo_usuario = $usuario->codigo;
			$usuario->base = $this->Base->get();
		}

		if(isset($tabelas["plataforma"])) 
		{
			$this->load->model("plataforma_model", "Plataforma");
			$this->Plataforma->codigo_usuario = $usuario->codigo;
			$usuario->plataforma =  $this->Plataforma->get();
		}

		if(isset($tabelas["revisoes"])) 
		{
			$this->load->model("revisoes_model", "Revisao");
			$this->Revisao->codigo_usuario = $usuario->codigo;
			$usuario->revisao =  $this->Revisao->get();
		}

		if(isset($tabelas["grupos"])) 
		{
			$this->load->model("grupo_model", "Grupo");
			$this->load->model("acesso_model", "Acesso");

			$this->Acesso->codigo_usuario 	 = $usuario->codigo;
			$this->Acesso->codigo_plataforma = $usuario->codigo;
			$acessos = $this->Acesso->search();

			$grupos = array();
			
			for ($i=0; $i < count($acessos); $i++) { 
				$this->Grupo->codigo = $acessos[$i]->codigo_grupo;
				$grupo = $this->Grupo->get();
				$grupos[$grupo->nome] = $grupo;
				$grupos[$grupo->nome]->codigo_base = $acessos[$i]->codigo_base;
			}

			$usuario->grupos = $grupos;
		}

		return $usuario;
	}


	public function delete()
	{
		$where = array();
		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->email)
			$where['email'] = $this->email;
		if ($this->senha)
			$where['senha'] = $this->senha;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;
		if ($this->foto)
			$where['foto'] = $this->foto;

		$this->db->delete('usuarios', $where); 
	}

	public function update()
	{
		$where = array();

		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->email)
			$where['email'] = $this->email;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;
		if($this->foto)
			$where['foto'] = $this->foto;
	
		$this->db->where('codigo', $this->codigo);
		$this->db->update('usuarios', $where); 
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'nome'  => $this->nome,  
			'email'  => $this->email,  
			'descricao'  => $this->descricao,  
			'foto'  => $this->foto  
		);

		$this->db->insert('usuarios', $data);
	}

	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('nome', $parametro);
		$this->db->or_like('email', $parametro);
		$resultado = $this->db->get('usuarios');
		
		return $resultado->result();
	}

	public function like_join($tabelas, $value)
	{
		$usuario = $this->like($value);

		$i = 0;
		while ( $i < count($usuario)) 
		{
			if (isset($tabelas["plataforma"])) 
			{
				$this->load->model("plataforma_model", "Plataforma");
				$this->Plataforma->codigo_usuario = $usuario[$i]->codigo;
				$usuario[$i]->plataforma = $this->Plataforma->get();
			}
			if (isset($tabelas["bases"])) 
			{
				$this->load->model("bases_model", "Base");
				$this->Base->codigo_usuario = $usuario[$i]->codigo;
				$usuario[$i]->base = $this->Base->get();
			}
			$i++;
		}
		return $usuario;
	}
	
}
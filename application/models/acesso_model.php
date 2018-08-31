<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Acesso_Model extends CI_Model
{
	var $codigo;
	var $codigo_base;
	var $codigo_grupo;
	var $codigo_usuario;
	var $data_hora;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_base)
			$where['codigo_base'] = $this->codigo_base;
		if ($this->codigo_grupo)
			$where['codigo_grupo'] = $this->codigo_grupo;
		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;

		$query = $this->db->get_where('acessos', $where);
		return $query->result();
	}

	public function searchJoin($tabela)
	{
		
		if(isset($tabela['grupo']))
			$this->codigo_grupo = $tabela['grupo'];

		$acessos = $this->search();
		$i=0;

		while($i < count($acessos))
		{
			if(isset($tabela['grupos']))
			{
				$this->load->model("grupo_model", "Grupo");
				$this->Grupo->codigo = $acessos[$i]->codigo_grupo;
					
				if (is_array($tabela['grupos']))
					$grupo = $this->Grupo->join($tabela['grupos']);
				else
					$grupo = $this->Grupo->get();

				$acessos[$i]->grupo = $grupo;
			}

			if(isset($tabela['bases']))
			{
				$this->load->model("base_model", "Base");
				$this->Base->codigo = $acessos[$i]->codigo_base;
					
				if (is_array($tabela['bases']))
					$base = $this->Base->join($tabela['bases']);
				else
					$base = $this->Base->get();

				$acessos[$i]->base =  $base;
			}

			if(isset($tabela['usuarios']))
			{
				$this->load->model("usuario_model", "Usuario");
				$this->Usuario->codigo = $acessos[$i]->codigo_usuario;
					
				if (is_array($tabela['usuarios']))
					$usuario = $this->Usuario->searchJoin($tabela['usuarios']);
				else
					$usuario = $this->Usuario->get();

				$acessos[$i]->usuario =  $usuario;
			}
			$i++;
		}

		return $acessos;
	}

	public function delete()
	{

		$where = array();
		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_base)
			$where['codigo_base'] = $this->codigo_base;
		if ($this->codigo_grupo)
			$where['codigo_grupo'] = $this->codigo_grupo;
		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;


		$this->db->delete('acessos', $where);
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_base)
			$data['codigo_base'] = $this->codigo_base;
		if ($this->codigo_grupo)
			$data['codigo_grupo'] = $this->codigo_grupo;
		if ($this->codigo_usuario)
			$data['codigo_usuario'] = $this->codigo_usuario;
		if ($this->data_hora)
			$data['data_hora'] = $this->data_hora;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('acessos', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo_base' => $this->codigo_base,
			'codigo_grupo' => $this->codigo_grupo,
			'codigo_usuario' => $this->codigo_usuario,
			'data_hora' => $this->data_hora
		);

		$this->db->insert('acessos', $data);
	}

	
	public function get()
	{
		$resultados = $this->search();
		
		if(!empty($resultados))
			return $this->search()[0];
		else
			return null;
	}

	/*
	public function getAll()
	{
		$query = $this->db->get('acessos');
		return $query->result();
	}

	public function join($tabela)
	{
		$acesso = $this->get();

		if(isset($tabela['bases']))
		{
			$this->load->model("base_model", "Base");
			$this->Base->codigo = $this->codigo_base;
			$base = $this->Base->get();
			$acesso->base = $base;
		}
		if(isset($tabela['grupos']))
		{
			$this->load->model("grupo_model", "Grupo");
			$this->Grupo->codigo = $this->codigo_grupo;
			$grupo = $this->Grupo->get();
			$acesso->grupo = $grupo;
		}
		if(isset($tabela['usuarios']))
		{
			$this->load->model("usuario_model", "Usuario");
			$this->Usuario->codigo = $this->codigo_usuario;
			$usuario = $this->Usuario->get();
			$acesso->usuario = $usuario;
		}	

		if (isset($tabela['auditorias']))
		{
			$this->load-model("auditoria_model", "Auditoria")
			$this->Auditoria->codigo_acesso = $this->codigo;
			if (is_array($tabela['auditorias']))
				$auditorias = $this->Auditoria->join($tabela['auditorias']);
			else	
				$auditorias = $this->Auditoria->search();
			$acesso->auditorias = $auditorias;
		}

		return $acesso;
	}

	*/
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Permissao_Model extends CI_Model
{
	var $codigo_funcao;
	var $codigo_grupo;

	public function search()
	{
		$where = array();

		if ($this->codigo_funcao)
			$where['codigo_funcao'] = $this->codigo_funcao;
		if ($this->codigo_grupo)
			$where['codigo_grupo'] = $this->codigo_grupo;

		$query = $this->db->get_where('permissoes', $where);
		return $query->result();
	}

	public function get()
	{
		$permissao = $this->search()[0]
		
		$this->codigo_funcao = $permissao->codigo_funcao;
		$this->codigo_grupo  = $permissao->codigo_grupo;

		return $permissao;
	}

	public function getAll()
	{
		$query = $this->db->get('permissoes');
		return $query->result();
	}

	public function join($tabela)
	{
		$permissao = $this->get();

		if(isset($tabela['funcoes']))
		{
			$this->load->model("funcao_model", "Funcao");
			$this->Funcao->codigo = $permissao->codigo_funcao;
			$funcao = $this->Funcao->get();
			$permissao->funcao = $funcao;
		}
		if(isset($tabela['grupos']))
		{
			$this->load->model("grupo_model", "Grupo");
			$this->Grupo->codigo = $permissao->codigo_grupo;
			$grupo = $this->Grupo->get();
			$permissao->grupo = $grupo;
		}

		return $permissao;
	}

	public function delete()
	{
		$where = array();

		if ($this->codigo_funcao)
			$where['codigo_funcao'] = $this->codigo_funcao;
		if ($this->codigo_grupo)
			$where['codigo_grupo'] = $this->codigo_grupo;

		$this->db->delete('permissoes', $where);
	}

	public function update()
	{
		// implementar
	}

	public function insert()
	{
		$data = array(
			'codigo_funcao' => $this->codigo_funcao,
			'codigo_grupo' => $this->codigo_grupo
		);

		$this->db->insert('permissoes', $data);
	}
}
<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

Class Funcao_Model extends CI_Model
{
	var $codigo;
	var $nome;
	var $tipo;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->tipo)
			$where['tipo'] = $this->tipo;

		$query = $this->db->get_where('funcoes', $where);
		return $query->result();
	}

	public function get()
	{
		$funcao = $this->search()[0];

		$this->codigo =  $this->codigo;
		$this->nome   =  $this->nome;
		$this->tipo   =  $this->tipo;
		
		return $funcao;
	}

	public function getAll()
	{
		$query = $this->db->get('funcoes');
		return $query->result();
	}

	public function join($tabela)
	{
		$funcao = $this->get();

		if (isset($tabela['auditorias']))
		{
			$this->load-model("auditoria_model", "Auditoria")
			$this->Auditoria->codigo_funcao = $funcao->codigo;
			if (is_array($tabela['auditorias']))
				$auditorias = $this->Auditoria->join($tabela['auditorias']);
			else	
				$auditorias = $this->Auditoria->search();
			$funcao->auditorias = $auditorias;
		}
		if (isset($tabela['permissoes']))
		{
			$this->load->model("permissao_model", "Permissao");
			$this->Permissao->codigo_funcao = $funcao->codigo;
			if (is_array($tabela['permissoes']))
				$permissoes = $this->Permissao->join($tabela['permissoes']);
			else
				$permissoes = $this->Permissao->search();
			$funcao->permissoes = $permissoes;
		}

		return $funcao;
	}

	public function delete()
	{
		$this->db->delete('funcoes', $this->codigo);
	}

	public function update()
	{
		$data = array();

		if ($this->nome)
			$data['nome'] = $this->nome;
		if ($this->tipo)
			$data['tipo'] = $this->tipo;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('funcoes', $data);
	}

	public function insert()
	{
		$data = array(
			'nome' => $this->nome,
			'tipo' => $this->tipo
		);

		$this->db->insert('funcoes', $data);
	}
}
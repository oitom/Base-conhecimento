<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Grupo_model extends CI_Model
{
	var $codigo;
	var $nome;
	var $descricao;

	public function search($inicio = 0, $limite = null)
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;

		$query = $this->db->get_where('grupos', $where, $limite, $inicio);
		return $query->result();
	}

	public function get()
	{
		$grupo = $this->search()[0];

		return $grupo;
	}

	public function getAll()
	{
		$query = $this->db->get('grupos');
		return $query->result();
	}

	public function join($tabela)
	{
		$grupo = $this->get();

		if (isset($tabela['permissoes']))
		{
			$this->load->model("permissao_model", "Permissao");
			$this->Permissao->codigo_grupo = $grupo->codigo;
			if(is_array($tabela['permissoes'])){
				$grupo->permissoes = $this->Permissao->join($tabela['permissoes']);
			} else {
				$grupo->permissoes = $this->Permissao->search();
			}
		}

		if (isset($tabela['acessos']))
		{
			$this->load->model("acesso_model", "Acesso");
			$this->Acesso->codigo_grupo = $grupo->codigo;
			if(is_array($tabela['acessos'])){
				$grupo->acessos = $this->Acesso->join($tabela['acessos']);
			} else {
				$grupo->acessos = $this->Acesso->search();
			}
		}
		return $grupo;
	}

	public function delete()
	{
		$where = array();
		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;

		$this->db->delete('grupos', $where);
	}

	public function update()
	{
		$data = array();
		if ($this->nome)
			$data['nome'] = $this->nome;
		if ($this->descricao)
			$data['descricao'] = $this->descricao;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('grupos', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'nome' => $this->nome,
			'descricao' => $this->descricao
		);

		$this->db->insert('grupos', $data);
	}

	/*
	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('nome', $parametro);
		$this->db->or_like('descricao', $parametro);
		$resultado = $this->db->get('grupos');
		
		return $resultado->result();
	}
	*/
}

?>
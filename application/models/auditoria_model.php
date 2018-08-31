<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Auditoria_model extends CI_Model
{
	var $codigo;
	var $codigo_funcao;
	var $codigo_acesso;
	var $data_hora;


	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_funcao)
			$where['codigo_funcao'] = $this->codigo_funcao;
		if ($this->codigo_acesso)
			$where['codigo_acesso'] = $this->codigo_acesso;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;

		$query = $this->db->get_where('auditorias', $where);
		return $query->result();
	}

	public function get()
	{
		$auditoria = $this->search()[0];

		$this->codigo 		 = $auditoria->codigo;
		$this->codigo_funcao = $auditoria->codigo_funcao;
		$this->codigo_acesso = $auditoria->codigo_acesso;
		$this->data_hora     = $auditoria->data_hora;

		return $auditoria;
	}

	public function getAll()
	{
		$query = $this->db->get('auditorias');
		return $query->result();
	}

	public function join($tabela)
	{
		$auditoria = $this->get();

		if (isset($tabela['acessos']))
		{
			$this->load->model("acesso_model", "Acesso");
			$this->Acesso->codigo = $auditoria->codigo_acesso;
			if(is_array($tabela['acessos'])){
				$auditoria->acesso = $this->Acesso->join($tabela['acessos']);
			} else {
				$auditoria->acesso = $this->Acesso->get();
			}
		}
		if (isset($tabela['funcoes']))
		{
			$this->load->model("funcao_model", "Funcao");
			$this->Funcao->codigo = $auditoria->codigo_funcao;
			if(is_array($tabela['funcoes'])){
				$auditoria->funcao = $this->Funcao->join($tabela['funcoes']);
			} else {
				$auditoria->funcao = $this->Funcao->get();
			}
		}
		return $auditoria;
	}

	public function delete()
	{
		$this->db->delete('auditorias', $this->codigo);
	}

	public function update()
	{
		$data = array();
		if ($this->codigo_funcao)
			$data['codigo_funcao'] = $this->codigo_funcao;
		if ($this->codigo_acesso)
			$data['codigo_acesso'] = $this->codigo_acesso;
		if ($this->data_hora)
			$data['data_hora'] = $this->data_hora;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('auditorias', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_funcao' => $this->codigo_funcao,
			'codigo_acesso' => $this->codigo_acesso,
			'data_hora' => $this->data_hora
		);

		$this->db->insert('auditorias', $data);
	}
}

?>
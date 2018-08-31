<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Campo_model extends CI_Model
{
	var $codigo;
	var $nome;
	var $obrigatorio;
	var $tipo;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->obrigatorio)
			$where['obrigatorio'] = $this->obrigatorio;
		if ($this->tipo)
			$where['tipo'] = $this->tipo;

		$query = $this->db->get_where('campos', $where);
		return $query->result();
	}

	public function get()
	{
		$campo = $this->search()[0];

		$this->codigo 	   = $campo->codigo;
		$this->nome 	   = $campo->nome;
		$this->obrigatorio = $campo->obrigatorio;
		$this->tipo 	   = $campo->tipo;

		return $campo;
	}

	public function getAll()
	{
		$query = $this->db->get('campos');
		return $query->result();
	}

	public function join($tabela)
	{
		$campo = $this->get();

		if (isset($tabela['metadados']))
		{
			$this->load->model("metadado_model", "Metadado");
			$this->Metadado->codigo_campo = $campo->codigo;
			if(is_array($tabela['metadados'])){
				$campo->metadados = $this->Metadado->join($tabela['metadados']);
			} else {
				$campo->metadados = $this->Metadado->search();
			}
		}
		return $campo;
	}

	public function delete()
	{
		$this->db->delete('campos', $this->codigo);
	}

	public function update()
	{
		$data = array();
		if ($this->nome)
			$data['nome'] = $this->nome;
		if ($this->obrigatorio)
			$data['obrigatorio'] = $this->obrigatorio;
		if ($this->tipo)
			$data['tipo'] = $this->tipo;;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('campos', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'nome' => $this->nome,
			'obrigatorio' => $this->obrigatorio,
			'tipo' => $this->tipo
		);

		$this->db->insert('campos', $data);
	}

	/*
	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('nome', $parametro);
		$this->db->or_like('tipo', $parametro);
		$resultado = $this->db->get('campos');
		
		return $resultado->result();
	}
	*/
}

?>
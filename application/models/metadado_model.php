<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Metadado_Model extends CI_Model
{
	var $codigo_usuario;
	var $codigo_campo;
	var $valor;

	public function search()
	{
		$where = array();

		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;
		if ($this->codigo_campo)
			$where['codigo_campo'] = $this->codigo_campo;
		if ($this->valor)
			$where['valor'] = $this->valor;

		$query = $this->db->get_where('metadados', $where);
		return $query->result();
	}

	public function get()
	{
		$metadado = $this->search()[0];

		$this->codigo_usuario   = $metadado->codigo_usuario;
		$this->codigo_campo   = $metadado->codigo_campo;
		$this->valor   = $metadado->valor;

		return metadado;
	}

	public function getAll()
	{
		$query = $this->db->get('metadados');
		return $query->result();
	}

	public function join($tabela)
	{
		$metadado = $this->get();

		if(isset($tabela['usuarios']))
		{
			$this->load->model("usuario_model", "Usuario");
			$this->Usuario->codigo = $metadado->codigo_usuario;
			$usuario = $this->Usuario->get();
			$metadado->usuario = $usuario;
		}
		if(isset($tabela['campos']))
		{
			$this->load->model("campo_model", "Campo");
			$this->Campo->codigo = $metadado->codigo_campo;
			$campo = $this->Campo->get();
			$metadado->campo = $campo;
		}

		return $metadado;
	}

	public function delete()
	{
		$where = array();

		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;
		if ($this->codigo_campo)
			$where['codigo_campo'] = $this->codigo_campo;

		$this->db->delete('metadados', $where);
	}

	public function update()
	{
		// implementar
	}

	public function insert()
	{
		$data = array(
			'codigo_usuario' => $this->codigo_usuario,
			'codigo_campo' => $this->codigo_campo,
			'valor' => $this->valor
		);

		$this->db->insert('metadados', $data);
	}
}
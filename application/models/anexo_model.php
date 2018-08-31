<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Anexo_model extends CI_Model
{
	var $codigo;
	var $codigo_resposta;
	var $caminho;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_resposta)
			$where['codigo_resposta'] = $this->codigo_resposta;
		if ($this->caminho)
			$where['caminho'] = $this->caminho;

		$query = $this->db->get_where('anexos', $where);
		return $query->result();
	}

	public function get()
	{
		$anexo = $this->search()[0];

		$this->codigo  			= $anexo->codigo;
		$this->codigo_resposta  = $anexo->codigo_resposta;
		$this->caminho  		= $anexo->caminho;

		return $anexo;
	}

	public function getAll()
	{
		$query = $this->db->get('anexos');
		return $query->result();
	}

	public function join($tabela)
	{
		$anexo = $this->get();

		if (isset($tabela['respostas']))
		{
			$this->load->model("resposta_model", "Resposta");
			$this->Resposta->codigo = $this->codigo_resposta;
			$anexo->resposta = $this->Resposta->get();
		}
		return $anexo;
	}

	public function delete()
	{
		$this->db->delete('anexos', $this->codigo);

		$this->load->model("resposta_model", "Resposta");
		$this->Resposta->codigo = $this->codigo_resposta;
		$this->Resposta->delete();
	}

	public function update()
	{
		$data = array();
		if ($this->codigo_resposta)
			$data['codigo_resposta'] = $this->codigo_resposta;
		if ($this->caminho)
			$data['caminho'] = $this->caminho;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('anexos', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_resposta' => $this->codigo_resposta,
			'caminho' => $this->caminho
		);

		$this->db->insert('anexos', $data);
	}

	/*
	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('caminho', $parametro);
		$resultado = $this->db->get('anexos');
		
		return $resultado->result();
	}
	*/
}

?>
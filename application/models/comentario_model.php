<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Comentario_Model extends CI_Model
{
	var $codigo;
	var $codigo_conteudo;
	var $texto;
	var $data_hora;
	var $aprovado;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->texto)
			$where['texto'] = $this->texto;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;
		if ($this->aprovado)
			$where['aprovado'] = $this->aprovado;

		$query = $this->db->get_where('comentarios', $where);
		return $query->result();
	}

	public function get()
	{
		$comentario = $this->search()[0];

		$this->codigo 		   = $comentario->codigo;
		$this->codigo_conteudo = $comentario->codigo_conteudo;
		$this->texto 		   = $comentario->texto;
		$this->data_hora 	   = $comentario->data_hora;
		$this->aprovado 	   = $comentario->aprovado;

		return $comentario;
	}

	public function getAll()
	{
		$query = $this->db->get('comentarios');
		return $query->result();
	}

	public function join($tabela)
	{
		$comentario = $this->get();

		if(isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $comentario->codigo_conteudo;
			$conteudo = $this->Conteudo->get();
			$comentario->conteudo = $conteudo;
		}

		return $comentario;
	}

	public function delete()
	{
		$this->db->delete('comentarios', $this->codigo);
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_conteudo)
			$data['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->texto)
			$data['texto'] = $this->texto;
		if ($this->data_hora)
			$data['data_hora'] = $this->data_hora;
		if ($data->aprovado)
			$where['aprovado'] = $this->aprovado;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('comentarios', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_conteudo' => $this->codigo_conteudo,
			'texto' => $this->texto,
			'data_hora' => $this->data_hora,
			'aprovado' => $this->aprovado
		);

		$this->db->insert('comantarios', $data);
	}
}
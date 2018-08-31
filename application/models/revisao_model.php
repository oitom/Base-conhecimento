<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Revisao_model extends CI_Model
{
	var $codigo;
	var $codigo_conteudo;
	var $codigo_usuario;
	var $data_hora;
	var $texto;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;
		if ($this->data_hora)
			$where['data_hora'] = $this->data_hora;
		if ($this->texto)
			$where['texto'] = $this->texto;

		$query = $this->db->get_where('revisoes', $where);
		return $query->result();
	}

	public function get()
	{
		$revisao = $this->search()[0];

		$this->$codigo = $revisao->$codigo;
		$this->$codigo_conteudo = $revisao->$codigo_conteudo;
		$this->$codigo_usuario = $revisao->$codigo_usuario;
		$this->$data_hora = $revisao->$data_hora;
		$this->$texto = $revisao->$texto;

		return $revisao;
	}

	public function getAll()
	{
		$query = $this->db->get('revisoes');
		return $query->result();
	}

	public function join($tabela)
	{
		$revisao = $this->get();

		if (isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $revisao->codigo_conteudo;
			
			if(is_array($tabela['conteudos'])){
				$revisao->conteudo = $this->Conteudo->join($tabela['conteudos']);
			} else {
				$revisao->conteudo = $this->Conteudo->get();
			}
		}
		if (isset($tabela['usuarios']))
		{
			$this->load->model("usuario_model", "Usuario");
			$this->Usuario->codigo = $revisao->codigo_usuario;
			
			if(is_array($tabela['usuarios'])){
				$revisao->usuario = $this->Usuario->join($tabela['usuarios']);
			} else {
				$revisao->usuario = $this->Usuario->get();
			}
		}
		return $revisao;
	}

	public function delete()
	{
		$this->db->delete('revisoes', $this->codigo);
	}

	public function update()
	{
		$data = array();
		if ($this->codigo_conteudo)
			$data['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->codigo_usuario)
			$data['codigo_usuario'] = $this->codigo_usuario;
		if ($this->data_hora)
			$data['data_hora'] = $this->data_hora;
		if ($this->texto)
			$data['texto'] = $this->texto;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('revisoes', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_conteudo' => $this->codigo_conteudo,
			'codigo_usuario' => $this->codigo_usuario,
			'data_hora' => $this->data_hora,
			'texto' => $this->texto
		);

		$this->db->insert('revisoes', $data);
	}

	/*
	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('texto', $parametro);
		$resultado = $this->db->get('revisoes');
		
		return $resultado->result();
	}
	*/
}

?>
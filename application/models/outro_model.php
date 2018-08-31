<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Outro_model extends CI_Model
{
	var $codigo;
	var $codigo_arquivo;
	var $descricao;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_arquivo)
			$where['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->descricao)
			$where['descricao'] = $this->descricao;

		$query = $this->db->get('outros', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$outro = $this->search()[0];

			$this->codigo 		  = $outro->codigo;
			$this->codigo_arquivo = $outro->codigo_arquivo;
			$this->descricao 	  = $outro->descricao;
		}
		else
		{
			$outro = null;
		}

		return $outro;
	}

	public function getAll()
	{
		$query = $this->db->get('outros');
		return $query->result();
	}

	public function join($tabela)
	{
		$outro = $this->get();

		if (isset($tabela['arquivos']))
		{
			$this->load->model('arquivo_model', 'Arquivo');
			$this->Arquivo->codigo = $imagem->codigo_arquivo;
			
			if (is_array($tabela['arquivos']))
				$arquivo = $this->Arquivo->join($tabela['arquivos']);
			else
				$arquivo = $this->Arquivo->search();

			$outro->arquivo = $arquivo;
		}

		return $outro;
	}

	public function delete()
	{
		$this->db->delete('outros', $this->codigo);

		$this->load->model('arquivo_model', 'Arquivo');
		$this->Arquivo->codigo = $this->codigo_arquivo;
		$this->Arquivo->delete();
	}

	public function insert()
	{
		$data = array(
			'codigo_arquivo' => $this->codigo_arquivo,
			'descricao' => $this->descricao
		);

		$this->db->insert('outros', $data);
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_arquivo)
			$data['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->descricao)
			$data['descricao'] = $this->descricao;

		$this->db->update('outros', $data);
	}

}

?>
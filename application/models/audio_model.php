<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Audio_Model extends CI_Model
{
	var $codigo;
	var $codigo_arquivo;
	var $duracao;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_arquivo)
			$where['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->duracao)
			$where['duracao'] = $this->duracao;

		$query = $this->db->get_where('audios', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$audio = $resultado[0]; 

			$this->codigo 		  = $audio->codigo;
			$this->codigo_arquivo = $audio->codigo_arquivo;
			$this->duracao 		  = $audio->duracao;
		}
		else
		{
			$audio = null;
		}

		return $audio;
	}

	public function getAll()
	{
		$query = $this->db->get('audios');
		return $query->result();
	}

	public function join($tabela)
	{
		$audio = $this->get();

		if (isset($tabela['arquivos']))
		{
			$this->load->model('arquivo_model', 'Arquivo');
			$this->Arquivo->codigo = $audio->codigo_arquivo;
			
			if (is_array($tabela['arquivos']))
				$arquivo = $this->Arquivo->join($tabela['arquivos']);
			else
				$arquivo = $this->Arquivo->search();

			$audio->arquivo = $arquivo;
		}

		return $audio;
	}

	public function insert()
	{
		$data = array(
			'codigo_arquivo' => $this->codigo_arquivo,
			'duracao' 		 => $this->duracao
		);

		$this->db->insert('audios', $data);
	}

	public function update()
	{
		$data = array();
		
		if ($this->codigo_arquivo)
			$data['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->duracao)
			$data['duracao'] = $this->duracao;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('audios', $data);
	}

	public function delete()
	{
		$where = array();
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_arquivo)
			$where['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->duracao)
			$where['duracao'] = $this->duracao;

		$this->db->delete('audios', $where);

		//$this->load->model('arquivo_model', 'Arquivo');
		//$this->Arquivo->codigo = $this->codigo_arquivo;
		//$this->Arquivo->delete();
	}
}
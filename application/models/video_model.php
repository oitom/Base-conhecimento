<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Video_Model extends CI_Model
{
	var $codigo;
	var $codigo_arquivo;
	var $duracao;
	var $altura;
	var $largura;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_arquivo)
			$where['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->duracao)
			$where['duracao'] = $this->duracao;
		if ($this->altura)
			$where['altura'] = $this->altura;
		if ($this->largura)
			$where['largura'] = $this->largura;
		$query = $this->db->get_where('videos', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$video = $this->search()[0];

			$this->codigo = $video->codigo;
			$this->codigo_arquivo = $video->codigo_arquivo;
			$this->duracao = $video->duracao;
			$this->altura = $video->altura;
			$this->largura = $video->largura;
		}
		else
		{
			$video = null;
		}

		return $video;
	}

	public function getAll()
	{
		$query = $this->db->get('videos');
		return $query->result();
	}

	public function join($tabela)
	{
		$video = $this->get();

		if(isset($tabela['arquivos']))
		{
			$this->load->model("arquivo_model", "Arquivo");
			$this->Arquivo->codigo = $video->codigo_arquivo;
			
			if (is_array($tabela['arquivos']))
				$arquivo = $this->Arquivo->join($tabela['arquivos']);
			else
				$arquivo = $this->Arquivo->search();

			$video->arquivo = $arquivo;
		}

		return $video;
	}

	public function delete()
	{
		$this->db->delete('videos', $this->codigo);

		$this->load->model('arquivo_model', 'Arquivo');
		$this->Arquivo->codigo = $this->codigo_arquivo;
		$this->Arquivo->delete();
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_arquivo)
			$data['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->duracao)
			$data['duracao'] = $this->duracao;
		if ($this->altura)
			$data['altura'] = $this->altura;
		if ($this->largura)
			$data['largura'] = $this->largura;

		$this->db->update('videos', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo_arquivo' => $this->codigo_arquivo,
			'duracao' => $this->duracao,
			'altura' => $this->altura,
			'largura' => $this->largura
		);

		$this->db->insert('videos', $data);
	}
}

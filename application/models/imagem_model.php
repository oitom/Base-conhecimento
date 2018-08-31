<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Imagem_model extends CI_Model
{
	var $codigo;
	var $codigo_arquivo;
	var $altura;
	var $largura;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_arquivo)
			$where['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->altura)
			$where['altura'] = $this->altura;
		if ($this->largura)
			$where['largura'] = $this->largura;

		$query = $this->db->get('imagens', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$imagem = $this->search()[0];

			$this->codigo = $imagem->codigo;
			$this->codigo_arquivo = $imagem->codigo_arquivo;
			$this->altura = $imagem->altura;
			$this->largura = $imagem->largura;
		}
		else
		{
			$imagem = null;
		}

		return $imagem;
	}

	public function getAll()
	{
		$query = $this->db->get('arquivos');
		return $query->result();
	}

	public function join($tabela)
	{
		$imagem = $this->get();

		if (isset($tabela['arquivos']))
		{
			$this->load->model('arquivo_model', 'Arquivo');
			$this->Arquivo->codigo = $imagem->codigo_arquivo;
			
			if (is_array($tabela['arquivos']))
				$arquivo = $this->Arquivo->join($tabela['arquivos']);
			else
				$arquivo = $this->Arquivo->search();

			$imagem->arquivo = $arquivo;
		}

		return $imagem;
	}

	public function delete()
	{
		$this->db->delete('imagens', $this->codigo);

		$this->load->model('arquivo_model', 'Arquivo');
		$this->Arquivo->codigo = $this->codigo_arquivo;
		$this->Arquivo->delete();
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_arquivo' => $this->codigo_arquivo,
			'altura' => $this->altura,
			'largura' => $this->largura
		);

		$this->db->insert('imagens', $data);
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_arquivo)
			$data['codigo_arquivo'] = $this->codigo_arquivo;
		if ($this->altura)
			$data['altura'] = $this->altura;
		if ($this->largura)
			$data['largura'] = $this->largura;

		$this->db->update('imagens', $data);
	}

}

?>
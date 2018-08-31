<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Artigo_model extends CI_Model
{
	var $codigo;
	var $codigo_conteudo;
	var $texto;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->texto)
			$where['texto'] = $this->texto;
		
		$query = $this->db->get_where('artigos', $where);
		return $query->result();
	}

	public function get()
	{
		$resultados = $this->search();
		
		if(!empty($resultados))
			return $this->search()[0];
		else
			return null;
	}

	public function getAll()
	{
		$query = $this->db->get('artigos');
		return $query->result();
	}

	public function join($tabela)
	{
		$artigo = $this->get();

		if (isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $artigo->codigo_conteudo;

			if (is_array($tabela['conteudos']))
				$conteudo = $this->Conteudo->join($tabela['conteudos']);
			else
				$conteudo = $this->Conteudo->get();

			$artigo->conteudo = $conteudo;
		}

		return $artigo;
	}

	public function insert()
	{
		$data = array(
			'codigo_conteudo' => $this->codigo_conteudo,
			'texto' => $this->texto
		);	

		echo "<pre>";
		print_r($data);
		echo "<pre>";

		$this->db->insert('artigos', $data);
	}

	public function update()
	{
		$update = array();

		if ($this->codigo_conteudo)
			$update['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->texto)
			$update['texto'] = $this->texto;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('artigos', $update);
	}

	public function delete()
	{
		$where = array();
		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->texto)
			$where['texto'] = $this->texto;

		$this->db->delete('artigos', $where);

		//$this->load->model('conteudo_model', 'Conteudo');
		//$this->Conteudo->codigo = $this->codigo_conteudo;
		//$this->Conteudo->delete();
	}



	
}

?>
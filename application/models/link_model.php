<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Link_Model extends CI_Model
{
	var $codigo;
	var $codigo_conteudo;
	var $url;
	
	public function search()
	{
		$where = array();
		
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->url)
			$where['url'] = $this->url;

		$query = $this->db->get_where('links', $where);
		
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
		$query = $this->db->get('links');
		return $query->result();	
	}

	public function join($tabela)
	{
		$link = $this->get();

		if(isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $link->codigo_conteudo;
			$conteudo = $this->Conteudo->get();
			$link->conteudo = $conteudo;
		}
		
		return $link;
	}

	public function delete()
	{
		$this->db->delete('links', $this->codigo);
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_conteudo)
			$data['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->url)
			$data['url'] = $this->url;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('links', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_conteudo' => $this->codigo_conteudo,
			'url' => $this->url
		);
		$this->db->insert('links', $data);
	}
}

?>
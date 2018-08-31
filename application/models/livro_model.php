<?php if (!defined('BASEPATH')) exit('No direct script access alld');

class Livro_model extends CI_Model
{
	var $codigo;
	var $codigo_conteudo;
	var $subtitulo;
	var $autor;
	var $paginas;
	var $edicao;
	var $editora;
	var $ano;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->subtitulo)
			$where['subtitulo'] = $this->subtitulo;
		if ($this->autor)
			$where['autor'] = $this->autor;
		if ($this->paginas)
			$where['paginas'] = $this->paginas;
		if ($this->edicao)
			$where['edicao'] = $this->edicao;
		if ($this->editora)
			$where['editora'] = $this->editora;
		if ($this->ano)
			$where['ano'] = $this->ano;

		$query = $this->db->get_where('livros', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$livro = $this->search()[0];

			$this->codigo = $livro->codigo;
			$this->codigo_conteudo = $livro->codigo_conteudo;
			$this->subtitulo = $livro->subtitulo;
			$this->autor = $livro->autor;
			$this->paginas = $livro->paginas;
			$this->edicao = $livro->edicao;
			$this->editora = $livro->editora;
			$this->ano = $livro->ano;
		}
		else
		{
			$livro = null;
		}

		return $livro;
	}

	public function getAll()
	{
		$query = $this->db->get('livros');
		return $query->result();
	}

	public function join($tabela)
	{
		$livro = $this->get();

		if (isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $livro->codigo_conteudo;
			if(is_array($tabela['conteudos'])){
				$livro->conteudo = $this->Conteudo->join($tabela['conteudos']);
			} else {
				$livro->conteudo = $this->Conteudo->get();
			}
		}
		return $livro;
	}

	public function delete()
	{
		$this->db->delete('livros', $this->codigo);

		$this->load->model("conteudo_model", "Conteudo");
		$this->Conteudo->codigo = $this->codigo_conteudo;
		$this->Conteudo->delete();
	}

	public function update()
	{
		$data = array();
		if ($this->codigo_conteudo)
			$data['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->subtitulo)
			$data['subtitulo'] = $this->subtitulo;
		if ($this->autor)
			$data['autor'] = $this->autor;
		if ($this->paginas)
			$data['paginas'] = $this->paginas;
		if ($this->edicao)
			$data['edicao'] = $this->edicao;
		if ($this->editora)
			$data['editora'] = $this->editora;
		if ($this->ano)
			$data['ano'] = $this->ano;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('livros', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_conteudo' => $this->codigo_conteudo,
			'subtitulo' => $this->subtitulo,
			'autor' => $this->autor,
			'paginas' => $this->paginas,
			'edicao' => $this->edicao,
			'editora' => $this->editora,
			'ano' => $this->ano
		);

		$this->db->insert('livros', $data);
	}

	/*
	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('autor', $parametro);
		$this->db->or_like('subtitulo', $parametro);
		$this->db->or_like('editora', $parametro);
		$resultado = $this->db->get('livros');
		
		return $resultado->result();
	}
	*/
}

?>
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Pergunta_Model extends CI_Model
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

		$query = $this->db->get_where('perguntas', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$pergunta =  $this->search()[0];
			$this->codigo = $pergunta->codigo;
			$this->codigo_conteudo = $pergunta->codigo_conteudo;
			$this->texto = $pergunta->texto;
		}
		else
		{
			$pergunta = null;
		}

		return $pergunta;
	}

	public function getAll()
	{
		$query = $this->db->get('perguntas');
		return $query->result();
	}

	public function join($tabela)
	{
		$pergunta = $this->get();

		if (isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $pergunta->codigo_conteudo;

			if (is_array($tabela['conteudos']))
				$conteudo = $this->Conteudo->join($tabela['conteudos']);
			else
				$conteudo = $this->Conteudo->get();

			$pergunta->conteudo = $conteudo;
		}
		if (isset($tabela['respostas']))
		{
			$this->load->model("resposta_model", "Resposta");
			$this->Resposta->codigo_pergunta = $pergunta->codigo;

			if (is_array($tabela['respostas']))
				$respostas = $this->Resposta->join($tabela['respostas']);
			else
				$respostas = $this->Resposta->search();

			$pergunta->respostas = $respostas;
		}

		return $pergunta;
	}

	public function delete()
	{
		$this->db->delete('perguntas', $this->codigo);

		$this->load->model("resposta_model", "Resposta");
		$this->Reposta->codigo_pergunta = $this->codigo;
		$this->Resposta->delete();
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_conteudo)
			$data['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->texto)
			$data['texto'] = $this->texto;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('perguntas', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'codigo_conteudo' => $this->codigo_conteudo,
			'texto' => $this->texto
		);

		$this->db->insert('perguntas', $data);
	}
}

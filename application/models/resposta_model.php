<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Resposta_Model extends CI_Model
{
	var $codigo;
	var $codigo_pergunta;
	var $texto;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_pergunta)
			$where['codigo_pergunta'] = $this->codigo_pergunta;
		if ($this->texto)
			$where['texto'] = $this->texto;

		$query = $this->db->get_where('respostas', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();

		if (count($resultado) > 0)
		{
			$resposta = $this->search()[0];

			$this->$codigo = $resposta->$codigo;
			$this->$codigo_pergunta = $resposta->$codigo_pergunta;
			$this->$texto = $resposta->$texto;
		}
		else
		{
			$resposta = null;
		}

		return $resposta;
	}

	public function getAll()
	{
		$query = $this->db->get('respostas');
		return $query->result();
	}

	public function join($tabela)
	{
		$resposta = $this->get();

		if (isset($tabela['perguntas']))
		{
			$this->load->model('pergunta_model', 'Pergunta');
			$this->Pegunta->codigo = $resposta->codigo_pergunta;
			
			if (is_array($tabela['perguntas']))
				$pergunta = $this->Pergunta->join($tabela['perguntas']);
			else
				$pergunta = $this->Pergunta->search();

			$resposta->pergunta = $pergunta;
		}
		if (isset($tabela['anexos']))
		{
			$this->load-model("anexo_model", "Anexo");
			$this->Anexo->codigo_resposta = $resposta->codigo;
			if (is_array($tabela['anexos']))
				$anexos = $this->Anexo->join($tabela['anexos']);
			else	
				$anexos = $this->Anexo->search();
			$resposta->anexos = $anexos;
		}

		return $resposta;
	}

	public function delete()
	{
		$this->db->delete('respostas', $this->codigo);

		$this->load->model("anexo_model", "Anexo");
		$this->Anexo->codigo_resposta = $this->codigo;
		$this->Anexo->delete();
	}

	public function update()
	{
		$data = array();

		if ($this->codigo_conteudo)
			$data['codigo_pergunta'] = $this->codigo_conteudo;
		if ($this->texto)
			$data['texto'] = $this->texto;

		$this->db->where('codigo', $this->codigo);
		$this->db->update('respostas', $data);
	}

	public function insert()
	{
		$data = array(
			'codigo_pergunta' => $this->codigo_pergunta,
			'texto' => $this->texto
		);

		$this->db->insert('respostas', $data);
	}
}
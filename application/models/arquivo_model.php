<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Arquivo_Model extends CI_Model
{
	var $codigo;
	var $codigo_conteudo;
	var $nome;
	var $extensao;
	var $caminho;
	var $tamanho;

	public function search()
	{
		$where = array();
		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->extensao)
			$where['extensao'] = $this->extensao;
		if ($this->caminho)
			$where['caminho'] = $this->caminho;
		if ($this->tamanho)
			$where['tamanho'] = $this->tamanho;

		$query = $this->db->get_where('arquivos', $where);
		return $query->result();
	}

	public function get()
	{
		$resultado = $this->search();


		if (count($resultado) > 0)
		{
			$arquivo = $this->search()[0];
		}
		else
		{
			$arquivo = null;
		}

		return $arquivo;
	}

	public function getAll()
	{
		$query = $this->db->get('arquivos');
		return $query->result();	
	}

	public function join($tabela)
	{
		$arquivo = $this->get();

		if(isset($tabela['conteudos']))
		{
			$this->load->model("conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $arquivo->codigo_conteudo;
			
			if (is_array($tabela['conteudos']))
				$conteudo = $this->Conteudo->join($tabela['conteudos']);
			else
				$conteudo = $this->Conteudo->search();

			$arquivo->conteudo = $conteudo;
		}
		if (isset($tabela['videos']))
		{
			$this->load->model("video_model", "Video");
			$this->Video->codigo_arquivo = $arquivo->codigo;
			
			if (is_array($tabela['videos']))
				$video = $this->Video->join($tabela['videos']);
			else
				$video = $this->Video->get();

			$arquivo->video = $video;
		}
		if (isset($tabela['imagens']))
		{
			$this->load->model("imagem_model", "Imagem");
			$this->Imagem->codigo_arquivo = $arquivo->codigo;

			if (is_array($tabela['imagens']))
				$imagem = $this->Imagem->join($tabela['imagens']);
			else
				$imagem = $this->Imagem->get();

			$arquivo->imagem = $imagem;
		}
		if (isset($tabela['audios']))
		{
			$this->load->model("audio_model", "Audio");
			$this->Audio->codigo_arquivo = $arquivo->codigo;

			if (is_array($tabela['audios']))
				$audio = $this->Audio->join($tabela['audios']);
			else
				$audio = $this->Audio->get();

			$arquivo->audio = $audio;
		}
		if (isset($tabela['outros']))
		{
			$this->load->model("outro_model", "Outro");
			$this->Outro->codigo_arquivo = $arquivo->codigo;

			if (is_array($tabela['outros']))
				$audio = $this->Outro->join($tabela['outros']);
			else
				$audio = $this->Outro->get();

			$arquivo->outro = $audio;
		}

		return $arquivo;
	}

	public function insert($model_arquivo_tipo)
	{

		$data = array(
			'codigo_conteudo' => $this->codigo_conteudo,
			'nome' => $this->nome,
			'extensao' => $this->extensao,
			'caminho' => $this->caminho,
			'tamanho' => $this->tamanho
		);
		$this->db->trans_start();
		$this->db->insert('arquivos', $data);
		
		$novo_arquivo = $this->get();
		
		$model_arquivo_tipo->codigo_arquivo = $novo_arquivo->codigo;
		$model_arquivo_tipo->insert();

		$this->db->trans_complete();
	}

	public function update($model_arquivo_tipo)
	{
		$update = array();

		if ($this->codigo_conteudo)
			$update['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->nome)
			$update['nome'] = $this->nome;
		if ($this->extensao)
			$update['extensao'] = $this->extensao;
		if ($this->caminho)
			$update['caminho'] = $this->caminho;
		if ($this->tamanho)
			$update['tamanho'] = $this->tamanho;

		$this->db->trans_start();
	
			$this->db->where('codigo', $this->codigo);
			$this->db->update('arquivos', $update);
			$arquivo_editado = $this->get();
			
			$model_arquivo_tipo->codigo_arquivo = $arquivo_editado->codigo;
			$model_arquivo_tipo->insert();

		$this->db->trans_complete();
	}

	public function delete()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_conteudo)
			$where['codigo_conteudo'] = $this->codigo_conteudo;
		if ($this->nome)
			$where['nome'] = $this->nome;
		if ($this->extensao)
			$where['extensao'] = $this->extensao;
		if ($this->caminho)
			$where['caminho'] = $this->caminho;
		if ($this->tamanho)
			$where['tamanho'] = $this->tamanho;
		
		$this->db->delete('arquivos', $where);

		//$this->load->model('coteudo_model', 'Conteudo');
		//$this->Conteudo->codigo = $this->codigo_conteudo;
		//$this->Conteudo->delete();
	}
}

?>
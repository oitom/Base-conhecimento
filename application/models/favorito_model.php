<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Favorito_Model extends CI_Model{
	
	var $codigo; 
	var $codigo_usuario;
	var $codigo_base;
	var $codigo_conteudo;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->codigo_usuario)
			$where['codigo_usuario'] = $this->codigo_usuario;

		$query_conteudo = $this->db->get_where('conteudo_favoritos', $where)->result();
		$query_base = $this->db->get_where('base_favoritos', $where)->result();

		$this->load->model("Base_model", "BaseFavoritos");
		$this->load->model("Conteudo_model", "ConteudoFavorito");
		$bases = array();
		$conteudos = array();


		foreach ($query_conteudo as $conteudo) {
			$this->ConteudoFavorito->codigo = $conteudo->codigo_conteudo;
			array_push($conteudos, $this->ConteudoFavorito->get());
		}

		foreach ($query_base as $base) {
			$this->BaseFavoritos->codigo = $base->codigo_base;
			array_push($bases, $this->BaseFavoritos->get());
		}
		$favoritos = array('bases' => $bases, 'conteudos' => $conteudos);
		return $favoritos;
	}

	public function delete()
	{
		if ($this->codigo_base)
			$this->db->delete('base_favoritos', array('codigo_base' => $this->codigo_base, 'codigo_usuario' => $this->codigo_usuario)); 
		if ($this->codigo_conteudo)
			$this->db->delete('conteudo_favoritos', array('codigo_conteudo' => $this->codigo_conteudo, 'codigo_usuario' => $this->codigo_usuario)); 
	}

	public function insert()
	{
		$data = array('codigo_usuario'  => $this->codigo_usuario );

		if ($this->codigo_base) {
			$data['codigo_base'] = $this->codigo_base;
			$this->db->insert('base_favoritos', $data);
		}
		
		if ($this->codigo_conteudo) {
			$data['codigo_conteudo'] = $this->codigo_conteudo;
			$this->db->insert('conteudo_favoritos', $data);
		}
	}	
}
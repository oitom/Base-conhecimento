<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Palavrachave_Model extends CI_Model{
	
	var $codigo; 
	var $titulo;
	var $codigo_plataforma;
	var $codigo_base;
	var $codigo_conteudo;

	public function search()
	{
		$where = array();

		if ($this->codigo)
			$where['codigo'] = $this->codigo;
		if ($this->titulo)
			$where['titulo'] = $this->titulo;
		if ($this->codigo_plataforma)
			$where['codigo_plataforma'] = $this->codigo_plataforma;

		
		$query = $this->db->get_where('palavraschave', $where);

		return $query->result();
	}

	public function get()
	{
		$palavrachave = $this->search()[0];
		return $palavrachave;
	}

	public function join($tabelas = array())
	{		
		
		if (isset($tabelas["plataforma"])) 
		{
			$this->load->model("plataforma_model", "Plataforma");
			$this->Plataforma->codigo = $this->codigo_plataforma;
			$palavraschave =  $this->Plataforma->get();
			$palavraschave->palavrachave = $this->search();
		}

		if (isset($tabelas["bases"])) 
		{
			$this->load->model("Base_model", "Base");
			$this->Base->codigo = $this->codigo_base;
			$palavraschave =  $this->Base->get();

			$this->db->select('codigo_palavraschave');
			$this->db->from('base_palavraschave');
			$this->db->join('palavraschave', 'palavraschave.codigo = base_palavraschave.codigo_palavraschave');
			$this->db->where(array('codigo_base' => $this->codigo_base));
			$base_palavraschave = $this->db->get()->result();


			for($i=0; $i < count($base_palavraschave); $i++)
			{
				$this->codigo = $base_palavraschave[$i]->codigo_palavraschave;
				$palavraschave->palavrachave[$i] = $this->get();		
			}
			
		}

		if (isset($tabelas["conteudos"])) 
		{			
			$this->load->model("Conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $this->codigo_conteudo; 
			$palavraschave = $this->Conteudo->get();		

			$this->db->select('codigo_palavraschave');
			$this->db->from('conteudo_palavraschave');
			$this->db->join('palavraschave', 'palavraschave.codigo = conteudo_palavraschave.codigo_palavraschave');
			$this->db->where(array('codigo_conteudo' => $this->codigo_conteudo));

			$conteudo_palavraschave = $this->db->get()->result();

			for($i=0; $i < count($conteudo_palavraschave); $i++)
			{
				$this->codigo = $conteudo_palavraschave[$i]->codigo_palavraschave;
				$palavraschave->palavrachave[$i] = $this->get();		
			}

		}

		return $palavraschave;
	}


	public function delete()
	{
		$this->db->delete('palavraschave', array('codigo' => $this->codigo)); 
	}

	public function update()
	{
		$update = array();

		if ($this->titulo)
			$update['titulo'] = $this->titulo;
	
		$this->db->where('codigo', $this->codigo);
		$this->db->update('palavraschave', $update); 
	}

	public function insert()
	{
		$data = array(
			'codigo' => $this->codigo,
			'titulo'  => $this->titulo,  
			'codigo_plataforma'  => $this->codigo_plataforma
		);

		$this->db->insert('palavraschave', $data);
	}

	public function insert_conteudo_pavalvrachave($codigo_conteudo, $palavras_conteudo)
	{
		$data = array();
		$data['codigo_conteudo'] = $codigo_conteudo;
			
		for ($i=0; $i < count($palavras_conteudo); $i++) 
		{
			$data['codigo_palavraschave'] = $palavras_conteudo[$i];				 
			$this->db->insert('conteudo_palavraschave', $data);		
		}
	}

	public function like($parametro_especifico)
	{
		$parametro = $parametro_especifico;
		$this->db->like('titulo', $parametro);
		$resultado = $this->db->get('palavraschave');
		
		return $resultado->result();
	}

	public function like_join($tabelas, $value)
	{
		$resultadoFiltro = $this->like($value);

		if (isset($tabelas["plataformas"])) 
		{
			$this->load->model("plataforma_model", "Plataforma");
			$this->Plataforma->codigo = $this->codigo_plataforma;
			$palavraschave =  $this->Plataforma->get();
			
			$this->db->where(array('codigo_plataforma' => $this->codigo_plataforma));
			$plataforma_palavraschave = $this->db->get('palavraschave')->result();

			$posicao=0;
			for ($i=0; $i < count($resultadoFiltro); $i++) 
			{ 
				for ($j=0; $j < count($plataforma_palavraschave); $j++) 
				{	 
					if($resultadoFiltro[$i]->codigo == $plataforma_palavraschave[$j]->codigo)
					{
						$palavraschave->palavrachave[$posicao] = $resultadoFiltro[$i];
						$posicao++;
					}
				}	
			}
		}

		if (isset($tabelas["bases"])) 
		{
			$this->load->model("Base_model", "Base");
			$this->Base->codigo = $this->codigo_base;
			$palavraschave =  $this->Base->get();
			
			$this->db->select('codigo, titulo, codigo_plataforma');
			$this->db->from('base_palavraschave');
			$this->db->join('palavraschave', 'palavraschave.codigo = base_palavraschave.codigo_palavraschave');
			$this->db->where(array('codigo_base' => $this->codigo_base));
			$base_palavraschave = $this->db->get()->result();	
			
			$posicao=0;
			for ($i=0; $i < count($resultadoFiltro); $i++) 
			{ 
				for ($j=0; $j < count($base_palavraschave); $j++) 
				{	 
					if($resultadoFiltro[$i]->codigo == $base_palavraschave[$j]->codigo)
					{
						$palavraschave->palavrachave[$posicao] = $resultadoFiltro[$i];
						$posicao++;
					}
				}	
			}
		}
		if (isset($tabelas["conteudos"])) 
		{
			$this->load->model("Conteudo_model", "Conteudo");
			$this->Conteudo->codigo = $this->codigo_conteudo;
			$palavraschave =  $this->Conteudo->get();
			
			$this->db->select('codigo');
			$this->db->from('conteudo_palavraschave');
			$this->db->join('palavraschave', 'palavraschave.codigo = conteudo_palavraschave.codigo_palavraschave');
			$this->db->where(array('codigo_conteudo' => $this->codigo_conteudo));
			$conteudo_palavraschave = $this->db->get()->result();	
			
			$posicao=0;
			for ($i=0; $i < count($resultadoFiltro); $i++) 
			{ 
				for ($j=0; $j < count($conteudo_palavraschave); $j++) 
				{	 
					if($resultadoFiltro[$i]->codigo == $conteudo_palavraschave[$j]->codigo)
					{
						$palavraschave->palavrachave[$posicao] = $resultadoFiltro[$i];
						$posicao++;
					}
				}	
			}

		}
		return $palavraschave;
	}
	
}
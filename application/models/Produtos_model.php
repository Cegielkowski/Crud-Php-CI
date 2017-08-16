<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produtos_model extends CI_Model
{	
    //Lista todos os produtos da tabela produtos	
    public function getProdutos()
    {                                 
        $query = $this->db->get("cadastro");
        return $query->result();
    }
    //Adiciona um novo produtos na tabela produtos
    public function addProduto($dados=NULL)
	{
	if ($dados != NULL):
		$this->db->insert('cadastro', $dados);		
	endif;
	}   


	//Get produtos by id
    public function getClienteByID($id=NULL)
    {
    if ($id != NULL):
        //Verifica se a ID no banco de dados
        $this->db->where('id', $id);        
        //limita para apenas um regstro    
        $this->db->limit(1);
        //pega os produto
        $query = $this->db->get("cadastro");        
        //retornamos o produto
        return $query->row();   
    endif;
    } 

    //Atualizr um produto na tabela clientes
    public function editarCliente($dados=NULL, $id=NULL)
    {
    //Verifica se foi passado $dados e $id    
    if ($dados != NULL && $id != NULL):
        //Se foi passado ele vai a atualização
        $this->db->update('cadastro', $dados, array('id'=>$id));      
    endif;
    }   
       	 	
}
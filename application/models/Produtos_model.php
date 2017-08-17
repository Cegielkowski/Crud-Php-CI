<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produtos_model extends CI_Model
{	
    //Lista todos os clientes da tabela de clientes	
    public function getProdutos()
    {                                 
        $query = $this->db->get("cadastro");
        return $query->result();
    }
    //Adiciona um novo cliente na tabela de clientes
    public function addProduto($dados=NULL)
	{
	if ($dados != NULL):
		$this->db->insert('cadastro', $dados);		
	endif;
	}   


	//Get cliente by id
    public function getClienteByID($id=NULL)
    {
    if ($id != NULL):
        //Verifica se a ID no banco de dados
        $this->db->where('id', $id);        
        //limita para apenas um regstro    
        $this->db->limit(1);
        //pega os clientes
        $query = $this->db->get("cadastro");        
        //retornamos o cliente
        return $query->row();   
    endif;
    } 

    //Atualizar um cliente na tabela clientes
    public function editarCliente($dados=NULL, $id=NULL)
    {
    //Verifica se foi passado $dados e $id    
    if ($dados != NULL && $id != NULL):
        //Se foi passado ele vai a atualização
        $this->db->update('cadastro', $dados, array('id'=>$id));      
    endif;
    }   
     
    //Apaga um produtos na tabela clientes 
    public function apagarCliente($id=NULL){
        //Verificamos se foi passado o a ID como parametro
        if ($id != NULL):
            //Executa a função DB DELETE para apagar o produto
            $this->db->delete('formularios', array('id'=>$id));            
        endif;
    }  
        	 	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {	
	
	//Página de listar produtos
	public function index()
	{					
		//Carrega o Model Produto
		$this->load->model('produtos_model', 'produtos');			
		//Criamos um Array dados para armazenas os produtos
		//Executamos a função no produtos_model getProdutos
		$data['produtos'] = $this->produtos->getProdutos();
		//Carregamos a view listarprodutos e passamos como parametro a array produtos que guarda todos os produtos da db produtos
		$this->load->view('listarprodutos', $data);
	}
	//Página de adicionar produto
	public function add()
	{	
		//Carrega o Model Produtos				
		$this->load->model('produtos_model', 'produtos');					
		//Carrega a View
		$this->load->view('addProdutos');
	}


	//Página de editar produto
	public function editar($id=NULL)	
	{						
	//Verifica se foi passado um ID, se não vai para a página listar produtos
	if($id == NULL) {
		redirect('/');
	}

	//Carrega o Model Produtos				
	$this->load->model('produtos_model', 'produtos');

	//Faz a consulta no banco de dados pra verificar se existe
	$query = $this->produtos->getClienteByID($id);

	//Verifica que a consulta voltar um registro, se não vai para a página listar produtos
	if($query == NULL) {
		redirect('/');
	}
	
	//Criamos uma array onde vai guardar os dados do produto e passamos como parametro para view;	
	$dados['cliente'] = $query;

	//Carrega a View
	$this->load->view('editarProdutos', $dados);		
}

	//Função salvar no DB
/*	public function salvar()
	{
		//Verifica se foi passado o campo nome vazio.
		if ($this->input->post('nome') == NULL || $this->input->post('email') == NULL || $this->input->post('endereco') == NULL) {
			echo 'O compo nome do Cliente é obrigatório.';
			echo '<a href="/produtos/add" title="voltar">Voltar</a>';
		} else	 {
			//Carrega o Model Produtos				
			$this->load->model('produtos_model', 'produtos');
			//Pega dados do post e guarda na array $dados
			$dados['nome'] = $this->input->post('nome');
			$dados['email'] = $this->input->post('email');
			$dados['endereco'] = $this->input->post('endereco');		
			
			//Executa a função do produtos_model adicionar
			$this->produtos->addProduto($dados);
			//Fazemos um redicionamento para a página 		
			redirect("/");	
		}		
	}
		*/


		public function salvar()
	{
		//Verifica se foi passado o campo nome vazio.
		if ($this->input->post('nome') == NULL) {
			echo 'O compo nome do Cliente é obrigatório.';
			echo 'Voltar';
		} else {
			//Carrega o Model Produtos				
			$this->load->model('produtos_model', 'produtos');

			//Pega dados do post e guarda na array $dados
			$dados['nome'] = $this->input->post('nome');
			$dados['email'] = $this->input->post('email');
			$dados['endereco'] = $this->input->post('endereco');		
						
			//Verifica se foi passado via post a id do produtos
			if ($this->input->post('id') != NULL) {		
				//Se foi passado ele vai fazer atualização no registro.	
				$this->produtos->editarCliente($dados, $this->input->post('id'));
			} else {
				//Se Não foi passado id ele adiciona um novo registro
				$this->produtos->addProduto($dados);
			}	
						
			//Fazemos um redicionamento para a página 		
			redirect("/");	
		}		
	}


}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {	
	
	//Página de listar clientes
	public function index()
	{					
		//Carrega o Model Produto
		$this->load->model('produtos_model', 'produtos');			
		//Cria um Array dados para armazenas os clientes
		//Executa a função no produtos_model getProdutos
		$data['produtos'] = $this->produtos->getProdutos();
		//Carregamos a view listarprodutos e passamos como parametro a array produtos que guarda todos os produtos da db produtos
		$this->load->view('listarprodutos', $data);
	}
	//Página de adicionar clientes
	public function add()
	{	
		//Carrega o Model Produtos				
		$this->load->model('produtos_model', 'produtos');					
		//Carrega a View
		$this->load->view('addProdutos');
	}


	//Página de editar clientes
	public function editar($id=NULL)	
	{						
	//Verifica se foi passado um ID, se não vai para a página listar clientes
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
		public function salvar()
	{
		//Verifica se foi passado campo vazio.
		if ($this->input->post('nome') == NULL || $this->input->post('email') == NULL || $this->input->post('endereco') == NULL) {

 		$acao = "não foi realizado devido ao não preenchimento de todos os campos";

		
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
				
			$acao = "foi realizado com sucesso!";


		}

		$msg['msg'] = '<script> alert("O seu cadastro/alteração '.$acao.' ") </script>';	
		
		$this->load->view('addProdutos',$msg);


	}

	//Função Apagar registro
	public function apagar($id=NULL)
	{
		//Verifica se foi passado um ID, se não vai para a página listar clientes
		if($id == NULL) {
			redirect('/');
		}

		//Carrega o Model Produtos				
		$this->load->model('produtos_model', 'produtos');

		//Faz a consulta no banco de dados pra verificar se existe
		$query = $this->produtos->getClienteByID($id);

		//Verifica se foi encontrado um registro com a ID passada
		if($query != NULL) {
			
			//Executa a função apagarClientes do produtos_model
			$this->produtos->apagarCliente($query->id);
			redirect('/');

		} else {
			//Se não encontrou nenhum registro no banco de dados com a ID passada ele volta para página listar clientes
			redirect('http://crud.procedo.com.br/produtos/add');
		}	
	}


}
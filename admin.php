<?php 
	//INICIA UMA SESSAO
	session_start();
	//INCLUI O FICHEIRO ONDE ESTAO AS FUNCOES DE BASE DE DADOS
	require_once './models/basededados.php'; 
	if(ligarAoServidor()){ // verifica se a ligacao a base de dados esta feita

		//VERIFICA QUE PAGINA É PARA SER PROCESSADA
		if(isset($_GET['do'])) {
			if($_GET['do'] == 'livros') {
				listaLivros(); //CHAMA A FUNCAO LISTALIVROS() ESCRITA EM BAIXO
			}
			if($_GET['do'] == 'utilizadores') {
				listaUtilizadores(); // IGUAL A FUNCAO ANALOGA
			}
			if($_GET['do'] == 'reservas') {
				listaReservas();// IGUAL A FUNCAO ANALOGA
			}
			if($_GET['do'] == 'adicionarLivro') {
				adicionarLivro();// IGUAL A FUNCAO ANALOGA
			}
			if($_GET['do'] == 'adicionarCategoria') {
				adicionarCategoria();// IGUAL A FUNCAO ANALOGA
			}
			if($_GET['do'] == 'removerLivro') {
				removerLivro();// IGUAL A FUNCAO ANALOGA
			}
		} else { // SE NENHUMA PAGINA FOI PEDIDA, PROCESSA A PAGINA PRINCIPAL
			$menu = 'home';
			$vista = "views/homepage_view.php";
			include("views/includes/back_template.php");
		}
	}

	//FUNCAO PARA PROCESSAR A LISTAGEM DE LIVROS
	function listaLivros(){
		$livros = lista('Livro','nome','ASC');
		$vista = "views/listaLivrosAdmin.php"; //FICHEIRO A SER DEVOLVIDO AO UTILIZADOR
		$categorias = lista('Categoria','nome','ASC');
		$menu = 'livros'; // VARIAVEL PARA SABER QUE PAGINA E QUE O UTILIZADOR ESTA A VER
		include("views/includes/back_template.php");
	}

	//IGUAL A FUNCAO ANALOGA
	function adicionarLivro(){
		/* RECEBE AS VARIAVEIS DO FORMULARIO */
		$nome = $_POST['nome']; 
		$autor = $_POST['autor'];
		$edicao = $_POST['edicao'];
		$ano = $_POST['ano'];
		$categoria = $_POST['categoria'];
		/* ---------- */

		/* CHAMA A FUNCAO DE BASE DE DADOS INSERELIVRO COM AS VARIAVEIS RECEBIDAS
			DO UTILIZADOR */
		insereLivro($nome,$autor,$edicao,$ano,$categoria); 
		header('Location:admin.php?do=livros');

	}

	//IGUAL A FUNCAO ANALOGA
	function adicionarCategoria() {
		$nome = $_POST['nome'];
		insereCategoria($nome);
		header('Location:admin.php?do=livros');
	}

	//IGUAL A FUNCAO ANALOGA
	function removerLivro() {
		if(!isset($_SESSION['ID_Utilizador']) || $_SESSION['admin'] != 1){ // se não existir utilizador autenticado
			header('Location:index.php'); // volta para a página principal
		} else {
			removeLivro($_GET['livro']); // faz a reserva do livro
			$menu = 'livro';
			header('Location:admin.php?do=livros'); // volta para a página principal
		}
	}

	//IGUAL A FUNCAO ANALOGA
	function listaUtilizadores() {
		$utilizadores = lista('Utilizador','nome','ASC');
		$vista = "views/listaUtilizadores.php";
		$menu = 'utilizadores';
		include("views/includes/back_template.php");
	}

?>
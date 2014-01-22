<?php 
	session_start();
	require_once './models/basededados.php';

	if(ligarAoServidor()){ // verifica se a ligacao a base de dados esta feita

		if(isset($_GET['do'])) {
			if($_GET['do'] == 'minhasreservas'){
				minhasReservas();
			} 
			if($_GET['do'] == 'livros') {
				listaLivros();
			}
			if($_GET['do'] == 'reservar') {
				reservarLivro();
			}
			if($_GET['do'] == 'entregar') {
				entregarLivro();
			}

		} else {
			$menu = 'home';
			$vista = "views/homepage_view.php";
			
			include("views/includes/front_template.php");
		}


	}

	function minhasReservas() {
		if(!isset($_SESSION['ID_Utilizador'])){ // se não existir utilizador autenticado
			header('Location:index.php'); // volta para a página principal
		} else {
			$reservas = listarReservas($_SESSION['ID_Utilizador'],"dataentrega","ASC");
			$vista = "views/minhasreservas_view.php";
			$menu = 'minhasreservas';
			include("views/includes/front_template.php");
		}
	}

	function reservarLivro() {
		if(!isset($_SESSION['ID_Utilizador'])){ // se não existir utilizador autenticado
			header('Location:index.php'); // volta para a página principal
		} else {
			reservaLivro($_GET['livro'],$_SESSION['ID_Utilizador']); // faz a reserva do livro
			$menu = 'minhasreservas';
			header('Location:index.php?do=minhasreservas'); // volta para a página principal
		}
	}

	function entregarLivro() {
		if(!isset($_SESSION['ID_Utilizador'])){ // se não existir utilizador autenticado
			header('Location:index.php'); // volta para a página principal
		} else {
			entregaLivro($_GET['livro']); // faz a reserva do livro
			$menu = 'minhasreservas';
			header('Location:index.php?do=minhasreservas'); // volta para a página principal
		}
	}

	function listaLivros() {
		$livros = lista('Livro','nome','ASC'); // vai buscar aos models
		$vista = "views/listaLivros.php"; //
		$menu = 'livros';
		include("views/includes/front_template.php");
	}


?>
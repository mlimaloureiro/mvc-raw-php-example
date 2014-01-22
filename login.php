<?php 
  session_start();
  require_once './models/basededados.php'; 

  if(ligarAoServidor()){ // verifica se a ligacao a base de dados esta feita

    if(isset($_SESSION['ID_Utilizador'])){
      header('Location:index.php');
    }

    if(isset($_GET['do'])){
      if($_GET['do'] == 'login'){
        login();
      } 
      if($_GET['do'] == 'registar') {
        registar();
      } 
      if($_GET['do'] == 'logout'){
        logout();
      }
    }
    $menu = 'login';
    include('views/login_view.php');
  }

  function login(){
    if(isset($_POST['login'])){
      /*VAI BUSCAR OS DADOS DO UTILIZADOR*/
      $utilizador = pesquisa('Utilizador','login',$_POST['login']);
      
      /* SE A PASSWORD NA BASE DE DADOS FOR IGUAL A PASSWORD INTRODUZIDA
        NO FORMULARIO INICIA VARIAVEIS DE SESSAO */
      if($_POST['password'] == $utilizador[0]->password){
        $_SESSION['ID_Utilizador'] = $utilizador[0]->ID_Utilizador;
        $_SESSION['nome'] = $utilizador[0]->nome;
        $_SESSION['login'] = $utilizador[0]->login;
        $_SESSION['password'] = $utilizador[0]->password;
        $_SESSION['admin'] = $utilizador[0]->admin;
        /* CASO SEJA ADMIN CHAMA O BACKOFFICE */
        if($_SESSION['admin'] == 0)
          header('Location:index.php');
        else
          header('Location:admin.php');
      } else { // CASO PASS ERRADA, CHAMA A PAGINA LOGIN
        header('Location:login.php');
      }
    }
  }

  function logout(){
    session_destroy();
    header('Location:index.php');
  }

  function registar(){
    /* insere o utilizador na base de dados com os dados submetidos no formulario */
    $id_utilizador = insereUtilizador($_POST['nome'],$_POST['login'],$_POST['password']);
    /* vai buscar os dados do utilizador inseridos na Base de dados para iniciar uma sessao */
    $utilizador = pesquisa('Utilizador','ID_Utilizador',$id_utilizador); 

    /* inicia as variaveis de sessao */
    $_SESSION['ID_Utilizador'] = $utilizador[0]->ID_Utilizador;
    $_SESSION['nome'] = $utilizador[0]->nome;
    $_SESSION['login'] = $utilizador[0]->login;

    header('Location:index.php');
  }

?>
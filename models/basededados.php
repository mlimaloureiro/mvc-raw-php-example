<?php

	/* DEFINE VARIAVEIS COMO CONSTANTES DE LIGACAO A BASE DE DADOS */
	define('SERVIDOR','mysql10.000webhost.com');
	define('UTILIZADOR','a1221253_biblio');
	define('PASS','teste123');
	define('BASEDEDADOS','a1221253_biblio');

	function ligarAoServidor() {
		$ligacao = mysql_connect(SERVIDOR,UTILIZADOR,PASS); // liga a base de dados
		if (!$ligacao) { // se não fez ligacao
		    die('Não foi possível conectar: ' . mysql_error()); // printa erros 
		} else {
			mysql_select_db(BASEDEDADOS,$ligacao);
			return $ligacao;
		} 
	}


	function lista($tabela,$ordem="",$asc="",$limiteInferior="",$limiteSuperior="") {


		/* FUNCAO PARA LISTAR LINHAS DE QUALQUER TABELA 
			RECEBE COMO PARAMETROS A TABELA A PESQUISAR, SE E PARA ORDENAR
			PARA ALGUMA COLUNA, CRESCENTE OU DECRESCENTE E LIMITA A PESQUISA
			ENTRE CADA LIMITE

		*/


		$limite = '';

		// PREPARA O STATEMENT
		if($ordem != '' && $asc != '') {
			$ordem = "ORDER BY ".$ordem." ".$asc;
		}

		if($limiteInferior != '' && $limiteSuperior != '') {
			$limite = "LIMIT ".$limiteInferior.",".$limiteSuperior;
		}

		$s = "SELECT * FROM ".$tabela." ".$ordem." ".$limite;
		$q = mysql_query($s) or die(mysql_error());

		if(mysql_num_rows($q) > 0) {
			while($result[] = mysql_fetch_object($q));
			return $result;
		} else {
			return false;
		}
	}

	function pesquisa($tabela,$coluna,$valor) {


		/* FUNCAO PARA PESQUISAR ALGO EM ESPECIFICO NUMA DETERMINADA TABELA
		*/

		$s = "SELECT * FROM ".$tabela." WHERE ".$coluna." = '".$valor."'";
		$q = mysql_query($s) or die(mysql_error());
		if(mysql_num_rows($q) > 0){
			while($result[] = mysql_fetch_object($q));
			return $result;
		} else {
			return false;
		}
	}

	function insereCategoria($nome){
		/* FUNCAO PARA INSERIR CATEGORIAS */
		$s = "INSERT INTO Categoria (nome) VALUES('$nome')";
		mysql_query($s) or die(mysql_error());
	}

	function pesquisaCategoriaLivro($id_livro) {
		/* FUNCAO PARA PESQUISAR A CATEGORIA DO LIVRO */

		$s = "SELECT Categoria.nome FROM Categoria,Categoria_Livro WHERE Categoria.ID_Categoria = Categoria_Livro.ID_Categoria AND Categoria_Livro.ID_Livro = $id_livro";
		$q = mysql_query($s) or die(mysql_error());
		if(mysql_num_rows($q) > 0) {
			$res = mysql_fetch_row($q);
			return $res[0];
		}
	}

	function insereLivro($nome,$autor,$edicao,$data,$categoria){
		/* FUNCAO PARA INSERIR O LIVRO 
		   INSERE PRIMEIRO O LIVRO E DEPOIS INSERE A LINHA DE RELACAO ENTRE O LIVRO E A CATEGORIA
		*/

		$s = "INSERT INTO Livro (nome,autor,edicao,data) VALUES('$nome','$autor','$edicao','$data')";
		mysql_query($s) or die(mysql_error());
		
		$ID_Livro = mysql_insert_id();
		$s2 = "INSERT INTO Categoria_Livro (ID_Livro,ID_Categoria) VALUES($ID_Livro,$categoria)";

		mysql_query($s2) or die(mysql_error());

	}

	function insereUtilizador($nome,$login,$password) {
		/* FUNCAO PARA INSERIR UTILIZADOR */

		$s = "INSERT INTO Utilizador (nome,login,password) VALUES('$nome','$login','$password')";
		mysql_query($s) or die(mysql_error());
		return mysql_insert_id();
	}



	function reservaLivro($id_livro,$id_utilizador){
		/* FUNCAO PARA RESERVAR O LIVRO, A FUNCAO CALCULA QUANDO E QUE O LIVRO VAI 
		ESTAR DISPONIVEL E FAZ A RESERVA PARA ESSE DIA TENDO COMO DATA DE ENTREGA O
		DIA INICIAL CALCULADO + 7 DIAS */

		$dataInicio = time();
		$data = date('d-m-Y', strtotime("+7 days"));
		$datafim = strtotime($data);
		$disp = calcDisponibilidade($id_livro);
		if($disp != false){
			$dataInicio = $disp;
			$disp = date('d-m-Y',$disp);
			$data = date('d-m-Y', strtotime("$disp +7 days"));
			$datafim = strtotime($data);
			
		}
		$s = "INSERT INTO Reserva (ID_Livro,ID_Utilizador,datalevantamento,dataentrega) VALUES ($id_livro,$id_utilizador,$dataInicio,$datafim)";
		mysql_query($s) or die(mysql_error());
	}

	function entregaLivro($id_livro){
		/* FUNCAO PARA ENTREGAR O LIVRO, APAGA A LINHA NA TABELA RESERVA PARA TORNAR O LIVRO DISPONIVEL */
		$id = $_SESSION['ID_Utilizador'];
		$s = "DELETE FROM Reserva WHERE ID_Livro = $id_livro AND ID_Utilizador = $id";
		mysql_query($s) or die(mysql_error());
	}

	function removeLivro($id_livro) {
		/* FUNCAO PARA REMOVER LIVRO, ELIMINA A LINHA NA TABELA LIVRO E TODAS AS LINHAS
		DA TABELA RESERVA RESPECTIVAS AO LIVRO A APAGAR */

		$s = "DELETE FROM Livro WHERE ID_Livro = $id_livro";
		$s2 = "DELETE FROM Reserva WHERE ID_Livro = $id_livro";
		mysql_query($s) or die(mysql_error());
		mysql_query($s2) or die(mysql_error());
	}

	function calcDisponibilidade($ID_Livro) { 
		/* FUNCAO PARA CALCULAR QUANDO UM LIVRO FICA DISPONIVEL, CORRESPONDE A DATA DE ENTREGA
		MAIS ALTA */
		$s = "SELECT dataentrega FROM Reserva WHERE ID_Livro = $ID_Livro ORDER BY dataentrega DESC";
		$q = mysql_query($s) or die(mysql_error());
		if(mysql_num_rows($q) > 0) {
			$res = mysql_fetch_row($q);
			return $res[0];
		}else{
			return time();
		}
	}

	function testaReserva($ID_Livro) {
		$hoje = time();
		$s = "SELECT Reserva.* FROM Reserva WHERE datalevantamento >= ".$hoje." AND dataentrega <= ".$hoje." AND ID_Livro = $ID_Livro";
		$q = mysql_query($s) or die(mysql_error());
		return mysql_num_rows($q);
	}

	function listarReservas($id_utilizador='',$ordem='',$asc='',$limiteInferior='',$limiteSuperior=''){
		/* FUNCAO PARA LISTAR RESERVAS */
		$limite = '';

		// PREPARA O STATEMENT
		if($ordem != '' && $asc != '') {
			$ordem = "ORDER BY ".$ordem." ".$asc;
		}

		if($limiteInferior != '' && $limiteSuperior != '') {
			$limite = "LIMIT ".$limiteInferior.",".$limiteSuperior;
		}

		$s = "SELECT Livro.*, Reserva.* FROM Livro,Reserva WHERE Reserva.ID_Livro = Livro.ID_Livro 
				AND Reserva.ID_Utilizador = $id_utilizador ".$ordem." ".$limite;
		$q = mysql_query($s) or die(mysql_error());

		if(mysql_num_rows($q) > 0){
			while($result[] = mysql_fetch_object($q));
			return $result;
		} else {
			return false;
		}
	}



	function edita($tabela,$id,$valor,$resultado){
		;//
	}

	function listaLivrosPorCategoria($categoria) {
		$s = "SELECT * FROM Livro.*,Categoria_Livro WHERE Livro.ID_Livro = Categoria_Livro.ID_Livro AND Categoria_Livro.ID_Categoria = $categoria";
		$q = mysql_query($s) or die(mysql_error());

		if(mysql_num_rows($q) > 0) {
			return mysql_fetch_object($q);
		} else {
			return false;
		}
	} 

?>
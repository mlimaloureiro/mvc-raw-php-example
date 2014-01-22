<?php

	function connectToServer($servidor,$utilizador,$password,$basededados) { // funcao para fazer a ligacao a base de dados
		$ligacao = mysql_connect($servidor,$utilizador,$password); // liga a base de dados
		if (!$ligacao) { // se não fez ligacao
		    die('Não foi possível conectar: ' . mysql_error()); // printa erros 
		} else {
			mysql_select_db('bibilioteca',$ligacao);
			return true; // devolve true para verificacao
		}
	}


?>
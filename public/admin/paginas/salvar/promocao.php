<?php 
	if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

	require '../../../autoload.php';

	use Promocao\Promocao;

	$promocaoP = new Promocao();

	$id = $preco = $dataInicial = $dataFinal = $produto_id = $mercado_id = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["preco"])) {
		$preco = trim ($_POST["preco"]);
	}

	if (isset ( $_POST["dataInicial"])) {
		$dataInicial = trim ($_POST["dataInicial"]);

		//formatar 30/12/2019 - 2019-12-30
		$dataInicial = explode("/",$dataInicial);
		$dataInicial = $dataInicial[2]."-".$dataInicial[1]."-".$dataInicial[0];
	}

	if (isset ( $_POST["dataFinal"])) {
		$dataFinal = trim ($_POST["dataFinal"]);

		//formatar 30/12/2019 - 2019-12-30
		$dataFinal = explode("/",$dataFinal);
		$dataFinal = $dataFinal[2]."-".$dataFinal[1]."-".$dataFinal[0];
	}

	if (isset ( $_POST["produto_id"])) {
		$produto_id = trim ($_POST["produto_id"]);
	}

	if (isset ( $_POST["mercado_id"])) {
		$mercado_id = trim ($_POST["mercado_id"]);
	}

	if (empty ( $preco )) {
		echo "<script>alert('Preencha o preco');history.back();</script>";
		exit;

	} else if (empty ( $dataInicial )) {
		echo "<script>alert('Preencha a data Inicial');history.back();</script>";
		exit;

	} else if (empty ( $dataFinal )) {
		echo "<script>alert('Preencha a data Final');history.back();</script>";
		exit;

	} else if ($dataInicial > $dataFinal) {//testando para datas uma maior que a outra date("Y-m-d")
		echo "<script>alert('Data invalida');history.back();</script>";
		exit;

	} else if (empty ( $produto_id )) {
		echo "<script>alert('selecione o produto');history.back();</script>";
		exit;

	} else if (empty ( $mercado_id )) {
		echo "<script>alert('selecione o mercado');history.back();</script>";
		exit;

	} else {

		//Formatando US
		$preco = str_replace(".", "", $preco);
		//2.000,00 -> 2000,00
		$preco = str_replace(",",".", $preco);
		//2000,00 -> 2000.00
		
		if ( empty ($id) ) {


			if ($promocaoP->inserirPromocao($preco, $dataInicial, $dataFinal, $produto_id, $mercado_id)) {
				if($_SESSION["sistema"]["tipo"] == "Master") {
					echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=promocao';</script>";
				  } else {
					echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=promocao';</script>";
				  }
				
			} else {

				echo "<script>alert('Não foi possivel salvar');</script>";
				exit;
			}//fim  else erro

		} else {

			if ($promocaoP->editarPromocao($id, $preco, $dataInicial, $dataFinal, $produto_id, $mercado_id)) {
				
				if($_SESSION["sistema"]["tipo"] == "Master") {
					echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=promocao';</script>";
				  } else {
					echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=promocao';</script>";
				  }

			} else {

			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;

			}//fim  else erro
		}
	}






 ?>
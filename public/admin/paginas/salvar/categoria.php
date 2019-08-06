<?php 
	if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

	require '../../../autoload.php';

	use Categoria\Categoria;

	$categoriaC = new Categoria();

	$id = $nomeCategoria = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["nomeCategoria"])) {
		$nomeCategoria = trim ($_POST["nomeCategoria"]);
	}

	if (empty ( $nomeCategoria )) {
		echo "<script>alert('Preencha o nome');history.back();</script>";
		exit;

	} else {

		$resultado = $categoriaC->verificaRegistro();

		foreach ($resultado as $key) {
			if ($key->nomeCategoria == $nomeCategoria) {
				echo "<script>alert('Esta categoria ja esta cadastrada!');history.back();</script>";
				exit;
			}
		}

		
		if ( empty ($id) ) {

			if ($categoriaC->inserirCategoria($nomeCategoria)) {
				if($_SESSION["sistema"]["tipo"] == "Master") {
					echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=categoria';</script>";
				  } else {
					echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=categoria';</script>";
				  }
				
			} else {
			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;
			}//fim  else erro
		} else {

			if ($categoriaC->editarCategoria($id, $nomeCategoria)) {
				
				if($_SESSION["sistema"]["tipo"] == "Master") {
					echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=categoria';</script>";
				  } else {
					echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=categoria';</script>";
				  }

			} else {

			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;

			}//fim  else erro
		}
	}






 ?>
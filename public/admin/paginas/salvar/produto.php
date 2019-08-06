<?php 
	if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

	require '../../../autoload.php';


	//incluir o arquivo da imagem
	include "../app/imagem.php";

	use Produto\Produto;

	$produtoP = new Produto();

	$id = $nome = $codigoDeBarra = $preco = $categoria_id = $foto = $descricao = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["nome"])) {
		$nome = trim ($_POST["nome"]);
	}

	if (isset ( $_POST["codigoDeBarra"])) {
		$codigoDeBarra = trim ($_POST["codigoDeBarra"]);
	}

	if (isset ( $_POST["preco"])) {
		$preco = trim ($_POST["preco"]);
	}

	if (isset ( $_POST["categoria_id"])) {
		$categoria_id = trim ($_POST["categoria_id"]);
	}

	if (isset ( $_POST["descricao"])) {
		$descricao = trim ($_POST["descricao"]);
	}

	if (empty ( $nome )) {
		echo "<script>alert('Preencha o nome');history.back();</script>";
		exit;

	} else if (empty ( $codigoDeBarra )) {
		echo "<script>alert('Preencha o codigo De Barra');history.back();</script>";
		exit;

	} else if (empty ( $preco )) {
		echo "<script>alert('Preencha o Preco');history.back();</script>";
		exit;

	} else if (empty ( $categoria_id )) {
		echo "<script>alert('Preencha sua categoria');history.back();</script>";
		exit;

	} else {
		//Formatando US
		$preco = str_replace(".", "", $preco);
		//2.000,00 -> 2000,00
		$preco = str_replace(",",".", $preco);
		//2000,00 -> 2000.00
		
		$dadusCodigo = $produtoP->listarProduto();
		
		foreach ($dadusCodigo as $key => $value) {
			if ($value->codigoDeBarra == $codigoDeBarra) {
				echo "<script>alert('Codigo de barra ja existe!');history.back();</script>";
				exit;
			}
		}

		//verificar se existe imagem
		if ( !empty ( $_FILES["foto"]["name"] ) ){
			//copiar o arquivo para a pasta ../fotos
			if ( copy ( $_FILES["foto"]["tmp_name"], "../imagesProdutos/".$_FILES["foto"]["name"]) ) {

				$nomeFoto = time();

				//chamar a função para alterar a imagem
				LoadImg("../imagesProdutos/".$_FILES["foto"]["name"],
					$nomeFoto,
					"../imagesProdutos/");
				
				//foto = nome da foto - id do registro
				$foto = $nomeFoto;
			}
		}


		
		if ( empty ($id) ) {


			if ($produtoP->inserirProduto($nome, $codigoDeBarra, $preco, $categoria_id, $foto, $descricao)) {

				/*arquivo json é criado ou atualizado quando se salva um arquivo*/
/*
				$dadus = $produtoP->listarProduto();
				file_put_contents("../arquivos/produtols.json", json_encode($dadus, JSON_UNESCAPED_UNICODE));*/

				if($_SESSION["sistema"]["tipo"] == "Master") {
					echo "<script>alert('Registro salvo');location.href='home.php?op=listas&pg=produto';</script>";
					exit;
				  } else {
					echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=produto';</script>";
					exit;
				  }
				

			} else {
				echo "<script>alert('Não foi possivel salvar');</script>";
				exit;
			}//fim  else erro
		} else {

			if(empty($foto)){

				if ($produtoP->editarProduto($id, $nome, $codigoDeBarra, $preco, $categoria_id, $descricao)) {

					/*arquivo json é criado ou atualizado quando se salva um arquivo*/
/*
					$dadus = $produtoP->listarProduto();
					file_put_contents("../arquivos/produtols.json", json_encode($dadus, JSON_UNESCAPED_UNICODE));*/
					if($_SESSION["sistema"]["tipo"] == "Master") {
						echo "<script>alert('Registro Atualizado');location.href='home.php?op=listas&pg=produto';</script>";
						exit;
					  } else {
						echo "<script>alert('Registro Atualizado');location.href='homeA.php?op=listas&pg=produto';</script>";
						exit;
					  }
					

				} else {

				echo "<script>alert('Não foi possivel salvar');</script>";
				exit;

				}//fim  else erro

			} else {//senao para caso tenha foto
				/*Quando excluir excluir as fotos cadastradas*/
				$dadosFoto = $produtoP->buscaProduto($id);
				$nomeFoto = "";
				if (!empty($dadosFoto->foto)) {
					$nomeFoto = $dadosFoto->foto;
				}

				if ($produtoP->editarProdutoFoto($id, $nome, $codigoDeBarra, $preco, $categoria_id, $foto, $descricao)) {

					/*arquivo json é criado ou atualizado quando se salva um arquivo*/
/*
					$dadus = $produtoP->listarProduto();
					file_put_contents("../arquivos/produtols.json", json_encode($dadus, JSON_UNESCAPED_UNICODE));*/

					//Excluir foto antiga 
					$fotop = "../imagesProdutos/".$nomeFoto."p.jpg";
					apagarFotos($fotop);

					$fotom = "../imagesProdutos/".$nomeFoto."m.jpg";
					apagarFotos($fotom);

					$fotog = "../imagesProdutos/".$nomeFoto."g.jpg";
					apagarFotos($fotog);

					$fotosite = "../imagesProdutos/".$nomeFoto."site.jpg";
					apagarFotos($fotosite);
					
					if($_SESSION["sistema"]["tipo"] == "Master") {
						echo "<script>alert('Registro Atualizado Com foto');location.href='home.php?op=listas&pg=produto';</script>";
						exit;
					  } else {
						echo "<script>alert('Registro Atualizado Com foto');location.href='homeA.php?op=listas&pg=produto';</script>";
						exit;
					  }

					

				} else {

				echo "<script>alert('Não foi possivel salvar');</script>";
				exit;

				}//fim  else erro
			}
		}
	}






 ?>
<?php 
	if (!isset ($pagina)) {
      header("Location: ../../index.php");
      exit;
    } 

	require '../../../autoload.php';

	//incluir o arquivo da imagem
	include "../app/imagem.php";

	use Mercado\Mercado;

	$mercadoM = new Mercado();

	$id = $nome = $apelido = $endereco = $numeroTelefone = $cnpj = $site = $facebook = $whatsapp = $cidade_id = $cep = $bairro = $instagram = $logo = "";

	if (isset ( $_POST["id"])) {
		$id = trim ($_POST["id"]);
	}

	if (isset ( $_POST["nome"])) {
		$nome = trim ($_POST["nome"]);
	}

	if (isset ( $_POST["apelido"])) {
		$apelido = trim ($_POST["apelido"]);
	}

	if (isset ( $_POST["endereco"])) {
		$endereco = trim ($_POST["endereco"]);
	}

	if (isset ( $_POST["numeroTelefone"])) {
		$numeroTelefone = trim ($_POST["numeroTelefone"]);
	}

	if (isset ( $_POST["cnpj"])) {
		$cnpj = trim ($_POST["cnpj"]);
	}

	require "../app/validaDocs.php";
	$msgCPF = validaCNPJ($cnpj);

	if (isset ( $_POST["site"])) {
		$site = trim ($_POST["site"]);
	}

	if (isset ( $_POST["facebook"])) {
		$facebook = trim ($_POST["facebook"]);
	}

	if (isset ( $_POST["whatsapp"])) {
		$whatsapp = trim ($_POST["whatsapp"]);
	}

	if (isset ( $_POST["cidade_id"])) {
		$cidade_id = trim ($_POST["cidade_id"]);
	}

	if (isset ( $_POST["cep"])) {
		$cep = trim ($_POST["cep"]);
	}

	if (isset ( $_POST["bairro"])) {
		$bairro = trim ($_POST["bairro"]);
	}

	if (isset ( $_POST["instagram"])) {
		$instagram = trim ($_POST["instagram"]);
	}

	if ( $msgCPF != 1 ) {

		echo "<script>alert('$msgCPF');history.back();</script>";
		exit;

	}else if (empty ( $nome )) {
		echo "<script>alert('Preencha o nome');history.back();</script>";
		exit;

	} else if (empty ( $cnpj )) {
		echo "<script>alert('Preencha seu cnpj');history.back();</script>";
		exit;

	} else if (empty ( $apelido )) {
		echo "<script>alert('Preencha seu apelido');history.back();</script>";
		exit;

	} else if (empty ( $cidade_id )) {
		echo "<script>alert('Selecione sua cidade');history.back();</script>";
		exit;

	} else {



		//verificar se existe imagem ou logo
		if ( !empty ( $_FILES["foto"]["name"] ) ){
			//copiar o arquivo para a pasta ../fotos
			if ( copy ( $_FILES["foto"]["tmp_name"], "../imagensMercados/".$_FILES["foto"]["name"]) ) {

				$nomeFoto = time();

				//chamar a função para alterar a imagem
				LoadImg("../imagensMercados/".$_FILES["foto"]["name"],
					$nomeFoto,
					"../imagensMercados/");
				
				//foto = nome da foto - id do registro
				$logo = $nomeFoto;
			}
		}
		
		if ( empty ($id) ) {

			$resultado = $mercadoM->verificaRegistro();

			foreach ($resultado as $key) {
				if ($key->cnpj == $cnpj) {
					echo "<script>alert('Este cnpj ja esta cadastrado!');history.back();</script>";
					exit;
				}
			}

			if ($mercadoM->inserirMercado($nome, $apelido, $endereco, $numeroTelefone, $cnpj, $site, $facebook, $whatsapp, $cidade_id, $cep, $bairro, $instagram, $logo)) {
				echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=mercado';</script>";
			} else {
			echo "<script>alert('Não foi possivel salvar');</script>";
			exit;
			}//fim  else erro
		} else {

			if (empty($logo)) {
				
			

				if ($mercadoM->editarMercado($id, $nome, $apelido, $endereco, $numeroTelefone, $cnpj, $site, $facebook, $whatsapp, $cidade_id, $cep, $bairro, $instagram)) {
					echo "<script>alert('Registro salvo');location.href='homeA.php?op=listas&pg=mercado';</script>";

				} else {

					echo "<script>alert('Não foi possivel salvar');</script>";
					exit;
		
				}//fim  else erro
			
			
			} else {//senao para caso tenha foto
				/*Quando excluir excluir as fotos cadastradas*/
				$dadosFoto = $mercadoM->buscaMercado($id);
				$nomeFoto = "";

				if (!empty($dadosFoto->logo)) {
					$nomeFoto = $dadosFoto->logo;
				}

				if ($mercadoM->editarMercadoFoto($id, $nome, $apelido, $endereco, $numeroTelefone, $cnpj, $site, $facebook, $whatsapp, $cidade_id, $cep, $bairro, $instagram, $logo)) {

					/*arquivo json é criado ou atualizado quando se salva um arquivo*/
/*
					$dadus = $produtoP->listarProduto();
					file_put_contents("../arquivos/produtols.json", json_encode($dadus, JSON_UNESCAPED_UNICODE));*/

					//Excluir foto antiga 
					$logop = "../imagesProdutos/".$nomeFoto."p.jpg";
					apagarFotos($logop);

					$logom = "../imagesProdutos/".$nomeFoto."m.jpg";
					apagarFotos($logom);

					$logog = "../imagesProdutos/".$nomeFoto."g.jpg";
					apagarFotos($logog);

					$logosite = "../imagesProdutos/".$nomeFoto."site.jpg";
					apagarFotos($logosite);
					
					echo "<script>alert('Registro Atualizado Com foto');location.href='homeA.php?op=listas&pg=mercado';</script>";

				} else {

				echo "<script>alert('Não foi possivel salvar');</script>";
				exit;

				}//fim  else erro
			
			
			
			
			
			}
		}
	}






 ?>
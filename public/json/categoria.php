<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	
	require '../../autoload.php';

	if (isset($_GET["mercado"])) {
        $mercado = trim ($_GET["mercado"]);
    }

	use Categoria\Categoria;

	$categoria = new Categoria();

	$rest = $categoria->listarCategoriaSite($mercado);


	foreach ($rest as $p) {
		$cate[] = array("id"=>$p->id,
								"categoria"=>$p->nomeCategoria);
	}

	//transformar em json
	echo json_encode($cate);

 
<?php 
	//para definir cabecario do arquivo que é do tipo json
	header("Content-Type:application/json");
	//incluir arquivo do banco
	require '../../autoload.php';

	use Mercado\Mercado;

	$mercadoM = new Mercado();

	$op = $mercado = "";
	if (isset($_GET["op"])) {
		$op = trim ($_GET["op"]);
	}
	if (isset($_GET["mercado"])) {
		$mercado = trim ($_GET["mercado"]);
	}

	//op = produto, categoria

	if ( empty ( $mercado ) ) {
        $consulta = $mercadoM->jsonListarMercado();
    }

	

	foreach ($consulta as $p) {

		$logop = "admin/imagensMercados/".$p->logo."site.jpg";
		$logog = "admin/imagensMercados/".$p->logo."p.jpg";

		$prod[] = array("id"=>$p->id,
							"nome"=>$p->nome,
							"apelido"=>$p->apelido,
							"logop"=>$logop,
							"logog"=>$logog
							);
	}

	echo json_encode($prod);
	
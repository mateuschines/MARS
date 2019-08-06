<?php

	namespace Promocao;

	use Conectar\Config;
	use Conectar\Base;

	class Promocao{

		public $dbh;

		public function __construct()
		{
			$config = new Config('mysql', 'mysql669.umbler.com', 3306, 'mars', 'mateus', 'Yw]sg+43tC');
			$this->dbh = new Base($config);
		}

		public function __destruct()
		{
			$this->dbh->desconectar();
		}


		public function inserirPromocao($preco, $dataInicial, $dataFinal, $produto_id, $mercado_id)
		{
			$sql = "INSERT INTO promocao (id, preco, dataInicial, dataFinal, produto_id, mercado_id) VALUES (NULL, :preco, :dataInicial, :dataFinal, :produto_id, :mercado_id)";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':preco', $preco, \PDO::PARAM_STR);
			$stmt->bindParam(':dataInicial', $dataInicial, \PDO::PARAM_STR);
			$stmt->bindParam(':dataFinal', $dataFinal, \PDO::PARAM_STR);
			$stmt->bindParam(':produto_id', $produto_id, \PDO::PARAM_STR);
			$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_STR);
			if ($stmt->execute()){
				return true;
			} else {
				//recuperar erro - array
				$erro = $consulta->errorInfo()[2];
				// 0 - codigo 2 - mensagem de erro [2]
				echo $erro;
				return false;
			}
		}

		public function editarPromocao($id, $preco, $dataInicial, $dataFinal, $produto_id, $mercado_id)
		{
			$sql = "UPDATE promocao SET preco = :preco, dataInicial = :dataInicial, dataFinal = :dataFinal, produto_id = :produto_id, mercado_id = :mercado_id  WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':preco', $preco, \PDO::PARAM_STR);
			$stmt->bindParam(':dataInicial', $dataInicial, \PDO::PARAM_STR);
			$stmt->bindParam(':dataFinal', $dataFinal, \PDO::PARAM_STR);
			$stmt->bindParam(':produto_id', $produto_id, \PDO::PARAM_STR);
			$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			if ($stmt->execute()){
				return true;
			} else {
				//recuperar erro - array
				$erro = $consulta->errorInfo()[2];
				// 0 - codigo 2 - mensagem de erro [2]
				echo $erro;
				return false;
			}
		}

		public function deletarPromocao($id)
		{
			$sql = "DELETE FROM promocao WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			if ($stmt->execute()){
				return true;
			} else {
				//recuperar erro - array
				$erro = $consulta->errorInfo()[2];
				// 0 - codigo 2 - mensagem de erro [2]
				echo $erro;
				return false;
			}
		}

		public function listarPromocao()
		{
			$sqlJ = "SELECT pro.id,pro.preco,date_format(dataInicial, '%d/%m/%Y') dataI,date_format(dataFinal, '%d/%m/%Y') dataF , pro.mercado_id ,pro.produto_id, p.nome as nomeProduto from promocao pro inner join produto p on pro.produto_id = p.id";
			//$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'promocao','id');
			$stmt = $this->dbh->preparar($sqlJ);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function listarPromocaoSite()
		{
			$sqlJ = "SELECT DISTINCT pro.id,pro.preco,date_format(dataInicial, '%d/%m/%Y') dataI,date_format(dataFinal, '%d/%m/%Y') dataF , pro.mercado_id ,pro.produto_id, p.nome as nomeProduto from promocao pro inner join produto p on pro.produto_id = p.id
			where dataFinal > NOW()
			GROUP BY p.nome, pro.produto_id";
			//$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'promocao','id');
			$stmt = $this->dbh->preparar($sqlJ);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function listarPromocaoAdmin($mercado_id)
		{
			$sqlJ = "SELECT pro.id,pro.preco,date_format(dataInicial, '%d/%m/%Y') dataI,date_format(dataFinal, '%d/%m/%Y') dataF , pro.mercado_id ,pro.produto_id, p.nome as nomeProduto 
			from promocao pro 
			inner join produto p on pro.produto_id = p.id
			where dataFinal > NOW() and pro.mercado_id = :mercado_id
			GROUP BY p.nome, pro.produto_id";
			//$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'promocao','id');
			$stmt = $this->dbh->preparar($sqlJ);
			$stmt->bindParam(':mercado_id', $mercado_id);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function listarPromocaoAdminAntiga($mercado_id)
		{
			$sqlJ = "SELECT p.id,pro.nome as nomeProduto,p.mercado_id,p.produto_id,pro.codigoDeBarra,p.preco, c.nomeCategoria, date_format(p.dataInicial, '%d/%m/%Y') as dataI, date_format(p.dataFinal, '%d/%m/%Y') as dataF
			from produto pro 
			inner join categoria c on (c.id = pro.categoria_id) 
			inner join promocao p on (p.produto_id = pro.id) 
			inner join mercado m on (m.id = p.mercado_id) 
			where p.dataFinal < NOW()
			and m.id = :mercado_id";
			//$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'promocao','id');
			$stmt = $this->dbh->preparar($sqlJ);
			$stmt->bindParam(':mercado_id', $mercado_id);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function buscaProdutoParaRelacionados($idProduto)
		{
			$sql = "SELECT pro.categoria_id FROM produto pro
			where pro.id = :id
			GROUP by pro.categoria_id";
			//$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'promocao','id');
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $idProduto, \PDO::PARAM_INT);
			$stmt->execute();
			return $res = $stmt->fetchObject();
		}
		public function produtosRelacionados($idProduto,$categoria_id, $mercado_id)
		{
			$sql = "SELECT pro.nome, pro.id, promo.preco, pro.foto FROM promocao promo
			LEFT join produto pro on pro.id = promo.produto_id
            LEFT join mercado me on me.id = promo.mercado_id
			where pro.categoria_id = :categoria_id and pro.id <> :id and promo.dataFinal > NOW()
			and me.apelido = :mercado
			GROUP by pro.nome limit 3";
			//$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'promocao','id');
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $idProduto, \PDO::PARAM_INT);
			$stmt->bindParam(':categoria_id', $categoria_id, \PDO::PARAM_INT);
			$stmt->bindParam(':mercado', $mercado_id);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscaPromocao($id){
			$sql = "SELECT pro.id, pro.preco,pro.produto_id,pro.mercado_id, date_format(dataInicial, '%d/%m/%Y') dataI, date_format(dataFinal, '%d/%m/%Y') dataF, p.nome as nomeProduto, p.preco as precoProduto FROM promocao pro inner join produto p on pro.produto_id = p.id WHERE pro.id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function verificaProduto($id){
			$sql = "SELECT * FROM promocao WHERE produto_id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function buscaPPromocao($id){
			$sql = "SELECT *, date_format(dataInicial, '%d/%m/%Y') dataI, date_format(dataFinal, '%d/%m/%Y') dataF FROM promocao WHERE mercado_id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function totalPromocao($mercado_id){
			$sql = "SELECT COUNT(id) FROM promocao
			WHERE mercado_id = :mercado and dataFinal > NOW()";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado_id, \PDO::PARAM_INT);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado;

		}

	}	
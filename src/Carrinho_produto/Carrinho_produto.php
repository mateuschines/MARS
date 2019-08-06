<?php

	namespace Carrinho_produto;

	use Conectar\Config;
	use Conectar\Base;



	class Carrinho_produto{



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





		public function inserirCarrinho_produto($carrinho_id, $produto_id, $quantidade, $valor) : void

		{

			$sql = "INSERT INTO carrinho_produto (carrinho_id, produto_id, quantidade, valor) VALUES (:carrinho_id, :produto_id, :quantidade, :valor)";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':carrinho_id', $carrinho_id, \PDO::PARAM_INT);

			$stmt->bindParam(':produto_id', $produto_id, \PDO::PARAM_INT);

			$stmt->bindParam(':quantidade', $quantidade);

			$stmt->bindParam(':valor', $valor);

			$stmt->execute();

		}



		public function editarCarrinho_produto($carrinho_id, $produto_id, $quantidade, $valor)

		{

			$sql = "UPDATE carrinho_produto SET produto_id = :produto_id, quantidade = :quantidade, valor = :valor WHERE carrinho_id = :carrinho_id LIMIT 1";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':produto_id', $produto_id, \PDO::PARAM_INT);

			$stmt->bindParam(':quantidade', $quantidade);

			$stmt->bindParam(':valor', $valor);

			$stmt->bindParam(':carrinho_id', $carrinho_id, \PDO::PARAM_INT);

			$stmt->execute();

		}



		public function deletarCarrinho_produto($carrinho_id)

		{

			$sql = "DELETE FROM carrinho_produto WHERE carrinho_id = :carrinho_id LIMIT 1";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':carrinho_id', $carrinho_id, \PDO::PARAM_INT);

			$stmt->execute();

		}



		public function listarCarrinho_produto()

		{

			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'carrinho_produto','carrinho_id');

			$stmt = $this->dbh->preparar($sql);

			$stmt->execute();

			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);

		}



		public function buscaCarrinho_produto($carrinho_id){

			$sql = "SELECT * FROM carrinho_produto WHERE carrinho_id = :carrinho_id LIMIT 1";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':carrinho_id', $carrinho_id, \PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchObject();

		}



		//



		public function buscaVenda($carrinho_id){

			$sql = "SELECT cp.carrinho_id, 

			cp.quantidade, 

			cp.valor, 

			p.nome, 

			p.id, 

			p.codigoDeBarra, 

			p.descricao FROM carrinho_produto cp 

			INNER JOIN produto p on ( p.id = cp.produto_id) 

			WHERE cp.carrinho_id = :carrinho_id";



			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':carrinho_id', $carrinho_id, \PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll(\PDO::FETCH_CLASS);

		}



	}	
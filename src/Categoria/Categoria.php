<?php

	namespace Categoria;

	use Conectar\Config;
	use Conectar\Base;

	class Categoria{

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


		public function inserirCategoria($nomeCategoria)
		{
			$sql = "INSERT INTO categoria (id, nomeCategoria) VALUES (NULL, :nomeCategoria)";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':nomeCategoria', $nomeCategoria, \PDO::PARAM_STR);
			if ($stmt->execute()){
				return true;
			} else {
				//recuperar erro - array
				$erro = $stmt->errorInfo()[2];
				// 0 - codigo 2 - mensagem de erro [2]
				echo $erro;
				return false;
			}
		}

		public function editarCategoria($id, $nomeCategoria)
		{
			$sql = "UPDATE categoria SET nomeCategoria = :nomeCategoria WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':nomeCategoria', $nomeCategoria, \PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			if ($stmt->execute()){
				return true;
			} else {
				//recuperar erro - array
				$erro = $stmt->errorInfo()[2];
				// 0 - codigo 2 - mensagem de erro [2]
				echo $erro;
				return false;
			}
		}

		public function deletarCategoria($id)
		{
			$sql = "DELETE FROM categoria WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			if ($stmt->execute()){
				return true;
			} else {
				//recuperar erro - array
				$erro = $stmt->errorInfo()[2];
				// 0 - codigo 2 - mensagem de erro [2]
				echo $erro;
				return false;
			}
		}

		public function listarCategoria()
		{
			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'categoria','id');
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function listarCategoriaSite($apelido)
		{
			$sql = "SELECT cat.id, cat.nomeCategoria FROM categoria cat
			INNER JOIN produto pro on pro.categoria_id = cat.id
			INNER JOIN promocao p on p.produto_id = pro.id
			INNER JOIN mercado m on m.id = p.mercado_id
			WHERE m.apelido = :apelido and p.dataFinal > NOW()
			GROUP BY cat.nomeCategoria
			ORDER BY cat.nomeCategoria";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':apelido', $apelido);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscaCategoria($id){
			$sql = "SELECT * FROM categoria WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function verificaRegistro(){
			$sql = "SELECT * FROM categoria";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$resultado = $stmt->fetchAll(\PDO::FETCH_CLASS);
			return $resultado;

		}

	}	
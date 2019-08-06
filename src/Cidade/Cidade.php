<?php

	namespace Cidade;

	use Conectar\Config;
	use Conectar\Base;

	class Cidade{

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


		public function inserirCidade($nome, $estado)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "INSERT INTO cidade (id, nome, estado) VALUES (NULL, :nome, :estado)";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':estado', $estado, \PDO::PARAM_STR);
				$stmt->execute();
				if ($stmt) {
					$this->dbh->commit();
				}
				return $stmt;	
				
			} catch (Exception $e) {
				$this->dbh->rollBack();
				return $e->getMessage();
				exit;
			}
		}

		public function editarCidade($id, $nome, $estado)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE cidade SET nome = :nome, estado = :estado WHERE id = :id LIMIT 1";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':estado', $estado, \PDO::PARAM_STR);
				$stmt->bindParam(':id', $id, \PDO::PARAM_INT);

				$stmt->execute();
				if ($stmt) {
					$this->dbh->commit();
				}
				return $stmt;	
				
			} catch (Exception $e) {
				$this->dbh->rollBack();
				return $e->getMessage();
				exit;
			}
		}

		public function deletarCidade($id)
		{
			$sql = "DELETE FROM cidade WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
		}

		public function listarCidades()
		{
			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'cidade','estado');
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscasCidades($busca){
			$busca = "%$busca%";
			$sql = "SELECT * FROM cidade WHERE nome LIKE  '$busca'  ORDER BY id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$res = $stmt->fetchAll(\PDO::FETCH_CLASS);
			return $res;
		}

		public function buscaCidade($id){
			$sql = "SELECT * FROM cidade WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function verificaRegistro(){
			$sql = "SELECT * FROM cidade";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$resultado = $stmt->fetchAll(\PDO::FETCH_CLASS);
			return $resultado;

		}

		public function cidadeJson(){
			$sql = "SELECT * FROM cidade";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$resultado = $stmt->fetchAll(\PDO::FETCH_CLASS);    
		    
		    //Passando vetor em forma de json
		    return json_encode($resultado, JSON_UNESCAPED_UNICODE);
			

		}

	}	
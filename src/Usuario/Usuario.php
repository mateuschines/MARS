<?php

	namespace Usuario;

	use Conectar\Config;
	use Conectar\Base;

	class Usuario{

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


		public function inserirUsuario($nome, $ativo, $email, $login, $senha, $mercado_id, $telefone, $cpf, $tipo)
		{
			try {
				$this->dbh->beginTransaction();
				$sql = "INSERT INTO usuario (id, nome, ativo, email, login, senha, mercado_id, telefone, cpf, tipo) VALUES (NULL, :nome, :ativo, :email, :login, :senha, :mercado_id, :telefone, :cpf, :tipo)";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':ativo', $ativo, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':login', $login, \PDO::PARAM_STR);
				$stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
				$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_INT);
				$stmt->bindParam(':telefone', $telefone, \PDO::PARAM_STR);
				$stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
				$stmt->bindParam(':tipo', $tipo, \PDO::PARAM_STR);
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

		/*--TESTAR SEUS ERROS--
		public function inserirUsuario($nome, $ativo, $email, $login, $senha, $mercado_id)
		{
			$sql = "INSERT INTO usuario (id, nome, ativo, email, login, senha, mercado_id) VALUES (NULL, :nome, :ativo, :email, :login, :senha, :mercado_id)";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':ativo', $ativo, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':login', $login, \PDO::PARAM_STR);
				$stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
				$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_INT);
				
			if ( $stmt->execute() ) return true;
			else return $stmt->errorInfo()[2];
		}*/

		public function editarUsuario($id, $nome, $ativo, $email, $senha, $mercado_id, $telefone, $cpf, $tipo)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE usuario SET nome = :nome, ativo = :ativo, email = :email, senha = :senha, mercado_id = :mercado_id, telefone = :telefone, cpf = :cpf, tipo = :tipo WHERE id = :id LIMIT 1";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':ativo', $ativo, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
				$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_INT);
				$stmt->bindParam(':telefone', $telefone, \PDO::PARAM_STR);
				$stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
				$stmt->bindParam(':tipo', $tipo, \PDO::PARAM_STR);
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

		public function RecuperarSenhaUsuario($id, $senha)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE usuario SET senha = :senha WHERE id = :id LIMIT 1";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
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

		public function editarEmpUsuario($id, $nome, $ativo, $email, $mercado_id, $telefone, $cpf, $tipo)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE usuario SET nome = :nome, ativo = :ativo, email = :email, mercado_id = :mercado_id, telefone = :telefone, cpf = :cpf, tipo = :tipo WHERE id = :id LIMIT 1";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':ativo', $ativo, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_INT);
				$stmt->bindParam(':telefone', $telefone, \PDO::PARAM_STR);
				$stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
				$stmt->bindParam(':tipo', $tipo, \PDO::PARAM_STR);
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

		public function deletarUsuario($id)
		{
			$sql = "DELETE FROM usuario WHERE id = :id LIMIT 1";
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

		public function listarUsuarios()
		{
			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'usuario','id');
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		//Para buscar mas nao esta mais usado
		public function buscasUsuarios($busca){
			$busca = "%$busca%";
			$sql = "SELECT * FROM usuario WHERE nome LIKE  '$busca'  ORDER BY id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$res = $stmt->fetchAll(\PDO::FETCH_CLASS);
			return $res;
		}

		public function buscaUsuario($id){
			$sql = "SELECT * FROM usuario WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		//para encontrar se tem mercado
		public function buscaUUsuario($id){
			$sql = "SELECT * FROM usuario WHERE mercado_id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function  autenticar($login) {

		    $sql = 'SELECT * FROM usuario WHERE login = :login LIMIT 1';
		    $stmt = $this->dbh->preparar($sql);
		    $stmt->bindParam(':login', $login, \PDO::PARAM_STR);

		    $stmt->execute();
		    $dados = $stmt->fetchObject();

		    return $dados;
		  }
	}	
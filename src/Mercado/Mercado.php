<?php



	namespace Mercado;



	use Conectar\Config;

	use Conectar\Base;



	class Mercado{



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





		public function inserirMercado($nome, $apelido, $endereco, $numeroTelefone, $cnpj, $site, $facebook, $whatsapp, $cidade_id, $cep, $bairro, $instagram, $logo)

		{

			try {

				$this->dbh->beginTransaction();



			$sql = "INSERT INTO mercado (id, nome, apelido, endereco, numeroTelefone, cnpj, site, facebook, whatsapp, cidade_id, cep, bairro, instagram, logo) VALUES (NULL, :nome, :apelido, :endereco, :numeroTelefone, :cnpj, :site, :facebook, :whatsapp, :cidade_id, :cep, :bairro, :instagram, :logo)";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);

			$stmt->bindParam(':apelido', $apelido, \PDO::PARAM_STR);

			$stmt->bindParam(':endereco', $endereco, \PDO::PARAM_STR);

			$stmt->bindParam(':numeroTelefone', $numeroTelefone, \PDO::PARAM_STR);

			$stmt->bindParam(':cnpj', $cnpj, \PDO::PARAM_STR);

			$stmt->bindParam(':site', $site, \PDO::PARAM_STR);

			$stmt->bindParam(':facebook', $facebook, \PDO::PARAM_STR);

			$stmt->bindParam(':whatsapp', $whatsapp, \PDO::PARAM_STR);

			$stmt->bindParam(':cidade_id', $cidade_id, \PDO::PARAM_INT);

			$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);

			$stmt->bindParam(':bairro', $bairro, \PDO::PARAM_STR);

			$stmt->bindParam(':instagram', $instagram, \PDO::PARAM_STR);

			$stmt->bindParam(':logo', $logo, \PDO::PARAM_STR);

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



		public function editarMercado($id, $nome, $apelido, $endereco, $numeroTelefone, $cnpj, $site, $facebook, $whatsapp, $cidade_id, $cep, $bairro, $instagram)

		{

			try {

				$this->dbh->beginTransaction();



				$sql = "UPDATE mercado SET nome = :nome, apelido = :apelido, endereco = :endereco, numeroTelefone = :numeroTelefone, cnpj = :cnpj, site = :site, facebook = :facebook, whatsapp = :whatsapp, cidade_id = :cidade_id, cep = :cep, bairro = :bairro, instagram = :instagram WHERE id = :id LIMIT 1";

				$stmt = $this->dbh->preparar($sql);

				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);

				$stmt->bindParam(':apelido', $apelido, \PDO::PARAM_STR);

				$stmt->bindParam(':endereco', $endereco, \PDO::PARAM_STR);

				$stmt->bindParam(':numeroTelefone', $numeroTelefone, \PDO::PARAM_STR);

				$stmt->bindParam(':cnpj', $cnpj, \PDO::PARAM_STR);

				$stmt->bindParam(':site', $site, \PDO::PARAM_STR);

				$stmt->bindParam(':facebook', $facebook, \PDO::PARAM_STR);

				$stmt->bindParam(':whatsapp', $whatsapp, \PDO::PARAM_STR);

				$stmt->bindParam(':cidade_id', $cidade_id, \PDO::PARAM_INT);

				$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);

				$stmt->bindParam(':bairro', $bairro, \PDO::PARAM_STR);

				$stmt->bindParam(':instagram', $instagram, \PDO::PARAM_STR);

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



		public function editarMercadoFoto($id, $nome, $apelido, $endereco, $numeroTelefone, $cnpj, $site, $facebook, $whatsapp, $cidade_id, $cep, $bairro, $instagram, $logo)

		{

			try {

				$this->dbh->beginTransaction();



				$sql = "UPDATE mercado SET nome = :nome, apelido = :apelido, endereco = :endereco, numeroTelefone = :numeroTelefone, cnpj = :cnpj, site = :site, facebook = :facebook, whatsapp = :whatsapp, cidade_id = :cidade_id, cep = :cep, bairro = :bairro, instagram = :instagram, logo = :logo WHERE id = :id LIMIT 1";

				$stmt = $this->dbh->preparar($sql);

				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);

				$stmt->bindParam(':apelido', $apelido, \PDO::PARAM_STR);

				$stmt->bindParam(':endereco', $endereco, \PDO::PARAM_STR);

				$stmt->bindParam(':numeroTelefone', $numeroTelefone, \PDO::PARAM_STR);

				$stmt->bindParam(':cnpj', $cnpj, \PDO::PARAM_STR);

				$stmt->bindParam(':site', $site, \PDO::PARAM_STR);

				$stmt->bindParam(':facebook', $facebook, \PDO::PARAM_STR);

				$stmt->bindParam(':whatsapp', $whatsapp, \PDO::PARAM_STR);

				$stmt->bindParam(':cidade_id', $cidade_id, \PDO::PARAM_INT);

				$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);

				$stmt->bindParam(':bairro', $bairro, \PDO::PARAM_STR);

				$stmt->bindParam(':instagram', $instagram, \PDO::PARAM_STR);

				$stmt->bindParam(':logo', $logo, \PDO::PARAM_STR);

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



		public function deletarMercado($id)

		{

			$sql = "DELETE FROM mercado WHERE id = :id LIMIT 1";

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



		public function listarMercados()

		{

			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'mercado','id');

			$stmt = $this->dbh->preparar($sql);

			$stmt->execute();

			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);

		}



		public function jsonListarMercado()

		{//arrumar select



			$sql = "SELECT DISTINCT m.id,m.apelido,m.bairro,m.cep,m.cidade_id,m.cnpj,m.endereco, m.facebook, m.instagram, m.logo, m.nome, m.numeroTelefone, m.site, m.whatsapp from mercado m  

			inner join promocao p on (p.mercado_id = m.id)";



			$stmt = $this->dbh->preparar($sql);

			$stmt->execute();

			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);

		}



		public function buscasMercados($busca){

			$busca = "%$busca%";

			$sql = "SELECT * FROM mercado WHERE nome LIKE  '$busca'  ORDER BY id";

			$stmt = $this->dbh->preparar($sql);

			$stmt->execute();

			$res = $stmt->fetchAll(\PDO::FETCH_CLASS);

			return $res;

		}



		public function buscaMercado($id){

			$sql = "SELECT me.id,me.nome, me.apelido, me.endereco ,me.numeroTelefone, me.cnpj, me.site, me.facebook, me.whatsapp, me.cidade_id,me.cep,me.bairro,me.instagram, me.logo, ci.nome as nomeCidade from mercado me inner join cidade ci on me.cidade_id = ci.id where me.id = :id limit 1";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchObject();

		}



		public function buscaMercadoApelido($apelido){

			$sql = "SELECT me.id,me.nome, me.apelido from mercado me where me.apelido = :apelido limit 1";

			$stmt = $this->dbh->preparar($sql);

			$stmt->bindParam(':apelido', $apelido);

			$stmt->execute();

			return $stmt->fetchObject();

		}



		public function verificaRegistro(){

			$sql = "SELECT * FROM mercado";

			$stmt = $this->dbh->preparar($sql);

			$stmt->execute();

			$resultado = $stmt->fetchAll(\PDO::FETCH_CLASS);

			return $resultado;



		}



	}	
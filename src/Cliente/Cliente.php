<?php

	namespace Cliente;

	use Conectar\Config;
	use Conectar\Base;

	class Cliente{

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


		public function inserirCliente($nome, $cpf, $rg, $endereco, $celular, $email, $senha, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "INSERT INTO cliente (id, nome, cpf, rg, endereco, celular, email, senha ,whatsapp, sexo, dtNascimento, cep, complemento, bairro, numero, cidade_id) VALUES (NULL, :nome, :cpf, :rg, :endereco, :celular, :email, :senha, :whatsapp, :sexo, :dtNascimento, :cep, :complemento, :bairro, :numero, :cidade_id)";

				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
				$stmt->bindParam(':rg', $rg, \PDO::PARAM_STR);
				$stmt->bindParam(':endereco', $endereco, \PDO::PARAM_STR);
				$stmt->bindParam(':celular', $celular, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
				$stmt->bindParam(':whatsapp', $whatsapp, \PDO::PARAM_STR);
				$stmt->bindParam(':sexo', $sexo, \PDO::PARAM_STR);
				$stmt->bindParam(':dtNascimento', $dtNascimento, \PDO::PARAM_STR);
				$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);
				$stmt->bindParam(':complemento', $complemento, \PDO::PARAM_STR);
				$stmt->bindParam(':bairro', $bairro, \PDO::PARAM_STR);
				$stmt->bindParam(':numero', $numero, \PDO::PARAM_STR);
				$stmt->bindParam(':cidade_id', $cidade_id, \PDO::PARAM_INT);
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

		public function editarCliente($id, $nome, $cpf, $rg, $endereco, $celular, $email, $senha, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE cliente SET nome = :nome, cpf = :cpf, rg = :rg, endereco = :endereco, celular = :celular, email = :email, senha = :senha, whatsapp = :whatsapp, sexo = :sexo, dtNascimento = :dtNascimento, cep = :cep, complemento = :complemento, bairro = :bairro, numero = :numero, cidade_id = :cidade_id WHERE id = :id LIMIT 1";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
				$stmt->bindParam(':rg', $rg, \PDO::PARAM_STR);
				$stmt->bindParam(':endereco', $endereco, \PDO::PARAM_STR);
				$stmt->bindParam(':celular', $celular, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':senha', $senha, \PDO::PARAM_STR);
				$stmt->bindParam(':whatsapp', $whatsapp, \PDO::PARAM_STR);
				$stmt->bindParam(':sexo', $sexo, \PDO::PARAM_STR);
				$stmt->bindParam(':dtNascimento', $dtNascimento, \PDO::PARAM_STR);
				$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);
				$stmt->bindParam(':complemento', $complemento, \PDO::PARAM_STR);
				$stmt->bindParam(':bairro', $bairro, \PDO::PARAM_STR);
				$stmt->bindParam(':numero', $numero, \PDO::PARAM_STR);
				$stmt->bindParam(':cidade_id', $cidade_id, \PDO::PARAM_INT);
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

		public function RecuperarSenhaCliente($id, $senha)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE cliente SET senha = :senha WHERE id = :id LIMIT 1";
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

		public function editarEmpCliente($id, $nome, $cpf, $rg, $endereco, $celular, $email, $whatsapp, $sexo, $dtNascimento, $cep, $complemento, $bairro, $numero, $cidade_id)
		{
			try {
				$this->dbh->beginTransaction();

				$sql = "UPDATE cliente SET nome = :nome, cpf = :cpf, rg = :rg, endereco = :endereco, celular = :celular, email = :email, whatsapp = :whatsapp, sexo = :sexo, dtNascimento = :dtNascimento, cep = :cep, complemento = :complemento, bairro = :bairro, numero = :numero, cidade_id = :cidade_id WHERE id = :id LIMIT 1";
				$stmt = $this->dbh->preparar($sql);
				$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
				$stmt->bindParam(':cpf', $cpf, \PDO::PARAM_STR);
				$stmt->bindParam(':rg', $rg, \PDO::PARAM_STR);
				$stmt->bindParam(':endereco', $endereco, \PDO::PARAM_STR);
				$stmt->bindParam(':celular', $celular, \PDO::PARAM_STR);
				$stmt->bindParam(':email', $email, \PDO::PARAM_STR);
				$stmt->bindParam(':whatsapp', $whatsapp, \PDO::PARAM_STR);
				$stmt->bindParam(':sexo', $sexo, \PDO::PARAM_STR);
				$stmt->bindParam(':dtNascimento', $dtNascimento, \PDO::PARAM_STR);
				$stmt->bindParam(':cep', $cep, \PDO::PARAM_STR);
				$stmt->bindParam(':complemento', $complemento, \PDO::PARAM_STR);
				$stmt->bindParam(':bairro', $bairro, \PDO::PARAM_STR);
				$stmt->bindParam(':numero', $numero, \PDO::PARAM_STR);
				$stmt->bindParam(':cidade_id', $cidade_id, \PDO::PARAM_INT);
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

		public function deletarCliente($id)
		{
			$sql = "DELETE FROM cliente WHERE id = :id LIMIT 1";
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

		public function listarClientes()
		{
			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'cliente','id');
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscaCliente($id){
			$sql = "SELECT cli.id,cli.nome, cli.cpf,cli.rg,cli.endereco,cli.celular,cli.email,cli.senha,cli.whatsapp,cli.sexo, date_format(dtNascimento, '%d/%m/%Y') as data,cli.cep,cli.complemento,cli.bairro,cli.numero,cli.cidade_id, c.nome as nomeCidade FROM cliente cli inner join cidade c on cli.cidade_id = c.id WHERE cli.id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function verificaRegistro(){
			$sql = "SELECT * FROM cliente";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$resultado = $stmt->fetchAll(\PDO::FETCH_CLASS);
			return $resultado;

		}

		public function totalClientes(){
			$sql = "SELECT COUNT(nome) FROM cliente";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado;

		}

		public function  autenticar($email) {

		    $sql = 'SELECT * FROM cliente WHERE email = :email LIMIT 1';
		    $stmt = $this->dbh->preparar($sql);
		    $stmt->bindParam(':email', $email, \PDO::PARAM_STR);

		    $stmt->execute();
		    $dados = $stmt->fetchObject();

		    return $dados;
		}
		  /**********************Relatoriosooooo */
		public function  gerarRelatorioClientesNuncaComprouAll() {

		    $sql = 'select cli.id,
			cli.nome,
			cli.email,
			cli.celular,
			cli.endereco
			from cliente cli
			where cli.id not in (select c.cliente_id from carrinho c)';
		    $stmt = $this->dbh->preparar($sql);
		    $stmt->execute();
		    return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function  gerarRelatorioClientesNuncaComprou($dataInicial, $dataFinal) {
/**NAO ESTA FUNCIONANDO */
		    $sql = 'select cli.id,
			cli.nome,
			cli.email,
			cli.celular,
			cli.endereco
			from cliente cli
            LEFT JOIN carrinho c on c.cliente_id = cli.id
			where cli.id not in (select c.cliente_id from carrinho c) and c.dataCompra BETWEEN :dataInicial and :dataFinal';
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
		    $stmt->execute();
		    return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		
		public function  gerarRelatorioClientesMaisCompraramLimit($mercado, $dataInicial, $dataFinal, $limit) {

		    $sql = sprintf("select cli.nome,
			cli.endereco,
			cli.celular,
			cli.email,
			sum(car.cliente_id) as quantidade
			from cliente as cli
			LEFT JOIN carrinho car on car.cliente_id = cli.id
			where car.mercado_id = :mercado  AND car.dataCompra BETWEEN :dataInicial and :dataFinal
			group by cli.nome, cli.endereco, cli.celular, cli.email
			order by sum(car.cliente_id)  desc LIMIT %s", $limit);
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
		    $stmt->execute();
		    return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function  gerarRelatorioClientesMaisCompraramAll($mercado) {

		    $sql = "select cli.nome,
			cli.endereco,
			cli.celular,
			cli.email,
			sum(car.cliente_id) as quantidade
			from cliente as cli
			LEFT JOIN carrinho car on car.cliente_id = cli.id
			where car.mercado_id = :mercado
			group by cli.nome, cli.endereco, cli.celular, cli.email
			order by sum(car.cliente_id)  desc";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
		    $stmt->execute();
		    return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function  gerarRelatorioClientesMaisCompraram($mercado, $dataInicial, $dataFinal) {

		    $sql = "select cli.nome,
			cli.endereco,
			cli.celular,
			cli.email,
			sum(car.cliente_id) as quantidade
			from cliente as cli
			LEFT JOIN carrinho car on car.cliente_id = cli.id
			where car.mercado_id = :mercado  AND car.dataCompra BETWEEN :dataInicial and :dataFinal
			group by cli.nome, cli.endereco, cli.celular, cli.email
			order by sum(car.cliente_id)  desc";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
		    $stmt->execute();
		    return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

	}
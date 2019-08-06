<?php

	namespace Carrinho;

	use Conectar\Config;
	use Conectar\Base;

	class Carrinho{

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


		public function inserirCarrinho($cliente_id, $mercado_id)
		{
			$sql = "INSERT INTO carrinho (id, dataCompra, cliente_id, mercado_id) VALUES (NULL, CURRENT_DATE, :cliente_id, :mercado_id)";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':cliente_id', $cliente_id, \PDO::PARAM_INT);
			$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_INT);
			if ($stmt->execute()) {
				$sql = "SELECT id FROM carrinho ORDER BY id DESC limit 1";
				$smt = $this->dbh->preparar($sql);
				if($smt->execute()){
				    return $smt->fetch();
				} else {
				    return false;
				}
			} else {
				return false;
			}
		}

		public function editarCarrinho($id, $dataCompra, $cliente_id, $mercado_id)
		{
			$sql = "UPDATE carrinho SET dataCompra = :dataCompra, cliente_id = :cliente_id, mercado_id = mercado_id WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':dataCompra', $dataCompra, \PDO::PARAM_INT);
			$stmt->bindParam(':cliente_id', $cliente_id, \PDO::PARAM_FLO);
			$stmt->bindParam(':mercado_id', $mercado_id, \PDO::PARAM_DOU);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			if ($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function deletarCarrinho($id)
		{
			$sql = "DELETE FROM carrinho WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
		}

		public function listarCarrinho()
		{
			$sql = sprintf("SELECT * FROM %s ORDER BY %s", 'carrinho','id');
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function totalVendas($mercado_id){
			$sql = "SELECT COUNT(id) FROM carrinho where mercado_id = :mercado";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado_id, \PDO::PARAM_INT);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado;

		}

		public function buscaCarrinho($id){
			$sql = "SELECT c.id as idCarrinho, date_format(c.dataCompra, '%d/%m/%Y') as data, c.cliente_id, c.mercado_id,cp.carrinho_id, 
			cp.quantidade, 
			cp.valor,
			p.nome, 
			p.id as idProduto, 
			p.codigoDeBarra, 
			p.descricao FROM carrinho c
			inner join carrinho_produto cp on (cp.carrinho_id = c.id)
			inner join produto p on ( p.id = cp.produto_id)
			WHERE c.id = :id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscaCompraRealizada($id){
			$sql = "SELECT c.id as idCarrinho, date_format(c.dataCompra, '%d/%m/%Y') as data, c.cliente_id, c.mercado_id,cp.carrinho_id, 
			SUM(cp.quantidade * cp.valor) as valorTotal,
            m.nome FROM carrinho c
			inner join carrinho_produto cp on (cp.carrinho_id = c.id)
            INNER JOIN mercado m on ( m.id = c.mercado_id)
			WHERE c.cliente_id = :id
			GROUP by c.id, c.dataCompra, c.cliente_id, c.mercado_id,cp.carrinho_id, m.nome
			ORDER BY c.dataCompra DESC";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscaCompraRealizadaPorMercado($id)
		{
			$sql = "SELECT c.id as idCarrinho, date_format(c.dataCompra, '%d/%m/%Y') as data, c.cliente_id, c.mercado_id,cp.carrinho_id,c.status, c.valorPago, 
			cli.nome as nomeCliente,
			SUM(cp.quantidade * cp.valor) as valorTotal,
            m.nome FROM carrinho c
			inner join carrinho_produto cp on (cp.carrinho_id = c.id)
            INNER JOIN mercado m on ( m.id = c.mercado_id)
            INNER join cliente cli on (cli.id = c.cliente_id)
			WHERE c.mercado_id = :id
			GROUP by c.id, c.dataCompra, c.cliente_id, c.mercado_id,cp.carrinho_id, c.status, c.valorPago, cli.nome
			ORDER BY c.dataCompra DESC";

			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);

		}
		public function buscaCompraRealizadaPorMercadoPorData($id, $dataInicial, $dataFinal)
		{
			$sql = "SELECT c.id as idCarrinho, date_format(c.dataCompra, '%d/%m/%Y') as data, c.cliente_id, c.mercado_id,cp.carrinho_id,c.status, c.valorPago, 
			cli.nome as nomeCliente,
			SUM(cp.quantidade * cp.valor) as valorTotal,
            m.nome FROM carrinho c
			inner join carrinho_produto cp on (cp.carrinho_id = c.id)
            INNER JOIN mercado m on ( m.id = c.mercado_id)
            INNER join cliente cli on (cli.id = c.cliente_id)
			WHERE c.mercado_id = :id and c.dataCompra BETWEEN :dataInicial and :dataFinal
			GROUP by c.id, c.dataCompra, c.cliente_id, c.mercado_id,cp.carrinho_id, m.nome, c.status, c.valorPago, cli.nome
			ORDER BY c.dataCompra DESC";

			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);

		}

		public function buscaCompraRealizadaComProdutos($id){
			$sql = "SELECT c.id as idCarrinho, date_format(c.dataCompra, '%d/%m/%Y') as dataCompra, c.cliente_id, c.mercado_id,cp.carrinho_id, 
			cp.quantidade,
            cp.valor,
            p.nome,
            cli.nome as nomeCliente,
            p.foto FROM carrinho c
			inner join carrinho_produto cp on (cp.carrinho_id = c.id)
            INNER JOIN mercado m on ( m.id = c.mercado_id)
			inner join produto p on ( p.id = cp.produto_id)
            left join cliente cli on ( cli.id = c.cliente_id)
			WHERE c.id = :id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		/***********Relatorios***********/

		public function gerarRelatorioProdutoMaisVendidoPorData($mercado, $dataInicial, $dataFinal)
		{
			$sql = "select pro.nome,
			car.mercado_id,
			pro.preco,
			cat.nomeCategoria,
				sum(c.quantidade) as quantos
			from carrinho_produto as c
			 LEFT JOIN carrinho as car on car.id = c.carrinho_id
			 LEFT JOIN produto as pro on c.produto_id = pro.id  
			 LEFT JOIN categoria as cat on cat.id = pro.categoria_id
			 where car.mercado_id = :mercado and car.dataCompra BETWEEN :dataInicial and :dataFinal
			group by pro.nome, car.mercado_id, pro.preco, cat.nomeCategoria
			order 
			by sum(c.quantidade)  desc";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function gerarRelatorioProdutoMaisVendido($mercado)
		{
			$sql = "select pro.nome,
			car.mercado_id,
			pro.preco,
			cat.nomeCategoria,
				sum(c.quantidade) as quantos
			from carrinho_produto as c
			 LEFT JOIN carrinho as car on car.id = c.carrinho_id
			 LEFT JOIN produto as pro on c.produto_id = pro.id  
			 LEFT JOIN categoria as cat on cat.id = pro.categoria_id
			 where car.mercado_id = :mercado
			group by pro.nome, car.mercado_id, pro.preco, cat.nomeCategoria
			order 
			by sum(c.quantidade)  desc";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function gerarRelatorioProdutoNuncaVendidos($mercado, $limit)
		{
			$sql = sprintf("select pro.id,
			pro.nome,
			pro.preco,
			cat.nomeCategoria
			from produto pro
			LEFT JOIN categoria cat on cat.id = pro.categoria_id
			where pro.id not in (select c.produto_id from carrinho_produto c 
								 LEFT JOIN carrinho car on car.id = c.carrinho_id  where car.mercado_id = :mercado)
			LIMIT %s", $limit);
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}
		public function gerarRelatorioProdutoNuncaVendidosAll($mercado)
		{
			$sql = "select pro.id,
			pro.nome,
			pro.preco,
			cat.nomeCategoria
			from produto pro
			LEFT JOIN categoria cat on cat.id = pro.categoria_id
			where pro.id not in (select c.produto_id from carrinho_produto c 
								 LEFT JOIN carrinho car on car.id = c.carrinho_id  where car.mercado_id = :mercado)";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function gerarRelatorioProdutoNuncaVendidosAllData($mercado, $dataInicial, $dataFinal)
		{
			$sql = "select pro.id,
			pro.nome,
			pro.preco,
			cat.nomeCategoria
			from produto pro
			LEFT JOIN categoria cat on cat.id = pro.categoria_id
			where pro.id not in (select c.produto_id from carrinho_produto c 
			LEFT JOIN carrinho car on car.id = c.carrinho_id  where car.mercado_id = :mercado)
			and car.dataCompra BETWEEN :dataInicial and :dataFinal";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_INT);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function gerarRelatorioMercadoMaisVendeAll()
		{
			$sql = "SELECT COUNT(car.mercado_id) as total, m.nome FROM carrinho car
			LEFT JOIN mercado m on m.id = car.mercado_id
			GROUP by m.nome";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function gerarRelatorioMercadoMaisVendeAllData($dataInicial, $dataFinal)
		{
			$sql = "SELECT COUNT(car.mercado_id) as total, m.nome FROM carrinho car
			LEFT JOIN mercado m on m.id = car.mercado_id
			where car.dataCompra BETWEEN :dataInicial and :dataFinal
			GROUP by m.nome";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':dataInicial', $dataInicial);
			$stmt->bindParam(':dataFinal', $dataFinal);
			$stmt->execute();
			return $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

	}	
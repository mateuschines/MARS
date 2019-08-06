<?php

	namespace Produto;

	use Conectar\Config;
	use Conectar\Base;

	class Produto{

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


		public function inserirProduto($nome, $codigoDeBarra, $preco, $categoria_id, $foto, $descricao)
		{
			$sql = "INSERT INTO produto (id, nome, codigoDeBarra, preco, categoria_id, foto, descricao) VALUES (NULL, :nome, :codigoDeBarra, :preco, :categoria_id, :foto, :descricao)";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
			$stmt->bindParam(':codigoDeBarra', $codigoDeBarra, \PDO::PARAM_STR);
			$stmt->bindParam(':preco', $preco, \PDO::PARAM_STR);
			$stmt->bindParam(':categoria_id', $categoria_id, \PDO::PARAM_STR);
			$stmt->bindParam(':foto', $foto, \PDO::PARAM_STR);
			$stmt->bindParam(':descricao', $descricao, \PDO::PARAM_STR);
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

		public function editarProduto($id, $nome, $codigoDeBarra, $preco, $categoria_id, $descricao)
		{
			$sql = "UPDATE produto SET nome = :nome, codigoDeBarra = :codigoDeBarra, preco = :preco, categoria_id = :categoria_id, descricao = :descricao WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
			$stmt->bindParam(':codigoDeBarra', $codigoDeBarra, \PDO::PARAM_STR);
			$stmt->bindParam(':preco', $preco, \PDO::PARAM_STR);
			$stmt->bindParam(':categoria_id', $categoria_id, \PDO::PARAM_STR);
			$stmt->bindParam(':descricao', $descricao, \PDO::PARAM_STR);
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
		
		public function editarProdutoFoto($id, $nome, $codigoDeBarra, $preco, $categoria_id, $foto, $descricao)
		{
			$sql = "UPDATE produto SET nome = :nome, codigoDeBarra = :codigoDeBarra, preco = :preco, categoria_id = :categoria_id, foto = :foto, descricao = :descricao WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':nome', $nome, \PDO::PARAM_STR);
			$stmt->bindParam(':codigoDeBarra', $codigoDeBarra, \PDO::PARAM_STR);
			$stmt->bindParam(':preco', $preco, \PDO::PARAM_STR);
			$stmt->bindParam(':categoria_id', $categoria_id, \PDO::PARAM_STR);
			$stmt->bindParam(':foto', $foto, \PDO::PARAM_STR);
			$stmt->bindParam(':descricao', $descricao, \PDO::PARAM_STR);
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

		public function deletarProduto($id)
		{
			$sql = "DELETE FROM produto WHERE id = :id LIMIT 1";
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

		public function listarProduto()
		{
			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria from produto pro inner join categoria c on pro.categoria_id = c.id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function buscaProduto($id){
			$sql = "SELECT * FROM produto WHERE id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		//para encontrar categoria
		public function buscaPProduto($id){
			$sql = "SELECT * FROM produto WHERE categoria_id = :id LIMIT 1";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchObject();
		}

		public function totalProduto(){
			$sql = "SELECT COUNT(nome) FROM produto";
			$stmt = $this->dbh->preparar($sql);
			$stmt->execute();
			$resultado = $stmt->fetch();
			return $resultado;

		}

		public function jsonListarProduto($id,$mercado)
		{
			//$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria 
			//from produto pro inner join categoria c on (c.id = pro.categoria_id) where pro.id = :id limit 1";

			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria, p.dataInicial, date_format(p.dataFinal, '%d/%m/%Y') as dataFinal, p.preco, m.nome mercado from produto pro 
				inner join categoria c on (c.id = pro.categoria_id) 
				inner join promocao p on (p.produto_id = pro.id) 
				inner join mercado m on (m.id = p.mercado_id) 
				where p.dataInicial <= NOW() and p.dataFinal >= NOW()
				and m.apelido = :mercado 
				and pro.id = :id limit 1";

			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function jsonListarProdutoBarcode($codigoDeBarra,$mercado)
		{
			//$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria 
			//from produto pro inner join categoria c on (c.id = pro.categoria_id) where pro.id = :id limit 1";

			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria, p.dataInicial, date_format(p.dataFinal, '%d/%m/%Y') as dataFinal, p.preco, m.nome mercado from produto pro 
				inner join categoria c on (c.id = pro.categoria_id) 
				inner join promocao p on (p.produto_id = pro.id) 
				inner join mercado m on (m.id = p.mercado_id) 
				where p.dataInicial <= NOW() and p.dataFinal >= NOW()
				and m.apelido = :mercado 
				and pro.codigoDeBarra = :codigoDeBarra limit 1";

			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_STR);
			$stmt->bindParam(':codigoDeBarra', $codigoDeBarra, \PDO::PARAM_STR);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function jsonListarProdutoPromocaoPassada($id,$mercado)
		{
			//$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria 
			//from produto pro inner join categoria c on (c.id = pro.categoria_id) where pro.id = :id limit 1";

			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco as precoProduto,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria, date_format(p.dataInicial, '%d/%m/%Y') as dataInicial, date_format(p.dataFinal, '%d/%m/%Y') as dataFinal, p.preco, m.nome mercado from produto pro 
					inner join categoria c on (c.id = pro.categoria_id) 
					inner join promocao p on (p.produto_id = pro.id) 
					inner join mercado m on (m.id = p.mercado_id) 
					where p.dataFinal < NOW()
					and m.apelido = :mercado
					and pro.id = :id";

			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}


		public function jsonListarCategoria($id)
		{
			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria from produto pro inner join categoria c on (c.id = pro.categoria_id) where pro.categoria_id = :id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function jsonListarCategoriaPromo($id,$mercado)
		{
			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria, p.dataInicial, p.dataFinal, p.preco, m.nome mercado 
				from produto pro 
				inner join categoria c on (c.id = pro.categoria_id) 
				inner join promocao p on (p.produto_id = pro.id) 
				inner join mercado m on (m.id = p.mercado_id) 
				where (p.dataInicial <= NOW() and p.dataFinal >= NOW() )
				and m.apelido = :mercado
				and pro.categoria_id = :id";
			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_STR);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

		public function jsonListarAll($mercado)
		{
			//$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.preco,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria from produto pro inner join categoria c on (c.id = pro.categoria_id) order by rand() limit 4";

			$sql = "SELECT pro.id,pro.nome,pro.codigoDeBarra,pro.categoria_id,pro.foto,pro.descricao, c.nomeCategoria, p.dataInicial, p.dataFinal, p.preco, m.nome mercado from produto pro 
				inner join categoria c on (c.id = pro.categoria_id) 
				inner join promocao p on (p.produto_id = pro.id) 
				inner join mercado m on (m.id = p.mercado_id) 
				where p.dataInicial <= NOW() and p.dataFinal >= NOW()
				and m.apelido = :mercado order by rand() limit 4";

			$stmt = $this->dbh->preparar($sql);
			$stmt->bindParam(':mercado', $mercado, \PDO::PARAM_STR);
			$stmt->execute();
			return $res = $stmt->fetchAll(\PDO::FETCH_CLASS);
		}

	}	
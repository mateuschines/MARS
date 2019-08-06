<?php

	namespace Conectar;

	class Config{
		
		public $tipo, $host, $porta, $base, $usuario, $senha, $dsn;
		
		public function __construct($tipo, $host, $porta, $base, $usuario, $senha)
		{
			$this->tipo = $tipo;
			$this->host = $host;
			$this->porta = $porta;
			$this->base = $base;
			$this->usuario = $usuario;
			$this->senha = $senha;
			$this->dsn = "$tipo:host=$host;dbname=$base;charset=utf8";
		}
		
	}
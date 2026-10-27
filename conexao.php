<?php
class Conexao {
    private $host = 'localhost';
    private $banco = 'loja_cafe';
    private $usuario = 'root';
    private $senha = '';

    public function conectar() {
        try {
            $pdo = new PDO("mysql:host=$this->host;dbname=$this->banco;charset=utf8mb4", $this->usuario, $this->senha);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die('Erro ao conectar: ' . $e->getMessage());
        }
    }
}
<?php
namespace Microblog;

/* Indicamos o uso das classes nativas do PHP (ou seja, classes que não fazem parte do nosso namespace) */
use PDO;
use Exception;


abstract class Banco {
    /* Propriedades/Atributos de acesso ao servidor de Banco de dados */
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "microblog_tiago";
    /* private static \PDO $conexao; não precisa do use PDO */
    private static PDO $conexao; //precisa do use PDO

    /* Método de conexão ao banco */
    public static function conecta():PDO {
        try {
            self::$conexao = new PDO(
                "mysql:host=".self::$servidor.";dbname=".self::$banco.";charset=utf8",
                self::$usuario,
                self::$senha //self:: acessa os atributos de uma classe static 
            );
            
            // Habilita a verificação de erros no código
            self::$conexao->setAttribute(
                PDO::ATTR_ERRMODE, //constante de erros em geral
                PDO::ERRMODE_EXCEPTION // constante de exceções de erro
            );

        } catch (Exception $erro) {
            die("Deu ruim: ".$erro->getMessage());
        }
        return self::$conexao;
    }

}
// Banco::conecta();
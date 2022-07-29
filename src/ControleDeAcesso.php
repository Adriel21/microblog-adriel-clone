<?php 
namespace Microblog;

final class ControleDeAcesso{
    public function __construct()
    {
        /* Se não existir uma sessão em funcionamento */
        if(!isset($_SESSION) ){
            // Então iniciamos a sessão
            session_start();
        }
    }

    public function verificaAcesso():void {
        // Se não existir uma variável de sessão relacionada ao id do usuário logado
        if(!isset($_SESSION['id'])) {
            // Então significa que o usuário não está logado, portanto apague qualquer resquício de sessão e force o usuário a ir para login.php
            session_destroy();
            header("location:../login.php?acesso_proibido");
            exit(); // mesma coisa que o die();
        }
    }

    public function login(int $id, string $nome, string $tipo):void {
        // No momento em que ocorrer o login, adicionamos à sessão variáveis de sessão contendo os dados necessários para o sistema
        
        $_SESSION['id'] = $id; //Session é um array associativo
        $_SESSION['nome'] = $nome;
        $_SESSION['tipo'] = $tipo;
    }

    public function logout():void {
        session_start();
        session_destroy(); 
        header("location:../login.php?logout");
        die(); // exit
    }
}

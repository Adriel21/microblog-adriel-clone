<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";

// Mensagens de feedback relacionados ao acesso
if(isset($_GET['acesso_proibido']) ){
	$feedback = 'Você deve logar primeiro! <span style="color: red"><i class="bi bi-x-circle-fill"></i></span>';
} else if (isset($_GET['campos_obrigatorios'])) {
	$feedback = 'Você deve preencher todos os campos <i class="bi bi-exclamation-octagon"></i>';
}  else if(isset($_GET['nao_encontrado'])) {
	$feedback = 'O email informado não está cadastrado';
} else if(isset($_GET['senha_incorreta'])) {
	$feedback = 'A senha informada está incorreta <span style="color: red"><i class="bi bi-x-circle-fill"></i></span>';
} else if(isset($_GET['logout'])) {
	$feedback = 'Você saiu o sistema';
}
?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

                <?php if(isset($feedback)){?>
				<p class="my-2 alert alert-warning text-center">
					<?=$feedback?>
				</p>
                <?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>


		<?php
		if(isset($_POST['entrar'])){
			//Verificação de campos do formulário
			if(empty($_POST['email']) || empty($_POST['senha'])){
				header("location:login.php?campos_obrigatorios");
			} else {
				// Capturamos o email informado
				$usuario = new Usuario;
				$usuario->setEmail($_POST['email']);

				// Buscando um usuário no banco a partir do e-mail
				$dados = $usuario->buscar();

				//if($dados === false){ - Se dados for false(ou seja, não tem dados de nenhum usuário cadastrado)
				if(!$dados) {
					//echo "Não tem ninguém nessa bagaça!";
					header("location:login.php?nao_encontrado");
				} else {
					// Verificação da senha e login
					if(password_verify($_POST['senha'], $dados['senha']) ) {
						$sessao = new ControleDeAcesso;
						$sessao->login($dados['id'], $dados['nome'], $dados['tipo']);
						header('location:admin/index.php');
					} else {
						header("location:login.php?senha_incorreta");
					}
				}
				
				// Utilitarios::dump($dados);
			}
		}
		?>
    </div>
    
    
</div>        
<?php include_once "inc/todas.php"; ?>
        
    



<?php 
require_once "inc/rodape.php";
?>


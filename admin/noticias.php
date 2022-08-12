<?php

use Microblog\Noticia;
use Microblog\Utilitarios;

require_once "../inc/cabecalho-admin.php";
$noticia = new Noticia;
//capturando o id e o tipo do usuário logado e associando estes valores às propriedades do objeto usuário//
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$listaDeNoticias = $noticia->listar();

// Utilitarios::dump($listaDeNoticias);

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias <span class="badge bg-dark"><?=count($listaDeNoticias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
	<?php if ($noticia->usuario->getTipo() === 'admin') {  ?>			
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Autor</th>
						<th class="text-center">Destaque</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
<?php foreach ($listaDeNoticias as $noticias) {  
	$noticias['autor'] === null?$noticias['autor'] = 'Equipe Microblog':$noticias['autor'] ?>
					<tr>
                        <td><?=$noticias['titulo']?></td>
                        <td><?=date('d/m/Y H:i',  strtotime($noticias['data']))?></td>
						<td><?=Utilitarios::limitaCaractere($noticias['autor'])?></td>
						<td class="text-center"><?=$noticias['destaque']?></td>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php?id=<?=$noticias['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php?id=<?=$noticias['id']?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
						<?php } ?> 
					</tr>

				</tbody>                
			</table>
	</div>

	</article>
</div>
<?php } else { ?>
	<div class="table-responsive">
		
	<table class="table table-hover">
		<thead class="table-light">
			<tr>
				<th>Título</th>
				<th>Data</th>
				<th class="">Operações</th>
			</tr>
		</thead>

		<tbody>
<?php foreach ($listaDeNoticias as $noticias) {  ?>
			<tr>
				<td><?=$noticias['titulo']?></td>
				<td><?=$noticias['data']?></td>
				<td class="text-center">
					<a class="btn btn-warning" 
					href="noticia-atualiza.php?id=<?=$noticias['id']?>">
					<i class="bi bi-pencil"></i> Atualizar
					</a>
				
					<a class="btn btn-danger excluir" 
					href="noticia-exclui.php?id=<?=$noticias['id']?>">
					<i class="bi bi-trash"></i> Excluir
					</a>
				</td>
				<?php } ?> 
			</tr>

		</tbody>                
	</table>
</div>

</article>
</div>
<?php } ?>

<?php 
require_once "../inc/rodape-admin.php";
?>


<?php

use Microblog\Categoria;
use Microblog\Noticia;

require_once "inc/cabecalho.php";

$categoria = new Categoria;
$noticia = new Noticia;
$noticia->setCategoriaId($_GET['id']);

$dados = $noticia->listarPorCategorias();


?>


<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2 class=" ">Notícias sobre <span class="badge bg-primary"><?=$dados['categoria']?></span> </h2>
     
        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
               
                    <a href="noticia.php" class="list-group-item list-group-item-action">
                    <?php foreach ($dados as $dado) { ?>
                        <h3 class="fs-6"><?=$dados['titulo']?></h3>
                        <p><time><?=$dados['data']?></time> - <?=$dados['autor']?></p>
                        <p><?=$dados['resumo']?></p>
                        <?php } ?>
                    </a>
                   
                </div>
            </div>
        </div>
                    
        
          


    </article>
    

</div>        
        
<?php include_once "inc/todas.php"; ?>       

<?php 
require_once "inc/rodape.php";
?>


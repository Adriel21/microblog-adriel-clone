    </div>
</main>

<footer class="footer mt-auto py-3 bg-dark border-top">
    <div class="container text-center text-white">
        Microblog é um site fictício desenvolvido para fins didáticos | Senac Penha &copy; 2022
    </div>
</footer>


<!-- <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


<?php 
switch($pagina){
    case 'usuarios.php':
    case 'noticias.php':
    case 'categorias.php':
?>
<script src="js/confirm.js"></script>
<?php
    break;

    case 'noticia-insere.php':
    case 'noticia-atualiza.php':
?>
<script src="js/contador.js"></script>
<?php
    break;
}
?>
</body>
</html>
<?php ob_end_flush(); ?>
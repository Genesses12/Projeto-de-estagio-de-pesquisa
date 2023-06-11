<?php

require_once "array_noticias.php";

$noticias = $arrayNoticias;

if ($_POST && $_POST['titulo']) {

    $resultadoArray = [];

    foreach ($noticias as $key => $noticia) {

        $resultado = preg_grep('~' . preg_quote($_POST['titulo'], '~') . '~', $noticia);

        if ($resultado) {
            $resultadoArray = array_merge([$noticias[$key]], $resultadoArray);
        }
    }

    $noticias = $resultadoArray;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/noticias.css" />
    <title>Bonafidenews</title>
</head>

<body>
    <header>
        <nav class="cabecalho-principal">
            <div>
                <a href="#">
                    <img class="img-logo" src="assets/img/logo.jpg">
                </a>
            </div>
            <div>
                <a class="cabecalho-principal-nav-link" href="#">Inicio</a>
                <a class="cabecalho-principal-nav-link" href="#">Sobre</a>
                <a class="cabecalho-principal-nav-link" href="#">Notícias</a>
                <a class="cabecalho-principal-nav-link" href="#">Contato</a>
            </div>
        </nav>
    </header>
    <div class="titulo-pagina">
        Notícias
    </div>
    <form method="post" class="form-pesquisa">
        <div class="form-campos">
            <input type="text" name="titulo" value="<?php echo ($_POST && $_POST['titulo']) ? $_POST['titulo'] : ''; ?>" class="campo-titulo" placeholder="Digite sua pesquisa">
            <button type="submit" class="botao-pesquisar">Pesquisar</button>
        </div>
    </form>
    <?php if (!$noticias) { ?>
        <div class="conteudo-sem-resultados">
            <div class="sem-resultados">
                Nenhum resultado encontrado.
            </div>
        </div>
    <?php } ?>
    <div class="conteudo">
        <div class="container">
            <?php
            $i = 0;
            foreach ($noticias as $key => $noticia) {
                $i++;
                if ($i == 5) {
                    $i = 1;
                }
            ?>
                <div class="card-<?php echo $i ?>">
                    <div class="conteudo-img-card">
                        <img class="img-card" src="<?php echo $noticia['imagem'] ?>">
                    </div>
                    <div class="data-card">
                        <small>
                            <?php echo $noticia['data'] ?>
                        </small>
                    </div>
                    <div class="titulo-card">
                        <?php echo $noticia['titulo'] ?>
                    </div>
                    <div class="texto-card">
                        <?php echo $noticia['texto'] ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <footer class="rodape">
        <span><b>Autor: </b> Genesses Fernandes</span>
    </footer>
</body>

</html>
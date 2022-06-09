<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/sgfp.png"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<header>
    <nav class="navbar navbar-light" style="background: #6ba4ff">
        <a class="navbar-brand fw-bold" href="<?= url("/admin"); ?>">
            <img src="<?= theme("/assets/images/sgfp.png"); ?>" width="30" height="30" class="d-inline-block align-top"
                 alt="">
            SGFP
        </a>
    </nav>
</header>

<!--CONTENT-->
<main class="vh-100">
    <div class="container-fluid h-custom">
        <?= $v->section("content"); ?>
    </div>
</main>

<footer>
    <div class="d-flex flex-column text-center text-md-start justify-content-between py-4 px-4 px-xl-5
    footer-block fixed-bottom" style="background: #5c9bff">
        <!-- Copyright -->
        <div class="row">
            <div class="<?php if (!empty($userName)): ?>col-md-9 <?php else: ?>col-md-10<?php endif; ?> text-white mb-3 mb-md-0">
                Copyright &copy; 2022. Todos direitos reservados - <?= CONF_SITE_NAME ?>.
            </div>
            <div class="col-md-3 mb-3 mb-md-0 float-end">
                <a href="<?= url("/") ?>" class="text-decoration-none text-white">&bull; Home</a>
                <a href="<?= url("/termos") ?>" class="text-decoration-none text-white">&bull; Termos de uso</a>
                <a href="<?= url("/admin/logoff") ?>" class="text-decoration-none text-white">&bull; Sair</a>
            </div>
        </div>
        <!-- Copyright -->
    </div>
</footer>

<script src="<?= theme("/assets/scripts.js"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>
</html>
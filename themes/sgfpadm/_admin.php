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

<nav class="py-2 bg-sgfp border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item">
                <a href="#" class="nav-link link-dark px-2 text-white fw-bold active" aria-current="page">
                    Gestão de Finanças
                </a>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-item">
                <a href="#" class="nav-link link-dark px-2 text-white fw-bolder">
                    <?= $date ?>
                </a>
            </li>
        </ul>
    </div>
</nav>
<header class="navbar navbar-expand-lg bg-sgfp-nav-content">
    <div class="container-fluid d-inline">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-center">
                <form>
                    <div class="form-group">
                        <select class="form-control form-select-sm" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <?php for ($i = 2022; $i <= 2030; $i++): ?>
                                <option value="1"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </form>
                <?php for ($i = 1; $i <= 12; $i++): ?>
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#"><?= months($i) ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</header>

<!--CONTENT-->
<main class="vh-100">
    <div class="container-fluid h-custom">
        <?= $v->section("content"); ?>
    </div>
</main>

<footer>
    <div class="d-flex flex-column text-center text-md-start justify-content-between py-4 px-4 px-xl-5
    footer-block fixed-bottom bg-sgfp">
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
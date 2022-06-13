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

<!--CONTENT-->
<!--<main class="vh-100">-->
<main class="main mt-5">
    <div class="container h-custom">
        <?= $v->section("content"); ?>
    </div>
</main>

<footer class="<?= $mtAuthOrForget ?? '' ?>">
    <div class="d-flex flex-column text-center text-md-start justify-content-between py-4 px-4 px-xl-5
    footer-block fixed-bottom">
        <!-- Copyright -->
        <div class="row">
            <div class="col-md-10 text-white mb-3 mb-md-0">
                Copyright &copy; 2022. Todos direitos reservados - <?= CONF_SITE_NAME ?>.
            </div>
            <div class="col-md-2 mb-3 mb-md-0 float-end">
                <a href="<?= url("/") ?>" class="text-decoration-none text-white">&bull; Home</a>
                <a href="<?= url("/termos") ?>" class="text-decoration-none text-white">&bull; Termos de uso</a>
            </div>
        </div>
        <!-- Copyright -->
    </div>
</footer>

<script src="<?= theme("/assets/scripts.js"); ?>"></script>
<?= $v->section("scripts"); ?>

</body>
</html>
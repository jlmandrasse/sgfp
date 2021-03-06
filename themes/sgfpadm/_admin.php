<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/sgfp.png"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/css/style.css", CONF_VIEW_ADMIN); ?>"/>
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<nav class="py-2 bg-sgfp-nav border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item">
                <a href="<?= url("/admin") ?>" class="nav-link link-dark px-2 fw-bold active fs-3"
                   aria-current="page">
                    <img src="<?= theme("/assets/images/sgfp.png"); ?>" alt="" height="40"
                         width="40" title="<?= CONF_SITE_NAME ?>"> Gestão de Finanças
                </a>
            </li>
        </ul>
        <ul class="nav">
            <li class="nav-item mt-3">
                <a href="?month=<?= date("m") ?>&year=<?= date("Y") ?>"
                   class="nav-link link-dark px-2 fw-bolder">
                    <?= $date ?>
                </a>
            </li>
            <li class="nav-item mt-3">
                <a href="<?= url("/admin/logoff") ?>"
                   class="nav-link px-2 fw-bolder text-decoration-none float-end sgfp-rd-payment font-size logout">
                    <i class="fas fa-arrow-right-from-bracket sgfp-rd-payment"></i> Sair
                </a>
            </li>
        </ul>
    </div>
</nav>

<header class="navbar navbar-expand-lg bg-sgfp-nav-content sticky-top">
    <div class="container-fluid d-inline">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-center">
                <form class="sgfp-mr-3">
                    <div class="form-group mt-1">
                        <select onchange="location.replace('?month=<?= $requested->month ?>&year='+this.value)"
                                class="form-control form-select-sm" aria-label="Default select example">
                            <?php for ($year = 2022; $year <= 2030; $year++): ?>
                                <option value="<?= $year ?>"
                                        <?= ($year == $requested->year ? "selected=selected" : "") ?>>
                                    <?= $year ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </form>
                <?php for ($month = 1; $month <= 12; $month++): ?>
                    <li class="nav-item">
                        <a class="nav-link active <?= ($requested->month == $month ? 'bg-month' :
                            'text-white bg-month-else') ?>" aria-current="page"
                           href="?month=<?= $month ?>&year=<?= $requested->year ?>">
                            <?= months($month) ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</header>

<!--CONTENT-->
<!--<main class="vh-100">-->
<main class="main">
    <div class="container-fluid h-custom">
        <?= $v->section("content"); ?>
    </div>
</main>

<footer class="mt-3">
    <div class="d-flex flex-column text-center text-md-start justify-content-between py-4 px-4 px-xl-5
    footer-block bg-sgfp">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<?= $v->section("scripts"); ?>

</body>
</html>
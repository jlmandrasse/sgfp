<?php $v->layout("_theme"); ?>

<div class="container-fluid h-custom" id="overlay">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="<?= theme("/assets/images/sgfp.png"); ?>"
                 class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form class="auth_form" action="<?= url("/"); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_input(); ?>

                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 sgfp-color"><?= CONF_SITE_NAME ?></p>
                </div>

                <div class="ajax_response"><?= flash(); ?></div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label fw-bold sgfp-color" for="email"><i class="fas fa-envelope"></i>
                        E-mail:</label>
                    <input type="email" name="email" id="email" value="<?= ($cookie ?? null); ?>" class="form-control form-control-lg"
                           placeholder="Ex: jlmandrasse@gmail.com"/>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label fw-bold sgfp-color" for="password"><i class="fas fa-unlock"></i>
                        Senha:</label>
                    <input type="password" name="password" id="password" class="form-control form-control-lg"
                           placeholder="Ex: *************"/>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" <?= (!empty($cookie) ? "checked" : ""); ?> name="save" id="remember"/>
                        <label class="form-check-label sgfp-color fw-bold" for="remember">
                            Lembrar dados?
                        </label>
                    </div>
                    <a href="<?= url("/recuperar"); ?>" class="sgfp-color text-decoration-none fw-bold">Esqueceu a
                        senha?</a>
                </div>
                <div class="d-grid mt-2 mb-5 button-auth">
                    <button class="btn-auth">Entrar</button>
                    <p hidden class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                                                                                             class="link-danger">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
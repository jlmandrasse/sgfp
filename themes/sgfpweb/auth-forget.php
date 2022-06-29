<?php $v->layout("_theme"); ?>

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-md-6 col-lg-6 col-xl-5">
        <img src="<?= theme("/assets/images/sgfp.png"); ?>" class="img-fluid" alt="Sample image">
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4 offset-xl-1">
        <form class="auth_form" data-reset="true" action="<?= url("/recuperar"); ?>" method="post"
              enctype="multipart/form-data">
            <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 sgfp-color">
                    Informe seu e-mail para receber um link de recuperação.
                </p>
            </div>

            <div class="ajax_response"><?= flash(); ?></div>
            <?= csrf_input(); ?>

            <div class="form-outline mb-4">
                <label class="form-label fw-bold sgfp-color" for="email"><i class="fas fa-envelope"></i>
                    E-mail:</label>
                <span class="ml-sgfp-forget">
                    <a title="Recuperar senha" href="<?= url(); ?>" class="text-decoration-none sgfp-color fw-bold">
                        Voltar e entrar!
                    </a>
                </span>
                <input type="email" id="email" name="email" class="form-control form-control-lg"
                       placeholder="Ex: jlmandrasse@gmail.com" required/>
            </div>
            <div class="d-grid mt-2 mb-5 button-auth">
                <button class="btn-auth text-uppercase">
                    <i class="fas fa-arrow-circle-right"></i> Recuperar
                </button>
            </div>
        </form>
    </div>
</div>
<?php $v->layout("_theme"); ?>

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-md-6 col-lg-6 col-xl-5">
        <img src="<?= theme("/assets/images/sgfp.png"); ?>" class="img-fluid" alt="Sample image">
    </div>
    <div class="col-md-6 col-lg-6 col-xl-4 offset-xl-1">
        <form class="auth_form" action="<?= url("/recuperar/resetar"); ?>" method="post"
              enctype="multipart/form-data">

            <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 sgfp-color">
                    Criar nova senha<br>
                    Informe e repita uma nova senha para recuperar seu acesso.
                </p>
            </div>

            <div class="ajax_response"><?= flash(); ?></div>
            <input type="hidden" name="code" value="<?= $code; ?>"/>
            <?= csrf_input(); ?>

            <div class="form-outline mb-4">
                <label class="form-label fw-bold sgfp-color" for="password">
                    <i class="fas fa-envelope"></i> Nova Senha:
                </label>
                <span style="margin-left: 14.7vh">
                    <a title="Recuperar senha" href="<?= url(); ?>" class="text-decoration-none sgfp-color fw-bold">
                        Voltar e entrar!
                    </a>
                </span>
                <input type="password" id="password" name="password" class="form-control form-control-lg"
                       placeholder="Nova senha:" required/>
            </div>
            <div class="form-outline mb-4">
                <label class="form-label fw-bold sgfp-color" for="password_re">
                    <i class="fas fa-envelope"></i> Repita a nova senha:
                </label>
                <input type="password" id="password_re" name="password_re" class="form-control form-control-lg"
                       placeholder="Repita a nova senha:" required/>
            </div>
            <div class="d-grid mt-2 mb-5 button-auth">
                <button class="btn-auth text-uppercase">
                    <i class="fas fa-arrow-circle-right"></i> Alterar Senha
                </button>
            </div>
        </form>
    </div>
</div>
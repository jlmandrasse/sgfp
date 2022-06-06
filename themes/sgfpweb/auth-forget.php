<?php $v->layout("_theme"); ?>

<div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="<?= theme("/assets/images/sgfp.png"); ?>"
                 class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form>
                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 sgfp-color">Informe seu e-mail para receber um link de
                        recuperação.</p>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label fw-bold sgfp-color" for="email"><i class="fas fa-envelope"></i>
                        E-mail:</label>
                    <span style="margin-left: 34.5vh"><a title="Recuperar senha" href="<?= url(); ?>"
                                                         class="text-decoration-none sgfp-color fw-bold">Voltar e entrar!</a></span>
                    <input type="email" id="email" class="form-control form-control-lg"
                           placeholder="Ex: jlmandrasse@gmail.com"/>
                </div>
                <div class="d-grid mt-2 mb-5 button-auth">
                    <button class="btn-auth" type="button">Recuperar</button>
                </div>
            </form>
        </div>
    </div>
</div>

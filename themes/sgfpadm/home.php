<?php $v->layout("_admin"); ?>

    <div class="container">

        <div class="my-1 mt-5">
            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#categoryModal"
                    data-bs-whatever="@mdo">
                [<i class="fas fa-add"></i>] Adicionar categoria
            </button>

            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#movementModal"
                    data-bs-whatever="@mdo">
                [<i class="fas fa-add"></i>] Adicionar movimento
            </button>
        </div>

        <div class="ajax_response mt-2"> <?= flash(); ?> </div>

        <div class="card text-center my-1">
            <div class="card-header">
                <span class="float-start fw-bold">SGFP</span>
                <span class="float-end">
                    <?= months($requested->month) . "/" . $requested->year ?>
                </span>
            </div>
            <div class="card-body">
                <div class="row align-items-md-stretch">
                    <div class="col-md-6 my-2">
                        <div class="h-100 p-5 border border-4 rounded-3">
                            <div class="row">
                                <header class="fw-bold text-sm-center">Entradas e Saídas deste mês</header>
                                <hr>
                                <hr>
                                <div class="row sgfp-rd-income">
                                    <div class="col-md-6 d-flex">
                                        <h4>Entradas:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4>
                                            <?php
                                            if (!empty($totalAmount)):
                                                foreach ($totalAmount as $amount):
                                                    $totalPerMonth = $amount->money;
                                                endforeach;
                                                echo str_amount($totalPerMonth);
                                            endif;
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row sgfp-rd-payment">
                                    <div class="col-md-6 d-flex">
                                        <h4>Saídas:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4>
                                            <?php
                                            if (!empty($totalUsed)):
                                                foreach ($totalUsed as $amount):
                                                    $totalPerMonth = $amount->money;
                                                endforeach;
                                                echo str_amount($totalPerMonth);
                                            endif;
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="row text-success">
                                    <div class="col-md-6 d-flex">
                                        <h4 class="fw-bold">Resultado:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4 class="fw-bold">
                                            <?php
                                            if (!empty($totalAmount)):
                                                foreach ($totalAmount as $amount):
                                                    $totalPerMonth = $amount->money;
                                                endforeach;
                                                echo str_amount($totalPerMonth);
                                            endif;
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-2">
                        <div class="h-100 p-5 border border-4 rounded-3">
                            <div class="row">
                                <header class="fw-bold text-sm-center">Balanço Geral</header>
                                <hr>
                                <hr>
                                <div class="row sgfp-rd-income">
                                    <div class="col-md-6 d-flex">
                                        <h4>Entradas:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4>
                                            <?php
                                            if (!empty($totalAmount) || !empty($total)):
                                                foreach ($totalAmount as $amount):
                                                    $total += $amount->money;
                                                endforeach;
                                                echo str_amount($total);
                                            endif;
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row sgfp-rd-payment">
                                    <div class="col-md-6 d-flex">
                                        <h4>Saídas:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4><?= str_amount('') ?></h4>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="row text-success">
                                    <div class="col-md-6 d-flex">
                                        <h4 class="fw-bold">Resultado:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4 class="fw-bold">
                                            <?php
                                            if (!empty($totalUsed) || !empty($total)):
                                                foreach ($totalUsed as $amount):
                                                    $total -= $amount->money;
                                                endforeach;
                                                echo str_amount($total);
                                            endif;
                                            ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-md-stretch mt-4">
                    <div class="col-md-6">
                        Movimentos deste Mês
                    </div>
                    <div class="col-3">
                        <label for="filter">Filtrar por categoria: </label>
                    </div>
                    <div class="col-2">
                        <select name="filter" class="form-control form-select-sm" id="filter">
                            <option value="all">Tudo</option>
                            <?php if (!empty($categories)): foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-outline-primary btn-sm">Filtrar</button>
                    </div>
                </div>
                <div class="container row mt-5">
                    <hr>
                </div>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </div>

    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title" id="exampleModalLabel">Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/create-category"); ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="col-form-label fw-bold">Nova Categoria:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="movementModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title" id="exampleModalLabel">Movimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/create-launch"); ?>" method="post">
                        <div class="mb-3">
                            <label for="date" class="col-form-label fw-bold">Data:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <strong>Tipo:<br/></strong>
                            <label for="incomeType" class="col-form-label sgfp-rd-income">
                                <input type="radio" name="type" value="1" id="incomeType"/> Receita
                            </label>&nbsp;
                            <label for="paymentType" class="col-form-label sgfp-rd-payment">
                                <input type="radio" name="type" value="0" id="paymentType"/> Despesa
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="categories_id" class="col-form-label fw-bold">Categoria:</label>
                            <select class="form-control form-select" id="categories_id" name="categories_id">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label fw-bold">Descrição:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="money" class="col-form-label fw-bold">Valor:</label>
                            <input type="text" class="form-control" id="money" name="money">
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $v->start("scripts"); ?>
    <script>
        $(document).ready(function () {
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            if (month < 10) month = "0" + month;
            if (day < 10) day = "0" + day;
            var today = year + "-" + month + "-" + day;
            $("#date").attr("value", today);
        });
    </script>
<?php $v->end(); ?>
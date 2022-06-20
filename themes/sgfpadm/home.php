<?php $v->layout("_admin"); ?>

    <div class="container">

        <div class="my-1 mt-5 fw-bold">
            <label class="m-1"> Categoria:
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal"
                        data-bs-whatever="@mdo">
                    <i class="fas fa-add"></i>
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm btn-read-cat">
                    <i class="fas fa-eye"></i>
                </button>
            </label>

            <label> Movimento:
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createMovementModal"
                        data-bs-whatever="@mdo">
                    <i class="fas fa-add"></i>
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm btn-read-mov">
                    <i class="fas fa-eye"></i>
                </button>
            </label>
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
                <div id="id_main_card_body">
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
                <div class="edit-category d-none">
                    <h3 class="fw-bold">Lista de Categorias</h3>
                    <hr>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data e hora de criação</th>
                            <th scope="col">Data da última atualização</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $key => $category): ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $category->name ?></td>
                                <td><?= $category->created_at ?></td>
                                <td><?= $category->updated_at ?></td>
                                <td colspan="2">
                                    <button data-route="<?= url("/admin/read-category") ?>"
                                            class="btn btn-outline-primary btn-sm read-category m-category"
                                            data-id="<?= $category->id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-route="<?= url("/admin/read-category") ?>"
                                            class="btn btn-outline-danger btn-sm read-category"
                                            data-delete="delete" data-id="<?= $category->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="edit-launch d-none">
                    <h3 class="fw-bold">Lista de Lançamentos</h3>
                    <hr>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Montante</th>
                            <th scope="col">Data e hora de criação</th>
                            <th scope="col">Data da última atualização</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($launches as $key => $launch): ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $launch->type ?></td>
                                <td><?= $launch->category ?></td>
                                <td><?= $launch->description ?></td>
                                <td><?= $launch->amount ?></td>
                                <td><?= $launch->created_at ?></td>
                                <td><?= $launch->updated_at ?></td>
                                <td colspan="2">
                                    <button data-route="<?= url("/admin/read-launch") ?>"
                                            class="btn btn-outline-primary btn-sm read-launch m-category"
                                            data-id="<?= $launch->id ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-route="<?= url("/admin/read-launch") ?>"
                                            class="btn btn-outline-danger btn-sm read-launch"
                                            data-delete="delete" data-id="<?= $launch->id ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-muted">
                2 days ago
            </div>
        </div>
    </div>

    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/create-category"); ?>" method="post"
                    autocomplete="off">
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

    <div class="modal fade" id="updateCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Atualizar Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/update-category"); ?>" method="post"
                    autocomplete="off">
                        <div class="mb-3 d-none">
                            <label for="categoryId" class="col-form-label fw-bold">Id da categoria:</label>
                            <input type="text" class="form-control" id="categoryId" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="categoryName" class="col-form-label fw-bold">Novo nome da categoria:</label>
                            <input type="text" class="form-control" id="categoryName" name="name">
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Excluir Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/delete-category"); ?>" method="post">
                        <div class="mb-3 d-none">
                            <label for="id" class="col-form-label fw-bold">Id da categoria:</label>
                            <input type="text" class="form-control" id="id" name="id">
                        </div>
                        <div class="mb-3">
                            <h4 class="text-secondary fw-bold">
                                Deseja remover a categoria <span class="text-warning" id="categoryNameDel"></span>?
                            </h4>
                            <p class="text-secondary">
                                <span class="fw-bold">Atenção:</span>
                                <span class="text-danger">
                                    apenas categorias sem movimentos associados poderão ser removidas.
                                </span>
                            </p>
                            <p class="text-secondary">Essa ação não poderá ser refeita. Caso seja excluída.</p>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <button class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createMovementModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Movimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/create-launch"); ?>" method="post"
                    autocomplete="off">
                        <div class="mb-3">
                            <label for="date" class="col-form-label fw-bold">Data:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <strong>Tipo:<br/></strong>
                            <label for="incomeType" class="col-form-label sgfp-rd-income">
                                <input type="radio" name="type_id" value="<?= $type[0]->id ?>" id="incomeType"/>
                                <?= $type[0]->name ?>
                            </label>&nbsp;
                            <label for="paymentType" class="col-form-label sgfp-rd-payment">
                                <input type="radio" name="type_id" value="<?= $type[1]->id ?>" id="paymentType"/>
                                <?= $type[1]->name ?>
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

    <div class="modal fade" id="updateMovementModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Atualizar Movimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form name="update_launch" class="auth_form" action="<?= url("/admin/update-launch"); ?>"
                          method="post" autocomplete="off">
                        <div class="mb-3 d-none">
                            <label for="launchId" class="col-form-label fw-bold">Id do movimento:</label>
                            <input type="text" class="form-control" id="launchId" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="launchDate" class="col-form-label fw-bold">Data:</label>
                            <input type="date" class="form-control" id="launchDate" name="date">
                        </div>
                        <div class="mb-3">
                            <strong>Tipo:<br/></strong>
                            <label for="incomeType" class="col-form-label sgfp-rd-income">
                                <input type="radio" name="types_id" value="<?= $type[0]->id ?>"
                                       id="incomeType"/>
                                <?= $type[0]->name ?>
                            </label>&nbsp;
                            <label for="paymentType" class="col-form-label sgfp-rd-payment">
                                <input type="radio" name="types_id" value="<?= $type[1]->id ?>" id="paymentType"/>
                                <?= $type[1]->name ?>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="lCategoryId" class="col-form-label fw-bold">Categoria:</label>
                            <select class="form-control form-select" id="lCategoryId" name="categories_id">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lDescription" class="col-form-label fw-bold">Descrição:</label>
                            <textarea class="form-control" id="lDescription" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lMoney" class="col-form-label fw-bold">Valor:</label>
                            <input type="text" class="form-control" id="lMoney" name="money">
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteMovementModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white fw-bold bg-sgfp">
                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Excluir Movimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-sgfp-nav">
                    <form class="auth_form" action="<?= url("/admin/delete-movement"); ?>" method="post">
                        <div class="mb-3 d-none">
                            <label for="id" class="col-form-label fw-bold">Id do movimento:</label>
                            <input type="text" class="form-control" id="idMov" name="id">
                        </div>
                        <div class="mb-3">
                            <h4 class="text-secondary fw-bold">
                                Deseja remover este movimento?
                            </h4>
                            <p class="text-secondary">Essa ação não poderá ser refeita. Caso seja deletado.</p>
                        </div>
                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <button class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $v->start("scripts"); ?>
    <script src="<?= theme("/assets/js/script.js", CONF_VIEW_ADMIN) ?>"></script>
<?php $v->end(); ?>
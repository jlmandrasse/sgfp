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

        <div class="card text-center my-1">
            <div class="card-header">
                <span class="float-start">Featured</span>
                <span class="float-end">Junho de 2022</span>
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
                                        <h4>0,00MZN</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row sgfp-rd-payment">
                                    <div class="col-md-6 d-flex">
                                        <h4>Saídas:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4>0,00MZN</h4>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="row text-success">
                                    <div class="col-md-6 d-flex">
                                        <h4 class="fw-bold">Resultado:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4 class="fw-bold">0,00MZN</h4>
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
                                        <h4>0,00MZN</h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row sgfp-rd-payment">
                                    <div class="col-md-6 d-flex">
                                        <h4>Saídas:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4>0,00MZN</h4>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="row text-success">
                                    <div class="col-md-6 d-flex">
                                        <h4 class="fw-bold">Resultado:</h4>
                                    </div>
                                    <div class="col-md-6 float-end">
                                        <h4 class="fw-bold">0,00MZN</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nova Categoria:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
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
                <div class="modal-body">
                    <form>
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
                            <label for="recipient-name" class="col-form-label fw-bold">Data:</label>
                            <select class="form-control form-select" aria-label="Default select example">
                                <option selected>Selecionar categoria</option>
                                <?php for ($i = 2022; $i <= 2030; $i++): ?>
                                    <option value="1"><?= $i ?></option>
                                <?php endfor; ?>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
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
            var today = year + "-" + day + "-" + month;
            $("#date").attr("value", today);
        });
    </script>
<?php $v->end(); ?>
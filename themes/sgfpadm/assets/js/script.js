$(document).ready(function () {
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    $("#date").attr("value", today);

    $(".read-category").on("click", function () {

        var data = $(this);
        var action = data.attr("data-route");
        var categoryId = data.attr("data-id");
        var verify = data.attr("data-delete");

        $.ajax({
            url: action,
            type: "post",
            data: {id: categoryId},
            dataType: "json",
            success: function (response) {

                if (verify) {
                    $("#id").val(response.category.id);
                    $("#categoryNameDel").html(response.category.name);
                    $('#deleteCategoryModal').modal('show');
                } else {
                    $("#categoryId").val(response.category.id);
                    $("#categoryName").val(response.category.name);
                    $('#updateCategoryModal').modal('show');
                }
            }
        });
    });

    $(".read-launch").on("click", function () {

        var data = $(this);
        var action = data.attr("data-route");
        var launchId = data.attr("data-id");
        var verify = data.attr("data-delete");

        $.ajax({
            url: action,
            type: "post",
            data: {id: launchId},
            dataType: "json",
            success: function (response) {

                if (verify) {
                    $("#idMov").val(response.launch.id);
                    $('#deleteMovementModal').modal('show');
                } else {

                    if (response.launch.type == 1) {
                        document.update_launch.paymentType.checked = false;
                        document.update_launch.incomeType.checked = true;
                    } else {
                        document.update_launch.incomeType.checked = false;
                        document.update_launch.paymentType.checked = true;
                    }

                    $("#launchId").val(response.launch.id);
                    $("#launchDate").val(response.launch.date);
                    $("#lDescription").val(response.launch.description);
                    $("#lMoney").val(response.launch.money);
                    document.getElementById("lCategoryId").innerHTML =
                        `<option value=${response.launch.category.id}>${response.launch.category.name}</option>`;
                    $('#updateMovementModal').modal('show');
                }
            }
        });
    });
});

$(".btn-read-cat").click(function () {
    if (document.getElementById("id_main_card_body").style.display == "") {
        $("#id_main_card_body").slideUp(600);
        $(".edit-category").removeClass("d-none");
        $(".edit-launch").addClass("d-none");
    } else {
        $("#id_main_card_body").slideDown(600);
        $(".edit-category").addClass("d-none");
        $(".edit-launch").addClass("d-none");
    }
});

$(".btn-read-mov").click(function () {
    if (document.getElementById("id_main_card_body").style.display == "") {
        $("#id_main_card_body").slideUp(600);
        $(".edit-launch").removeClass("d-none");
        $(".edit-category").addClass("d-none");
    } else {
        $("#id_main_card_body").slideDown(600);
        $(".edit-launch").addClass("d-none");
        $(".edit-category").addClass("d-none");
    }
});

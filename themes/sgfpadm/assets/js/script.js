$(document).ready(function () {
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    $("#date").attr("value", today);

    $(".read-category").on("click", function(){

        var data = $(this);
        var action = data.attr("data-route");
        var categoryId = $(this).data("id");

        $.ajax({
            url: action,
            type: "post",
            data: {categoryId: categoryId},
            dataType: "json",
            success: function (response) {
                $("#categoryId").val(response.category.id);
                $("#categoryName").val(response.category.name);
                $('#updateCategoryModal').modal('show');
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

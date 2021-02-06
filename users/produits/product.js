$(document).ready(function(e) {
    // Ajouter un produit
    $(".newProduct").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "../newProduct.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#resultSendProduct").html(data).slideDown();
                $("#name").val("");
                $("#prix").val("");
                $("#description").val("");
                $("#img_prod").val("");
            },
            error: function() {
                $("#resultSendProduct").html(data).slideDown();
            },
        });
    });
});
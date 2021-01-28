$(".updateProduct").on("submit", function(e) {
    e.preventDefault();
    // modifier mon produit
    $.ajax({
        url: "../updateProduct.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $("#resultSendProductU").html(data).slideDown();
        },
        error: function() {
            $("#resultSendProductU").html(data).slideDown();
        },
    });
});

// Ajouter une image pour un produit
$(".newImageProd").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        url: "../images_prod/newPicture.php",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            $("#resultSendProductI").html(data).slideDown();
        },
        error: function() {
            $("#resultSendProductI").html(data).slideDown();
        },
    });
});

// supprimer un produit
$("#deleteProd").on("click", function(e) {
    e.preventDefault();
    var $a = $(this);
    var url = $a.attr("href");
    $.ajax(url, {
        type: "GET",
        success: function(data) {
            $(".resultadeleteProd").html(data).slideDown();

        },
        error: function(data) {
            $(".resultadeleteProd").html(data).slideDown();
        },
    });
});
// supprimer une image d'un produit
$("#deleteImageProd").on("click", function(e) {
    e.preventDefault();
    var $a = $(this);
    var url = $a.attr("href");
    $.ajax(url, {
        type: "GET",
        success: function(data) {
            $(".resultadeleteImage").html(data).slideDown();
            $a.parents("#cardProdImage").remove();
        },
        error: function(data) {
            $(".resultadeleteImage").html(data).slideDown();
        },
    });
});
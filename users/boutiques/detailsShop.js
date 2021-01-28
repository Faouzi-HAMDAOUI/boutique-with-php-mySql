$(document).ready(function(e) {
    // modifier une boutique
    $(".updateShop").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "../updateShop.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#resultSend").html(data).slideDown();
            },
            error: function() {
                $("#resultSend").html(data).slideDown();
            },
        });
    });

    // Ajouter une image pour une boutique
    $(".addImageShop").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "../images/newImage.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#resultSendImage").html(data).slideDown();
            },
            error: function() {
                $("#resultSendImage").html(data).slideDown();
            },
        });
    });

    // supprimer une boutique
    $("#delete").on("click", function(e) {
        e.preventDefault();
        var $a = $(this);
        var url = $a.attr("href");
        $.ajax(url, {
            type: "GET",
            success: function() {
                //$("#resultSendImage").html(data).slideDown();
                $a.parents("#cardShop").remove();
            },
            error: function(data) {
                $("#resultDeleteShop").html(data).slideDown();
            },
        });
    });

    // supprimer une image d'une boutique
    $("#deleteImage").on("click", function(e) {
        e.preventDefault();
        var $a = $(this);
        var url = $a.attr("href");
        $.ajax(url, {
            type: "GET",
            success: function(data) {
                $(".resultadeleteImage").html(data).slideDown();
                $a.parents("#cardShopImage").remove();
            },
            error: function(data) {
                $(".resultadeleteImage").html(data).slideDown();
            },
        });
    });

    // function getMyShop() {
    //     $.post("../getOnShop.php", function(data) {
    //         $(".afficher").html(data);
    //     });
    // }

    // function getMyShops() {

    //     var xmlhttp = new XMLHttpRequest();
    //     xmlhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             $(".afficher").html(responseText) = this.responseText;
    //         }
    //     };
    //     xmlhttp.open("GET", "./boutiques/getShops.php", true);
    //     xmlhttp.send();

    // }
});
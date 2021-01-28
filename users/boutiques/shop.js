$(document).ready(function(e) {
    getMyShops(); // récupérer mes boutique

    //Ajouter une boutique 
    $(".addShops").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "./boutiques/newShop.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#resultSend").html(data).slideDown();
                getMyShops();
                $("#title").val('');
                $("#adresse").val('');
                $("#description").val('');
                $("#img_bout").val('');
            },
            error: function(data) {
                $("#resultSend").html(data).slideDown();
            },
        });
    });

    // récupérer mes boutiques
    function getMyShops() {
        $.post("./boutiques/getShops.php", function(data) {
            $(".afficher").html(data);
        });
    }

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
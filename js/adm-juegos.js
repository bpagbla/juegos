console.log("perfe");

document.getElementById("titulo").addEventListener("focusout", function () {
    console.log("aja");
    var xhr = new XMLHttpRequest();

    /* EL LINK FALTA */
    xhr.open("GET", "", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);
        } else {
            console.log(`Error: Status ${xhr.status} - ${xhr.responseText}`);
        }
    };
    xhr.send();
})

$(document).ready(function () {
    console.log("hola")
    //buscar generos
    $("#buscarGen").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        // Excluir el input del filtro y buscar en los <li>
        $("#listaGeneros li").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    //buscar sistemas
    $("#buscarSist").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        // Excluir el input del filtro y buscar en los <li>
        $("#listaSist li").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

});


$(document).ready(function () {
    $("#buscarGen").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        // Excluir el input del filtro y buscar en los <li>
        $("#listaGeneros li").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
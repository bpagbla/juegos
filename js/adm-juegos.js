$(document).ready(function () {
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

// Seleccionar los elementos
const inputPortada = document.getElementById('file');
const imgPreview = document.getElementById('portada');

// Escuchar el evento change del input de archivo
inputPortada.addEventListener('change', function (event) {
    const file = event.target.files[0]; // Obtener el archivo seleccionado
    // Verificar si se seleccionó un archivo y si es una imagen
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();

        // Leer el archivo y actualizar el src del img
        reader.onload = function (e) {
            imgPreview.src = e.target.result; // Establecer la ruta de la imagen
            document.getElementById("fileSrc").value = null;
        };

        reader.readAsDataURL(file); // Leer el archivo como URL
    } else {
        imgPreview.src = ''; // Limpiar la previsualización si no es válido
        alert('Por favor, selecciona un archivo de imagen válido.');
    }
});



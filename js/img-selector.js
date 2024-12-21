const selectImage = document.querySelector('.select-img');
const inputFile = document.querySelector('#file');
const portada = document.querySelector('.portada');

selectImage.addEventListener('click', function () {
    inputFile.click();
});

inputFile.addEventListener('change', function () {
    const image = this.files[0];
    if (image.size < 2000000) { // Verifica que el tamaño sea menor a 2MB
        const reader = new FileReader();
        reader.onload = () => {
            const imgUrl = reader.result;
            portada.src = imgUrl; // Reemplaza la imagen de la clase "portada"
        };
        reader.readAsDataURL(image); // Lee el archivo como una URL de datos (base64)
    } else {
        alert("El tamaño de la imagen debe ser menor a 2MB");
    }
});

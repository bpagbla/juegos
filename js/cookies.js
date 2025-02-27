document.querySelectorAll('.cookie-button').forEach((e) => {
    e.addEventListener('click', function () {
        document.getElementById('div-cookies').classList.add('d-none');
        localStorage.setItem('cookies', 'true');
    })
})

if (localStorage.getItem('cookies') !== null) {
    document.getElementById('div-cookies').classList.add('d-none');
}

const myModal = new bootstrap.Modal('#modal', {
    keyboard: false
})

document.getElementById('cookie-link').addEventListener('click', function () {
    myModal.show();
})
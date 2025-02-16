(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

const firstName = document.getElementById('firstName')
const lastName = document.getElementById('lastName')
const dir1 = document.getElementById('address')
const dir2 = document.getElementById('address2')
const country = document.getElementById('country')
const state = document.getElementById('state')
const zip = document.getElementById('zip')

if (localStorage.getItem('firstName') !== null) {
    firstName.value = localStorage.getItem('firstName')
    lastName.value = localStorage.getItem('lastName')
    dir1.value = localStorage.getItem('address')
    dir2.value = localStorage.getItem('address2')
    country.value = localStorage.getItem('country')
    state.value = localStorage.getItem('state')
    zip.value = localStorage.getItem('zip')
}

function save() {
    localStorage.setItem('firstName', firstName.value)
    localStorage.setItem('lastName', lastName.value)
    localStorage.setItem('address', dir1.value)
    localStorage.setItem('address2', dir2.value)
    localStorage.setItem('country', country.value)
    localStorage.setItem('state', state.value)
    localStorage.setItem('zip', zip.value)
}


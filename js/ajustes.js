let passwd1 = document.getElementById("passwd1")
let passwd2 = document.getElementById("passwd2")

passwd1.addEventListener('input', function() {
    if (!passwd1.value && !passwd2.value) {
        passwd1.classList.remove('success-input')
        passwd2.classList.remove('success-input')
        passwd1.classList.remove('error-input')
        passwd2.classList.remove('error-input')
        return;
    }

    if (!passwd2.value) {return;}

    if (passwd1.value === passwd2.value) {
        passwd1.classList.remove('error-input')
        passwd2.classList.remove('error-input')
        passwd1.classList.add('success-input')
        passwd2.classList.add('success-input')
    } else {
        passwd1.classList.add('error-input')
        passwd2.classList.add('error-input')
        passwd1.classList.remove('success-input')
        passwd2.classList.remove('success-input')
    }

})

passwd2.addEventListener('input', function() {
        if (passwd1.value === passwd2.value) {
            passwd1.classList.remove('error-input')
            passwd2.classList.remove('error-input')
            if (!passwd1.value && !passwd2.value) {
                passwd1.classList.remove('success-input')
                passwd2.classList.remove('success-input')
            } else {
                passwd1.classList.add('success-input')
                passwd2.classList.add('success-input')
            }
        } else {
            passwd1.classList.add('error-input')
            passwd2.classList.add('error-input')
            passwd1.classList.remove('success-input')
            passwd2.classList.remove('success-input')
        }
})
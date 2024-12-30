const myModal = new bootstrap.Modal('#myModal', {
    keyboard: false
})
myModal.show();

function showLoading(elem) {
    elem.innerHTML = '<li class="list-group-item"><span class="placeholder w-75"></span></li><li class="list-group-item"><span class="placeholder w-75"></span></li><li class="list-group-item"><span class="placeholder w-75"></span></li>'
}

function createButton(name, value, display) {
    const button = document.createElement('div')
    button.classList.add('col-auto')
    button.classList.add('p-0')
    button.classList.add('m-2')
    button.innerHTML = '<button type="button" class="btn btn-sm btn-primary">' + display + '<svg class="bg-transparent" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <use href="#remove"></use></svg></button><input type="hidden" name="' + name + '" value="' + value + '"><input type="hidden" name="' + name.replace('[]','') + value + '" value="' + display + '">'
    return button;
}

const modal = document.getElementById('myModal')

async function setCompanies(id, platform) {
    const companies = await fetch('http://localhost/?page=api&endpoint=games&format=normal&id=' + id + '&platform=' + platform)
    const companiesJson = await companies.json()
    let pub_id = ''
    let dev_id = ''
    let pub_name = ''
    let dev_name = ''
    companiesJson.releases[0].companies.forEach((company) => {
        if (company.role === 'Published by') {
            pub_id = company.company_id
            pub_name = company.company_name
        }
        if (company.role === 'Developed by') {
            dev_id = company.company_id
            dev_name = company.company_name
        }
    })

    if (pub_id === '' && dev_id !== '') {
        pub_id = dev_id
        pub_name = dev_name
    }

    if (dev_id === '' && pub_id !== '') {
        dev_id = pub_id
        dev_name = pub_name
    }

    const placementDev = document.getElementById('dev-active')
    placementDev.innerHTML = '';
    const buttonDev = createButton('dev', dev_id, dev_name)
    placementDev.appendChild(buttonDev)
    buttonDev.addEventListener('click', function (e) { e.target.closest("div").remove() })

    const placement = document.getElementById('dis-active')
    placement.innerHTML = '';
    const button = createButton('dis', pub_id, pub_name)
    placement.appendChild(button)
    button.addEventListener('click', function (e) { e.target.closest("div").remove() })

    document.getElementById('blackout').remove()
}

//Distribuidores

let timeoutDis = ''
const dis = document.getElementById('dis')
const sugerenciasDis = document.getElementById('sugerencias-dis')
const listDis = document.getElementById('sugerencias-list-dis')
let pendingDis = true;

dis.addEventListener('focus', function (e) {
    sugerenciasDis.classList.remove('d-none')
    if (pendingDis) {
        loadNamesDis(e)
        pendingDis = false;
    }
    function closeDis(e) {
        if (e.target !== dis) {
            sugerenciasDis.classList.add('d-none')
            modal.removeEventListener('click', closeDis)
        }
    }
    modal.addEventListener('click', closeDis)
})
dis.addEventListener('input', startQueueDis)

function startQueueDis(e) {
    showLoading(listDis)
    clearTimeout(timeoutDis)
    timeoutDis = setTimeout(function () { loadNamesDis(e) }, 200);
}

async function loadNamesDis(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=companies&name=' + e.target.value)
    const json = await response.json()
    if (json.hasOwnProperty('companies')) {
        let length = json.companies.length
        if (length > 0) {
            listDis.innerHTML = ''
            for (let i = 0; i < length; i++) {
                const el = document.createElement('li')
                el.classList.add('list-group-item')
                el.innerText = json.companies[i].name
                listDis.appendChild(el)
                el.addEventListener('click', function () {
                    const placement = document.getElementById('dis-active')
                    placement.innerHTML = '';
                    const button = createButton('dis', json.companies[i].company_id, json.companies[i].name)
                    placement.appendChild(button)
                    button.addEventListener('click', function (e) { e.target.closest("div").remove() })
                })
            }
        } else {
            listDis.innerHTML = ''
            const el = document.createElement('li')
            el.classList.add('list-group-item')
            el.innerText = 'No hay resultados'
            listDis.appendChild(el)
        }
    }
}

//Desarrolladores
let timeoutDev = ''
const dev = document.getElementById('dev')
const sugerenciasDev = document.getElementById('sugerencias-dev')
const listDev = document.getElementById('sugerencias-list-dev')
let pendingDev = true;

dev.addEventListener('focus', function (e) {
    sugerenciasDev.classList.remove('d-none')
    if (pendingDev) {
        loadNamesDev(e)
        pendingDev = false;
    }
    function closeDev(e) {
        if (e.target !== dev) {
            sugerenciasDev.classList.add('d-none')
            modal.removeEventListener('click', closeDev)
        }
    }
    modal.addEventListener('click', closeDev)
})
dev.addEventListener('input', startQueueDev)

function startQueueDev(e) {
    showLoading(listDev)
    clearTimeout(timeoutDev)
    timeoutDev = setTimeout(function () { loadNamesDev(e) }, 200);
}

async function loadNamesDev(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=companies&name=' + e.target.value)
    const json = await response.json()
    if (json.hasOwnProperty('companies')) {
        let length = json.companies.length
        if (length > 0) {
            listDev.innerHTML = ''
            for (let i = 0; i < length; i++) {
                const el = document.createElement('li')
                el.classList.add('list-group-item')
                el.innerText = json.companies[i].name
                listDev.appendChild(el)
                el.addEventListener('click', function () {
                    const placement = document.getElementById('dev-active')
                    placement.innerHTML = '';
                    const button = createButton('dev', json.companies[i].company_id, json.companies[i].name)
                    placement.appendChild(button)
                    button.addEventListener('click', function (e) { e.target.closest("div").remove() })
                })
            }
        } else {
            listDev.innerHTML = ''
            const el = document.createElement('li')
            el.classList.add('list-group-item')
            el.innerText = 'No hay resultados'
            listDev.appendChild(el)
        }
    }
}

//Sistemas
let timeoutSist = ''
const sist = document.getElementById('sist')
const sugerenciasSist = document.getElementById('sugerencias-sist')
const listSist = document.getElementById('sugerencias-list-sist')
let pendingSist = true;

sist.addEventListener('focus', function (e) {
    sugerenciasSist.classList.remove('d-none')
    if (pendingSist) {
        loadNamesSist(e)
        pendingSist = false;
    }
    function closeSist(e) {
        if (e.target !== sist) {
            sugerenciasSist.classList.add('d-none')
            modal.removeEventListener('click', closeSist)
        }
    }
    modal.addEventListener('click', closeSist)
})
sist.addEventListener('input', startQueueSist)

function startQueueSist(e) {
    showLoading(listSist)
    clearTimeout(timeoutSist)
    timeoutSist = setTimeout(function () { loadNamesSist(e) }, 200);
}

async function loadNamesSist(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=platforms&name=' + e.target.value)
    const json = await response.json()
    if (json.hasOwnProperty('platforms')) {
        let length = json.platforms.length
        if (length > 0) {
            listSist.innerHTML = ''
            for (let i = 0; i < length; i++) {
                const el = document.createElement('li')
                el.classList.add('list-group-item')
                el.innerText = json.platforms[i].name
                listSist.appendChild(el)
                el.addEventListener('click', function () {
                    const button = createButton('sist[]', json.platforms[i].platform_id, json.platforms[i].name)
                    document.getElementById('sist-active').appendChild(button)
                    button.addEventListener('click', function (e) { e.target.closest("div").remove() })
                })
            }
        } else {
            listSist.innerHTML = ''
            const el = document.createElement('li')
            el.classList.add('list-group-item')
            el.innerText = 'No hay resultados'
            listSist.appendChild(el)
        }
    }
}

//Género
let timeoutGen = ''
const gen = document.getElementById('gen')
const sugerenciasGen = document.getElementById('sugerencias-gen')
const listGen = document.getElementById('sugerencias-list-gen')
let pendingGen = true;

gen.addEventListener('focus', function (e) {
    sugerenciasGen.classList.remove('d-none')
    if (pendingGen) {
        loadNamesGen(e)
        pendingGen = false;
    }
    function closeGen(e) {
        if (e.target !== gen) {
            sugerenciasGen.classList.add('d-none')
            modal.removeEventListener('click', closeGen)
        }
    }
    modal.addEventListener('click', closeGen)
})
gen.addEventListener('input', startQueueGen)

function startQueueGen(e) {
    showLoading(listGen)
    clearTimeout(timeoutGen)
    timeoutGen = setTimeout(function () { loadNamesGen(e) }, 100);
}

async function loadNamesGen(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=genres&name=' + e.target.value)
    const json = await response.json()
    if (json.hasOwnProperty('genres')) {
        let length = json.genres.length
        if (length > 0) {
            listGen.innerHTML = ''
            for (let i = 0; i < length; i++) {
                const el = document.createElement('li')
                el.classList.add('list-group-item')
                el.innerText = json.genres[i].name
                listGen.appendChild(el)
                el.addEventListener('click', function () {
                    const button = createButton('gen[]', json.genres[i].genre_id, json.genres[i].name)
                    document.getElementById('gen-active').appendChild(button)
                    button.addEventListener('click', function (e) { e.target.closest("div").remove() })
                })
            }
        } else {
            listGen.innerHTML = ''
            const el = document.createElement('li')
            el.classList.add('list-group-item')
            el.innerText = 'No hay resultados'
            listGen.appendChild(el)
        }
    }
}

const buttonsDelete = document.querySelectorAll('.removable-buttons')
buttonsDelete.forEach((button) => {
    button.addEventListener('click', function (e) {
        e.target.closest("div").remove()
    })
})

function checkFilled() {
    let valid = true;
    const activeDis = document.getElementById('dis-active').children
    const activeDev = document.getElementById('dev-active').children
    if (!activeDev[0]) {
        const devDiv = document.getElementById('devDiv')
        devDiv.classList.add('shake')
        setTimeout(function () {
            devDiv.classList.remove('shake')
        },1000)
        valid = false
    }

    if (!activeDis[0]) {
        const devDis = document.getElementById('devDis')
        devDis.classList.add('shake')
        setTimeout(function () {
            devDis.classList.remove('shake')
        },1000)
        valid = false
    }

    if (valid) {
        document.getElementById('add-errors').innerHTML = ''
    } else {
        document.getElementById('add-errors').innerHTML = '<div class="alert alert-warning text-center" role="alert">Faltan campos por rellenar!</div>'
    }

    return valid;
}
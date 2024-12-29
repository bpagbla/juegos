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
function createInput(name, value) {
    const input = document.createElement('input')
}

const modal = document.getElementById('exampleModal')

//Titulo
let id = document.getElementById('id')
let timeoutTitulo = ''
const titulo = document.getElementById('titulo')
const sugerenciasTitulo = document.getElementById('sugerencias-titulo')
const listTitulo = document.getElementById('sugerencias-list-titulo')
let pendingTitulo = true;

titulo.addEventListener('focus', function (e) {
    sugerenciasTitulo.classList.remove('d-none')
    if (pendingTitulo) {
        loadNamesTitulo(e)
        pendingTitulo = false;
    }
    function closeTitle(e) {
        if (e.target !== titulo) {
            sugerenciasTitulo.classList.add('d-none')
            modal.removeEventListener('click', closeTitle)
        }
    }
    modal.addEventListener('click', closeTitle)
})
titulo.addEventListener('input', startQueueTitulo)
function startQueueTitulo(e) {
    showLoading(listTitulo)
    clearTimeout(timeoutTitulo)
    timeoutTitulo = setTimeout(function () { loadNamesTitulo(e) }, 400);
}

async function loadNamesTitulo(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=games&format=brief&title=' + e.target.value)
    const json = await response.json()
    if (json.hasOwnProperty('games')) {
        let length = json.games.length
        if (length > 0) {
            listTitulo.innerHTML = ''
            for (let i = 0; i < length; i++) {
                const el = document.createElement('li')
                el.classList.add('list-group-item')
                el.innerText = json.games[i].title
                el.value = json.games[i].game_id
                listTitulo.appendChild(el)
                el.addEventListener('click', async function (e) {
                    titulo.value = e.target.innerText
                    id.value = e.target.value
                    try {
                        document.getElementById('add-errors').innerHTML = ''
                        await fillForm(e.target.value)
                    } catch (err) {
                        console.log(err)
                        document.getElementById('blackout').remove()
                        document.getElementById('add-errors').innerHTML = '<div class="alert alert-danger" role="alert">Error cargando los datos! Intentalo de nuevo.</div>'
                        document.getElementById('titulo').value = '';
                        document.getElementById('id').value = '';
                    }
                })
            }
        } else {
            listTitulo.innerHTML = ''
            const el = document.createElement('li')
            el.classList.add('list-group-item')
            el.innerText = 'No hay resultados'
            listTitulo.appendChild(el)
        }
    }
}

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

async function fillForm(id) {
    const gray = document.createElement('div')
    gray.id = 'blackout'
    document.body.appendChild(gray)
    const spin = document.createElement('div')
    spin.classList.add('spinner')
    gray.appendChild(spin)
    const response = await fetch('http://localhost/?page=api&endpoint=games&format=normal&id=' + id)
    const json = await response.json()
    if (json.games[0].description) {
        document.getElementById('descripcion').value = json.games[0].description.replace(/<\/?[^>]+(>|$)/g, "")
    } else {
        document.getElementById('descripcion').value = '';
    }
    document.getElementById('year').value = json.games[0].platforms[0].first_release_date.slice(0, 4)

    document.getElementById('portada').src = json.games[0].sample_cover.image
    document.getElementById("fileSrc").value =json.games[0].sample_cover.image;
    console.log(json.games[0].sample_cover.image);


    document.getElementById('gen-active').innerHTML = '';
    json.games[0].genres.forEach((genre) => {
        const button = createButton('gen[]', genre.genre_id, genre.genre_name)
        document.getElementById('gen-active').appendChild(button)
        button.addEventListener('click', function (e) { e.target.closest("div").remove() })
    })
    document.getElementById('sist-active').innerHTML = '';
    json.games[0].platforms.forEach((platform) => {
        const button = createButton('sist[]', platform.platform_id, platform.platform_name)
        document.getElementById('sist-active').appendChild(button)
        button.addEventListener('click', function (e) { e.target.closest("div").remove() })
    })
    setTimeout(function () { setCompanies(id, json.games[0].platforms[0].platform_id) }, 1000)
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
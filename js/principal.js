/* global bootstrap: false */
(function () {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()

const filterModal = new bootstrap.Modal('#filter-modal', {
    keyboard: false
})
document.getElementById('filter-button').addEventListener('click', function () {
    filterModal.show();
})

function showLoading(elem) {
    elem.innerHTML = '<li class="list-group-item"><span class="placeholder w-75"></span></li><li class="list-group-item"><span class="placeholder w-75"></span></li><li class="list-group-item"><span class="placeholder w-75"></span></li>'
}

window.onload = function () {
    slideOne();
    slideTwo();
};

let sliderOne = document.getElementById("slider-1");
let sliderTwo = document.getElementById("slider-2");
let displayValOne = document.getElementById("range1");
let displayValTwo = document.getElementById("range2");
let minGap = 0;
let sliderTrack = document.querySelector(".slider-track");
let sliderMaxValue = document.getElementById("slider-1").max;

function slideOne() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderOne.value = parseInt(sliderTwo.value) - minGap;
    }
    displayValOne.textContent = sliderOne.value;
    fillColor();
}
function slideTwo() {
    if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderTwo.value = parseInt(sliderOne.value) + minGap;
    }
    displayValTwo.textContent = sliderTwo.value;
    fillColor();
}
function fillColor() {
    percent1 = ((sliderOne.value-1952) / (sliderMaxValue-1952)) * 100;
    percent2 = ((sliderTwo.value-1952) / (sliderMaxValue-1952)) * 100;
    sliderTrack.style.background = `linear-gradient(to right, #FFFFFF ${percent1}% , #A020F0 ${percent1}% , #A020F0 ${percent2}%, #FFFFFF ${percent2}%)`;
}

sliderOne.addEventListener('input',slideOne)
sliderTwo.addEventListener('input',slideTwo)

let timeoutGen = ''
const gen = document.getElementById('gen')
const sugerenciasGen = document.getElementById('sugerencias-gen')
const listGen = document.getElementById('sugerencias-list-gen')
let filterModalElement = document.getElementById('filter-modal')

function createButton(name, value, display) {
    const button = document.createElement('div')
    button.classList.add('col-auto')
    button.classList.add('p-0')
    button.classList.add('m-2')
    button.innerHTML = '<button type="button" class="btn btn-sm btn-primary">' + display + '<svg class="bg-transparent" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <use href="#remove"></use></svg></button><input type="hidden" name="' + name + '" value="' + value + '"><input type="hidden" name="' + name.replace('[]','') + value + '" value="' + display + '">'
    return button;
}

function closeGen(e) {
    if (e.target !== gen) {
        sugerenciasGen.classList.add('d-none')
        filterModalElement.removeEventListener('click', closeGen)
    }
}

gen.addEventListener('focus', function (e) {
    sugerenciasGen.classList.remove('d-none')
    loadNamesGen(e)
    filterModalElement.addEventListener('click', closeGen)
})
gen.addEventListener('input', startQueueGen)

async function loadNamesGen(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=filter&filter=generos&name=' + e.target.value + getFilters())
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
                    if (!gameList.includes(json.genres[i].genre_id)) {
                        gameList.push(json.genres[i].genre_id)
                        const button = createButton('gen[]', json.genres[i].genre_id, json.genres[i].name)
                        document.getElementById('gen-active').appendChild(button)
                        button.addEventListener('click', function (e) {
                            e.target.closest("div").remove()
                            gameList.pop(json.genres[i].genre_id)
                        })
                        document.getElementById('add-errors').innerHTML = '';
                    } else {
                        document.getElementById('add-errors').innerHTML = '<div class="alert alert-danger" role="alert">Ese genero ya esta en los filtros</div>'
                    }
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

function startQueueGen(e) {
    showLoading(listGen)
    clearTimeout(timeoutGen)
    timeoutGen = setTimeout(function () { loadNamesGen(e) }, 100);
}

document.querySelectorAll('.removable-buttons').forEach( (elem) => {
    elem.addEventListener('click', function (e) { e.target.closest("div").remove() })
})

//Desarrolladores
let timeoutDev = ''
const dev = document.getElementById('dev')
const sugerenciasDev = document.getElementById('sugerencias-dev')
const listDev = document.getElementById('sugerencias-list-dev')
dev.addEventListener('focus', function (e) {
    sugerenciasDev.classList.remove('d-none')
    loadNamesDev(e)
    function closeDev(e) {
        if (e.target !== dev) {
            sugerenciasDev.classList.add('d-none')
            filterModalElement.removeEventListener('click', closeDev)
        }
    }
    filterModalElement.addEventListener('click', closeDev)
})
dev.addEventListener('input', startQueueDev)

function startQueueDev(e) {
    showLoading(listDev)
    clearTimeout(timeoutDev)
    timeoutDev = setTimeout(function () { loadNamesDev(e) }, 200);
}

async function loadNamesDev(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=filter&filter=companies&name=' + e.target.value + getFilters())
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
                    devList = [json.companies[i].company_id]
                    button.addEventListener('click', function (e) {
                        e.target.closest("div").remove()
                        devList.pop(json.companies[i].company_id);
                    })
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

let timeoutDis = ''
const dis = document.getElementById('dis')
const sugerenciasDis = document.getElementById('sugerencias-dis')
const listDis = document.getElementById('sugerencias-list-dis')

dis.addEventListener('focus', function (e) {
    sugerenciasDis.classList.remove('d-none')
    loadNamesDis(e)
    function closeDis(e) {
        if (e.target !== dis) {
            sugerenciasDis.classList.add('d-none')
            filterModalElement.removeEventListener('click', closeDis)
        }
    }
    filterModalElement.addEventListener('click', closeDis)
})
dis.addEventListener('input', startQueueDis)

function startQueueDis(e) {
    showLoading(listDis)
    clearTimeout(timeoutDis)
    timeoutDis = setTimeout(function () { loadNamesDis(e) }, 200);
}

async function loadNamesDis(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=filter&filter=companies&name=' + e.target.value + getFilters())
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
                    disList = [json.companies[i].company_id]
                    button.addEventListener('click', function (e) {
                        e.target.closest("div").remove()
                        disList.pop(json.companies[i].company_id);
                    })
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

let timeoutSist = ''
const sist = document.getElementById('sist')
const sugerenciasSist = document.getElementById('sugerencias-sist')
const listSist = document.getElementById('sugerencias-list-sist')

sist.addEventListener('focus', function (e) {
    sugerenciasSist.classList.remove('d-none')
    loadNamesSist(e)

    function closeSist(e) {
        if (e.target !== sist) {
            sugerenciasSist.classList.add('d-none')
            filterModalElement.removeEventListener('click', closeSist)
        }
    }
    filterModalElement.addEventListener('click', closeSist)
})
sist.addEventListener('input', startQueueSist)

function startQueueSist(e) {
    showLoading(listSist)
    clearTimeout(timeoutSist)
    timeoutSist = setTimeout(function () { loadNamesSist(e) }, 200);
}

async function loadNamesSist(e) {
    const response = await fetch('http://localhost/?page=api&endpoint=filter&filter=platforms&name=' + e.target.value + getFilters())
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
                    if (!sistList.includes(json.platforms[i].platform_id)) {
                        sistList.push(json.platforms[i].platform_id)
                        const button = createButton('sist[]', json.platforms[i].platform_id, json.platforms[i].name)
                        document.getElementById('sist-active').appendChild(button)
                        button.addEventListener('click', function (e) {
                            e.target.closest("div").remove()
                            sistList.pop(json.platforms[i].platform_id)
                        })
                        document.getElementById('add-errors').innerHTML = '';
                    } else {
                        document.getElementById('add-errors').innerHTML = '<div class="alert alert-danger" role="alert">Ese sistema ya esta en los filtros</div>'
                    }
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

const desc = document.getElementById('desc')
const descButton = document.getElementById('desc-button')
if (descButton !== null) {
    descButton.addEventListener('click', function () {
        if (desc.classList.contains('closed-description')) {
            desc.classList.remove('closed-description')
            desc.classList.add('pb-2')
            descButton.textContent = '...menos'
        } else {
            desc.classList.add('closed-description')
            desc.classList.remove('pb-2')
            descButton.textContent = '...mas'
        }
    })
}

const close = document.querySelectorAll('.modal-close');
close.forEach((e) => {
    e.addEventListener('click', function () {
        window.history.back();
    })
})

function getFilters() {
    let options = '';
    devList.forEach(dev => {
        options += '&dev='+dev
    })
    disList.forEach(dis => {
        options += '&dis='+dis
    })
    sistList.forEach(sist => {
        options += '&sist[]='+sist
    })
    gameList.forEach(sist => {
        options += '&gen[]='+sist
    })

    return options;
}
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
let pendingGen = true;
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
    if (pendingGen) {
        loadNamesGen(e)
        pendingGen = false;
    }
    filterModalElement.addEventListener('click', closeGen)
})
gen.addEventListener('input', startQueueGen)

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
                    if (!gameList.includes(json.genres[i].genre_id)) {
                        gameList.push(json.genres[i].genre_id)
                        const button = createButton('gen[]', json.genres[i].genre_id, json.genres[i].name)
                        document.getElementById('gen-active').appendChild(button)
                        button.addEventListener('click', function (e) {
                            e.target.closest("div").remove()
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
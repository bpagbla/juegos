<div class="row justify-content-around justify-content-lg-start">
    <?php
    foreach ($games as $game) {
        include "frm/templates/card-game-adm.php";
    }
    ?>
</div>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="remove" viewBox="0 0 16 16">
        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
    </symbol>
</svg>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir un Juego Nuevo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="position-relative col-4 img-container d-flex align-items-center flex-column">
                            <!-- IMG PREVIEW -->

                            <img id="portada" src="" alt="Previsualización de la imagen">

                        </div>

                        <div class="col campos">
                            <div class="row">
                                <div class="col-3 ps-0 pe-3">
                                    <label for="id" class="col-form-label">ID:</label>
                                    <input type="text" class="form-control" id="id" name="id" required>
                                </div>
                                <div class="col-9 p-0">
                                    <label for="titulo" class="col-form-label">Título:</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Busca un Titulo" required>
                                    <div class="position-relative">
                                        <div id="sugerencias-titulo" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                            <ul id="sugerencias-list-titulo" class="list-group placeholder-glow">
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col p-0">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col p-0">
                                    <label for="dis" class="col-form-label">Distribuidores:</label>
                                    <input type="text" class="form-control" id="dis" placeholder="Busca un distribuidor">
                                    <div class="position-relative">
                                        <div id="sugerencias-dis" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                            <ul id="sugerencias-list-dis" class="list-group placeholder-glow">
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dis-active" class="row mt-2">
                            </div>
                            <div class="row mb-1">
                                <div class="col p-0">
                                    <label for="dis" class="col-form-label">Desarrolladores:</label>
                                    <input type="text" class="form-control" id="dev" placeholder="Busca un desarrollador">
                                    <div class="position-relative">
                                        <div id="sugerencias-dev" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                            <ul id="sugerencias-list-dev" class="list-group placeholder-glow">
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dev-active" class="row mt-2">
                            </div>
                            <div class="row">
                                <div class="col p-0">
                                    <label for="sist" class="col-form-label">Sistemas:</label>
                                    <input type="text" class="form-control" id="sist" placeholder="Busca un Sistema">
                                    <div class="position-relative">
                                        <div id="sugerencias-sist" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                            <ul id="sugerencias-list-sist" class="list-group placeholder-glow">
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sist-active" class="row mt-2">
                            </div>
                            <div class="row">
                                <div class="col p-0">
                                    <label for="gen" class="col-form-label">Géneros:</label>
                                    <input type="text" class="form-control" id="gen" placeholder="Busca un Género">
                                    <div class="position-relative">
                                        <div id="sugerencias-gen" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                            <ul id="sugerencias-list-gen" class="list-group placeholder-glow">
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="gen-active" class="row mt-2">
                            </div>
                            <div class="row mb-3">
                                <label class="col-form-label" for="year">Año</label>
                                <input class="form-control" type="number" name="year" id="year" min="1900"
                                    max="<?php echo date("Y"); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 campos">
                            <!-- INPUT PORTADA -->
                            <label for="portada" class="col-form-label">Portada:</label>
                            <input type="file" id="file" name="portada" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Añadir" name="addGame">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn text-white position-fixed end-0 bottom-0 m-4" data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    <?php
    if (isset($_POST["addGame"])) {
        ?>
        console.log("bien bien");
        <?php
    }
    ?>

    //TODO quitar
    const addModal = new bootstrap.Modal('#exampleModal', {
        keyboard: false
    })

    addModal.show()

    function showLoading(elem) {
        elem.innerHTML = '<li class="list-group-item"><span class="placeholder w-75"></span></li><li class="list-group-item"><span class="placeholder w-75"></span></li><li class="list-group-item"><span class="placeholder w-75"></span></li>'
    }

    function createButton(name,value,display) {
        const button = document.createElement('div')
        button.classList.add('col-auto')
        button.classList.add('p-0')
        button.classList.add('m-2')
        button.innerHTML = '<button type="button" class="btn btn-sm btn-primary">' + display + '<svg class="bg-transparent" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"> <use href="#remove"></use></svg></button><input type="hidden" name="' + name + '" value="' + value + '">'
        return button;
    }
    function createInput(name,value) {
        const input = document.createElement('input')
    }

    const modal = document.getElementById('exampleModal')

    //Titulo
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
        function closeTitle (e) {
            if (e.target !== titulo) {
                sugerenciasTitulo.classList.add('d-none')
                modal.removeEventListener('click', closeTitle)
            }
        }
        modal.addEventListener('click', closeTitle)
    })
    titulo.addEventListener('input', startQueueTitulo)
    function startQueueTitulo (e) {
        showLoading(listTitulo)
        clearTimeout(timeoutTitulo)
        timeoutTitulo = setTimeout(function() {loadNamesTitulo(e)},400);
    }

    async function loadNamesTitulo(e) {
        const response = await fetch('http://localhost/?page=api&endpoint=games&format=brief&title='+e.target.value)
        const json = await response.json()
        if (json.hasOwnProperty('games')) {
            let length = json.games.length
            if (length > 0) {
                listTitulo.innerHTML = ''
                for (let i = 0; i < length; i++) {
                    const el = document.createElement('li')
                    el.classList.add('list-group-item')
                    el.innerText = json.games[i].title
                    listTitulo.appendChild(el)
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
        function closeDis (e) {
            if (e.target !== dis) {
                sugerenciasDis.classList.add('d-none')
                modal.removeEventListener('click', closeDis)
            }
        }
        modal.addEventListener('click', closeDis)
    })
    dis.addEventListener('input', startQueueDis)

    function startQueueDis (e) {
        showLoading(listDis)
        clearTimeout(timeoutDis)
        timeoutDis = setTimeout(function() {loadNamesDis(e)},200);
    }

    async function loadNamesDis(e) {
        const response = await fetch('http://localhost/?page=api&endpoint=companies&name='+e.target.value)
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
                        const button = createButton('dis',json.companies[i].company_id,json.companies[i].name)
                        placement.appendChild(button)
                        button.addEventListener('click', function (e) {e.target.closest("div").remove()})
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
        function closeDev (e) {
            if (e.target !== dev) {
                sugerenciasDev.classList.add('d-none')
                modal.removeEventListener('click', closeDev)
            }
        }
        modal.addEventListener('click', closeDev)
    })
    dev.addEventListener('input', startQueueDev)

    function startQueueDev (e) {
        showLoading(listDev)
        clearTimeout(timeoutDev)
        timeoutDev = setTimeout(function() {loadNamesDev(e)},200);
    }

    async function loadNamesDev(e) {
        const response = await fetch('http://localhost/?page=api&endpoint=companies&name='+e.target.value)
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
                        const button = createButton('dev',json.companies[i].company_id,json.companies[i].name)
                        placement.appendChild(button)
                        button.addEventListener('click', function (e) {e.target.closest("div").remove()})
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
        function closeSist (e) {
            if (e.target !== sist) {
                sugerenciasSist.classList.add('d-none')
                modal.removeEventListener('click', closeSist)
            }
        }
        modal.addEventListener('click', closeSist)
    })
    sist.addEventListener('input', startQueueSist)

    function startQueueSist (e) {
        showLoading(listSist)
        clearTimeout(timeoutSist)
        timeoutSist = setTimeout(function() {loadNamesSist(e)},200);
    }

    async function loadNamesSist(e) {
        const response = await fetch('http://localhost/?page=api&endpoint=platforms&name='+e.target.value)
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
                        const button = createButton('sist[]', json.platforms[i].platform_id ,json.platforms[i].name)
                        document.getElementById('sist-active').appendChild(button)
                        button.addEventListener('click', function (e) {e.target.closest("div").remove()})
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
        function closeGen (e) {
            if (e.target !== gen) {
                sugerenciasGen.classList.add('d-none')
                modal.removeEventListener('click', closeGen)
            }
        }
        modal.addEventListener('click', closeGen)
    })
    gen.addEventListener('input', startQueueGen)

    function startQueueGen (e) {
        showLoading(listGen)
        clearTimeout(timeoutGen)
        timeoutGen = setTimeout(function() {loadNamesGen(e)},100);
    }

    async function loadNamesGen(e) {
        const response = await fetch('http://localhost/?page=api&endpoint=genres&name='+e.target.value)
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
                        const button = createButton('gen[]',json.genres[i].genre_id,json.genres[i].name)
                        document.getElementById('gen-active').appendChild(button)
                        button.addEventListener('click', function (e) {e.target.closest("div").remove()})
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


</script>
<script src="library/dselect.js"></script>
<script src="js/adm-juegos.js"></script>
<div class="row justify-content-around justify-content-lg-start">
    <?php
    foreach ($games as $game) {
        include "frm/templates/card-game-adm.php";
    }
    ?>
</div>

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
                                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                                    <div class="position-relative">
                                        <div id="sugerencias" class="position-absolute bg-primary w-100 rounded z-overmodal mt-1 branded-shadow d-none">
                                            <ul id="sugerencias-list" class="list-group placeholder-glow">
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                                <li class="list-group-item"><span class="placeholder w-75"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            </div>
                            <div class="dropdown row mb-3">
                                <!-- PLANTILLA DISTRIBUIDORES -->
                                <select class="form-select" id="select-dis" name="dis"
                                    aria-label="Default select example" required>
                                    <option selected disabled value="">Selecciona un Distribuidor</option>
                                    <?php
                                    $contDist = 0;
                                    foreach ($companias as $dis) {
                                        include "frm/templates/distribuidores.php";
                                        $contDist++;
                                    }
                                    if ($contDist == 0) {
                                        ?>
                                        <li>
                                            <div class="dropdown-item">
                                                <div class="form-check">
                                                    <option disabled value="">No existen Distribuidores</option>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="dropdown row mb-3">
                                <!-- PLANTILLA DEV -->
                                <select class="form-select " name="dev" id="select-dev"
                                    aria-label="Default select example" required>
                                    <option selected disabled value="">Selecciona un Desarrollador</option>
                                    <?php
                                    $contDev = 0;
                                    foreach ($companias as $dev) {
                                        include "frm/templates/dev.php";
                                        $contDev++;
                                    }
                                    if ($contDev == 0) {
                                        ?>
                                        <li>
                                            <div class="dropdown-item">
                                                <div class="form-check">
                                                    <option disabled value="">No existen Desarrolladores</option>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="dropdown row mb-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Sistema
                                </button>
                                <ul id="listaSist" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- Input de búsqueda -->
                                    <input class="form-control mb-2" id="buscarSist" type="text"
                                        placeholder="Buscar...">
                                    <!-- PLANTILLA SISTEMA -->
                                    <?php
                                    $contSist = 0;
                                    foreach ($sistemas as $sistema) {
                                        include "frm/templates/sistema.php";
                                        $contSist++;
                                    }
                                    if ($contSist == 0) {
                                        ?>
                                        <li>
                                            <div class="dropdown-item">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="gen"
                                                        disabled />
                                                    <label class="form-check-label" for="gen">No existen Sistemas</label>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div class="dropdown row mb-3">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Géneros
                                </button>
                                <ul id="listaGeneros" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <!-- Input de búsqueda -->
                                    <input class="form-control mb-2" id="buscarGen" type="text" placeholder="Buscar...">
                                    <!-- PLANTILLA GENEROS -->
                                    <?php
                                    $gen = 0;
                                    foreach ($generos as $genero) {
                                        include "frm/templates/generos.php";
                                        $gen++;
                                    }
                                    if ($gen == 0) {
                                        ?>
                                        <li>
                                            <div class="dropdown-item">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="gen"
                                                        disabled />
                                                    <label class="form-check-label" for="gen">No existen géneros</label>
                                                </div>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
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

    let timeout = ''

    const titulo = document.getElementById('titulo')
    const sugerencias = document.getElementById('sugerencias')
    const list = document.getElementById('sugerencias-list')

    titulo.addEventListener('focus', function () {
        sugerencias.classList.remove('d-none')
    })
    titulo.addEventListener('focusout', function () {
        sugerencias.classList.add('d-none')
    })
    titulo.addEventListener('input', startQueue)

    function startQueue (e) {
        clearTimeout(timeout)
        timeout = setTimeout(function() {loadNames(e)},400);
    }

    async function loadNames(e) {
        const response = await fetch('http://localhost/?page=api&endpoint=games&format=brief&title='+e.target.value)
        const json = await response.json()
        if (json.hasOwnProperty('games')) {
            let length = json.games.length
            if (length > 0) {
                list.innerHTML = ''
                for (let i = 0; i < length; i++) {
                    const el = document.createElement('li')
                    el.classList.add('list-group-item')
                    el.innerText = json.games[i].title
                    list.appendChild(el)
                    console.log(json.games[i].title)
                }
            } else {
                list.innerHTML = ''
                const el = document.createElement('li')
                el.classList.add('list-group-item')
                el.innerText = 'No hay resultados'
                list.appendChild(el)
            }
        }
    }

</script>
<script src="library/dselect.js"></script>
<script src="js/adm-juegos.js"></script>
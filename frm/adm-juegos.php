<div class="row">
    <?php
    foreach ($games as $game) {
        include "frm/templates/card-admin.php";
    }
    ?>
</div>

<button type="button" class="btn text-white position-fixed end-0 bottom-0 m-4" data-bs-toggle="modal"
    data-bs-target="#exampleModal">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir un Juego Nuevo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="img-container">
                        <div class="img-area">
                            <svg class="bi me-2" width="30" height="30">
                                <use xlink:href="#upload" />
                            </svg>
                            <h3>Subir Imágen</h3>
                            <p>La imagen debe ser de un tamaño menor que <span>XTAMAÑO</span></p>
                        </div>
                        <button class="select-img"> Seleccionar Imágen</button>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Título:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descripción:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Añadir</button>
            </div>
        </div>
    </div>
</div>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script>
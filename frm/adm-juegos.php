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
                            <input type="file" id="file" accept="image/*" hidden>

                            <img class="portada" src="https://placehold.co/400x600?text=Portada" alt="">

                            <button type="button" class="select-img btn text-white position-absolute bottom-0 end-0 m-4"><svg
                                    class="bi me-2 d-flex align-items-center" width="30" height="30">
                                    <use xlink:href="#upload" />
                                </svg></button>
                        </div>



                        <div class="col">
                            <div class="row mb-3">
                                <label for="recipient-name" class="col-form-label">Título:</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="row mb-3">
                                <label for="message-text" class="col-form-label">Descripción:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </div>
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

<button type="button" class="btn text-white position-fixed end-0 bottom-0 m-4" data-bs-toggle="modal"
        data-bs-target="#exampleModal">
    <svg class="bi me-2" width="16" height="16">
        <use xlink:href="#plus" />
    </svg>
    Añadir
</button>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script>
<script src="js/img-selector.js"></script>
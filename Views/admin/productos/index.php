<?php include_once 'Views/template/header-admin.php'; ?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#listaProducto" type="button" role="tab" aria-controls="listaProducto" aria-selected="true">Productos</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#nuevoProducto" type="button" role="tab" aria-controls="nuevoProducto" aria-selected="false">Nuevo</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="listaProducto" role="tabpanel" aria-labelledby="home-tab">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" style="width: 100%;" id="tblProductos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Imagen</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nuevoProducto" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
            <div class="card-body p-5">
                <form id="frmRegistro">
                    <div class="row">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="imagen_actual" name="imagen_actual">
                        <div class="col-md-5">
                            <label for="nombre">Título</label>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label" for="nombre">Título</label>
                                <input id="nombre" class="form-control" type="text" name="nombre">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="precio">Precio</label>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label" for="precio">Precio</label>
                                <input id="precio" class="form-control" type="text" name="precio">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="cantidad">Cantidad</label>
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label" for="cantidad">Cantidad</label>
                                <input id="cantidad" class="form-control" type="number" name="cantidad">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="categoria">Categoria</label>
                            <div class="input-group input-group-outline my-3">
                                <select id="categoria" class="form-control" name="categoria">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($data['categorias'] as $categoria) { ?>
                                        <option value="<?php echo $categoria['id']; ?>"><?php echo $categoria['categoria']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="descripcion">Descripción</label>
                            <div class="input-group input-group-outline my-3">
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-7">
                        <label for="imagen">Imagen (Opcional)</label>
                            <div class="input-group input-group-outline my-3">
                                <input id="imagen" type="file" class="form-control" name="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalGaleria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Imagenes del Producto</h5>
                <button class="btn-close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo BASE_URL . 'productos/galeriaImagenes'; ?>" class="dropzone">
                    <input type="hidden" id="idProducto" name="idProducto">
                </form>
                <div class="text-end mt-3">
                    <button class="btn btn-primary" type="button" id="btnProcesar">Subir Imagenes</button>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-between" id="containerGaleria">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>

<script src="<?php echo BASE_URL . 'assets/js/modulos/productos.js'; ?>"></script>

</body>

</html>
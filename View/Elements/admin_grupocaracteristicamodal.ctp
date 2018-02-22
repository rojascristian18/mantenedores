 <!-- MODALS -->        
<div class="modal" id="modalpalabraclave" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead"><span class="fa fa-key"></span> Crear Palabra Clave</h4>
            </div>
            <div class="modal-body">
                <h3>¿Desea crear la palabra <strong id="palabraclavenocreada"></strong>?</h3>
            </div>
            <div class="modal-body">
                <div class="progress hide">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="crearpalabraclave">Sí, crear palabra clave</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No crear</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modalunidadmedida" tabindex="-1" role="dialog" aria-labelledby="headUnidadmedia" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="headUnidadmedia"><span class="fa fa-crop"></span> Crear Unidad de medida</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="">Nombre de la unidad de medida</label>
                        <input class="form-control" type="text" id="nombreunidadmedia" placeholder="CM, MM">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <br>
                        <label for="">Nombre de la unidad de medida</label>
                        <select class="form-control" id="tipounidadmedia">
                            <option value="text">Texto</option>
                            <option value="number">Sólo números</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <br>
                        <label for=""><small>Carácteres permitidos adicionales</small></label>
                        <input class="tagsinput" type="text" id="permitidosunidadmedia">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <br>
                        <label for=""><small>Ejemplo para mantenedor</small></label>
                        <input class="form-control" type="text" id="ejemplounidadmedia" placeholder="EJ: 355 mm">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="progress hide">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="crearunidadmedida">Crear unidad de media</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No crear</button>
            </div>
        </div>
    </div>
</div>
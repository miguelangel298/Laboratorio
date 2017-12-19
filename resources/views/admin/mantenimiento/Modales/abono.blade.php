<div class="modal fade" id="abonar-modal">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Abonar monto</h4>
          </div>
          <div class="modal-body">
            <div class="row">
	            <div class="col-md-12">
	               <div class="form-group">
	                <label>Monto a Abonar:</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-dollar"></i>
	                  </div>
	                  <div id="DivPsUp" >
	                   <input type="text" placeholder="Monto a Abonar" class="form-control" id="abonoMonto">
	                  </div>
	                </div>
	              </div>
	            </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6" style="font-size: 22px;">Pendiente: $<b id="montoPendienteAbono"></b></div>
              <div class="col-md-offset-1 col-md-5" style="font-size: 22px;">Total: $<b id="montoTotalAbono"></b></div>
              <br>
              <br>
              <div class="col-md-6" style="font-size: 22px;">Restante: $<b id="montoRestanteAbono"></b></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" id="AbonarBtn" class="btn btn-primary">Generar</button>
          </div>
        </div>
    </div>
</div>

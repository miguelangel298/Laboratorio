<div class="modal fade" id="divisa-modal">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Actualizar Divisa</h4>
          </div>
          <div class="modal-body">
            <div class="row">
	            <div class="col-md-12">
	               <div class="form-group">
	                <label>Valor (RD$):</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-dollar"></i>
	                  </div>
	                  <div id="DivNE" >
	                   <input type="text" maxlength="6" placeholder="Valor del dollar (RD$)" class="form-control" id="Valor" name="Valor">
	                  </div>
	                </div>
	              </div>
	            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" id="updateDivisa" class="btn btn-primary">Actualizar</button>
          </div>
        </div>
    </div>
</div>

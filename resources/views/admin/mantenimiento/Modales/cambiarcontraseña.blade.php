<div class="modal fade" id="modal-contraseña">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cambiar Contraseña / <span id="UsuarioName"></span> </h4>
          </div>
          <div class="modal-body">
          	<input type="hidden"  name="IdUser" id="IdUser" value="{{ Auth::user()->IdUser }}">
          	<form>
            <div class="row">
	            <div class="col-md-12">
	               <div class="form-group">
	                <label>Nueva Contraseña:</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-lock"></i>
	                  </div>
	                  <div id="DivPsUp" >
	                   <input type="password" placeholder="Nueva Contraseña" class="form-control verificacionPass" id="contraseña" name="contraseña">
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="col-md-12">
	               <div class="form-group">
	                <label>Confirmar Contraseña:</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-lock"></i>
	                  </div>
	                  <div id="DivPUp" >
	                   <input type="password" placeholder="Confirmar Contraseña" class="form-control verificacionPass" id="cContraseña" name="cContraseña">
	                  </div>
	                </div>
	              </div>
	            </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" id="ActualizarContraseña" class="btn btn-primary">Actualizar</button>
          </div>
         </form>
        </div>
    </div>
</div>


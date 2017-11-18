<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Procedimiento</h4>
          </div>
          <div class="modal-body">
          	<form>
            <div class="row">
	            <div class="col-md-12">
	            <input type="hidden"  name="IdUser" id="IdUser" value="{{ Auth::user()->IdUser }}">
	               <div class="form-group">
	                <label>Procedimiento:</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    <i class="fa fa-user"></i>
	                  </div>
	                  <div id="DivNE" >
	                   <input type="text" placeholder="Nombre del Procedimiento" class="form-control" id="NombreE" name="Nombre">              
	                  </div>
	                </div>               
	              </div>              
	            </div>
				<div class="col-md-6">             
	               <div class="form-group">
	                <label>Costo en Pesos:</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    RD$
	                  </div>
	                  <div id="DivClE">
	                    <input type="number"  id="CostoPesoE" class="form-control" placeholder="Costo en Peso" name="CostoPeso" >
	                  </div>                  
	                </div>                
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group">
	                <label>Costo en Dollar:</label>
	                <div class="input-group">
	                  <div class="input-group-addon">
	                    US$
	                  </div>
	                  <div id="DivTE">
	                     <input type="text" id="CostoDolarE"   class="form-control" placeholder="Costo en Dollar" name="CostoDolar">
	                  </div>
	                </div>
	                <!-- /.input group -->
	              </div>
	          	</div>            	
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="button" id="ActualizarProcedimiento" class="btn btn-primary">Actualizar</button>
          </div>
         </form>
        </div>
    </div>    
</div>
       

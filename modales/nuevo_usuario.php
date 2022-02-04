 <style>
   #headModal{
  background-color: black;
  color: white;
  text-align: center;
}

 </style>
 <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../estilos/styles.css">
  </head>
  <body>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="nuevo_usuario" style="border-radius:0px !important;">
    <div class="modal-dialog modal-lg" id="tanModal">
      <!-- cabecera de la modal-->
      <div class="modal-content" >
        <div class="modal-header" id="headModal" style="justify-content: space-between">
          <span><i class="fas fa-plus-square"></i><strong> NUEVO USUARIO</strong></span>
          <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-row" autocomplete="on">
            <div class="form-group col-md-8">
              <label for="ex3">Nombre</label>
              <input type="text"  class="form-control" name="" placeholder="Nombre completo" required="" id="nombre">
            </div>
            <div class="form-group col-md-2">
              <label for="ex3">Teléfono</label>
              <input type="text"  class="form-control" name="" placeholder="Teléfono" required="" id="telefono">
            </div>
            <div class="form-group col-md-6">
              <label for="ex3">Dirección</label>
              <input type="text"  class="form-control" name="" placeholder="Dirección" required="" id="direccion">
            </div>
            <div class="form-group col-md-6">
              <label for="ex3">Correo</label>
              <input type="text"  class="form-control" name="" placeholder="Correo electrónico" required="" id="correo">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">DUI</label>
              <input type="text"  class="form-control" name="" placeholder="Número DUI" required="" id="dui">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">NIT</label>
              <input type="text"  class="form-control" name="" placeholder="Número NIT" required="" id="nit">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">Usuario</label>
              <input type="text"  class="form-control" name="" placeholder="Usuario" required="" id="usuario">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">Contraseña</label>
              <input type="text"  class="form-control" name="" placeholder="Contraseña" required="" id="pass">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">Nick</label>
              <input type="text"  class="form-control" name="" placeholder="1nombre 1apellido" required="" id="nick">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">ISSS</label>
              <input type="text"  class="form-control" name="" placeholder="Número ISSS" required="" id="isss">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">AFP</label>
              <input type="text"  class="form-control" name="" placeholder="Número AFP" required="" id="afp">
            </div>
            <div class="form-group col-md-3">
              <label for="ex3">Cuenta Bancaria</label>
              <input type="text"  class="form-control" name="" placeholder="Número cuenta" required="" id="cuenta">
            </div>
          </div>
        </div>
        <input type="hidden" id='id_usuario' value="<?php echo $_SESSION['id_usuario']?>" >
        <input type="text" class="form-control clear_input" id="codigo_user" readonly="" style="background: white;border: 1px solid white;color:black;text-align:right;">
        <!-- Modal footer -->
        <div class="modal-footer" style="margin-top:3px;">
          <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" style="border-radius:0px" onClick="guardar_usuario();"><i class="fas fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
  </body>
  </html>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
   <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>    
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
     <script>        
      $(document).ready(function(){
         $('.modal').modal();
      });
          
      </script>
	  <style>
		  .modal{max-height:90% !important;}	  
	  </style>
    </head>
 <body>  
  <!-- Modal Button -->
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Open Regiister Modal</a>

  <!-- Modal Body -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Register</h4>
	 <div class="col s6">
		<form class="">
      <div class="row">
		 <div class="input-field col s6">
          <input id="Name" type="text" class="validate">
          <label for="Email">Name</label>
        </div>
		 <div class="input-field col s6">
          <input id="Email" type="email" class="validate">
          <label for="Email">Email</label>
        </div>
		<div class="input-field col s12">
          <input id="Phone" type="text" class="validate">
          <label for="Phone">Phone</label>
        </div>
        <div class="input-field col s12">
          <input id="Password" type="password" class="validate">
          <label for="Password">Password</label>
        </div>
		  <div class="input-field col s12">
          <input id="CnfPassword" type="password" class="validate">
          <label for="CnfPassword">Confirm Password</label>
        </div>
		 <div class="input-field col s12">
          <button type="submit" class="waves-effect waves-light btn">Register</button>
        </div>        
      </div>	
      </form>
     </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div> 
 </body>
    
  </html>
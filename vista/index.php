<?php
require_once __DIR__ . '/../negocio/Globales.php';
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: " . URL_BASE);
	exit;
}
?>

<?php 
require "template/cabecera.php";
?>
<style>
	.esquinas {
		border-radius: 6px 0 0 6px;
	}

	.sexo-container {
	  flex: 1;
	  display: flex;
	  gap: 2rem;
	  justify-content: center;
	  align-items: center;
	  border-radius: 6px;
	}

	.sexo-item {
	  display: flex;
	  align-items: center;
	  gap: .25rem;
	}

	.sexo-container:has(#M:checked) {
	  background-color: #cce4ff;
	}

	.sexo-container:has(#F:checked) {
	  background-color: #ffd6e7;
	}

	.no-margin {
		margin: 0;
	}

	.custom-legend {
		color: #6c757d;
		font-weight: 600;
	}

	.row-gap {
	  display: grid;
	  grid-template-columns: repeat(4, 1fr);
	  gap: 1rem;
	}

	@media (max-width: 768px) {
		.row-gap{
			grid-template-columns: repeat(2, 1fr);	
		} 
	}
</style>
<!-- Begin Page Content -->
    <div class="container">
    <!-- <div class="container-fluid"> -->
    	<fieldset class="row">
    		<div class="col-12">
    			<legend class="custom-legend">Identificación del Paciente</legend>
    		</div>

    		<div class="col-12 col-sm-4">
    			<div class="form-group">
    				<label for="tip_doc">Tipo documento</label>
    				<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <select class="custom-select esquinas">
						    <!-- <option selected>Choose...</option> -->
						    <option value="1" selected>DNI</option>
						    <option value="2">Carné ext.</option>
						    <option value="3">Pasaporte</option>
						</select>
					  </div>
					  <input type="text" class="form-control" id="tip_doc">
					</div>
    			</div>
    		</div>
    		<div class="col-12 col-sm-4">
    			<div class="form-group">
				    <label for="nombres">Nombres</label>
				    <input type="text" class="form-control" id="nombres">
				</div>
    		</div>
    		<div class="col-12 col-sm-4">
    			<div class="form-group">
				    <label for="apellidos">Apellidos</label>
				    <input type="text" class="form-control" id="apellidos">
				</div>
    		</div>


    		<div class="col-12 col-sm-4">
    			<div class="form-row">
	    			<div class="col-9">
		    			<div class="form-group">
							<label for="fecha_nacimiento">Fecha de nacimiento</label>
							<input type="date" class="form-control" id="fecha_nacimiento">
						</div>
		    		</div>
		    		<div class="col-3">
		    			<div class="form-group">
							<label for="edad">Edad</label>
							<input type="num" class="form-control" id="edad" disabled>
						</div>
		    		</div>
	    		</div>
    		</div>
    		<div class="col-12 col-sm-5">
    			<div class="form-group">
    				<label>Sexo</label><br>
					<div class="sexo-container">
						<div class="sexo-item">
							<input type="radio" name="sexo" value="masculino" id="M" required>
							<label for="M" class="no-margin">Masculino</label>
						</div>
						<div class="sexo-item">
							<input type="radio" name="sexo" value="femenino" id="F" required>
							<label for="F" class="no-margin">Femenino</label>
						</div>
					</div>
    			</div>
    		</div>
    		<div class="col-12 col-sm-3">
    			<div class="form-group">
    				<label>Estado civil</label>
	    			<div class="input-group mb-3">
		    			<select class="custom-select">
						  <option value="1" selected>Nada</option>
						  <option value="2">Soltero(a)</option>
						  <option value="3">Casado(a)</option>
						</select>
					</div>
    			</div>
    		</div>


    		<div class="col-12 col-sm-8">
	    		<div class="form-group">
				    <label for="direccion">Dirección</label>
				    <input type="text" class="form-control" id="direccion">
				</div>
	    	</div>
	    	<div class="col-12 col-sm-4">
	    		<div class="form-group">
				    <label>Localidad o Distrito</label>
				    <select class="custom-select">
					  <option value="1" selected>Chicama</option>
					  <option value="2">Chiclín</option>
					  <option value="3">Chocope</option>
					  <option value="4">Casagrande</option>
					</select>
				</div>
	    	</div>


	    	<div class="col-12 col-sm-6">
	    		<div class="form-group mb-1">
	    			<label>Tipo teléfono</label>
	    			<label style="margin-left: 2.7rem;">Número teléfono</label>
	    			<div class="input-group">
					  <div class="input-group-prepend">
					    <select class="custom-select esquinas">
						    <option value="whatsapp" selected>WhatsApp</option>
						    <option value="llamadas">Sólo llamadas</option>
						    <option value="fijo">Teléfono fijo</option>
						</select>
					  </div>
					  <input type="text" class="form-control" id="telefono">
					  <div class="input-group-append">
					    <label class="input-group-text">Principal</label>
					  </div>
					</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="input-group">
					  <div class="input-group-prepend">
					    <select class="custom-select esquinas">
						    <option value="whatsapp" selected>WhatsApp</option>
						    <option value="llamadas">Sólo llamadas</option>
						    <option value="fijo">Teléfono fijo</option>
						</select>
					  </div>
					  <input type="text" class="form-control" id="telefono">
					  <div class="input-group-append">
					    <label class="input-group-text">Secundario</label>
					  </div>
					</div>
	    		</div>
	    	</div>
	    	<div class="col-12 col-sm-6">
	    		<div class="form-group mb-1">
	    			<label>Correo Electrónico</label>
	    			<div class="input-group">
					  <div class="input-group-prepend">
					    <select class="custom-select esquinas">
						    <option value="personal" selected>Personal</option>
						    <option value="institucional">Institucional</option>
						</select>
					  </div>
					  <input type="text" class="form-control" id="telefono">
					</div>
	    		</div>
	    		<div class="form-group">
	    			<div class="input-group">
					  <div class="input-group-prepend">
					    <select class="custom-select esquinas">
						    <option value="personal" selected>Personal</option>
						    <option value="institucional">Institucional</option>
						</select>
					  </div>
					  <input type="text" class="form-control" id="telefono">
					</div>
	    		</div>
	    	</div>
    	</fieldset>

    		    
		<fieldset class="row">
			<div class="col-12">
				<legend class="custom-legend">Información de la Consulta</legend>		
			</div>
		  	<div class="col-12">
		  		<!-- Motivo de consulta -->
			    <div class="form-group">
			      <label for="reason">Motivo de consulta</label>
			      <input type="text" class="form-control" id="reason" name="reason">
			    </div>
		  	</div>
			
			<!-- Enfermedades -->
		  	<div class="col-12">
		    	<label>Enfermedad(es) que padece</label>
		  	</div>
		  	<div class="col-6 col-md-3">
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="asma" name="enfermedades" value="asma">
			          <label class="custom-control-label" for="asma">Asma</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="diabetes" name="enfermedades" value="diabetes">
			          <label class="custom-control-label" for="diabetes">Diabetes</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="tuberculosis" name="enfermedades" value="tuberculosis">
			          <label class="custom-control-label" for="tuberculosis">Tuberculosis</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="enfermedad_osea" name="enfermedades" value="enfermedad_osea">
			          <label class="custom-control-label" for="enfermedad_osea">Enfermedad ósea</label>
			        </div>
		  		</div>
		  	</div>
		  	<div class="col-6 col-md-3">
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="cardiopatia" name="enfermedades" value="cardiopatia">
			          <label class="custom-control-label" for="cardiopatia">Cardiopatía</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="hepatitis" name="enfermedades" value="hepatitis">
			          <label class="custom-control-label" for="hepatitis">Hepatitis</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="herpes" name="enfermedades" value="herpes">
			          <label class="custom-control-label" for="herpes">Herpes</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="trastorno_emocional" name="enfermedades" value="trastorno_emocional">
			          <label class="custom-control-label" for="trastorno_emocional">Trastorno emocional</label>
			        </div>
		  		</div>
		  	</div>
		  	<div class="col-6 col-md-3">
		  		<div class="form-group">
			        <div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="hemorragia" name="enfermedades" value="hemorragia">
			          <label class="custom-control-label" for="hemorragia">Hemorragia</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="anemia" name="enfermedades" value="anemia">
			          <label class="custom-control-label" for="anemia">Anemia</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		 		    <div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="cirugia" name="enfermedades" value="cirugia">
			          <label class="custom-control-label" for="cirugia">Cirugía</label>
			        </div>
		  		</div>
		  	</div>
		  	<div class="col-6 col-md-3">
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="epilepsia" name="enfermedades" value="epilepsia">
			          <label class="custom-control-label" for="epilepsia">Epilepsia</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="hipoacusia" name="enfermedades" value="hipoacusia">
			          <label class="custom-control-label" for="hipoacusia">Hipoacusia</label>
			        </div>
		  		</div>
		  		<div class="form-group">
		  			<div class="custom-control custom-checkbox">
			          <input class="custom-control-input" type="checkbox" id="accidentes" name="enfermedades" value="accidentes">
			          <label class="custom-control-label" for="accidentes">Accidentes</label>
			        </div>
		  		</div>
		  	</div>
		  


		  <!-- Notas / Comentarios -->
		  <div class="col-12">
		  	<div class="form-group">
			    <label for="notes">Notas / Comentarios adicionales</label>
			    <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
			</div>
		  </div>
		</fieldset>

		<!-- Historial Médico -->
		<fieldset class="row">
			<div class="col-12">
				<legend class="custom-legend">Historial Médico</legend>		
			</div>
		  	
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="alergia">¿Tiene alergias?</label>
		  			<input type="checkbox" name="alergia" id="alergia" class="ml-1">
		  		</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="ronca">¿Ronca al dormir?</label>
		  			<input type="checkbox" name="alergia" id="ronca" class="ml-1">
		  		</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="resfria">¿Se resfría con frecuencia?</label>
		  			<input type="checkbox" name="alergia" id="resfria" class="ml-1">
		  		</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="amigdalitis">¿Sufre de amigdalitis?</label>
		  			<input type="checkbox" name="alergia" id="amigdalitis" class="ml-1">
		  		</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="masticar">¿Tiene dificultad para masticar?</label>
		  			<input type="checkbox" name="alergia" id="masticar" class="ml-1">
		  		</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="chupa">¿Se chupa el dedo/labio?</label>
		  			<input type="checkbox" name="alergia" id="chupa" class="ml-1">
		  		</div>
		  	</div>
		  	<div class="col-12 col-md-4">
		  		<div class="d-flex justify-content-between flex-row">
		  			<label for="tratamiento_previo">¿Ha recibido tratamiento de ortodoncia previo?</label>
		  			<input type="checkbox" name="alergia" id="tratamiento_previo" class="ml-1">
		  		</div>
		  	</div>

		</fieldset>
  
    </div>


<!-- /.container-fluid -->
<?php
require "template/pie.php";
?>
<?php 
require "template/cabecera.php";
?>
<style>
	.perro {
		border-radius: 6px 0 0 6px;
	}
</style>
<!-- Begin Page Content -->
    <div class="container-fluid">
    	<div class="row">
    		<div class="col-xs-12 col-sm-4">
    			<div class="form-group">
    				<label for="exampleInputPassword1">Password</label>
    				<div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <select class="custom-select perro" id="inputGroupSelect01">
						    <option selected>Choose...</option>
						    <option value="1">One</option>
						    <option value="2">Two</option>
						    <option value="3">Three</option>
						  </select>
					  </div>
					  <input type="password" class="form-control" id="exampleInputPassword1">
					</div>
    			</div>
    		</div>
    		<div class="col-xs-12 col-sm-4">
    			<div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1">
				  </div>
    		</div>
    		<div class="col-xs-12 col-sm-4">
    			<div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1">
				  </div>
    		</div>
    	</div>
        <!-- Page Heading -->     

    </div>
<!-- /.container-fluid -->
<?php
require "template/pie.php";
?>
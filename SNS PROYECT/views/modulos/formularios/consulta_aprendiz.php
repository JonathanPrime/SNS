
<div id="main">
	<div class="container">
		<br>
		<h2>Consulta de aprendices</h2>
		<br>
		
		<br>
		<table class="table table-striped table-responsive ">
		<thead class="thead-dark">
			<tr>
			<th>nombre</th>
			<th>documento</th>
			<th>tipo documento</th>
			<th>direccion</th>
			<th>correo</th>
			<th>telefono</th>
			<th>ficha</th>
			<th>sede</th>
			<th>modalidad</th>
			<th>jornada</th>
			<th>tipo formacion</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			</tr>
		</thead>

		<tbody>
			<?php
	    $registro = new MvcController();
      	$registro -> vistaAprendizController();
        if(isset($_GET["action"])){

        if ($_GET["action"]=="ok") {
            echo"registro exitoso";
         }
        }
		?>
		</tbody>
		</table>	
		<br>	
		<br>	
		</div>
</div>
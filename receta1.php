<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CVS</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">  <!-- Google web font "Open Sans" -->
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css"/>  
	<link rel="stylesheet" href="css/tooplate-style.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script> 
	var x=0;
	var dato  = "";
	var renderPage = true;	
    	function cambio(){
    		document.getElementById('nombre').value=document.getElementById('cliente').value;
    		document.getElementById('cod').value=document.getElementById('producto').value;
		}
		function ag() {
			document.getElementById("prin").style.display = 'block';
			var tabla=document.getElementById("tbl");				
			var tbd=document.getElementById("tbd");				
			var codi=document.getElementById("cod").value;
			var dos=document.getElementById("txtdos").value;
			var cant=document.getElementById("txtcant").value;
			var combo=document.getElementById("producto");
			var med = combo.options[combo.selectedIndex].text;
			var dat="<td>"+med+"</td><td>"+dos+"</td><td>"+cant+"</td>";
			document.getElementById("tbl").insertRow(-1).innerHTML = dat;								
			document.getElementById("txtdos").value="";
			document.getElementById("txtcant").value="";
			document.getElementById("producto").value="";
				dato+=+codi+","+dos+","+cant+";";
		}
		function guardar() {
		document.getElementById("gr").value=dato;
		var combo=document.getElementById("cliente");
		var med = combo.options[combo.selectedIndex].text;
		document.getElementById("dpi").value=med;	
		}
	</script>
</head>
<body>
	<!-- Page Content -->	
	<div class="container-fluid tm-main">
		<div class="row tm-main-row">		
			<?php  include 'barra.php'; include 'cone.php';
			?>
			<div class="ml-5">
				<h2 class="font-weight-bold mb-3 mt-3">Nueva Receta</h2>
				<form method="POST" action="HistorialDoc.php?cod=1">
				<a>DPI: </a>
				<select id="cliente" name="cliente "onchange="cambio();">
					<option value="">Seleccione Cliente</option>
					<?php  
					$sql = "SELECT * FROM cliente";			
					$result = $conn->query($sql);	
						if ($result->num_rows > 0) {
							$combobox="";
								while ($row=$result->fetch_assoc()) {
									echo "<option value='".$row['nombre']." ".$row['apellido']."'>".$row['dpi']."</option>";
								}
						}else{
							echo "no hay datos";
						}
						?>
				</select>				
				<a>Nombre: </a><input type="text" id="nombre" name="nombre" placeholder="Nombre Cliente" readonly="true" />
				<a>Fecha: </a><input type="date" name="fecha" required/>											
				<button  name="btnInser" type="submit" onclick="guardar();"class="btn btn-warning ml-4">Finalizar</button>
				<input type="text" value="" id="gr" name="gr" hidden><input type="text" value="" id="dpi" name="dpi" hidden>
				</form>
					<div>
					<table class="table bg-info"  id="tabla">
						<tr class="info">
							<th>Nombre</th>							
							<th>Dosis</th>
							<th>Cantidad</th>
							<th>Agregar</th>
					    </tr>
					    <tr class="fila-fija">
					    <td><select id="producto" name="slcmed" onchange="cambio();">
					    	<option value="">Codigo</option>
					    	<?php  
								$sql = "SELECT * FROM medicamento";			
								$result = $conn->query($sql);	
									if ($result->num_rows > 0) {
										$combobox="";
											while ($row=$result->fetch_assoc()) {												
												echo "<option value='".$row['codigo']."'>".$row['nombre']."</option>";
											}
									}else{
										echo "no hay datos";
									}
							?>
					    </select></td>
				    	<input type="text" id="cod" name="cod" readonly="true"hidden/>
				    	<td><input type="text" id="txtdos"name="dosis" required></td>
				    	<td><input type="number" id="txtcant" name="Cantidad" required></td>
						<td><input type="button" name="btnAg" value="+" onclick="ag();"></td>
				    	</tr>
					</table>					
				</div>
				<div id="prin" class="row">
					<div class="media tm-bg-transparent-black tm-border-white">							
						<table id="tbl">               
							<tr>
							<th>Medicamento</th><th>Dosis</th><th>Cantidad</th>
						<tbody class="tbd">
						</tbody>
						</table> 
					</div>
				</div>
			</div>	
		</div>			
	        <!-- no quitar -->			
			<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
			<script>
	      	$(window).on("load", function(){
	      		if(renderPage) {
			      	$('body').addClass('loaded');   
			     	var bgImg = $("#tmNavLink1").data("bgImg");
			     	$.backstretch("img/" + bgImg, {fade: 500});
	      		}	      	
			});
			var acc = document.getElementsByClassName("accordion");
			var i;
			for (i = 0; i < acc.length; i++) {
			    acc[i].addEventListener("click", function() {
			        
			        this.classList.toggle("active");
			        /* Toggle between hiding and showing the active panel */
			        var panel = this.nextElementSibling;
			        if (panel.style.display === "block") {
			            panel.style.display = "none";
			        } else {
			            panel.style.display = "block";
			        }
			    });
			}	
			document.getElementById("prin").style.display = 'none';		
		</script>

		
	</body>
</html>
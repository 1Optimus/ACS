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
    <script> var renderPage = true;</script>
</head>
<body>
	<!-- Page Content -->	
	<div class="container-fluid tm-main">
		<div class="row tm-main-row">		
			<?php  include 'barra.php'; include 'cone.php';
			$error=0;
			$sql = "SELECT * FROM `farmacia`";			
			$result = $conn->query($sql);	
			if ($result->num_rows > 0) {
				$x=0;
				while($row = $result->fetch_assoc()) {	
				$farm[$x][0]=$row["codigo"];$farm[$x][2]=$row["direccion"];
				$farm[$x][1]=$row["horaAp"].' AM';$farm[$x][3]=$row["horaCe"].'PM';
				$x++;
				}
			} else {
				$error=1;
			}
			$sql = "SELECT receta.codigo, receta.costo_tot,receta.fecha, receta.estado, doctor.nombre as doc, doctor.apellido FROM `receta`,`doctor` WHERE receta.cod_doc=doctor.dpi AND receta.cod_cliente=".$_SESSION['dpi']." AND receta.estado='pendiente'";
			echo '<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 ">';
			$result = $conn->query($sql);	
			if ($result->num_rows > 0) {
				$x=0;
				while($row = $result->fetch_assoc()) {	
				$mat[$x][0]=$row["codigo"];$mat[$x][3]=$row["fecha"];
				$mat[$x][1]=$row["costo_tot"];$mat[$x][4]=$row["doc"]." ".$row["apellido"];
				$mat[$x][2]=$row["estado"];				
				$x++;
				}
			} else {
				$error=1;
				echo '<br><div class="row">
						<div class="col-xl-12 col-lg-11 col-md-12 col-sm-12 tm-content">
							<div class="media tm-bg-transparent-black tm-border-white">							
								<div class="media-body">
								 <img src="img/ok.png"> &nbsp; &nbsp; &nbsp;
								 <span>¡¡Genial, no hay recetas por atender!!</span>									
								</div>
							</div>
						</div>
					</div>';
			}
			if($error==0){
			for($i=0;$i<$x;$i++){
				echo'<form name="form'.$i.'" action="Historial.php?dat='.$i.'" method="POST">';
				$sql = "SELECT detalle.dosis, detalle.cantidad, medicamento.nombre, medicamento.presentacion, detalle.total FROM `detalle`,`medicamento` WHERE medicamento.codigo=detalle.cod_med AND detalle.cod_receta=".$mat[$i][0]."";
				$result = $conn->query($sql);
				echo '<p class="accordion">Por: '.$mat[$i][4].' el: '.$mat[$i][3].' estado:'.$mat[$i][2].'</p>
				<div class="panel">
				<div class="p2">
				<table>               
            		<tr>
					<th>Medicamento</th><th>Presentacion</th><th>Dosis</th><th>Cantidad</th><th>Costo total</th>
					 </tr>';
			if ($result->num_rows > 0) {				
				while($row = $result->fetch_assoc()) {	
				echo"<tr>
					<td>".$row["nombre"]."</td><td>".$row["presentacion"]."</td><td>".$row["dosis"]."</td><td>".$row["cantidad"]."</td><td>".$row["total"]."</td>
					</tr>";							
				}
				echo '<tr><td></td><td></td><td></td><td></td><td><span class="badge badge-success	">Total a pagar: '.$mat[$i][1].'</span>		</td></tr></table>
				</div>
				<div class="p3">
					<div class="dat">
						<span class="badge badge-success">El seguro cubre TODA la receta, no es necesario pagar</span>						
					</div>
					<div class="dat">
						<input type="checkbox" name="rbt'.$i.'"> <label> Pagar en caja</label>				
					</div><br>
					<div class="dat1">
					<table>              
            		<tr><th>Direccion</th><th>Abre</th><th>Cierra</th><th>Recoger</th></tr>';
						for($y=0;$y<sizeof($farm);$y++){
							echo '<tr><td>'.$farm[$y][2].'</td><td>'.$farm[$y][1].'</td>
							<td>'.$farm[$y][3].'</td><td><input type="radio" value="'.$farm[$y][0].'" name="radio'.$i.'" required></td>
							</tr>';
						}
						echo '
					</table> 
					</div>
					<div class="dat2">
						<input type="date" min="2020-10-20" max="2021-4-20" name="fech'.$i.'"required/>
						<input type="time" name="hora'.$i.'"required/>
						<button class="btn btn-primary" id="boton">Aceptar</button>
					</div>
					</div><input type="text" name="receta" value="'.$mat[$i][0].'" hidden>			
				</div></form>';
			} else {
				echo "<tr><td colspan='5'><center>!UPS¡ al parecer no hay medicamentos</center></td></tr>";
			}			
			}
			}else{

			}			
			$conn->close();			
			?>
			</div>	<!-- .tm-content -->							
        </div>	<!-- row -->			
	</div>	
        <!-- no quitar -->			
		<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
		<script>
            //entrada y barra
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
		</script>
	</body>
</html>
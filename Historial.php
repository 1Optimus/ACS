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
        
            <?php  
			include 'barra.php'; include 'cone.php';  
			if (isset($_GET["dat"])) {
			$rd = $_POST['radio' . $_GET["dat"] . ''];
			$cod = $_POST['receta'];
			$fec = $_POST['fech' . $_GET["dat"] . ''];
			$hor = $_POST['hora' . $_GET["dat"] . ''];
			if (isset($_POST['rbt' . $_GET["dat"] . ''])) {
				$pago = 'Caja';
			} else {
				$pago = 'Seguro';
			}
			$sql = "UPDATE `receta` SET `estado`='Finalizado',`cod_farm`=" . $rd . ",`tipo_pago`='" . $pago . "',`noFactura`=3,`fechaEntrega`='" . $fec . "',`hora`='" . $hor . "' WHERE codigo=" . $cod . "";		
			if ($conn->query($sql) === TRUE) {
				echo "<script language='javascript'>alert('¡Solicitud realizada con exito!');</script>";
			} else {
				echo "<script language='javascript'>alert('tuvimos un pequeño problema, favor de llamar a servicio tecnico');</script>";			
			}
		}           
            echo '<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 ">
            <h1>Historial de recetas</h1>
            ';?>
			<!--
            <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input id="buscar" name="buscar" type="search" placeholder="Buscar aquí…" autofocus >
            <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
            </form>	
            -->
            <?php
			/*
            if($_POST){
                $busqueda = trim($_POST['buscar']);
                $entero = 0;
                if (empty($busqueda)){
                $texto = 'Búsqueda sin resultados';
                }
                else{

*/
                    
            $error=0;
			$sql = "SELECT receta.codigo, receta.costo_tot,receta.fecha, receta.estado, doctor.nombre as doc, doctor.apellido FROM `receta`,`doctor`,`cliente` WHERE receta.cod_doc=doctor.dpi AND receta.cod_cliente=cliente.dpi AND receta.cod_cliente=".$_SESSION['dpi']."";
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
			}
			if($error==0){
			for($i=0;$i<$x;$i++){
				
				$sql = "SELECT detalle.dosis, detalle.cantidad, medicamento.nombre, medicamento.presentacion, detalle.total FROM `detalle`,`medicamento` WHERE medicamento.codigo=detalle.cod_med AND detalle.cod_receta=".$mat[$i][0]." ";
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
                
			 <input type="text" name="receta" value="'.$mat[$i][0].'" hidden>			
                </div>
                
              ';
			} else {
			echo "<tr><td colspan='5'><center>!UPS¡ al parecer no hay medicamentos</center></td></tr>";
			}
			}
			}else{

			}			
			$conn->close();	

              //  }
           // }

           		
			?>
			</div>	<!-- .tm-content -->							
        </div>	<!-- row -->				
    
    
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
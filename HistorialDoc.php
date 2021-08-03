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
			$x=0;$y=0;$tot=0;$rec=0;
			include 'barra.php'; include 'cone.php';
			//verificamos si es ingreso de receta 
			if(isset($_GET['cod'])){
				// 1 si es ingreso de factura
				if($_GET['cod']==1){
					//obtencion de datos importantes para ingreso de factura
					$fecha=$_POST['fecha'];
					$doc=$_SESSION['dpi'];
					$dpi=$_POST['dpi'];				
					$string = $_POST["gr"];
					//de los datos de la receta se pasan a una matriz, esots viene separados por ; y ,
					$token = strtok($string, ";");				
					while ($token !== false)
						{				
							$mat[$x]=$token;
							$token = strtok(";");
							$x=$x+1;
						}
						//se sigue buscando los datos y a esta matriz se le busca el costo de cada medicamento				
					for ($i=0; $i <$x ; $i++) { 
						$y=0;
						$string2 = $mat[$i];
						$token2 = strtok($string2, ",");				
						while ($token2 !== false)
						{				
							$mat2[$i][$y]=$token2;
							$token2 = strtok(",");
							//obtencion de costos por medicamento
							if($y==0){
								$sqlD = "SELECT costo FROM `medicamento` where codigo=".$mat2[$i][$y]."";
								$resultD = $conn->query($sqlD);
								if($row = $resultD->fetch_assoc()){
									$mat2[$i][3]=$row['costo'];
								}
							}
							//al ser 2, es porque ya termino entonces hace el total de costos por medicamento
							if($y==2){
								$mat2[$i][4]=$mat2[$i][$y]*$mat2[$i][3];
							}									
							$y=$y+1;								
						}
					}
					// obtencion de costo total de la factura
					for ($i=0; $i < $x; $i++) { 
						$tot=$tot+$mat2[$i][4];
					}
					//ya teniendo todos los datos, estos son ingresados a la base de datos
					//ingreso de factura con el monto total
					$sql = "INSERT INTO `receta`(`cod_cliente`, `fecha`, `estado`, `cod_farm`, `costo_tot`,  `cod_doc`) VALUES (".$dpi.",'".$fecha."','pendiente',1,'".$tot."',".$doc.")";
					$result = $conn->query($sql);
					if (!($result == true)) {
						echo $result;
					}	
					//se obtiene el ultimo en la receta para guardar el detalle con ese numero de factura
					$sqlD = "select MAX(codigo) as ma from receta";
					$resultD = $conn->query($sqlD);
					if($row = $resultD->fetch_assoc()){
							$rec=$row['ma'];
					}
					//se ingresa cada mdicamento de la factura
					for ($i=0; $i < $x; $i++) { 
						$sql = "INSERT INTO `detalle`(`cod_med`, `cod_receta`, `dosis`, `cantidad`, `total`) VALUES (".$mat2[$i][0].",".$rec.",'".$mat2[$i][1]."',".$mat2[$i][2].",'".$mat2[$i][4]."');";
						$result = $conn->query($sql);
						if (!($result == true)) {
							echo "Error: "+$result;
						}
					}				
					}
			}            
            echo '<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 ">
            <h1>Historial de recetas</h1>
            ';          
            $error=0;
			$sql = "SELECT receta.codigo, receta.costo_tot,receta.fecha, receta.estado, cliente.nombre, cliente.apellido FROM `receta`,`cliente` WHERE receta.cod_cliente=cliente.dpi AND receta.cod_doc=".$_SESSION['dpi']."";
			echo '<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 ">';
			$result = $conn->query($sql);	
			if ($result->num_rows > 0) {
				$x=0;
				while($row = $result->fetch_assoc()) {					
				$mat2[$x][0]=$row["codigo"];
				$mat2[$x][3]=$row["fecha"];				
				$mat2[$x][1]=$row["costo_tot"];
				$mat2[$x][4]=$row["nombre"]." ".$row["apellido"];
				$mat2[$x][2]=$row["estado"];				
				$x++;
				}
			} else {
				$error=1;
			}
			if($error==0){
			for($i=0;$i<$x;$i++){
				$sql = "SELECT detalle.dosis, detalle.cantidad, medicamento.nombre, medicamento.presentacion, detalle.total FROM `detalle`,`medicamento` WHERE medicamento.codigo=detalle.cod_med AND detalle.cod_receta=".$mat2[$i][0]." ";
				$result = $conn->query($sql);
				echo '<p class="accordion">De: '.$mat2[$i][4].' el: '.$mat2[$i][3].' estado:'.$mat2[$i][2].'</p>
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
			} else {
				echo "0 results";
			}
			echo '<tr><td></td><td></td><td></td><td></td><td><span class="badge badge-success	">Total a pagar: '.$mat2[$i][1].'</span>		</td></tr></table>
                </div>
                
			 <input type="text" name="receta" value="'.$mat2[$i][0].'" hidden>			
                </div>
                
              ';
			}
			}else{

			}			
			$conn->close();	           		
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
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
			if(isset($_GET['cod'])){
				if($_GET['cod']==1){
				$fecha=$_POST['fecha'];
				$doc=$_SESSION['dpi'];
				$dpi=$_POST['dpi'];				
				$string = $_POST["gr"];
				$token = strtok($string, ";");				
				while ($token !== false)
				{				
				$mat[$x]=$token;
				$token = strtok(";");
				$x=$x+1;
				}				
				for ($i=0; $i <$x ; $i++) { 
				$y=0;
				$string2 = $mat[$i];
				$token2 = strtok($string2, ",");				
				while ($token2 !== false)
				{				
				$mat2[$i][$y]=$token2;
				$token2 = strtok(",");
				if($y==0){
					 $sqlD = "SELECT costo FROM `medicamento` where codigo=".$mat2[$i][$y]."";
					 $resultD = $conn->query($sqlD);
					 if($row = $resultD->fetch_assoc()){
						$mat2[$i][3]=$row['costo'];
					 }
				}
				if($y==2){
					$mat2[$i][4]=$mat2[$i][$y]*$mat2[$i][3];
				}									
				$y=$y+1;								
				}
				}
				for ($i=0; $i < $x; $i++) { 
					$tot=$tot+$mat2[$i][4];
				}
				$sql = "INSERT INTO `receta`(`cod_cliente`, `fecha`, `estado`, `cod_farm`, `costo_tot`,  `cod_doc`) VALUES (".$dpi.",'".$fecha."','pendiente',1,'".$tot."',".$doc.")";
				$result = $conn->query($sql);
				if (!($result == true)) {
        			echo $result;
				}	
				$sqlD = "select MAX(codigo) as ma from receta";
				$resultD = $conn->query($sqlD);
				if($row = $resultD->fetch_assoc()){
						$rec=$row['ma'];
				}
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
			$sql = "SELECT receta.codigo, receta.costo_tot,receta.fecha, receta.estado, cliente.nombre, cliente.apellido FROM `receta`,`cliente` WHERE receta.cod_cliente=cliente.dpi AND receta.cod_doc=".$_SESSION['dpi']."";
			echo '<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 ">';
			$result = $conn->query($sql);	
			if ($result->num_rows > 0) {
				$x=0;
				while($row = $result->fetch_assoc()) {	
				$mat[$x][0]=$row["codigo"];$mat[$x][3]=$row["fecha"];
				$mat[$x][1]=$row["costo_tot"];$mat[$x][4]=$row["nombre"]." ".$row["apellido"];
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
				echo '<p class="accordion">De: '.$mat[$i][4].' el: '.$mat[$i][3].' estado:'.$mat[$i][2].'</p>
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
			echo '<tr><td></td><td></td><td></td><td></td><td><span class="badge badge-success	">Total a pagar: '.$mat[$i][1].'</span>		</td></tr></table>
                </div>
                
			 <input type="text" name="receta" value="'.$mat[$i][0].'" hidden>			
                </div>
                
              ';
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
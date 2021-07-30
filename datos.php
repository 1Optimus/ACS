<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CVS</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400"> <!-- Google web font "Open Sans" -->
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css" />
	<link rel="stylesheet" href="css/tooplate-style.css">
	<script>
		var renderPage = true;
	</script>
</head>

<body>
	<div id="loader-wrapper">
		<div id="loader"></div>
	</div>
	<!-- Page Content -->
	<div class="container-fluid tm-main">
		<div class="row tm-main-row">
			<?php include 'barra.php'; 
	include 'cone.php';
	if (isset($_GET["cod"])) {				
		$dpi = $_POST['dpi'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$telefono = $_POST['telefono'];
		$dire = $_POST['direccion'];
		$correo = $_POST['correo'];
		$contra = $_POST['password'];
		if(($_SESSION['quien'])==1){$fecha = $_POST['nacimiento'];}
		 if(($_SESSION['quien'])==1){
			$sql = "UPDATE cliente SET dpi='$dpi', nombre='$nombre',apellido='$apellido',telefono=$telefono,direccion='$dire',correo='$correo',fechaNac='$fecha',contra='$contra' where correo='$_SESSION[usuario]'";			
		}else{
			$sql = "UPDATE doctor SET dpi='$dpi', nombre='$nombre',apellido='$apellido',telefono=$telefono,direccion='$dire',correo='$correo', contra='$contra' where correo='$_SESSION[usuario]'";			
		}		
			if ($conn->query($sql) === TRUE) {
				echo "<script language='javascript'>alert('¡actualizacion realizada con exito!');</script>";
			} else {
				echo "<script language='javascript'>alert('tuvimos un pequeño problema, favor de llamar a servicio tecnico');</script>";							
			}
		}	

	?>
			<div class="col-xl-9 col-lg-8 col-md-12 col-sm-12 tm-content">
				<?php
				//datos personales 
				 if(($_SESSION['quien'])==1){
					$sql = "SELECT * FROM cliente where correo='$_SESSION[usuario]'";
				}else{
					$sql = "SELECT * FROM doctor where correo='$_SESSION[usuario]'";
				}
				
				$result = $conn->query($sql);
				if ($result == true) {
					if ($row = $result->fetch_assoc()) {
					$mat[0]=$row["dpi"];
					$mat[1]=$row["nombre"];
					$mat[2]=$row["apellido"];
					$mat[4]=$row["telefono"];
					$mat[3]=$row["direccion"];
					$mat[6]=$row["correo"];
					if(($_SESSION['quien'])==1){$mat[7]=$row["fechaNac"];}					
					$mat[5]=$row["contra"];
					} else {
						echo "<h1>'Ocurrio un error';</h1>";
					}
				} else {
					echo "<h1>'Ocurrio un error';</h1>";
				}
				?>
		<div class="row">
			<div class="col-xl-11 col-lg-10 col-md-12 col-sm-12 tm-content">
				<div class="media tm-bg-transparent-black tm-border-white">							
					<div class="media-body">
						<form method="post" action="datos.php?cod=1">
							<div class="form-group ">
								<label>Numero de DPI</label>
								<input type="text" name="dpi" value="<?php echo $mat[0];?>" class="campo2"class="form-control" required readonly>
							</div>
							<div class="form-group ">
								<label>Nombre</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<input type="text" name="nombre" value="<?php echo $mat[1];?>" class="campo2"class="form-control"required>
							</div>
							<div class="form-group ">
								<label>Apellido</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<input type="text" name="apellido" value="<?php echo $mat[2];?>"class="campo2" class="form-control"required>
							</div>
							<div class="form-group ">
								<label>Direccion</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<input type="text" name="direccion" value="<?php echo $mat[3];?>"class="campo2" class="form-control"required>
							</div>
							<div class="form-group ">
								<label>Telefono</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<input type="text" name="telefono" value="<?php echo $mat[4];?>" class="campo2"class="form-control"required>
							</div>
							<div class="form-group ">
								<label>Contraseña</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<input type="password" name="password" value="<?php echo $mat[5];?>" class="campo2"class="form-control"required>
							</div>
							<div class="form-group ">
								<label>Correo</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="text" name="correo" value="<?php echo $mat[6];?>" class="campo2"class="form-control"required>
							</div>
							<?php
							if(($_SESSION['quien'])==1){echo '
								<div class="form-group ">
                                <label  >Fecha de Nacimiento</label>
                                <input type="date" name="nacimiento" value="'. $mat[7].'" class="campo"class="form-control">
                            </div>
								';}
							?>							
							<div class="form-group">
								<input  type="submit" class="btn btn-primary" value="Actualizar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- .tm-content -->
	<!-- no quitar -->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
	<script>
		//entrada y barra
		$(window).on("load", function() {
			if (renderPage) {
				$('body').addClass('loaded');
				var bgImg = $("#tmNavLink1").data("bgImg");
				$.backstretch("img/" + bgImg, {
					fade: 500
				});
			}
		});
	</script>
</body>

</html>
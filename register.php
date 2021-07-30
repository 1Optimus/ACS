<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CVS</title>
    <!-- load CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300"> <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="css2/bootstrap.min.css"> <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="fontawesome/css/fontawesome-all.min.css"> <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css2/tooplate-style.css"> <!-- Templatemo style -->
</head>

<body>
    <?php
    if(isset($_GET["cod"])==1){
    include 'cone.php';
    $dpi = $_POST['dpi'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $dire = $_POST['direccion'];
    $correo = $_POST['correo'];
    $contra = $_POST['password'];
    $fecha = $_POST['nacimiento'];
    $sql = "INSERT INTO cliente(dpi,nombre,apellido,telefono,direccion,correo,contra,fechaNac) VALUES('" . $dpi . "','" . $nombre . "','" . $apellido . "','" . $telefono . "','" . $dire . "','" . $correo . "','" . $contra . "','" . $fecha . "');";
    $result = $conn->query($sql);
    if ($result == true) {
        echo "<script>alert('Datos Ingresados');window.location.href='login.php';</script>";
    } else {
        echo "Error: ";
    }
}

    ?>
    <div id="tm-bg"></div>
    <div id="tm-wrap">
        <div class="tm-main-content">
            <div class="container tm-site-header-container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4 tm-site-header-col">
                        <div class="tm-site-header">
                            <h1 class="mb-4">FARMACIA CVS</h1>
                            <img src="img/underline.png" class="img-fluid mb-4">
                            <p>New HTML Template with pop up pages and use this layout for your website</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4 tm-site-header-colp">
                        <form method="post" action="register.php?cod=1">
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Numero de DPI</label>
                                <input type="text" name="dpi" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Nombre</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                <input type="text" name="nombre" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Apellido</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                <input type="text" name="apellido" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Direccion</label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                                <input type="text" name="direccion" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Telefono</label>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="text" name="telefono" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Contraseña</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="password" name="password" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark ">Correo</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="text" name="correo" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group ">
                                <label class="badge badge-pill badge-dark " >Fecha de Nacimiento</label>
                                <input type="date" name="nacimiento" value="" class="campo"class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Registrar">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
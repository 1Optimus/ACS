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
    if(isset($_GET["cod"])){
        if(($_GET["cod"])==1){
include 'cone.php';
    $usuario = $_POST['username'];
    $contra= $_POST['password'];

    $sql = "SELECT nombre, apellido, dpi FROM `cliente` where correo='$usuario' and contra='$contra'";
    $result = $conn->query($sql);

    $sqlD = "SELECT nombre, apellido, dpi FROM `doctor` where correo='$usuario' and contra='$contra'";
    $resultD = $conn->query($sqlD);
            echo $resultD->num_rows;
        if($row = $result->fetch_assoc()){
            session_start();
            $_SESSION['usuario']=$usuario; 
            $_SESSION['quien']='1'; 
            $_SESSION['nombre']=$row['nombre']." ".$row['apellido']; 
            $_SESSION['dpi']=$row['dpi']; 
            echo "<script>alert('Bienvenido $row[nombre] $row[apellido]');window.location.href='receta.php';</script>";
        }else if($row = $resultD->fetch_assoc()){
            echo 'aca2';
            session_start();
            $_SESSION['usuario']=$usuario; 
            $_SESSION['quien']='2'; 
             $_SESSION['nombre']=$row['nombre']." ".$row['apellido']; 
            $_SESSION['dpi']=$row['dpi']; 
            echo "<script>alert('Bienvenido Doctor $row[nombre] $row[apellido]');window.location.href='receta.php';</script>";
    }else{
        echo "<script>alert('Sesion Invalida, verifique los datos ingresados');window.location.href='login.php';</script>";
    }   
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
                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4 tm-site-header-col">
                        <form method="post" action="login.php?cod=1">
                            <div class="form-group ">
                                <label>Correo</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Ingresar">
                            </div>
                            <div >
                            <p class="badge badge-pill badge-primary">¿No tienes una cuenta? <a href="register.php" class="text-warning">Regístrate ahora</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
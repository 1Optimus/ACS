<div id="tmSideBar" class="col-xl-3 col-lg-4 col-md-12 col-sm-12 sidebar">
    <button id="tmMainNavToggle" class="menu-icon">&#9776;</button>
    <div class="inner">
    <?php
    
    session_start();
	if (empty($_SESSION['usuario'])) {
		session_start();
		session_destroy();
		echo "<script>alert('Sesion Invalida, verifique los datos ingresados');window.location.href='login.php';</script>";
	}
    ?>
        <nav id="tmMainNav" class="tm-main-nav">
            <ul>
                <li>
                    <a href="datos.php" id="tmNavLink1" class="scrolly" data-bg-img="constructive_bg_01.jpg" data-page="#tm-section-1">
                        <i class="fas fa-home tm-nav-fa-icon"></i>
                        <span>Mis Datos<?php echo '<p>'.$_SESSION['nombre'] .'</p>'; ?></span>
                    </a>
                </li>
                <?php
                if(($_SESSION['quien'])==1){
                    echo '<li>
                    <a href="Historial.php" class="scrolly" data-bg-img="constructive_bg_03.jpg" data-page="#tm-section-3">
                        <i class="fas fa-users tm-nav-fa-icon"></i>
                        <span>Historial de recetas</span>
                    </a>
                </li>';
                }else{
                    echo '<li>
                    <a href="HistorialDoc.php" class="scrolly" data-bg-img="constructive_bg_03.jpg" data-page="#tm-section-3">
                        <i class="fas fa-users tm-nav-fa-icon"></i>
                        <span>Historial de recetas</span>
                    </a>
                </li>';
                }
                if(($_SESSION['quien'])==1){
                    echo '<li>
                    <a href="receta.php" class="scrolly" data-bg-img="constructive_bg_03.jpg" data-page="#tm-section-3">
                        <i class="fas fa-users tm-nav-fa-icon"></i>
                        <span>Recetas pendientes</span>
                    </a>
                </li>';
                }else{
                    echo '<li>
                    <a href="receta1.php" class="scrolly" data-bg-img="constructive_bg_03.jpg" data-page="#tm-section-3">
                        <i class="fas fa-users tm-nav-fa-icon"></i>
                        <span>Asignar recetas</span>
                    </a>
                </li>';
                }
                ?>						
                <li>
                    <a href="login.php?cod=2" class="scrolly" data-bg-img="constructive_bg_04.jpg" data-page="#tm-section-4">
                        <i class="fas fa-comments tm-nav-fa-icon"></i>
                        <span>Salir</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

			
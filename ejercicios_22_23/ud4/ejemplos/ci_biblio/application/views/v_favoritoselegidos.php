<?php


//Recibe $rtdo_aniadir_favorito: rtdo del último añadido al array de sesión

echo "<hr/>";
if (isset($rtdo_aniadir_favorito))
    echo "<p>$rtdo_aniadir_favorito</p>";


foreach ($_SESSION['librosfavoritos'] as $idlibro){
    echo "<li>$idlibro</li>";
}

if (isset($_SESSION['librosfavoritos']) && count($_SESSION['librosfavoritos'])>0)
    echo "<a href='c_devoluciones/guardarfavoritos' >GUARDAR FAVORITOS </a>";

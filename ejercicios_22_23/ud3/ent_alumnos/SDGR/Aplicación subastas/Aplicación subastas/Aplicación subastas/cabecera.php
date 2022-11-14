<?php ?>
    <header id="header">
        <h1><?php echo $nombre_Foro ?></h1>
    </header>
    <nav id="menu">
        <a href="index.php">Home</a>
            <?php if(!isset($_SESSION["id_usuario"])) :?>
                <a href="login.php">Login</a>
            <?php else :?>
                <a href="logout.php">Logout</a>
                <a href="nuevoitem.php">Nuevo Item</a>
            <?php endif; ?>
        </ul>
    </nav>
<?php ?>
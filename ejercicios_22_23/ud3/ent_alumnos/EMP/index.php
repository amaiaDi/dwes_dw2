<?php require 'php/cabecera.php'; ?>
<body>
    <h2>Items Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>IMAGEN</th>
                <th>ITEM</th>
                <th>PUJAS</th>
                <th>PRECIO</th>
                <th>PUJAS HASTA</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if (isset($_GET['id']))
                    rellenarTabla($conn, $_GET['id']);
                else 
                    rellenarTabla($conn, -1);
            ?>
        </tbody>
    </table>
    <?php 
        // Cerrar Container y Main
            echo "</div>";
        echo "</div>";
    ?>
</body>
</html>

<?php

include_once("config.php");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
mysqli_select_db($conn, DB_DATABASE);

$sql = "SELECT categoria as d FROM categorias";

$resultado= $conn->query($sql);
print "<h2>CATEGORIAS</h2>";
print "<ul>";
print "<li><a href='index.php'>ver todas</a></li>";
while($fila = $resultado -> fetch_assoc()){ 
    echo "<li><a href='index.php?categoria=$fila[d]'>$fila[d]</a></li>";
}      
print "</ul>";
$conn->close();


?>
